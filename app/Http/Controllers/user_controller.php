<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\{

    User,

    registration,

    role,

    prodi,

    lecture,

    mahasiswa
};

use Helper;

use Illuminate\Support\Facades\Crypt;

use DataTables;

use Illuminate\Support\Facades\Hash;



class user_controller extends Controller

{

    public function index()
    {

        $data = [

            'menu' => 'akun',

            'submenu' => 'profile',

            'registration' => User::find(auth()->user()->id),

        ];



        return view('user.admin.akun.index', $data);
    }

    public function indexs()
    {

        if (auth()->user()->role == "2") {

            $data = [

                'menu' => 'akun',

                'submenu' => 'setting',

                'registration' => registration::where('id_user', auth()->user()->id)->first(),

            ];
        } elseif (auth()->user()->role == "1") {

            $data = [

                'menu' => 'akun',

                'submenu' => 'setting',

                'registration' => User::find(auth()->user()->id),

            ];
        }

        return view('user.pendaftar.akun.indexs', $data);
    }

    public function account_update(Request $request)
    {

        if (auth()->user()->role == "2") {

            if (auth()->user()->status == "wait") {

                $registration = registration::where('id_user', auth()->user()->id)->first();

                $registration->name = $request->name;

                $registration->phone = $request->phone;

                $registration->school = $request->school;

                $registration->nisn = $request->nisn;

                $registration->address = $request->address;

                $registration->status_perkawinan = $request->status_perkawinan;

                $registration->nama_ayah = $request->nama_ayah;

                $registration->nama_ibu = $request->nama_ibu;

                $registration->nama_wali = $request->nama_wali;

                $registration->pekerjaan_ayah = $request->pekerjaan_ayah;

                $registration->pekerjaan_ibu = $request->pekerjaan_ibu;

                $registration->no_hp_ortu = $request->no_hp_ortu;

                $registration->alamat_ortu = $request->alamat_ortu;

                $registration->agama = $request->agama;



                $registration->save();
            }

            $user = User::find(auth()->user()->id);

            $user->name = $request->name;

            if ($request->image == true) {

                $file_name = "profile_" . auth()->user()->email . "_" . uniqid() . "." . $request->image->extension();

                $request->image->move(public_path('image/user'), $file_name);

                $user->profile_image = $file_name;
            }

            $user->save();
        } else {



            $user = User::find(auth()->user()->id);

            $user->name = $request->name;

            if ($request->image == true) {

                $file_name = "profile_" . auth()->user()->email . "_" . uniqid() . "." . $request->image->extension();

                $request->image->move(public_path('image/user'), $file_name);

                $user->profile_image = $file_name;
            }

            $user->id_no = $request->id_no;

            $user->phone = $request->phone;

            $user->save();
        }



        return back()->with('msg', 'Update Profil Berhasil ');
    }

    public function check_pass(Request $request)
    {

        $user = User::find(auth()->user()->id);

        $check = Hash::check($request->pass, $user->password);

        if ($check) {

            $msg = true;
        } else {

            $msg = false;
        }



        return response()->json(

            [

                'msg' => $msg,

            ],

            200

        );
    }

    public function change_pass(Request $request)
    {

        $user = user::find(auth()->user()->id);

        $user->password = Hash::make($request->pass3);

        $user->save();

        return back()->with('msg', 'Ubah Password Berhasil ');
    }

    public function check_registered_email($email)
    {

        $check = User::where('email', $email)->count();



        if ($check > 0) {

            $msg = 'error';
        } else {

            $msg = 'ok';
        }



        return response()->json(

            [

                'msg' => $msg,

            ],

            200

        );
    }

    // Menu Pengguna Admin

    public function pengguna()
    {

        $data = [

            'menu' => 'pengguna',

            'submenu' => 'pengguna',

            'roles' => role::where('id', '!=', '3')->where('id', '!=', '4')->where('id', '!=', '5')->get(),

            'roles_edit' => role::where('id', '!=', '3')->where('id', '!=', '4')->get(),

            'role' => role::where('id', '!=', auth()->user()->role)->get(),

            'prodi' => prodi::where('name', '!=', 'Tidak Memilih')->get(),

        ];

        return view('user.admin.pengguna.index', $data);
    }

    public function get_data(Request $request)
    {

        if ($request->ajax()) {

            // $data = User::where('role','!=','4')->where('status','done')->orWhere('role','!=','4')->where('status','AKTIF')->latest()->get();

            $data = User::where('role', '!=', auth()->user()->role)->latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()

                ->addColumn('name', function ($row) {

                    if ($row->role == '5') {

                        $lecture = lecture::where('id_user', $row->id)->first();

                        if ($lecture) {

                            $yohohoho = Helper::yohohoho($lecture->place_birth);

                            $name = Helper::haha($yohohoho, $lecture->name);
                        } else {

                            $name = $row->name;
                        }

                        return $name;
                    } else {

                        return $row->name;
                    }
                })

                ->addColumn('phone', function ($row) {

                    if ($row->role == '5') {

                        $lecture = lecture::where('id_user', $row->id)->first();

                        if ($lecture) {

                            $yohohoho = Helper::yohohoho($lecture->place_birth);

                            $phone = Helper::haha($yohohoho, $lecture->phone);
                        } else {

                            $phone = $row->phone;
                        }

                        return $phone;
                    } else {

                        return $row->phone;
                    }
                })

                ->addColumn('role', function ($row) {

                    if ($row->role == "7") {

                        $prodi = prodi::find($row->id_prodi);


                        if($prodi){
                            $roles = role::find($row->role);

                        $role = $roles->name . " " . $prodi->name;

                        return $role;
                        }else{
                            return '-';
                        }
                    } elseif ($row->role == "5") {

                        return "Dosen";
                    } else {

                        $roles = role::find($row->role);

                        if($roles){
                            $role = $roles->name;

                        return $role;
                        }else{
                            return '-';
                        }
                    }
                })

                ->addColumn('action', function ($row) {

                    if ($row->role != "2" || $row->role != "3") {

                        $actionBtn = '  <button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="' . $row->id . '">

                                            <i class="fa fa-edit"></i>

                                        </button>

                                        <button class="btn btn-sm btn-danger hapus" value="' . $row->id . '">

                                            <i class="fa fa-trash"></i>

                                        </button>

                                        <button class="btn btn-sm btn-info reset_pass" title="Reset Password User" value="' . $row->id . '">

                                            <i class="fa fa-repeat"></i>

                                        </button>';
                    } else {

                        $actionBtn = '<button class="btn btn-sm btn-info reset_pass" title="Reset Password User" value="' . $row->id . '">

                                            <i class="fa fa-repeat"></i>

                                        </button>';
                    }



                    return $actionBtn;
                })

                ->rawColumns(['action'])

                ->make(true);
        }
    }

    public function get_data2(Request $request, $id)
    {

        if ($request->ajax()) {

            // $data = User::where('status','done')->where('role',$id)

            //             ->orwhere('status','AKTIF')->where('role',$id)

            //             ->latest()->get();
            if ($id == 5) {
                $lectures = lecture::pluck('id_user')->toArray();

                $data = User::where('role', $id)->whereIn('id', $lectures)->latest()->get();
            } else {

                $data = User::where('role', $id)->latest()->get();
            }

            return Datatables::of($data)

                ->addIndexColumn()

                ->addColumn('name', function ($row) {

                    if ($row->role == '5') {

                        $lecture = lecture::where('id_user', $row->id)->first();
                        if ($lecture) {

                            $yohohoho = Helper::yohohoho($lecture->place_birth);

                            $name = Helper::haha($yohohoho, $lecture->name);

                            return $name;
                        } else {

                            return $row->name;
                        }
                    } else {

                        return $row->name;
                    }
                })

                ->addColumn('phone', function ($row) {

                    if ($row->role == '5') {

                        $lecture = lecture::where('id_user', $row->id)->first();
                        if ($lecture) {

                            $yohohoho = Helper::yohohoho($lecture->place_birth);

                            $phone = Helper::haha($yohohoho, $lecture->phone);

                            return $phone;
                        } else {
                            return $row->phone;
                        }
                    } else {

                        return $row->phone;
                    }
                })

                ->addColumn('role', function ($row) {

                    if ($row->role == "7") {

                        $prodi = prodi::find($row->id_prodi);

                        $roles = role::find($row->role);

                        $role = $roles->name . " " . $prodi->name;

                        return $role;
                    } elseif ($row->role == "5") {

                        return "Dosen";
                    } else {

                        $roles = role::find($row->role);

                        $role = $roles->name;

                        return $role;
                    }
                })

                ->addColumn('action', function ($row) {

                    if ($row->role != "2" || $row->role != "3") {

                        $actionBtn = '  <button class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#edit_modal" value="' . $row->id . '">

                                            <i class="fa fa-edit"></i>

                                        </button>

                                        <button class="btn btn-sm btn-danger hapus" value="' . $row->id . '">

                                            <i class="fa fa-trash"></i>

                                        </button>

                                        <button class="btn btn-sm btn-info reset_pass" title="Reset Password User" value="' . $row->id . '">

                                            <i class="fa fa-repeat"></i>

                                        </button>';
                    } else {

                        $actionBtn = '<button class="btn btn-sm btn-info reset_pass" title="Reset Password User" value="' . $row->id . '">

                                            <i class="fa fa-repeat"></i>

                                        </button>';
                    }



                    return $actionBtn;
                })

                ->rawColumns(['action'])

                ->make(true);
        }
    }

    public function pengguna_store(Request $request)
    {

        $user = new User();

        $user->name = $request->name;

        $user->email = $request->email;

        $user->role = $request->role;

        if ($request->role == "7") {

            $user->id_prodi = $request->id_prodi;
        }

        $user->phone = $request->phone;

        $user->id_no = $request->id_no;

        $user->address = $request->address;

        $user->status = "done";

        $user->password = hash::make("123");

        $user->save();



        return response()->json(

            [

                'msg' => 'success',

            ],
            200

        );
    }

    public function pengguna_detail($id)
    {



        return response()->json(

            [

                'data' => User::find($id),

            ],
            200

        );
    }

    public function pengguna_update(Request $request)
    {

        $user = User::find($request->id);

        $user->name = $request->name;

        $user->email = $request->email;

        $user->role = $request->role;

        if ($request->role == "7") {

            $user->id_prodi = $request->id_prodi;
        }

        $user->phone = $request->phone;

        $user->address = $request->address;

        $user->password = hash::make("123");

        $user->save();

        if ($request->role == 2) {
            $mhs = registration::where('id_user', $request->id)->first();
            if ($mhs) {
                $mhs->name = $request->name;
                $mhs->email = $request->email;
                $mhs->phone = $request->phone;
                $mhs->address = $request->address;
                $mhs->save();
            }
        }

        return response()->json(

            [

                'msg' => 'success',

            ],
            200

        );
    }

    public function pengguna_delete(Request $request)
    {

        $user = User::find($request->id);

        $user->delete();



        return response()->json(

            [

                'msg' => 'success',

            ],
            200

        );
    }

    public function reset_password_pengguna(Request $request)
    {

        $user = User::find($request->id);

        $new_pass = Hash::make('Sugenghartono@user');

        $user->password = $new_pass;

        $user->save();



        return response()->json(

            [

                'msg' => 'success',

            ],
            200

        );
    }
}
