<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    pengurus,
    jabatan_pengurus
};
use DataTables;
use Helper;
use Illuminate\Support\Facades\Crypt;
class pengurus_controller extends Controller
{
    public function index(){
        $data = [
            'menu' => 'master_pengurus',
            'submenu' => 'pengurus',
            'jabatan_pengurus' => jabatan_pengurus::all(),
        ];
        return view('user.admin.pengurus.index',$data);
    }
    public function get_data(Request $request){
        if ($request->ajax()) {
            $data = pengurus::latest()->get();
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
        $pengurus = new pengurus();
        $pengurus->no_id = $request->no_id;
        $pengurus->jabatan = $request->jabatan;
        $pengurus->name = $request->name;
        $pengurus->id_user_create = auth()->user()->id;
        $pengurus->save();

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
                'data' => pengurus::find($id),
            ],
            200
        );
    }
    public function update(Request $request,$id){
        $pengurus = pengurus::find($id);
        $pengurus->name = $request->name;
        $pengurus->jabatan = $request->jabatan;
        $pengurus->no_id = $request->no_id;
        $pengurus->id_user_create = auth()->user()->id;
        $pengurus->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function destroy($id){
        $pengurus = pengurus::find($id);
        $pengurus->delete();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
}
