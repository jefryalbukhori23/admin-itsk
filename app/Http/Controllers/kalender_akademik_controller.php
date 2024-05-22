<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Redirect;
use App\Models\{
    kalender_akademik,
    batch_year,
    days,
};

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
class kalender_akademik_controller extends Controller
{
    public function upload_kalender(){

        $kalender = kalender_akademik::where('school_id', auth()->user()->school_id)->get();

        $data = [
            'menu' => 'master3',
            'submenu' => 'kalender_akademik',
            'kalender' => $kalender,
        ];
        return view('user.admin.kalender.index',$data);
    }
    public function index(){
        $kalender = array();
        $color = "";
        $batch_years = batch_year::where('status','Y')->get();
        $batch_year = batch_year::where('status','Y')->first();
        $kalenderr = kalender_akademik::where('id_batch_year',$batch_year->id)->get();
        foreach($kalenderr as $kal){
            // switch($color){
            //     case($kal->status == "E");
            //         $color = "#FFFFFF";
            //     break;
            //     case($kal->status == "L5");
            //         $color = "#FF2D00 ";
            //     break;
            // }
            $color = $kal->bg;
            $kalender[] = [
                'title' => $kal->status,
                'start' => $kal->tanggal,
                'color' => $color,
            ];
        }
        $data = [
            'menu' => 'master3',
            'submenu' => 'kalender_akademik',
            'batch_years' => $batch_years,
            'batch_year' => $batch_year,
        ];
        return view('user.admin.kalender.index', $data, ['kalender' => $kalender]);
    }

    public function store_upload_kalender(Request $request) {

        $rules = [
            'file_kalender' => 'required|mimetypes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'id_batch_year'    => 'required',
        ];
        $customMessages = [
            'file_kalender.required' => 'Masukkan file !',
            'file_kalender.mimetypes' => 'Format file salah !',
            'id_batch_year.required' => 'Pilih tahun akademik !',
        ];
        $this->validate($request, $rules, $customMessages);
        $file = $request->file('file_kalender');
        //data
        $id_batch_year = $request->id_batch_year;
        //Import
        $reader = IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($file);

            $import = [$spreadsheet->setActiveSheetIndex(0)->toArray(null, true, true, true)];

            for ($j=5; $j < 18; $j++) {
                $bulan = $import[0][$j]["A"];
                $tahun = $import[0][$j]["C"];
                for ($i = 'D'; $i !== 'AI'; $i++){
                   $status_hari = $import[0][$j][$i];
                   $tgl = $import[0][4][$i];
                   if($status_hari){
                    if($tgl){
                            $new_tgl = "$tahun/$bulan/$tgl";
                            $new_tgl = strtotime($new_tgl);
                            $newformat = date('Y-m-d',$new_tgl);

                            $cek_kalender = kalender_akademik::where('id_batch_year',$id_batch_year)->where('tanggal',$newformat)->count();
                            if($cek_kalender == 1){
                                $cek_kalender = kalender_akademik::where('id_batch_year',$id_batch_year)->where('tanggal',$newformat)->first();
                                $kalender = kalender_akademik::find($cek_kalender->id);
                            }else{
                                $kalender = new kalender_akademik();
                            }
                            $day_name = date('D', strtotime($newformat));
                            $days = days::where('eng_name',$day_name)->first();

                            $isi = $import[0][$j][$i];
                            switch($isi){
                                case "LHB";
                                    $bg = "#fc0303";
                                break;
                                case "LU";
                                    $bg = "#fc0303";
                                break;
                                case "CM";
                                    $bg = "#03dbfc";
                                break;
                                case "LS";
                                    $bg = "#fc0303";
                                break;
                                case "KRS";
                                    $bg = "#04bf29";
                                break;
                                case "KHS";
                                    $bg = "#fc7b03";
                                break;
                                case "PMB";
                                    $bg = "#e5fa00";
                                break;
                                case "MT";
                                    $bg = "#b3b5b1";
                                break;
                                case "PT";
                                    $bg = "#0036fa";
                                break;
                                case "UAS";
                                    $bg = "#fa00e5";
                                break;
                                case "UTS";
                                    $bg = "#fa00e5";
                                break;
                                case "MSG";
                                    $bg = "#b3b5b1";
                                break;
                                case str_contains($isi, "W");
                                    $bg = "#00f531";
                                break;
                            }
                            $kalender->id_batch_year = $request->id_batch_year;
                            $kalender->tanggal = $newformat;
                            $kalender->status = $isi;
                            $kalender->bg = $bg;
                            $kalender->id_days = $days->id;
                            $kalender->save();
                    }
                   }
                }

            }
            // dd($import);
            // die();
        //End Import

        // Excel::import(new ValueSkillImport($request->class, $request->set_lesson), $file);

        return back()->with('messageSuccess', 'Kalender Berhasil Di Upload');
    }
    public function download_kalender(){

        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load(public_path('excel/formatKalender.xlsx'));

        $spreadsheet->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Format Kalender Akademik .xlsx"');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        return $writer->save('php://output');

    }

}
