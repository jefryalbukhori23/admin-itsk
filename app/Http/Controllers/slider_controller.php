<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    slider,
    sub
};
use DataTables;
use Illuminate\Support\Facades\Http;
class slider_controller extends Controller
{
    public function index(){

        $data = [
            'menu' => 'landing',
            'submenu' => 'slider',
            'sub' => sub::all(),
        ];

        return view('user.admin.slider.index',$data);
    }
    public function get_data(Request $request){
        if ($request->ajax()) {
            $data = slider::where('id_sub','1')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '  <button class="btn btn-sm btn-info images" title="Preview Gambar" value="'.$row->image.'"  data-bs-toggle="modal" data-bs-target="#image_modal">
                                        <i class="fa fa-file-image-o"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning edit" title="Edit Data" data-bs-toggle="modal" data-bs-target="#edit_modal" value="'.$row->id.'">
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
        $slider = new slider();
        $slider->title = $request->title;
        $slider->id_sub = $request->id_sub;
        $slider->desc = $request->desc;
        $code_name = "slider_";
        $file_name = "slider_".uniqid().".".$request->image->extension();
        // $request->image->move(public_path('image/slider'),$file_name);
        $slider->image = $file_name;
        $slider->save();

        $file = request('image');
        // dd($file);
        $original_filename = $file->getClientOriginalName();
        $file_mime = $file->getMimeType();
        $file_path = $file->getPathName();

        $upload_api_url = 'http://127.0.0.1:4500/api/upload_file/'.$code_name;
        $client = new \GuzzleHttp\Client();
        $response = $client->request("POST",$upload_api_url, [
            'multipart' => [
                [
                    'name' => 'file',
                    'filename' => $original_filename,
                    'Mime-type' => $file_mime,
                    'contents' => fopen($file_path,'r'),
                ],
                [
                    'name' => 'path',
                    'contents' => 'image/slider',
                ],
                [
                    'name' => 'filename',
                    'contents' => $file_name,
                ],
            ]

        ]);



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
                'data' => slider::find($id),
            ],
            200
        );
    }
    public function update(Request $request,$id){
        $slider = slider::find($id);
        $slider->title = $request->title;
        $slider->id_sub = $request->id_sub;
        $slider->desc = $request->desc;
        $slider->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function destroy($id){
        $slider = slider::find($id);
        $slider->delete();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
}
