<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use App\Models\berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class berita_controller extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = [
      'menu' => ' berita',
      'submenu' => ' berita',
      'mahasiswa' => mahasiswa::all(),
    ];

    return view('user.admin.berita.index', $data);
  }

  public function get_data(Request $request)
  {
    if ($request->ajax()) {
      $data = berita::where(['is_deleted' => 'N'])->latest()->get();

      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('image', function ($row) {
          $url = asset('image/berita/' . $row->image);
          return '<img src="' . $url . '" style="width: auto;height: 250px;" align="center" />';
        })
        ->addColumn('action', function ($row) {
          if ($row->is_deleted == 'Y') {
            $actionBtn = '<button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="' . $row->id . '" disabled>
              <i class="fa fa-edit"></i>
            </button>
            <button class="btn btn-sm btn-danger hapus" value="' . $row->id . '" disabled>
              <i class="fa fa-trash"></i>
            </button>';
          } else {
            $actionBtn = '<button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="' . $row->id . '">
              <i class="fa fa-edit"></i>
            </button>
            <button class="btn btn-sm btn-danger hapus" value="' . $row->id . '">
              <i class="fa fa-trash"></i>
            </button>
            ';
          }
          return $actionBtn;
        })
        ->rawColumns(['action', 'image'])
        ->make(true);
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $berita = new berita();
    $berita->judul = $request->judul;
    $berita->berita = $request->berita;
    if ($request->image == true) {
      $file_name = "berita_" . uniqid() . "." . $request->image->extension();
      $request->image->move(public_path('image/berita'), $file_name);
      $berita->image = $file_name;
    }
    $berita->save();

    return response()->json(
      [
        'msg' => 'Success',
      ],
      200
    );
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $berita = berita::find($id);

    return response()->json([
      'berita' => $berita,
    ], 200);
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $berita = berita::find($id);
    $berita->judul = $request->judul;
    $berita->berita = $request->berita;
    if ($request->image == true) {
      $file_name = "berita_" . uniqid() . "." . $request->image->extension();
      $request->image->move(public_path('image/berita'), $file_name);
      $berita->image = $file_name;
    }
    $berita->save();

    return response()->json(
      [
        'msg' => 'Success',
      ],
      200
    );
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $berita = berita::find($id);
    $berita->is_deleted = 'Y';
    $berita->save();

    return response()->json(
      [
        'msg' => 'Success',
      ],
      200
    );
  }
}
