<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    jenjang
};
use DataTables;
class jenjang_controller extends Controller
{
    public function index(){
        $data = [
            'menu' => 'master',
            'submenu' => 'jenjang',
        ];

        return view('user.admin.jenjang.index',$data);
    }
    public function get_data(Request $request){
        if ($request->ajax()) {
            $data = jenjang::where('id','!=','99')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if($row->is_deleted == "Y"){
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
                ->make(true);
        }
    }
    public function store(Request $request){
        $jenjang = new jenjang();
        $jenjang->name = $request->name;
        $jenjang->save();

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
                'data' => jenjang::find($id),
            ],
            200
        );
    }
    public function update(Request $request,$id){
        $jenjang = jenjang::find($id);
        $jenjang->name = $request->name;
        $jenjang->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function destroy($id){
        $jenjang = jenjang::find($id);
        $jenjang->delete();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
}
