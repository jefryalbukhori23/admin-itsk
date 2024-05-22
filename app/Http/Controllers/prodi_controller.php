<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    prodi,
    fakultas,
    jenjang
};
use DataTables;
class prodi_controller extends Controller
{
    public function index(){
        $data = [
            'menu' => 'master',
            'submenu' => 'prodi',
            'fakultas' => fakultas::all(),
            'jenjang' => jenjang::all(),
        ];

        return view('user.admin.prodi.index',$data);
    }
    public function get_data(Request $request){
        if ($request->ajax()) {
            $data = prodi::join('jenjang','prodi.id_jenjang','jenjang.id')
                        ->join('fakultas','prodi.id_fakultas','fakultas.id')
                        ->select('prodi.*','jenjang.name as jenjang','fakultas.name as fakultas')
                        ->latest()->get();
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
                ->make(true);
        }
    }
    public function store(Request $request){
        $prodi = new prodi();
        $prodi->id_fakultas = $request->id_fakultas;
        $prodi->id_jenjang  = $request->id_jenjang;
        $prodi->name = $request->name;
        $prodi->kode = $request->kode;
        $prodi->kaprodi = $request->kaprodi;
        $prodi->nip_kaprodi = $request->nip_kaprodi;
        $prodi->save();

        $fakultas = fakultas::find($request->id_fakultas);
        $fakultas->is_deleted = 'Y';
        $fakultas->save();

        $jenjang = jenjang::find($request->id_jenjang);
        $jenjang->is_deleted = 'Y';
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
                'data' => prodi::find($id),
            ],
            200
        );
    }
    public function update(Request $request,$id){
        $prodi = prodi::find($id);
        $prodi->name = $request->name;
        $prodi->id_fakultas = $request->id_fakultas;
        $prodi->id_jenjang  = $request->id_jenjang;
        $prodi->kode = $request->kode;
        $prodi->kaprodi = $request->kaprodi;
        $prodi->nip_kaprodi = $request->nip_kaprodi;
        $prodi->save();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function destroy($id){
        $prodi = prodi::find($id);
        // check fakultas;
        $check_fakultas = prodi::where('id_fakultas',$prodi->id_fakultas)->count();
        $check_jenjang = prodi::where('id_fakultas',$prodi->id_fakultas)->count();
        if($check_fakultas == 0){
            $fakultas = fakultas::find($prodi->id_fakultas);
            $fakultas->is_deleted = 'N';
            $fakultas->save();
        }

        if($check_jenjang == 0){
            $jenjang = jenjang::find($prodi->id_jenjang);
            $jenjang->is_deleted = 'N';
            $jenjang->save();
        }

        $prodi->delete();

        // check fakultas;

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
}
