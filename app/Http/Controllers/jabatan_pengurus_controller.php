<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    jabatan_pengurus
};
use DataTables;
use Helper;
use Illuminate\Support\Facades\Crypt;
class jabatan_pengurus_controller extends Controller
{
    public function index(){
        $data = [
            'menu' => 'master_pengurus',
            'submenu' => 'jabatan_pengurus',
        ];
        return view('user.admin.jabatan_pengurus.index',$data);
    }
    public function get_data(Request $request){
        if ($request->ajax()) {
            $data = jabatan_pengurus::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if($row->allow_delete == 'Y'){
                        $actionBtn = '  <button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="'.$row->id.'">
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
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function store(Request $request){
        $jabatan_pengurus = new jabatan_pengurus();
        $jabatan_pengurus->name = $request->name;
        $jabatan_pengurus->desc = $request->desc;
        $jabatan_pengurus->id_user_create = auth()->user()->id;
        $jabatan_pengurus->save();

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
                'data' => jabatan_pengurus::find($id),
            ],
            200
        );
    }
    public function update(Request $request,$id){
        $jabatan_pengurus = jabatan_pengurus::find($id);
        $jabatan_pengurus->name = $request->name;
        $jabatan_pengurus->desc = $request->desc;
        $jabatan_pengurus->id_user_create = auth()->user()->id;
        $jabatan_pengurus->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function destroy($id){
        $jabatan_pengurus = jabatan_pengurus::find($id);
        $jabatan_pengurus->delete();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
}
