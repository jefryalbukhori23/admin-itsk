<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    sistem_kuliah
};
use DataTables;
class sistem_kuliah_controller extends Controller
{
    public function index(){
        $data = [
            'menu' => 'master',
            'submenu' => 'sistem_kuliah',
        ];

        return view('user.admin.sistem_kuliah.index',$data);
    }
    public function get_data(Request $request){
        if ($request->ajax()) {
            $data = sistem_kuliah::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '  <button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="'.$row->id.'">
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
        $sistem_kuliah = new sistem_kuliah();
        $sistem_kuliah->name = $request->name;
        $sistem_kuliah->save();

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
                'data' => sistem_kuliah::find($id),
            ],
            200
        );
    }
    public function update(Request $request,$id){
        $sistem_kuliah = sistem_kuliah::find($id);
        $sistem_kuliah->name = $request->name;
        $sistem_kuliah->save();

        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
    public function destroy($id){
        $sistem_kuliah = sistem_kuliah::find($id);
        $sistem_kuliah->delete();
        return response()->json(
            [
                'msg' => 'Success',
            ],
            200
        );
    }
}
