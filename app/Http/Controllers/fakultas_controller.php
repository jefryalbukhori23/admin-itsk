<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    fakultas
};
use DataTables;
class fakultas_controller extends Controller
{
    public function index(){
        $data = [
            'menu' => 'master',
            'submenu' => 'fakultas',
        ];

        return view('user.admin.fakultas.index',$data);
    }
    public function get_data(Request $request){
        if ($request->ajax()) {
            $total_record = fakultas::count();
            $data = fakultas::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    if($row->is_deleted == 'Y'){
                        $actionBtn = '  <button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="'.$row->id.'">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger hapus" value="'.$row->id.'" disabled>
                                            <i class="fa fa-trash"></i>
                                        </button>';
                    }else{
                        $actionBtn = '  <button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="'.$row->id.'">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger hapus" value="'.$row->id.'">
                                            <i class="fa fa-trash"></i>
                                        </button>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->with([
                    "recordsTotal" => $total_record,
                    "recordsFiltered" => $total_record,
                    ])
            ->make(true);
        }
    }
    public function store(Request $request){
        $fakultas = new fakultas();
        $fakultas->name = $request->name;
        $fakultas->save();

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
                'data' => fakultas::find($id),
            ],
            200
        );
    }
    public function update(Request $request,$id){
        $fakultas = fakultas::find($id);
        $fakultas->name = $request->name;
        $fakultas->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function destroy($id){
        $fakultas = fakultas::find($id);
        $fakultas->delete();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
}
