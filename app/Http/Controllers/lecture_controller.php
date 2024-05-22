<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    lecture,
    prodi,
    fakultas,
    User,
    position,
    default_province,
    default_regenci,
    bank
};
use Helper;
use Illuminate\Support\Facades\Crypt;
use DataTables;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Hash;

// Excel

use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Modules\Guilds\Entities\Guild;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\IOFactory;


class lecture_controller extends Controller
{
    public function index(){
        $data = [
            'menu' => 'dosen',
            'submenu' => 'lecture',
            'fakultas' => fakultas::all(),
            'prodi' => prodi::all(),
            'position' => position::all(),
            'default_province' => default_province::all(),
            'bank' => bank::all(),
        ];

        return view('user.admin.lecture.index',$data);
    }
    public function get_data(Request $request){
        if ($request->ajax()) {
            $data = lecture::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('nidn', function($row){
                    $yohohoho = Helper::yohohoho($row->place_birth);
                    $nidn = Helper::haha($yohohoho,$row->nidn);
                    return $nidn;
                })
                ->addColumn('name', function($row){
                    $yohohoho = Helper::yohohoho($row->place_birth);
                    $name = Helper::haha($yohohoho,$row->name);
                    return $name;
                })
                ->addColumn('email', function($row){
                    $yohohoho = Helper::yohohoho($row->place_birth);
                    $email = Helper::haha($yohohoho,$row->email);
                    return $email;
                })
                ->addColumn('jabatan', function($row){
                    $jabatans = position::find($row->id_position);
                    $yohohoho = Helper::yohohoho($jabatans->desc);
                    $jabatan = Helper::haha($yohohoho,$jabatans->name);
                    return $jabatan;
                })
                ->addColumn('prodi', function($row){
                    $prodis = prodi::find($row->id_prodi);
                    return $prodis->name;
                })
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    if($row->is_deleted == 'Y'){
                        $actionBtn = '  <button class="btn btn-sm btn-info text-white detail" data-bs-toggle="modal" data-bs-target="#detail_modal" value="'.$row->id.'">
                                            <i class="fa fa-info"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="'.$row->id.'">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger hapus" value="'.$row->id.'" disabled>
                                            <i class="fa fa-trash"></i>
                                        </button>';
                    }else{
                        $actionBtn = '  <button class="btn btn-sm btn-info text-white detail" data-bs-toggle="modal" data-bs-target="#detail_modal" value="'.$row->id.'">
                                            <i class="fa fa-info"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="'.$row->id.'">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger hapus" value="'.$row->id.'">
                                            <i class="fa fa-trash"></i>
                                        </button>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function store(Request $request){
        $hehe = Helper::D();

        $haha = Crypt::encryptString($hehe);

        $lecture = new lecture();
        $lecture->id_prodi = $request->id_prodi;
        $lecture->id_position = $request->id_position;
        $lecture->nidn = Helper::hehe($hehe,$request->nidn);
        $lecture->name = Helper::hehe($hehe,$request->name);
        $lecture->email = Helper::hehe($hehe,$request->email);
        $lecture->phone = Helper::hehe($hehe,$request->phone);
        $lecture->gender = Helper::hehe($hehe,$request->gender);
        $lecture->position = Helper::hehe($hehe,$request->position);
        $lecture->address = Helper::hehe($hehe,$request->address);
        $lecture->agama = Helper::hehe($hehe,$request->agama);
        $lecture->status_perkawinan = Helper::hehe($hehe,$request->status_perkawinan);
        $lecture->date_birth = Helper::hehe($hehe,$request->date_birth);
        $lecture->place_birth = $haha;
        if($request->image == true){
            $file_name = "user_".uniqid().".".$request->image->extension();
            $request->image->move(public_path('image/user'),$file_name);
            $lecture->image = $file_name;
        }
        $lecture->tahun_masuk = Helper::hehe($hehe,$request->tahun_masuk);
        $lecture->nik = Helper::hehe($hehe,$request->nik);
        $lecture->tempat_lahir = Helper::hehe($hehe,$request->tempat_lahir);
        $lecture->rt = Helper::hehe($hehe,$request->rt);
        $lecture->rw = Helper::hehe($hehe,$request->rw);
        $lecture->province = Helper::hehe($hehe,$request->province);
        $lecture->regency = Helper::hehe($hehe,$request->regency);
        $lecture->district = Helper::hehe($hehe,$request->district);
        $lecture->village= Helper::hehe($hehe,$request->village);
        $lecture->kode_pos = Helper::hehe($hehe,$request->kode_pos);
        $lecture->no_kk = Helper::hehe($hehe,$request->no_kk);
        $lecture->no_npwp = Helper::hehe($hehe,$request->no_npwp);
        $lecture->nama_npwp = Helper::hehe($hehe,$request->nama_npwp);
        $lecture->nama_pasangan = Helper::hehe($hehe,$request->nama_pasangan);
        $lecture->nik_pasangan = Helper::hehe($hehe,$request->nik_pasangan);
        $lecture->jml_anak = Helper::hehe($hehe,$request->jml_anak);
        $lecture->nama_rekening = Helper::hehe($hehe,$request->nama_rekening);
        $lecture->no_rek = Helper::hehe($hehe,$request->no_rek);
        $lecture->bank = Helper::hehe($hehe,$request->bank);
        $lecture->no_telp = Helper::hehe($hehe,$request->no_telp);
        $lecture->pekerjaan_pasangan = Helper::hehe($hehe,$request->pekerjaan_pasangan);
        $lecture->pendidikan_terakhir = Helper::hehe($hehe,$request->pendidikan_terakhir);

        $lecture->save();

        $date_birth = date('dmy',strtotime($request->date_birth));

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->name;
        $user->email = $request->email;
        $user->status = "AKTIF";
        $user->password = Hash::make($date_birth);
        $user->role = "5";
        if($request->image == true){
            $user->profile_image = $lecture->image;
        }
        $user->status = "done";
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->agama = $request->agama;
        $user->save();

        $lecture->id_user = $user->id;
        $lecture->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function show($id){
        $lectures = lecture::find($id);

        $lecture = array();

        $jabatans = position::find($lectures->id_position);
        $yohohoho = Helper::yohohoho($jabatans->desc);
        $jabatan = Helper::haha($yohohoho,$jabatans->name);
        $lecture['jabatan'] = $jabatan;

        $prodis = prodi::find($lectures->id_prodi);
        $lecture['prodi'] = $prodis->name;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $nidn = Helper::haha($yohohoho,$lectures->nidn);
        $lecture['nidn'] = $nidn;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $name = Helper::haha($yohohoho,$lectures->name);
        $lecture['name'] = $name;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $gender = Helper::haha($yohohoho,$lectures->gender);
        $lecture['gender'] = $gender;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $nidn = Helper::haha($yohohoho,$lectures->nidn);
        $lecture['nidn'] = $nidn;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $address = Helper::haha($yohohoho,$lectures->address);
        $lecture['address'] = $address;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $status_perkawinan = Helper::haha($yohohoho,$lectures->status_perkawinan);
        $lecture['status_perkawinan'] = $status_perkawinan;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $agama = Helper::haha($yohohoho,$lectures->agama);
        $lecture['agama'] = $agama;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $email = Helper::haha($yohohoho,$lectures->email);
        $lecture['email'] = $email;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $phone = Helper::haha($yohohoho,$lectures->phone);
        $lecture['phone'] = $phone;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $tahun_masuk = Helper::haha($yohohoho,$lectures->tahun_masuk);
        $lecture['tahun_masuk'] = $tahun_masuk;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $date_birth = Helper::haha($yohohoho,$lectures->date_birth);
        $lecture['date_birth'] = date('d F Y',strtotime($date_birth));

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $tgl_lahir = Helper::haha($yohohoho,$lectures->date_birth);
        $lecture['tgl_lahir'] = $tgl_lahir;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $id_position = $lectures->id_position;
        $lecture['id_position'] = $id_position;


        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $nik = Helper::haha($yohohoho,$lectures->nik);
        $lecture['nik'] = $nik;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $tempat_lahir = Helper::haha($yohohoho,$lectures->tempat_lahir);
        $lecture['tempat_lahir'] = $tempat_lahir;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $rt = Helper::haha($yohohoho,$lectures->rt);
        $lecture['rt'] = $rt;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $rw = Helper::haha($yohohoho,$lectures->rw);
        $lecture['rw'] = $rw;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $province = Helper::haha($yohohoho,$lectures->province);
        $lecture['province'] = $province;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $regency = Helper::haha($yohohoho,$lectures->regency);
        $lecture['regency'] = $regency;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $district = Helper::haha($yohohoho,$lectures->district);
        $lecture['district'] = $district;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $village = Helper::haha($yohohoho,$lectures->village);
        $lecture['village'] = $village;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $kode_pos = Helper::haha($yohohoho,$lectures->kode_pos);
        $lecture['kode_pos'] = $kode_pos;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $no_kk = Helper::haha($yohohoho,$lectures->no_kk);
        $lecture['no_kk'] = $no_kk;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $no_npwp = Helper::haha($yohohoho,$lectures->no_npwp);
        $lecture['no_npwp'] = $no_npwp;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $nama_npwp = Helper::haha($yohohoho,$lectures->nama_npwp);
        $lecture['nama_npwp'] = $nama_npwp;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $nama_pasangan = Helper::haha($yohohoho,$lectures->nama_pasangan);
        $lecture['nama_pasangan'] = $nama_pasangan;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $nik_pasangan = Helper::haha($yohohoho,$lectures->nik_pasangan);
        $lecture['nik_pasangan'] = $nik_pasangan;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $pekerjaan_pasangan = Helper::haha($yohohoho,$lectures->pekerjaan_pasangan);
        $lecture['pekerjaan_pasangan'] = $pekerjaan_pasangan;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $jml_anak = Helper::haha($yohohoho,$lectures->jml_anak);
        $lecture['jml_anak'] = $jml_anak;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $nama_rekening = Helper::haha($yohohoho,$lectures->nama_rekening);
        $lecture['nama_rekening'] = $nama_rekening;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $no_rek = Helper::haha($yohohoho,$lectures->no_rek);
        $lecture['no_rek'] = $no_rek;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $bank = Helper::haha($yohohoho,$lectures->bank);
        $lecture['bank'] = $bank;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $no_telp = Helper::haha($yohohoho,$lectures->no_telp);
        $lecture['no_telp'] = $no_telp;

        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $pendidikan_terakhir = Helper::haha($yohohoho,$lectures->pendidikan_terakhir);
        $lecture['pendidikan_terakhir'] = $pendidikan_terakhir;

        $img = $lectures->image;
        return response()->json(
            [
                'data' => $lecture,
                'img' => $img,
            ],
            200
        );
    }
    public function update(Request $request,$id){
        $hehe = Helper::D();

        $haha = Crypt::encryptString($hehe);

        $lecture = lecture::find($id);
        $lecture->id_prodi = $request->id_prodi;
        $lecture->id_position = $request->id_position;
        $lecture->name = Helper::hehe($hehe,$request->name);
        $lecture->nidn = Helper::hehe($hehe,$request->nidn);
        $lecture->email = Helper::hehe($hehe,$request->email);
        $lecture->phone = Helper::hehe($hehe,$request->phone);
        $lecture->gender = Helper::hehe($hehe,$request->gender);
        $lecture->position = Helper::hehe($hehe,$request->position);
        $lecture->address = Helper::hehe($hehe,$request->address);
        $lecture->agama = Helper::hehe($hehe,$request->agama);
        $lecture->status_perkawinan = Helper::hehe($hehe,$request->status_perkawinan);
        $lecture->date_birth = Helper::hehe($hehe,$request->date_birth);
        $lecture->place_birth = $haha;
        if($request->image == true){
            $file_name = "user_".uniqid().".".$request->image->extension();
            $request->image->move(public_path('image/user'),$file_name);
            $lecture->image = $file_name;
        }
        $lecture->tahun_masuk = Helper::hehe($hehe,$request->tahun_masuk);
        $lecture->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function destroy($id){
        $lecture = lecture::find($id);

        $yohohoho = Helper::yohohoho($lecture->place_birth);
        $id_user = $lecture->id_user;

        if (File::exists(public_path('image/user/'.$lecture->image))) {
            File::delete(public_path('image/user/'.$lecture->image));
        }
        $user = User::find($id_user);
        $lecture->delete();
        $user->delete();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }

    public function download_excel_form(){
        $jabatan = position::all();

        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load(public_path('excel\form_import_dosen.xlsx'));
        // set main data
        $spreadsheet->setActiveSheetIndex(1);
        $sheet = $spreadsheet->getActiveSheet();
        $baris = 3;
        foreach($jabatan as $row){
            $yohohoho = Helper::yohohoho($row->desc);
            $jabatan = Helper::haha($yohohoho,$row->name);
            $sheet->setCellValue('A'.$baris,$jabatan);
            $baris++;
        }
        $prodi = prodi::where('id','!=','1')->get();
        $baris = 3;
        foreach($prodi as $row){
            $sheet->setCellValue('E'.$baris,$row->name);
            $baris++;
        }

        $spreadsheet->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Form Import Dosen.xlsx"');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        return $writer->save('php://output');
    }
    public function import_data(Request $request){
        $file = $request->file('excel');
        $reader = IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($file);
        $import = [$spreadsheet->setActiveSheetIndex(0)->toArray(null, true, true, true)];
        // dd($import);
        for($i=6;$i<count($import[0]);$i++){
            // Insert Soal
            if($import[0][$i]['B'] == true){
                $position_name = $import[0][$i]['D'];
                $positions = position::all();
                foreach($positions as $row){
                    $jabatans = position::find($row->id);
                    $yohohoho = Helper::yohohoho($jabatans->desc);
                    $jabatan = Helper::haha($yohohoho,$jabatans->name);
                    // dd($jabatan);
                    if($jabatan == $position_name){
                        $id_position = $row->id;
                        break;
                    }else{
                        $id_position = "";
                    }
                }
                $prodi_name = $import[0][$i]['AH'];
                $prodis = prodi::where('name',$prodi_name)->first();
                $id_prodi = $prodis->id;

                $hehe = Helper::D();

                $haha = Crypt::encryptString($hehe);

                $lecture = new lecture();
                $lecture->place_birth = $haha;

                $lecture->nidn = Helper::hehe($hehe,$import[0][$i]['B']);
                $lecture->name = Helper::hehe($hehe,$import[0][$i]['C']);
                $lecture->id_position = $id_position;
                $lecture->id_prodi = $id_prodi;
                $lecture->position = Helper::hehe($hehe,$import[0][$i]['D']);
                $lecture->gender = Helper::hehe($hehe,$import[0][$i]['E']);
                $lecture->email = Helper::hehe($hehe,$import[0][$i]['F']);
                $lecture->nik = Helper::hehe($hehe,$import[0][$i]['G']);
                $lecture->no_kk = Helper::hehe($hehe,$import[0][$i]['H']);
                $lecture->bank = Helper::hehe($hehe,$import[0][$i]['I']);
                $lecture->nama_rekening = Helper::hehe($hehe,$import[0][$i]['J']);
                $lecture->no_rek = Helper::hehe($hehe,$import[0][$i]['K']);
                $lecture->province = Helper::hehe($hehe,$import[0][$i]['L']);
                $lecture->regency = Helper::hehe($hehe,$import[0][$i]['M']);
                $lecture->district = Helper::hehe($hehe,$import[0][$i]['N']);
                $lecture->village = Helper::hehe($hehe,$import[0][$i]['O']);
                $lecture->rt = Helper::hehe($hehe,$import[0][$i]['P']);
                $lecture->rw = Helper::hehe($hehe,$import[0][$i]['Q']);
                $lecture->kode_pos = Helper::hehe($hehe,$import[0][$i]['R']);
                $lecture->address = Helper::hehe($hehe,$import[0][$i]['S']);
                $lecture->phone = Helper::hehe($hehe,$import[0][$i]['T']);
                $lecture->no_telp = Helper::hehe($hehe,$import[0][$i]['U']);
                $lecture->tempat_lahir = Helper::hehe($hehe,$import[0][$i]['V']);

                $UNIX_DATE = ($import[0][$i]["W"] - 25569) * 86400;
                $date =  gmdate("Y-m-d", $UNIX_DATE);
                $lecture->date_birth = Helper::hehe($hehe,$date);

                $lecture->tahun_masuk = Helper::hehe($hehe,$import[0][$i]['X']);
                $lecture->pendidikan_terakhir = Helper::hehe($hehe,$import[0][$i]['Y']);
                $lecture->agama = Helper::hehe($hehe,$import[0][$i]['Z']);
                $lecture->status_perkawinan = Helper::hehe($hehe,$import[0][$i]['AA']);
                $lecture->nik_pasangan = Helper::hehe($hehe,$import[0][$i]['AB']);
                $lecture->nama_pasangan = Helper::hehe($hehe,$import[0][$i]['AC']);
                $lecture->pekerjaan_pasangan = Helper::hehe($hehe,$import[0][$i]['AD']);
                $lecture->jml_anak = Helper::hehe($hehe,$import[0][$i]['AE']);
                $lecture->nama_npwp = Helper::hehe($hehe,$import[0][$i]['AF']);
                $lecture->no_npwp = Helper::hehe($hehe,$import[0][$i]['AG']);

                $lecture->save();

                $date_birth = date('dmy',strtotime($date));

                $user = new User();
                $user->name = $import[0][$i]['C'];
                $user->username = $import[0][$i]['C'];
                $user->email = $import[0][$i]['F'];
                $user->password = Hash::make($date_birth);
                $user->role = "5";
                $user->status = "done";
                $user->address = $import[0][$i]['S'];
                $user->phone = $import[0][$i]['T'];
                $user->agama = $import[0][$i]['Z'];
                $user->save();

                $lecture->id_user =$user->id;
                $lecture->save();
            }else{
                break;
            }
        }

        return back()->with('msg','Import Data Berhasil');

    }
}
