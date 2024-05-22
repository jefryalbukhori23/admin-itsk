<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    krs_date,
    batch_year
};
use DataTables;
class krs_date_controller extends Controller
{
    public function index(){
        $data = [
            'menu' => 'master3',
            'submenu' => 'krs_date',
            'batch_year' => batch_year::where('status','Y')->get(),
        ];

        return view('user.admin.krs_date.index',$data);
    }
    public function get_data(Request $request){
        if ($request->ajax()) {
            $data = krs_date::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('start', function($row){
                    $start = date('d F Y',strtotime($row->start));
                    return $start;
                })
                ->addColumn('end', function($row){
                    $end = date('d F Y',strtotime($row->end));
                    return $end;
                })
                ->addColumn('by', function($row){
                    $batch_year = batch_year::find($row->id_batch_year);
                    return $batch_year->name;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '  <button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="'.$row->id.'">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger hapus" value="'.$row->id.'">
                                        <i class="fa fa-trash"></i>
                                    </button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function store(Request $request){
        if($request->status == "Y"){
            $unactives = krs_date::all();
            foreach($unactives as $row){
                $unactive = krs_date::find($row->id);
                $unactive->status = "N";
                $unactive->save();
            }
        }
        $krs_date = new krs_date();
        $krs_date->start = $request->start;
        $krs_date->end  = $request->end;
        $krs_date->id_batch_year = $request->id_batch_year;
        $krs_date->status = $request->status;
        $krs_date->save();

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
                'data' => krs_date::find($id),
            ],
            200
        );
    }
    public function update(Request $request,$id){
        if($request->status == "Y"){
            $all_by = krs_date::all();
            foreach($all_by as $row){
                $by = krs_date::find($row->id);
                $by->status = "N";
                $by->save();
            }
        }
        $krs_date = krs_date::find($id);

        $krs_date->start = $request->start;
        $krs_date->end  = $request->end;
        $krs_date->id_batch_year = $request->id_batch_year;
        $krs_date->status = $request->status;
        $krs_date->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function destroy($id){
        $krs_date = krs_date::find($id);
        $krs_date->delete();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
}
