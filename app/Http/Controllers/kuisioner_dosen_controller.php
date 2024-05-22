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
    kuisioner_dosen,
    kuisioner_dosen_soal,
    kuisioner_mahasiswa,
    kuisioner_mahasiswa_detail,
    prodi,
    fakultas,
    User,
    position,
    default_province,
    default_regenci,
    bank,
    batch_year,
    sub_by,
    mahasiswa,
    lecture,
    lesson,
};
use Helper;
use Illuminate\Support\Facades\Crypt;
use DataTables;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Hash;



class kuisioner_dosen_controller extends Controller
{
    public function index(){
        $data = [
            'menu' => 'master3',
            'submenu' => 'kuisioner_dosen',
            'by' => batch_year::all(),
            'lecture' => lecture::all(),
        ];

        return view('user.admin.kuisioner_dosen.index',$data);
    }
    public function get_soal_kuisioner_dosen(Request $request){
        if ($request->ajax()) {
            $data = kuisioner_dosen_soal::where('id_kuisioner','1')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('soal', function($row){
                    return $row->soal;
                })
                ->addColumn('action', function($row){
                    if($row->allow_delete == 'Y'){
                        $actionBtn = ' <button class="btn btn-sm btn-danger hapus" value="'.$row->id.'">
                                            <i class="fa fa-trash"></i>
                                        </button>';
                    }else{
                        $actionBtn = '  <button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="'.$row->id.'">
                                            <i class="fa fa-edit"></i>
                                        </button>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action','soal'])
                ->make(true);
        }
    }
    public function get_hasil_kuisioner_dosen(Request $request,$id_by,$semester,$id_lecture){
        if ($request->ajax()) {
            if($id_by == 'null' && $semester == 'null' && $id_lecture == 'null'){
                $data = [];
            }else{
                if($semester == "all" && $id_lecture == "all"){
                    $data = kuisioner_mahasiswa::where([
                        'id_kuisioner_dosen' => '1',
                        'id_batch_year' => $id_by,
                    ])->latest()->get();
                }elseif($semester == "all" && $id_lecture != "all"){
                    $data = kuisioner_mahasiswa::where([
                        'id_kuisioner_dosen' => '1',
                        'id_batch_year' => $id_by,
                        'id_lecture' => $id_lecture,
                    ])->latest()->get();
                }elseif($semester != "all" && $id_lecture == "all"){
                    $data = kuisioner_mahasiswa::where([
                        'id_kuisioner_dosen' => '1',
                        'id_batch_year' => $id_by,
                        'semester' => $semester,
                    ])->latest()->get();
                }elseif($semester != "all" && $id_lecture != "all"){
                    $data = kuisioner_mahasiswa::where([
                        'id_kuisioner_dosen' => '1',
                        'id_batch_year' => $id_by,
                        'semester' => $semester,
                        'id_lecture' => $id_lecture,
                    ])->latest()->get();
                }

            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('by', function($row){
                    $by = batch_year::find($row->id_batch_year);
                    return $by->name;
                })
                ->addColumn('mahasiswa', function($row){
                    $mahasiswa = mahasiswa::find($row->id_mahasiswa);
                    return $mahasiswa->name;
                })
                ->addColumn('dosen', function($row){
                    $lecture = lecture::find($row->id_lecture);
                    $yohohoho = Helper::yohohoho($lecture->place_birth);
                    $name = Helper::haha($yohohoho,$lecture->name);
                    return $name;
                })
                ->addColumn('nilai', function($row){
                    if($row->total_skor > 83){
                        $nilai = '<span class="badge bg-success text-white">'.$row->total_skor.'</span> '. $row->desc_skor;
                    }else{
                        $nilai = '<span class="badge bg-danger text-white">'.$row->total_skor.'</span> '. $row->desc_skor;
                    }
                    return $nilai;
                })
                ->addColumn('action', function($row){
                    if($row->allow_delete == 'Y'){
                        $actionBtn = ' <button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="'.$row->id.'">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger hapus" value="'.$row->id.'">
                                            <i class="fa fa-trash"></i>
                                        </button>';
                    }else{
                        $actionBtn = '  <button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="'.$row->id.'">
                                            <i class="fa fa-edit"></i>
                                        </button>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action','nilai'])
                ->make(true);
        }
    }
    public function store(Request $request){
        $kuisioner_dosen = new kuisioner_dosen_soal();
        $kuisioner_dosen->id_kuisioner = '1';
        $kuisioner_dosen->no = $request->no;
        $kuisioner_dosen->soal = $request->soal;
        $kuisioner_dosen->kategori = $request->kategori;
        $kuisioner_dosen->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function update(Request $request,$id){
        $kuisioner_dosen = kuisioner_dosen::find($id);
        $kuisioner_dosen->id_kuisioner = '1';
        $kuisioner_dosen->no = $request->no;
        $kuisioner_dosen->soal = $request->soal;
        $kuisioner_dosen->kategori = $request->kategori;
        $kuisioner_dosen->save();
        $kuisioner_dosen->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function destroy($id){
        $kuisioner_dosen = kuisioner_dosen_soal::find($id);
        $kuisioner_dosen->delete();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }

    public function download_excel_form(){
        $pekerjaan_kuisioner_dosen = pekerjaan_kuisioner_dosen::all();

        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load(public_path('excel\form_import_kuisioner_dosen.xlsx'));
        // set main data
        $spreadsheet->setActiveSheetIndex(1);
        $sheet = $spreadsheet->getActiveSheet();
        $baris = 4;
        foreach($pekerjaan_kuisioner_dosen as $row){
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
        header('Content-Disposition: attachment;filename="Form Import kuisioner_dosen.xlsx"');
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
                $pekerjaan_kuisioner_dosens = pekerjaan_kuisioner_dosen::where('name',$import[0][$i]['D'])->first();
                if($pekerjaan_kuisioner_dosens){
                    $id_pekerjaan_kuisioner_dosen = $pekerjaan_kuisioner_dosens->id;
                }else{
                    $id_pekerjaan_kuisioner_dosen = 0;
                }

                $kuisioner_dosen = new kuisioner_dosen();

                $kuisioner_dosen->nik                      = $import[0][$i]['B'];
                $kuisioner_dosen->nama_rekening            = $import[0][$i]['C'];
                $kuisioner_dosen->name                     = $import[0][$i]['C'];
                $kuisioner_dosen->id_pekerjaan_kuisioner_dosen    = $id_pekerjaan_kuisioner_dosen;
                $kuisioner_dosen->email                    = $import[0][$i]['E'];
                $kuisioner_dosen->gender                   = $import[0][$i]['F'];
                $kuisioner_dosen->tempat_lahir             = $import[0][$i]['G'];
                $kuisioner_dosen->tgl_lahir                = $import[0][$i]['H'];
                $kuisioner_dosen->phone                    = $import[0][$i]['I'];
                $kuisioner_dosen->status_perkawinan        = $import[0][$i]['J'];
                $kuisioner_dosen->agama                    = $import[0][$i]['K'];
                $kuisioner_dosen->address                  = $import[0][$i]['L'];
                $kuisioner_dosen->bank                     = $import[0][$i]['M'];
                $kuisioner_dosen->no_rek                   = $import[0][$i]['N'];
                $kuisioner_dosen->province                 = "-";
                $kuisioner_dosen->regency                  = "-";
                $kuisioner_dosen->district                 = "-";
                $kuisioner_dosen->village                  = "-";
                $kuisioner_dosen->rt                       = "-";
                $kuisioner_dosen->rw                       = "-";
                $kuisioner_dosen->kode_pos                 = "-";
                $kuisioner_dosen->nama_npwp                = $import[0][$i]['O'];
                $kuisioner_dosen->no_npwp                  = $import[0][$i]['P'];
                $kuisioner_dosen->tahun_masuk              = $import[0][$i]['R'];
                $kuisioner_dosen->jml_anak                 = $import[0][$i]['Q'];
                $kuisioner_dosen->pendidikan_terakhir      = $import[0][$i]['S'];
                $kuisioner_dosen->id_user_create           = auth()->user()->id;

                $kuisioner_dosen->save();

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
                // $user->address = $kuisioner_dosen->address;
                // $user->phone = $kuisioner_dosen->phone;
                // $user->agama = $kuisioner_dosen->agama;
                // $user->save();

                // $kuisioner_dosen->id_user =$user->id;
                $kuisioner_dosen->save();
            }else{
                break;
            }
        }

        return back()->with('msg','Import Data Berhasil');

    }

    // laporan
    public function get_laporan_kuisioner_soal(Request $request,$id_by,$id_sub_by,$id_lecture){
        if($request->ajax()){
            $data = array();
            if($id_by != 0 && $id_lecture != 0){
                $soal = kuisioner_dosen_soal::where('id_kuisioner','1')->get();
            }else{
                $soal = [];
            }
            foreach($soal as $key => $row){
                $data[$key]['soal'] = $row->soal;
                // count total
                $total_mhs = kuisioner_mahasiswa_detail::where('id_lecture',$id_lecture)->where('id_batch_year',$id_by)->where('id_sub_batch_year',$id_sub_by)->where('id_soal',$row->id)->count();
                $data[$key]['total'] = $total_mhs;
                // count average score
                $average_score =kuisioner_mahasiswa_detail::where('id_lecture',$id_lecture)->where('id_batch_year',$id_by)->where('id_sub_batch_year',$id_sub_by)->where('id_soal',$row->id)->avg('jawaban');
                $data[$key]['avg'] = $average_score;
                // declare ket
                if($average_score > 0 && $average_score <= 1){
                    $ket = "Sangat Tidak Baik";
                    $color = "danger";
                }elseif($average_score > 1 && $average_score <= 2){
                    $ket = "Tidak Baik";
                    $color = "warning";
                }elseif($average_score > 2 && $average_score <= 3){
                    $ket = "Cukup";
                    $color = "info";
                }elseif($average_score > 3 && $average_score <= 4){
                    $ket = "Baik";
                    $color = "primary";
                }elseif($average_score > 4 && $average_score <= 5){
                    $ket = "Sangat Baik";
                    $color = "success";
                }else{
                    $ket = "-";
                    $color = "secondary";
                }
                $data[$key]['ket'] = $ket;
                $data[$key]['color'] = $color;
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('soal', function($row){
                    return $row["soal"];
                })
                ->addColumn('keterangan', function($row){
                    return '<span class="badge bg-'.$row["color"].'">'.$row["ket"].'</span>';
                })
                ->addColumn('hasil', function($row){
                    $hasil = number_format($row["avg"],2);
                    return $hasil;
                })
                ->rawColumns(['keterangan','soal'])
            ->make(true);
        }
    }
    public function get_laporan_kuisioner_dosen(Request $request,$id_by,$id_sub_by){
        if($request->ajax()){
            $data = array();
            if($id_by != 0){
                $dosen = lecture::all();
            }else{
                $dosen = [];
            }
            foreach($dosen as $key => $row){
                $yohohoho = Helper::yohohoho($row->place_birth);
                $name = Helper::haha($yohohoho,$row->name);
                $data[$key]['dosen'] = $name;
                // count total
                $total_mhs = kuisioner_mahasiswa_detail::where('id_lecture',$row->id)
                                ->where('id_batch_year',$id_by)
                                ->where('id_sub_batch_year',$id_sub_by)
                                ->distinct('id_mahasiswa')
                                ->count();
                if($total_mhs == "0"){
                    $total = "0";
                }else{
                    $total_nilai = kuisioner_mahasiswa_detail::where('id_lecture',$row->id)
                                    ->where('id_batch_year',$id_by)
                                    ->where('id_sub_batch_year',$id_sub_by)
                                    ->sum('skor_jawaban');
                    $total = $total_nilai/$total_mhs;
                }
                $data[$key]['total'] = $total;
                // count average score

                // declare ket
                if($total > 0){
                    if($total > 111){
                        $ket = "Sangat Bagus";
                        $color = "success";
                    }elseif($total >83 && $total <= 111){
                        $ket = "Bagus";
                        $color = "primary";
                    }elseif($total > 55 && $total <= 83){
                        $ket = "Cukup";
                        $color = 'warning';
                    }elseif($total < 55){
                        $ket = "Kurang";
                        $color = 'danger';
                    }
                }else{
                    $ket = "Belum ada data";
                    $color = "secondary";
                }

                $data[$key]['ket'] = $ket;
                $data[$key]['color'] = $color;
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('keterangan', function($row){
                    return '<span class="badge bg-'.$row["color"].'">'.$row["ket"].'</span>';
                })
                ->addColumn('total', function($row){
                    $total = number_format($row["total"],2);
                    return $total;
                })
                ->rawColumns(['keterangan'])
            ->make(true);
        }
    }
    public function report_laporan_kuisioner_soal($id_by,$id_sub_by,$id_lecture){
        $data = array();
        $soal = kuisioner_dosen_soal::where('id_kuisioner','1')->get();

        foreach($soal as $key => $row){
            $data[$key]['soal'] = strip_tags($row->soal);
            // get data per answer
            $count_1 = kuisioner_mahasiswa_detail::where([
                            'id_lecture' => $id_lecture,
                            'id_batch_year' => $id_by,
                            'id_sub_batch_year' => $id_sub_by,
                            'id_soal' => $row->id,
                            'jawaban' => '1',
            ])->count();
            $count_2 = kuisioner_mahasiswa_detail::where([
                            'id_lecture' => $id_lecture,
                            'id_batch_year' => $id_by,
                            'id_sub_batch_year' => $id_sub_by,
                            'id_soal' => $row->id,
                            'jawaban' => '2',
            ])->count();
            $count_3 = kuisioner_mahasiswa_detail::where([
                            'id_lecture' => $id_lecture,
                            'id_batch_year' => $id_by,
                            'id_sub_batch_year' => $id_sub_by,
                            'id_soal' => $row->id,
                            'jawaban' => '3',
            ])->count();
            $count_4 = kuisioner_mahasiswa_detail::where([
                            'id_lecture' => $id_lecture,
                            'id_batch_year' => $id_by,
                            'id_sub_batch_year' => $id_sub_by,
                            'id_soal' => $row->id,
                            'jawaban' => '4',
            ])->count();
            $count_5 = kuisioner_mahasiswa_detail::where([
                            'id_lecture' => $id_lecture,
                            'id_batch_year' => $id_by,
                            'id_sub_batch_year' => $id_sub_by,
                            'id_soal' => $row->id,
                            'jawaban' => '5',
            ])->count();
            $data[$key]['count_1'] = $count_1;
            $data[$key]['count_2'] = $count_2;
            $data[$key]['count_3'] = $count_3;
            $data[$key]['count_4'] = $count_4;
            $data[$key]['count_5'] = $count_5;
            // count total
            $total_mhs = kuisioner_mahasiswa_detail::where('id_lecture',$id_lecture)->where('id_batch_year',$id_by)->where('id_sub_batch_year',$id_sub_by)->where('id_soal',$row->id)->count();
            $data[$key]['total'] = $total_mhs;
            // declare percentage
            $percentage_1 = $count_1/$total_mhs;
            $percentage_2 = $count_2/$total_mhs;
            $percentage_3 = $count_3/$total_mhs;
            $percentage_4 = $count_4/$total_mhs;
            $percentage_5 = $count_5/$total_mhs;

            $data[$key]['percentage_1'] = $percentage_1;
            $data[$key]['percentage_2'] = $percentage_2;
            $data[$key]['percentage_3'] = $percentage_3;
            $data[$key]['percentage_4'] = $percentage_4;
            $data[$key]['percentage_5'] = $percentage_5;
            // count average score
            $average_score =kuisioner_mahasiswa_detail::where('id_lecture',$id_lecture)->where('id_batch_year',$id_by)->where('id_sub_batch_year',$id_sub_by)->where('id_soal',$row->id)->avg('jawaban');
            $data[$key]['avg'] = $average_score;
            // declare ket
            if($average_score > 0 && $average_score <= 1){
                $ket = "Sangat Tidak Baik";
                $color = "danger";
            }elseif($average_score > 1 && $average_score <= 2){
                $ket = "Tidak Baik";
                $color = "warning";
            }elseif($average_score > 2 && $average_score <= 3){
                $ket = "Cukup";
                $color = "info";
            }elseif($average_score > 3 && $average_score <= 4){
                $ket = "Baik";
                $color = "primary";
            }elseif($average_score > 4 && $average_score <= 5){
                $ket = "Sangat Baik";
                $color = "success";
            }else{
                $ket = "-";
                $color = "secondary";
            }
            $data[$key]['ket'] = $ket;
            $data[$key]['color'] = $color;
        }
        $kuisioner_mahasiswa = kuisioner_mahasiswa::where([
            'id_lecture' => $id_lecture,
            'id_batch_year' => $id_by,
            'id_sub_batch_year' => $id_sub_by,
        ])->first();
        $lecture = lecture::find($id_lecture);
        $yohohoho = Helper::yohohoho($lecture->place_birth);
        $lecture_name = Helper::haha($yohohoho,$lecture->name);

        $prodi = prodi::find($lecture->id_prodi);
        $by = batch_year::find($id_by);
        $sub_by = sub_by::find($id_sub_by);

        $lesson = lesson::find($kuisioner_mahasiswa->id_lesson);
        $yohohoho = Helper::yohohoho($lesson->image);
        $lesson_name = Helper::haha($yohohoho,$lesson->name);

        // excel things
        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load(public_path('excel\laporan_kuisioner_edom_per_soal.xlsx'));
        $sheet = $spreadsheet->getActiveSheet();

        // set data
        $sheet->setCellValue('B2','PROGRAM STUDI '.$prodi->name);
        $sheet->setCellValue('B4','SEMESTER '.$sub_by->name.' T.A '.$by->name);
        $sheet->setCellValue('B6','Nama                : '.$lecture_name);
        $sheet->setCellValue('B7','Program Studi : '.$prodi->name);
        $sheet->setCellValue('B8','Mata Kuliah      : '.$lesson_name);

        $nomer = 1;
        $baris = 13;
        foreach($data as $row){
            $sheet->setCellValue('A'.$baris,$nomer);
            $sheet->setCellValue('B'.$baris,$row["soal"]);
            $sheet->setCellValue('C'.$baris,$row["count_1"]);
            $sheet->setCellValue('D'.$baris,$row["count_2"]);
            $sheet->setCellValue('E'.$baris,$row["count_3"]);
            $sheet->setCellValue('F'.$baris,$row["count_4"]);
            $sheet->setCellValue('G'.$baris,$row["count_5"]);
            $sheet->setCellValue('H'.$baris,$row["total"]);
            $sheet->setCellValue('I'.$baris,$row["percentage_1"]);
            $sheet->setCellValue('J'.$baris,$row["percentage_2"]);
            $sheet->setCellValue('K'.$baris,$row["percentage_3"]);
            $sheet->setCellValue('L'.$baris,$row["percentage_4"]);
            $sheet->setCellValue('M'.$baris,$row["percentage_5"]);
            $sheet->setCellValue('N'.$baris,$row["total"]);
            $sheet->setCellValue('O'.$baris,$row["avg"]);
            $sheet->setCellValue('P'.$baris,$row["ket"]);
            $baris++;
            $nomer++;
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="EDOM '.$lecture_name.' SEMESTER '.$sub_by->name.' T.A '.$by->name.'.xlsx"');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        return $writer->save('php://output');
    }
    public function report_laporan_kuisioner_dosen($id_by,$id_sub_by){
        $data = array();
        $dosen = lecture::all();
        foreach($dosen as $key => $row){
            $yohohoho = Helper::yohohoho($row->place_birth);
            $name = Helper::haha($yohohoho,$row->name);
            $data[$key]['dosen'] = $name;
            // count total
            $total_mhs = kuisioner_mahasiswa_detail::where('id_lecture',$row->id)
                            ->where('id_batch_year',$id_by)
                            ->where('id_sub_batch_year',$id_sub_by)
                            ->distinct('id_mahasiswa')
                            ->count();
            if($total_mhs == "0"){
                $total = "0";
            }else{
                $total_nilai = kuisioner_mahasiswa_detail::where('id_lecture',$row->id)
                                ->where('id_batch_year',$id_by)
                                ->where('id_sub_batch_year',$id_sub_by)
                                ->sum('skor_jawaban');
                $total = $total_nilai/$total_mhs;
            }
            $data[$key]['total'] = $total;
            // count average score

            // declare ket
            if($total > 0){
                if($total > 111){
                    $ket = "Sangat Bagus";
                    $color = "success";
                }elseif($total >83 && $total <= 111){
                    $ket = "Bagus";
                    $color = "primary";
                }elseif($total > 55 && $total <= 83){
                    $ket = "Cukup";
                    $color = 'warning';
                }elseif($total < 55){
                    $ket = "Kurang";
                    $color = 'danger';
                }
            }else{
                $ket = "Belum ada data";
                $color = "secondary";
            }

            $data[$key]['ket'] = $ket;
            $data[$key]['color'] = $color;
        }
        $by = batch_year::find($id_by);
        $sub_by = sub_by::find($id_sub_by); // excel things
        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load(public_path('excel\laporan_edom_dosen.xlsx'));
        $sheet = $spreadsheet->getActiveSheet();

        // set data
        $sheet->setCellValue('B5','SEMESTER '.$sub_by->name.' T.A '.$by->name);

        $nomer = 1;
        $baris = 10;
        foreach($data as $row){
            $sheet->setCellValue('A'.$baris,$nomer);
            $sheet->setCellValue('B'.$baris,$row["dosen"]);
            $sheet->setCellValue('C'.$baris,$row["total"]);
            $sheet->setCellValue('D'.$baris,$row["ket"]);
            $baris++;
            $nomer++;
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="EDOM per dosen SEMESTER '.$sub_by->name.' T.A '.$by->name.'.xlsx"');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        return $writer->save('php://output');
    }
}
