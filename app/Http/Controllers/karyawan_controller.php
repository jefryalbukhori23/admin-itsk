<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Models\{
    karyawan,
    prodi,
    fakultas,
    User,
    position,
    default_province,
    default_regenci,
    bank,
    pekerjaan_karyawan,
};
use Helper;
use Illuminate\Support\Facades\Crypt;
use DataTables;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Hash;



class karyawan_controller extends Controller
{
    public function index(){
        $data = [
            'menu' => 'karyawan',
            'submenu' => 'karyawan',
            'bank' => bank::all(),
            'pekerjaan_karyawan' => pekerjaan_karyawan::all(),
            'prodi' => prodi::all(),
            'position' => position::all(),
            'default_province' => default_province::all(),
        ];

        return view('user.admin.karyawan.index',$data);
    }
    public function get_data(Request $request){
        if ($request->ajax()) {
            $data = karyawan::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('pekerjaan', function($row){
                    $pekerjaan_karyawan = pekerjaan_karyawan::find($row->id_pekerjaan_karyawan);
                    return $pekerjaan_karyawan->name;
                })
                ->addColumn('action', function($row){
                    if($row->allow_delete == 'Y'){
                        $actionBtn = '  <button class="btn btn-sm btn-info text-white detail" data-bs-toggle="modal" data-bs-target="#detail_modal" value="'.$row->id.'">
                                            <i class="fa fa-info"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="'.$row->id.'">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger hapus" value="'.$row->id.'">
                                            <i class="fa fa-trash"></i>
                                        </button>';
                    }else{
                        $actionBtn = '  <button class="btn btn-sm btn-info text-white detail" data-bs-toggle="modal" data-bs-target="#detail_modal" value="'.$row->id.'">
                                            <i class="fa fa-info"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="'.$row->id.'">
                                            <i class="fa fa-edit"></i>
                                        </button>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function store(Request $request){
        $karyawan = new karyawan();
        $karyawan->nik = $request->nik;
        $karyawan->name = $request->name;
        $karyawan->id_pekerjaan_karyawan = $request->id_pekerjaan_karyawan;
        $karyawan->bank = $request->bank;
        $karyawan->nama_rekening = $request->nama_rekening;
        $karyawan->no_rek = $request->no_rek;
        $karyawan->province = $request->province;
        $karyawan->regency = $request->regency;
        $karyawan->district = $request->district;
        $karyawan->village = $request->village;
        $karyawan->rt = $request->rt;
        $karyawan->rw = $request->rw;
        $karyawan->kode_pos = $request->kode_pos;
        $karyawan->address = $request->address;
        $karyawan->agama = $request->agama;
        $karyawan->gender = $request->gender;
        $karyawan->status_perkawinan = $request->status_perkawinan;
        $karyawan->phone = $request->phone;
        $karyawan->email = $request->email;
        $karyawan->tempat_lahir = $request->tempat_lahir;
        $karyawan->tgl_lahir = $request->date_birth;
        $karyawan->tahun_masuk = $request->tahun_masuk;
        $karyawan->pendidikan_terakhir = $request->pendidikan_terakhir;
        $karyawan->jml_anak = $request->jml_anak;
        $karyawan->no_npwp = $request->no_npwp;
        $karyawan->nama_npwp = $request->nama_npwp;
        $karyawan->id_user_create = auth()->user()->id;

        if($request->image == true){
            $file_name = "karyawan_".uniqid().".".$request->image->extension();
            $request->image->move(public_path('image/user'),$file_name);
            $karyawan->image = $file_name;
        }

        $karyawan->save();

        // $date_birth = date('dmy',strtotime($request->date_birth));

        // $user = new User();
        // $user->name = Helper::hehe($hehe,$request->name);
        // $user->username = Helper::hehe($hehe,$request->name);
        // $user->email = $request->email;
        // $user->password = Hash::make($date_birth);
        // $user->role = "5";
        // if($request->image == true){
        //     $user->profile_image = $karyawan->image;
        // }
        // $user->status = "done";
        // $user->address = $karyawan->address;
        // $user->phone = $karyawan->phone;
        // $user->agama = $karyawan->agama;
        // $user->save();

        // $karyawan->id_user = $user->id;
        $karyawan->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function show($id){
        $karyawan = karyawan::find($id);
        $img = $karyawan->image;
        $pekerjaan = pekerjaan_karyawan::find($karyawan->id_pekerjaan_karyawan);
        return response()->json(
            [
                'data' => $karyawan,
                'img' => $img,
                'pekerjaan' => $pekerjaan->name,
            ],
            200
        );
    }
    public function update(Request $request,$id){
        $karyawan = karyawan::find($id);
        $karyawan->nik = $request->nik;
        $karyawan->name = $request->name;
        $karyawan->id_pekerjaan_karyawan = $request->id_pekerjaan_karyawan;
        $karyawan->bank = $request->bank;
        $karyawan->nama_rekening = $request->nama_rekening;
        $karyawan->no_rek = $request->no_rek;
        $karyawan->province = $request->province;
        $karyawan->regency = $request->regency;
        $karyawan->district = $request->district;
        $karyawan->village = $request->village;
        $karyawan->rt = $request->rt;
        $karyawan->rw = $request->rw;
        $karyawan->kode_pos = $request->kode_pos;
        $karyawan->address = $request->address;
        $karyawan->agama = $request->agama;
        $karyawan->gender = $request->gender;
        $karyawan->status_perkawinan = $request->status_perkawinan;
        $karyawan->phone = $request->phone;
        $karyawan->email = $request->email;
        $karyawan->tempat_lahir = $request->tempat_lahir;
        $karyawan->tgl_lahir = $request->date_birth;
        $karyawan->tahun_masuk = $request->tahun_masuk;
        $karyawan->pendidikan_terakhir = $request->pendidikan_terakhir;
        $karyawan->jml_anak = $request->jml_anak;
        $karyawan->no_npwp = $request->no_npwp;
        $karyawan->nama_npwp = $request->nama_npwp;
        $karyawan->id_user_create = auth()->user()->id;

        if($request->image == true){
            $file_name = "karyawan_".uniqid().".".$request->image->extension();
            $request->image->move(public_path('image/user'),$file_name);
            $karyawan->image = $file_name;
        }
        $karyawan->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function destroy($id){
        $karyawan = karyawan::find($id);

        $yohohoho = Helper::yohohoho($karyawan->place_birth);
        $id_user = $karyawan->id_user;

        if (File::exists(public_path('image/user/'.$karyawan->image))) {
            File::delete(public_path('image/user/'.$karyawan->image));
        }
        $user = User::find($id_user);
        $karyawan->delete();
        $user->delete();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }

    public function download_excel_form(){
        $pekerjaan_karyawan = pekerjaan_karyawan::all();

        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load(public_path('excel\form_import_karyawan.xlsx'));
        // set main data
        $spreadsheet->setActiveSheetIndex(1);
        $sheet = $spreadsheet->getActiveSheet();
        $baris = 4;
        foreach($pekerjaan_karyawan as $row){
            $sheet->setCellValue('A'.$baris,$row->name);
            $baris++;
        }
        $bank = bank::all();
        $baris = 4;
        foreach($bank as $row){
            $sheet->setCellValue('E'.$baris,$row->code.' - '.$row->name);
            $baris++;
        }

        $spreadsheet->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Form Import Karyawan.xlsx"');
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
                $pekerjaan_karyawans = pekerjaan_karyawan::where('name',$import[0][$i]['D'])->first();
                if($pekerjaan_karyawans){
                    $id_pekerjaan_karyawan = $pekerjaan_karyawans->id;
                }else{
                    $id_pekerjaan_karyawan = 0;
                }

                $karyawan = new karyawan();

                $karyawan->nik                      = $import[0][$i]['B'];
                $karyawan->nama_rekening            = $import[0][$i]['C'];
                $karyawan->name                     = $import[0][$i]['C'];
                $karyawan->id_pekerjaan_karyawan    = $id_pekerjaan_karyawan;
                $karyawan->email                    = $import[0][$i]['E'];
                $karyawan->gender                   = $import[0][$i]['F'];
                $karyawan->tempat_lahir             = $import[0][$i]['G'];
                $karyawan->tgl_lahir                = $import[0][$i]['H'];
                $karyawan->phone                    = $import[0][$i]['I'];
                $karyawan->status_perkawinan        = $import[0][$i]['J'];
                $karyawan->agama                    = $import[0][$i]['K'];
                $karyawan->address                  = $import[0][$i]['L'];
                $karyawan->bank                     = $import[0][$i]['M'];
                $karyawan->no_rek                   = $import[0][$i]['N'];
                $karyawan->province                 = "-";
                $karyawan->regency                  = "-";
                $karyawan->district                 = "-";
                $karyawan->village                  = "-";
                $karyawan->rt                       = "-";
                $karyawan->rw                       = "-";
                $karyawan->kode_pos                 = "-";
                $karyawan->nama_npwp                = $import[0][$i]['O'];
                $karyawan->no_npwp                  = $import[0][$i]['P'];
                $karyawan->tahun_masuk              = $import[0][$i]['R'];
                $karyawan->jml_anak                 = $import[0][$i]['Q'];
                $karyawan->pendidikan_terakhir      = $import[0][$i]['S'];
                $karyawan->id_user_create           = auth()->user()->id;

                $karyawan->save();

                // $UNIX_DATE = ($import[0][$i]["W"] - 25569) * 86400;
                // $date =  gmdate("Y-m-d", $UNIX_DATE);
                // $date_birth = date('dmy',strtotime($date));

                // $user = new User();
                // $user->name = Helper::hehe($hehe,$import[0][$i]['C']);
                // $user->username = Helper::hehe($hehe,$import[0][$i]['C']);
                // $user->email = $import[0][$i]['F'];
                // $user->password = Hash::make($date_birth);
                // $user->role = "5";
                // $user->status = "done";
                // $user->address = $karyawan->address;
                // $user->phone = $karyawan->phone;
                // $user->agama = $karyawan->agama;
                // $user->save();

                // $karyawan->id_user =$user->id;
                $karyawan->save();
            }else{
                break;
            }
        }

        return back()->with('msg','Import Data Berhasil');

    }
}
