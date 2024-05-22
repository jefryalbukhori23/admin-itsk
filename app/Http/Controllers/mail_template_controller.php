<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    mail_template,
};
use DataTables;
class mail_template_controller extends Controller
{
    public function index(){
        $data = [
            'menu' => 'pendaftaran',
            'submenu' => 'mail_template',
        ];

        return view('user.admin.mail_template.index',$data);
    }
    public function get_data(Request $request){
        if ($request->ajax()) {
            $data = mail_template::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if($row->is_deleted == 'Y'){
                        $actionBtn = '  <button class="btn btn-sm btn-info text-white detail" data-bs-toggle="modal" data-bs-target="#detail_modal" value="'.$row->id.'">
                                            <i class="fa fa-info-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="'.$row->id.'">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger hapus" value="'.$row->id.'" disabled>
                                            <i class="fa fa-trash"></i>
                                        </button>';
                    }else{
                        $actionBtn = '  <button class="btn btn-sm btn-info text-white detail" data-bs-toggle="modal" data-bs-target="#detail_modal" value="'.$row->id.'">
                                            <i class="fa fa-info-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="'.$row->id.'">
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
        $mail_template = new mail_template();
        $mail_template->name = $request->name;
        $mail_template->desc = $request->desc;
        $mail_template->subject = $request->subject;
        if($request->att == true){
            $att_name = $request->att->extension();
            $request->att->move(public_path('mail_templates/att'),$att_name);
            $mail_template->att = $att_name;
        }
        $mail_template->save();

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
                'data' => mail_template::find($id),
            ],
            200
        );
    }
    public function update(Request $request,$id){
        $mail_template = mail_template::find($id);
        $mail_template->name = $request->name;
        $mail_template->desc = $request->desc;
        $mail_template->subject = $request->subject;
        if($request->att == true){
            $att_name = "mail_template_att_".uniqid().".".$request->att->extension();
            $request->att->move(public_path('mail_templates/att'),$att_name);
            $mail_template->att = $att_name;
        }
        $mail_template->save();


        return back()->with('msg','Konten berhasil di update');
        // return response()->json(
        //     [
        //         'msg' => 'Success',
        //     ],
        //     200
        // );
    }
    public function destroy($id){
        $mail_template = mail_template::find($id);
        $mail_template->delete();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
}
