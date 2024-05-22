<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    daftar_ulang,
    registration,
    User,
    tagihan_daftar_ulang_mahasiswa,
    tagihan_daftar_ulang_mahasiswa_detail,

};
use DataTables;
class daftar_ulang_owner_controller extends Controller
{
    public function index(){
        $data = [
            'menu' => 'master',
            'submenu' => 'daftar_ulang',
        ];

        return view('user.owner.daftar_ulang.index',$data);
    }
    public function get_data(Request $request){
        if ($request->ajax()) {
            $data = tagihan_daftar_ulang_mahasiswa::where('status','W')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    $registration = registration::find($row->id_registration);
                    return $registration->name;
                })
                ->addColumn('total', function($row){
                    return number_format($row->total, 2, ',', '.');
                })
                ->addColumn('action', function($row){
                        $actionBtn = '  <button class="btn btn-sm btn-info detail" data-bs-toggle="modal" data-bs-target="#detail_modal" title="Detail Data" value="'.$row->id.'">
                                            <i class="fa fa-info-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success acc" value="'.$row->id.'" title="Setujui">
                                            <i class="fa fa-check-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger deny" value="'.$row->id.'" title="Tolak">
                                            <i class="fa fa-times-circle"></i>
                                        </button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
            ->make(true);
        }
    }
    public function store(Request $request){
        $daftar_ulang = new daftar_ulang();
        $daftar_ulang->name = $request->name;
        $daftar_ulang->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function show($id){
        $tagihan = tagihan_daftar_ulang_mahasiswa::find($id);
        $tagihan_detail = tagihan_daftar_ulang_mahasiswa_detail::where('id_tagihan_daftar_ulang_mahasiswa',$id)->get();
        return response()->json(
            [
                'tagihan' => $tagihan,
                'tagihan_detail' => $tagihan_detail,
            ],
            200
        );
    }
    public function acc(Request $request){
        $tagihan = tagihan_daftar_ulang_mahasiswa::find($request->id);
        $tagihan->status = $request->status;
        $tagihan->remark_owner = $request->remark;
        $tagihan->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function destroy($id){
        $daftar_ulang = daftar_ulang::find($id);
        $daftar_ulang->delete();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
}
