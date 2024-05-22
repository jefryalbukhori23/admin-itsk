<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    pekerjaan_karyawan
};
use DataTables;
use Helper;
use Illuminate\Support\Facades\Crypt;
class pekerjaan_karyawan_controller extends Controller
{
    public function index(){
        $data = [
            'menu' => 'master',
            'submenu' => 'pekerjaan_karyawan',
        ];
        return view('user.admin.pekerjaan_karyawan.index',$data);
    }
    public function get_data(Request $request){
        if ($request->ajax()) {
            $data = pekerjaan_karyawan::latest()->get();
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
        $pekerjaan_karyawan = new pekerjaan_karyawan();
        $pekerjaan_karyawan->name = $request->name;
        $pekerjaan_karyawan->desc = $request->desc;
        $pekerjaan_karyawan->code = $request->code;
        $pekerjaan_karyawan->id_user_create = auth()->user()->id;
        $pekerjaan_karyawan->save();

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
                'data' => pekerjaan_karyawan::find($id),
            ],
            200
        );
    }
    public function update(Request $request,$id){
        $pekerjaan_karyawan = pekerjaan_karyawan::find($id);
        $pekerjaan_karyawan->name = $request->name;
        $pekerjaan_karyawan->desc = $request->desc;
        $pekerjaan_karyawan->code = $request->code;
        $pekerjaan_karyawan->id_user_create = auth()->user()->id;
        $pekerjaan_karyawan->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function destroy($id){
        $pekerjaan_karyawan = pekerjaan_karyawan::find($id);
        $pekerjaan_karyawan->delete();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
}
