<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    kategori_konten,
    sub
};
use DataTables;
class kategori_konten_controller extends Controller
{
    public function index(){

        $data = [
            'menu' => 'landing',
            'submenu' => 'kategori_konten',
            'sub' => sub::all(),
        ];

        return view('user.admin.kategori_konten.index',$data);
    }
    public function get_data(Request $request){
        if ($request->ajax()) {
            $data = kategori_konten::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '  <button class="btn btn-sm btn-warning edit" title="Edit Data" data-bs-toggle="modal" data-bs-target="#edit_modal" value="'.$row->id.'">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger hapus" title="Hapus Data" value="'.$row->id.'">
                                        <i class="fa fa-trash"></i>
                                    </button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function store(Request $request){
        $kategori_konten = new kategori_konten();
        $kategori_konten->name = $request->name;
        $kategori_konten->tampil_menu = $request->tampil_menu;
        $kategori_konten->save();

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
                'data' => kategori_konten::find($id),
            ],
            200
        );
    }
    public function update(Request $request,$id){
        $kategori_konten = kategori_konten::find($id);
        $kategori_konten->name = $request->name;
        $kategori_konten->tampil_menu = $request->tampil_menu;
        $kategori_konten->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function destroy($id){
        $kategori_konten = kategori_konten::find($id);
        $kategori_konten->delete();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
}
