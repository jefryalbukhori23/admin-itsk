<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    batch_year,
    sub_by
};
use DataTables;
class batch_year_controller extends Controller
{
    public function index(){
        $data = [
            'menu' => 'master3',
            'submenu' => 'batch_year',
        ];

        return view('user.admin.batch_year.index',$data);
    }
    public function get_data(Request $request){
        if ($request->ajax()) {
            $data = batch_year::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    if($row->status == "Y"){
                        $st = '<span class="badge bg-success">Aktif</span>';
                    }elseif($row->status == "P"){
                        $st = '<span class="badge bg-info">Aktif PMB</span>';
                    }else{
                        $st = '<span class="badge bg-danger">Tidak Aktif</span>';
                    }
                    return $st;
                })
                ->addColumn('action', function($row){
                    if($row->is_deleted == "N"){
                        $actionBtn = '  <button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="'.$row->id.'">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-info text-white detail" title="Detail Data" data-bs-toggle="modal" data-bs-target="#detail_modal" value="'.$row->id.'">
                                            <i class="fa fa-info-circle"></i>
                                        </button>';

                    }else{
                        $actionBtn = '  <button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="'.$row->id.'">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-info text-white detail" title="Detail Data" data-bs-toggle="modal" data-bs-target="#detail_modal" value="'.$row->id.'">
                                            <i class="fa fa-info-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger hapus" value="'.$row->id.'">
                                            <i class="fa fa-trash"></i>
                                        </button>';
                    }

                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
    }
    public function store(Request $request){
        $batch_year = new batch_year();
        $batch_year->name = $request->name;
        $batch_year->status = $request->status;
        $batch_year->save();

        $sub_by = new sub_by();
        $sub_by->id_batch_year = $batch_year->id;
        $sub_by->code = substr($batch_year->name,0,4)."1";
        $sub_by->name = "Ganjil";
        $sub_by->save();

        $sub_by = new sub_by();
        $sub_by->id_batch_year = $batch_year->id;
        $sub_by->code = substr($batch_year->name,0,4)."2";
        $sub_by->name = "Genap";
        $sub_by->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function show($id){
        return response()->json(
            [
                'data' => batch_year::find($id),
            ],
            200
        );
    }
    public function update(Request $request,$id){
        if($request->status == "Y"){
            $all_by = batch_year::all();
            foreach($all_by as $row){
                $by = batch_year::find($row->id);
                $by->status = "N";
                $by->save();
            }
            $all_sub_by = sub_by::all();
            foreach($all_sub_by as $row){
                $sub_by = sub_by::find($row->id);
                $sub_by->status = "N";
                $sub_by->save();
            }
        }
        $batch_year = batch_year::find($id);
        $batch_year->name = $request->name;
        $batch_year->status = $request->status;
        $batch_year->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function destroy($id){
        $batch_year = batch_year::find($id);
        $sub_by = sub_by::where('id_batch_year',$id)->delete();
        $batch_year->delete();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }

    public function get_sub_by($id){
        $sub_by = sub_by::where("id_batch_year",$id)->get();
        $by = batch_year::find($id);
        return response()->json(
            [
                'sub' => $sub_by,
                'status' => $by->status,
            ],200
        );
    }

    public function update_sub_by(Request $request){
        // dis active all
        $sub_bys = sub_by::all();
        foreach($sub_bys as $row){
            $non = sub_by::find($row->id);
            $non->status ="N";
            $non->save();
        }
        $sub_by = sub_by::find($request->id);
        $sub_by->status = "Y";
        $sub_by->save();

        return response()->json(
            [
                'msg' => 'success',
            ],200
        );
    }
}
