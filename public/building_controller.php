<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    building,
    land,
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


class building_controller extends Controller
{
    public function index(){
        $data = [
            'menu' => 'master',
            'submenu' => 'building',
            'land' => land::all(),
        ];

        return view('user.admin.building.index',$data);
    }
    public function get_data(Request $request){
        if ($request->ajax()) {
            $data = building::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('tanah', function($row){
                    $tanah = land::find($row->id_land);
                    $yohohoho = Helper::yohohoho($tanah->image);
                    $tanah = Helper::haha($yohohoho,$tanah->name);
                    return $tanah;
                })
                ->addColumn('name', function($row){
                    $yohohoho = Helper::yohohoho($row->datetime);
                    $name = Helper::haha($yohohoho,$row->name);
                    return $name;
                })
                ->addColumn('desc', function($row){
                    $yohohoho = Helper::yohohoho($row->datetime);
                    $desc = Helper::haha($yohohoho,$row->desc);
                    return $desc;
                })
                ->addColumn('panjang', function($row){
                    $yohohoho = Helper::yohohoho($row->datetime);
                    $panjang = Helper::haha($yohohoho,$row->panjang);
                    return $panjang." m";
                })
                ->addColumn('lebar', function($row){
                    $yohohoho = Helper::yohohoho($row->datetime);
                    $lebar = Helper::haha($yohohoho,$row->lebar);
                    return $lebar." m";
                })
                ->addColumn('luas', function($row){
                    $yohohoho = Helper::yohohoho($row->datetime);
                    $luas = Helper::haha($yohohoho,$row->luas);
                    return $luas."m <sup>2</sup>";
                })
                ->addColumn('jml_lantai', function($row){
                    $yohohoho = Helper::yohohoho($row->datetime);
                    $jml_lantai = Helper::haha($yohohoho,$row->jml_lantai);
                    return $jml_lantai;
                })
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    if($row->is_deleted == 'Y'){
                        $actionBtn = '  <button class="btn btn-sm btn-success text-white detail" data-bs-toggle="modal" data-bs-target="#detail_modal" value="'.$row->id.'">
                                            <i class="fa fa-image"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="'.$row->id.'">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger hapus" value="'.$row->id.'" disabled>
                                            <i class="fa fa-trash"></i>
                                        </button>';
                    }else{
                        $actionBtn = '  <button class="btn btn-sm btn-success text-white detail" data-bs-toggle="modal" data-bs-target="#detail_modal" value="'.$row->id.'">
                                            <i class="fa fa-image"></i>
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
                ->rawColumns(['action','luas'])
                ->make(true);
        }
    }
    public function store(Request $request){
        $hehe = Helper::D();

        $haha = Crypt::encryptString($hehe);
        $luas = $request->panjang * $request->lebar;

        $building = new building();
        $building->id_land = $request->id_land;
        $building->id_user = auth()->user()->id;
        $building->name = Helper::hehe($hehe,$request->name);
        $building->panjang = Helper::hehe($hehe,$request->panjang);
        $building->lebar = Helper::hehe($hehe,$request->lebar);
        $building->luas = Helper::hehe($hehe,$luas);
        $building->desc = Helper::hehe($hehe,$request->desc);
        $building->jml_lantai = Helper::hehe($hehe,$request->jml_lantai);
        if($request->image == true){
            $file_name = "user_".uniqid().".".$request->image->extension();
            $request->image->move(public_path('image/building'),$file_name);
            $building->image = $file_name;
        }
        $building->datetime = $haha;
        $building->save();

        // Land Update delete status
        $count_land_building = building::where('id_land',$request->id_land)->count()-1;
        $land = land::find($request->id_land);
        if($count_land_building > 0){
            $land->is_deleted = "Y";
        }else{
            $land->is_deleted = "N";
        }
        $land->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function show($id){
        $buildings = building::find($id);

        $building = array();

        $building['id_land'] = $buildings->id_land;

        $yohohoho = Helper::yohohoho($buildings->datetime);
        $name = Helper::haha($yohohoho,$buildings->name);
        $building['name'] = $name;

        $yohohoho = Helper::yohohoho($buildings->datetime);
        $desc = Helper::haha($yohohoho,$buildings->desc);
        $building['desc'] = $desc;

        $yohohoho = Helper::yohohoho($buildings->datetime);
        $luas = Helper::haha($yohohoho,$buildings->luas);
        $building['luas'] = $luas;

        $yohohoho = Helper::yohohoho($buildings->datetime);
        $panjang = Helper::haha($yohohoho,$buildings->panjang);
        $building['panjang'] = $panjang;

        $yohohoho = Helper::yohohoho($buildings->datetime);
        $lebar = Helper::haha($yohohoho,$buildings->lebar);
        $building['lebar'] = $lebar;

        $yohohoho = Helper::yohohoho($buildings->datetime);
        $jml_lantai = Helper::haha($yohohoho,$buildings->jml_lantai);
        $building['jml_lantai'] = $jml_lantai;

        $img = $buildings->image;
        return response()->json(
            [
                'data' => $building,
                'img' => $img,
            ],
            200
        );
    }
    public function update(Request $request,$id){
        $hehe = Helper::D();

        $haha = Crypt::encryptString($hehe);
        $luas = $request->panjang * $request->lebar;

        $building = building::find($id);

        // Land Update delete status
        $count_land_building = building::where('id_land',$building->id_land)->count()-1;
        $land = land::find($request->id_land);
        if($count_land_building > 0){
            $land->is_deleted = "Y";
        }else{
            $land->is_deleted = "N";
        }
        $land->save();

        $building->id_land = $request->id_land;
        $building->id_user = auth()->user()->id;
        $building->name = Helper::hehe($hehe,$request->name);
        $building->panjang = Helper::hehe($hehe,$request->panjang);
        $building->lebar = Helper::hehe($hehe,$request->lebar);
        $building->luas = Helper::hehe($hehe,$luas);
        $building->desc = Helper::hehe($hehe,$request->desc);
        $building->jml_lantai = Helper::hehe($hehe,$request->jml_lantai);
        if($request->image == true){
            $file_name = "user_".uniqid().".".$request->image->extension();
            $request->image->move(public_path('image/building'),$file_name);
            $building->image = $file_name;
        }
        $building->datetime = $haha;
        $building->save();

        // Land Update deleted status
        $count_land_building = building::where('id_land',$request->id_land)->count()-1;
        $land = land::find($request->id_land);
        if($count_land_building > 0){
            $land->is_deleted = "Y";
        }else{
            $land->is_deleted = "N";
        }
        $land->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function destroy($id){
        $building = building::find($id);

        $yohohoho = Helper::yohohoho($building->datetime);

        if (File::exists(public_path('image/building/'.$building->image))) {
            File::delete(public_path('image/building/'.$building->image));
        }
        // Land Update delete status
        $count_land_building = building::where('id_land',$building->id_land)->count()-1;
        $land = land::find($building->id_land);
        if($count_land_building > 0){
            $land->is_deleted = "Y";
        }else{
            $land->is_deleted = "N";
        }
        $land->save();

        $building->delete();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
}
