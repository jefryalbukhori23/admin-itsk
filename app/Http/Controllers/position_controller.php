<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    position
};
use DataTables;
use Helper;
use Illuminate\Support\Facades\Crypt;
class position_controller extends Controller
{
    public function index(){
        $data = [
            'menu' => 'master',
            'submenu' => 'position',
        ];
        return view('user.admin.position.index',$data);
    }
    public function get_data(Request $request){
        if ($request->ajax()) {
            $data = position::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    $yohohoho = Helper::yohohoho($row->desc);
                    $name = Helper::haha($yohohoho,$row->name);
                    return $name;
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
        $hehe = Helper::D();

        $haha = Crypt::encryptString($hehe);

        $position = new position();
        $position->name = Helper::hehe($hehe,$request->name);
        $position->desc = $haha;
        $position->id_user = auth()->user()->id;
        $position->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function show($id){
        $position = position::find($id);
        $yohohoho = Helper::yohohoho($position->desc);
        $name = Helper::haha($yohohoho,$position->name);
        return response()->json(
            [
                'name' => $name,
            ],
            200
        );
    }
    public function update(Request $request,$id){
        $hehe = Helper::D();

        $haha = Crypt::encryptString($hehe);

        $position = position::find($id);
        $position->name = Helper::hehe($hehe,$request->name);
        $position->desc = $haha;
        $position->id_user = auth()->user()->id;
        $position->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function destroy($id){
        $position = position::find($id);
        $position->delete();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
}
