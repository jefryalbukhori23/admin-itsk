<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    building_room_function
};
use DataTables;
class building_room_function_controller extends Controller
{
    public function index(){
        $data = [
            'menu' => 'master2',
            'submenu' => 'fungsi_ruangan',
        ];

        return view('user.admin.building_room_function.index',$data);
    }
    public function get_data(Request $request){
        if ($request->ajax()) {
            $data = building_room_function::latest()->get();
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
        $building_room_function = new building_room_function();
        $building_room_function->name = $request->name;
        $building_room_function->save();

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
                'data' => building_room_function::find($id),
            ],
            200
        );
    }
    public function update(Request $request,$id){
        $building_room_function = building_room_function::find($id);
        $building_room_function->name = $request->name;
        $building_room_function->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function destroy($id){
        $building_room_function = building_room_function::find($id);
        $building_room_function->delete();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
}
