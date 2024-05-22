<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    berkas_pendaftaran,
    prodi
};
use DataTables;
class berkas_pendaftaran_controller extends Controller
{
    public function index(){
        $data = [
            'menu' => 'master2',
            'submenu' => 'berkas_pendaftaran',
            'prodi' => prodi::all(),
        ];

        return view('user.admin.berkas_pendaftaran.index',$data);
    }
    public function get_data(Request $request){
        if ($request->ajax()) {
            $data = berkas_pendaftaran::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('prodi_name', function($row){
                    $prodi = prodi::find($row->prodi);
                    if($prodi){
                        $prodi_name = $prodi->name;
                    }else{
                        $prodi_name = "Semua Prodi";
                    }
                    return $prodi_name;
                })
                ->addIndexColumn()
                ->addColumn('wajib', function($row){
                    if($row->is_required == "required"){
                        $wajib = "Wajib";
                    }else{
                        $wajib = "Tidak Wajib";
                    }
                    return $wajib;
                })
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
                ->make(true);
        }
    }
    public function store(Request $request){
        $berkas_pendaftaran = new berkas_pendaftaran();
        $berkas_pendaftaran->name = $request->name;
        $berkas_pendaftaran->lokasi = $request->lokasi;
        $berkas_pendaftaran->type = $request->type;
        $berkas_pendaftaran->prodi = $request->prodi;
        $berkas_pendaftaran->is_required = $request->is_required;
        $berkas_pendaftaran->save();

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
                'data' => berkas_pendaftaran::find($id),
            ],
            200
        );
    }
    public function update(Request $request,$id){
        $berkas_pendaftaran = berkas_pendaftaran::find($id);
        $berkas_pendaftaran->name = $request->name;
        $berkas_pendaftaran->lokasi = $request->lokasi;
        $berkas_pendaftaran->type = $request->type;
        $berkas_pendaftaran->prodi = $request->prodi;
        $berkas_pendaftaran->is_required = $request->is_required;
        $berkas_pendaftaran->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function destroy($id){
        $berkas_pendaftaran = berkas_pendaftaran::find($id);
        $berkas_pendaftaran->delete();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
}
