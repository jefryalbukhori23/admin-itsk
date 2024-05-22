<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    konten,
    kategori_konten,
    sub
};
use DataTables;
class konten_controller extends Controller
{
    public function index(){
        $kategori = kategori_konten::all();
        $data = [
            'menu' => 'landing',
            'submenu' => 'konten',
            'kategori' => $kategori,
            'sub' => sub::where('id','!=',1)->get(),
        ];

        return view('user.admin.konten.index',$data);
    }
    public function get_data(Request $request){
        if ($request->ajax()) {
            $data = konten::join('kategori_konten','konten.id_kategori','kategori_konten.id')->join('sub','konten.id_sub','sub.id')->select('konten.*','kategori_konten.name as kategori','sub.name as sub')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '  <a target="_blank" href="kontens-detail/'.$row->id.'">
                                        <button class="btn btn-sm btn-info text-white" title="Lihat Konten">
                                            <i class="fa fa-info-circle"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="'.$row->id.'">
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
        $konten = new konten();
        $konten->id_kategori = $request->id_kategori;
        $konten->title = $request->title;
        $konten->desc = $request->desc;
        $konten->id_sub = $request->id_sub;
        if($request->image == true){
            $image_name = "konten_image_".uniqid().".".$request->image->extension();
            $request->image->move(public_path('kontens/image'),$image_name);
            $konten->image = $image_name;
        }
        if($request->att == true){
            $att_name = "konten_att_".uniqid().".".$request->att->extension();
            $request->att->move(public_path('kontens/att'),$att_name);
            $konten->att = $att_name;
        }
        $konten->save();

        return back()->with('msg','Konten berhasil di upload');
        // return response()->json(
        //     [
        //         'msg' => 'Success',
        //     ],
        //     200
        // );
    }
    public function show($id){
        return response()->json(
            [
                'data' => konten::find($id),
            ],
            200
        );
    }
    public function update(Request $request,$id){
        $konten = konten::find($id);
        $konten->id_kategori = $request->id_kategori;
        $konten->title = $request->title;
        $konten->desc = $request->desc;
        $konten->id_sub = $request->id_sub;
        if($request->image == true){
            $image_name = "konten_image_".uniqid().".".$request->image->extension();
            $request->image->move(public_path('kontens/image'),$image_name);
            $konten->image = $image_name;
        }
        if($request->att == true){
            $att_name = "konten_att_".uniqid().".".$request->att->extension();
            $request->att->move(public_path('kontens/att'),$att_name);
            $konten->att = $att_name;
        }
        $konten->save();


        return back()->with('msg','Konten berhasil di update');
        // return response()->json(
        //     [
        //         'msg' => 'Success',
        //     ],
        //     200
        // );
    }
    public function destroy($id){
        $konten = konten::find($id);
        $konten->delete();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
}
