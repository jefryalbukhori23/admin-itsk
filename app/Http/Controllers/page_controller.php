<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    kategori,
    slider,
    mahasiswa,
    sekolah,
    batch_year,
    jalur_seleksi,
    jalur_seleksi_class,
    country,
    default_province,
    default_regenci,
    default_district,
    default_village,
    registration,
    prodi,
    jenjang,
    User,
    kategori_konten,
    konten,
    ujian,
    berkas_pendaftaran,
    berkas_pendaftaran_mahasiswa,
    mail_template,
    kuisioner_dosen,
    kuisioner_dosen_soal,
    kuisioner_mahasiswa,
    kuisioner_mahasiswa_detail,
    fakultas,
    lecture,
};
use Session;
use Mail;
use App\Mail\notification_mail;
use File;
use Barryvdh\DomPDF\Facade\Pdf;
class page_controller extends Controller
{
    public function index(){
        $role = auth()->user()->role;
        switch($role){
            case "4";
            // data for dashboard
            // card
                $count_mhs = mahasiswa::where('status','AKTIF')->count();
                $count_fakultas = fakultas::count();
                $count_prodi = prodi::count();
                $count_lecture = lecture::count();
            // end card

            $data = [
                'menu' => 'dashboard',
                'submenu' => '',
                'count_mhs' => $count_mhs,
                'count_fakultas' => $count_fakultas,
                'count_prodi' => $count_prodi,
                'count_lecture' => $count_lecture,
            ];
                return view('user.admin.index',$data);
            break;
            case "11";
                $data = [
                    'menu' => 'dashboard',
                    'submenu' => '',
                ];
                return view('user.owner.index',$data);
            break;
        }
    }
    public function landing(){
        if (Auth::check()) {
            if(auth()->user()->role == "2"){
                return redirect('dashboard');
            }
        }

        return view('landing.index');
    }
    public function jalur_seleksi_detail($id){
        $jalur_seleksi = jalur_seleksi::join('sistem_kuliah','jalur_seleksi.id_sistem_kuliah','sistem_kuliah.id')
                                        ->join('batch_year','jalur_seleksi.id_batch_year','batch_year.id')
                                        ->select('sistem_kuliah.name as sistem_kuliah','jalur_seleksi.*','batch_year.name as by')
                                        ->where('jalur_seleksi.id',$id)->first();
        $prodi = jalur_seleksi_class::join('prodi','jalur_seleksi_class.id_prodi','prodi.id')
                                    ->join('jenjang','prodi.id_jenjang','jenjang.id')
                                    ->select('jalur_seleksi_class.quota','prodi.name','jenjang.name as jenjang')
                                    ->where('jalur_seleksi_class.id_jalur_seleksi',$id)->get();
        $data = [
            'jalur_seleksi' => $jalur_seleksi,
            'prodi' => $prodi,
        ];

        return view('landing.jalur_seleksi.detail',$data);
    }
    public function registration($id){
        $jalur_seleksi = jalur_seleksi::join('sistem_kuliah','jalur_seleksi.id_sistem_kuliah','sistem_kuliah.id')
                                        ->join('batch_year','jalur_seleksi.id_batch_year','batch_year.id')
                                        ->select('sistem_kuliah.name as sistem_kuliah','jalur_seleksi.*','batch_year.name as by')
                                        ->where('jalur_seleksi.id',$id)->first();
        $prodi = jalur_seleksi_class::join('prodi','jalur_seleksi_class.id_prodi','prodi.id')
                                    ->join('jenjang','prodi.id_jenjang','jenjang.id')
                                    ->select('jalur_seleksi_class.quota','prodi.name','jenjang.name as jenjang','jalur_seleksi_class.id','prodi.id as id_prodi')
                                    ->where('jalur_seleksi_class.id_jalur_seleksi',$id)->get();
        $berkas = berkas_pendaftaran::where('lokasi','pendaftaran')->get();
        // dd($prodi);
        $data = [
            'jalur_seleksi' => $jalur_seleksi,
            'country' => country::all(),
            'sekolah' => sekolah::where('bentuk','SMA')->orWhere('bentuk','SMK')->get(),
            'default_province' => default_province::all(),
            'prodi' => $prodi,
            'berkas' => $berkas,
        ];

        return view('landing.jalur_seleksi.registration',$data);

    }

    // API
    public function get_regencies($id){
        $province = default_province::where('name',$id)->first();
        $data = default_regenci::where('province_id',$province->id)->get();

        return response()->json(
            [
                'data' => $data,
            ],200
        );
    }
    public function get_districts($id){
        $regency = default_regenci::where('name',$id)->first();
        $data = default_district::where('regency_id',$regency->id)->get();

        return response()->json(
            [
                'data' => $data,
            ],200
        );
    }
    public function get_villages($id){
        $district = default_district::where('name',$id)->first();
        $data = default_village::where('district_id',$district->id)->get();

        return response()->json(
            [
                'data' => $data,
            ],200
        );
    }
    public function get_school(Request $request){
            $term = trim($request->q);

            if (empty($term)) {
                return \Response::json([]);
            }

            $sekolah = sekolah::where('sekolah','LIKE','%'.$term.'%')->orwhere('npsn','LIKE','%'.$term.'%')->limit(30)->get();

            $formatted_tags = [];

            foreach ($sekolah as $row) {
                $formatted_tags[] = ['id' => $row->npsn, 'text' => $row->npsn." - ".$row->sekolah];
            }

            return \Response::json($formatted_tags);
    }
    public function get_unselect_prodi($id,$id_jalur_seleksi){
        $prodi = jalur_seleksi_class::join('prodi','jalur_seleksi_class.id_prodi','prodi.id')
                                    ->join('jenjang','prodi.id_jenjang','jenjang.id')
                                    ->select('jalur_seleksi_class.quota','prodi.name','jenjang.name as jenjang','jalur_seleksi_class.id','prodi.id as id_prodi')
                                    ->where('jalur_seleksi_class.id_jalur_seleksi',$id_jalur_seleksi)
                                    ->where('jalur_seleksi_class.id_prodi','!=',$id)->get();
        return response()->json(
            [
                'data' => $prodi,
            ],
            200
        );
    }
    public function get_prodi_jalur_seleksi($id){
        $prodi = jalur_seleksi_class::join('prodi','jalur_seleksi_class.id_prodi','prodi.id')
                        ->join('jenjang','prodi.id_jenjang','jenjang.id')
                        ->select('jalur_seleksi_class.quota','prodi.name','jenjang.name as jenjang','jalur_seleksi_class.id','prodi.id as id_prodi')
                        ->where('jalur_seleksi_class.id_jalur_seleksi',$id)->get();
        return response()->json(
            [
            'data' => $prodi,
            ],
            200
        );
    }

    public function check_registered_email($email){
        $check = registration::where('email',$email)->count();

        if($check > 0){
            $msg = 'error';
        }else{
            $msg = 'ok';
        }

        return response()->json(
            [
                'msg' => $msg,
            ],
            200
        );
    }
    public function check_registered_id_no($id_no){
        $check = registration::where('id_no',$id_no)->count();

        if($check > 0){
            $msg = 'error';
        }else{
            $msg = 'ok';
        }

        return response()->json(
            [
                'msg' => $msg,
            ],
            200
        );
    }
    public function registration_store (Request $request){
        $jalur_seleksi = jalur_seleksi::find($request->id_jalur_seleksi);

        $berkas = berkas_pendaftaran::where('lokasi','pendaftaran')->get();

        $school = sekolah::where('npsn',$request->school)->first();
        $registration = new registration();
        $registration->id_sistem_kuliah = $jalur_seleksi->id_sistem_kuliah;
        $registration->id_jalur_seleksi  = $request->id_jalur_seleksi;
        $registration->name = $request->name;
        $registration->tahun_lulus = $request->tahun_lulus;
        $registration->gender = $request->gender;
        $registration->phone = chop($request->phone,"_");
        $registration->email = $request->email;
        $registration->date_birth = $request->date_birth;
        $registration->place_birth = $request->place_birth;
        $registration->nationality = $request->nationality;
        $registration->id_no = chop($request->id_no,"_");
        $registration->nisn = chop($request->nisn,"_");
        $registration->address = $request->address;
        $registration->status_perkawinan = $request->status_perkawinan;
        $registration->nama_ayah = $request->nama_ayah;
        $registration->nama_ibu = $request->nama_ibu;
        $registration->nama_wali = $request->nama_wali;
        $registration->pekerjaan_ayah = $request->pekerjaan_ayah;
        $registration->pekerjaan_ibu = $request->pekerjaan_ibu;
        $registration->no_hp_ortu = chop($request->no_hp_ortu,"_");
        $registration->alamat_ortu = $request->alamat_ortu;
        $registration->agama = $request->agama;
        $registration->school = $school->sekolah;
        $registration->jurusan = $request->jurusan;
        $registration->id_prodi1 = $request->prodi1;
        $registration->id_prodi2 = $request->prodi2;

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->name;
        $user->email = $request->email;
        $date_birth = date('dmy',strtotime($request->date_birth));
        $user->password = Hash::make($date_birth);
        $user->role = "2";
        $user->save();

        $registration->id_user = $user->id;
        $registration->save();

        foreach($berkas as $row){
            $id_berkas = (string)$row->id;
            if($request->$id_berkas == true){
                $file_name1 = "registration_file_".$row->name."_".$request->email.uniqid().".".$request->$id_berkas->extension();
                $file_name1 = str_replace("/","_",$file_name1);
                $request->$id_berkas->move(public_path('file/registration'),$file_name1);
                $berkas_file = new berkas_pendaftaran_mahasiswa();
                $berkas_file->id_berkas_pendaftaran = $row->id;
                $berkas_file->id_registration = $registration->id;
                $berkas_file->id_user = $user->id;
                $berkas_file->file = $file_name1;
                $berkas_file->save();
            }
        }
        $berkass = berkas_pendaftaran::where('name','Foto Terbaru')->first();
        $berkas_mahasiswa = berkas_pendaftaran_mahasiswa::where('id_berkas_pendaftaran',$berkass->id)->where('id_user',$user->id)->first();
        $user = User::find($user->id);
        $user->profile_image = $berkas_mahasiswa->file;
        $user->save();
        File::copy(public_path('file/registration/'.$berkas_mahasiswa->file), public_path('image/user/'.$berkas_mahasiswa->file));

        // $mail_data = [
        //     'name' => 'pendaftaran',
        //     'title' => 'Selamat, Pendaftaran anda berhasil dilakukan',
        //     'desc' => 'silahkan lanjutkan pendaftaran dengan cara login ke website : ',
        //     'mail' => 'Email anda : '.$request->email,
        //     'pass' => 'password anda : tanggal lahir dengan format (ddmmyy) <br>   contoh : tgl lahir 01-02-2004 maka password adalah 010204;,'
        // ];
        $mail_template = mail_template::find(1);
        $konten = str_replace("__nama_mahasiswa",$registration->name,$mail_template->desc);
        if($mail_template->att != ""){
            $att = $mail_template->att;
        }else{
            $att = "N";
        }
        $mail_data = [
            'id_registration' => $registration->id,
            'email' => $registration->email,
            'content' => $konten,
            'att' => $att,
        ];

        Mail::to($request->email)->send(new notification_mail($mail_data));
        return redirect('info-pendaftaran/'.$request->name);
    }
    public function informasi_pendafaran($name){
        $check = registration::where('name',$name)->count();
        if($check > 0){
            $registration = registration::where('name',$name)->orderBy('created_at','desc')->first();
            $data = [
                'name' => $name,
                'email' => $registration->email,
            ];
            return view('landing.jalur_seleksi.pengumuman',$data);
        }else{
            return view('landing.index');
        }
    }
    public function konten_kategori($id){
        $konten = konten::where('id_kategori',$id)->get();
        $data = [
            'kategori' => kategori_konten::find($id),
            'kategoris' => kategori_konten::all(),
            'konten' => $konten,

        ];
        return view('landing.info.konten',$data);
    }
    public function konten_detail($id){
        $konten = konten::find($id);
        $kategoris = kategori_konten::all();
        $related = konten::where('id_kategori',$konten->id_kategori)->where('id','!=',$id)->get();
        $data = [
            'konten' => $konten,
            'kategoris' => $kategoris,
            'related' => $related,
        ];
        return view('landing.info.konten_detail',$data);
    }
    public function pengumuman(){
        $konten = konten::where('id_kategori','1')->get();

        $data = [
            'konten' => $konten,
        ];

        return view('user.pendaftar.pengumuman.index',$data);
    }
    public function kontens_detail($id){
        $konten = konten::find($id);
        $related = konten::where('id_kategori',$konten->id_kategori)->where('id','!=',$id)->get();
        $data = [
            'menu' => 'landing',
            'submenu' => 'konten',
            'konten' => $konten,
            'related' => $related,
        ];
        return view('user.pendaftar.pengumuman.detail',$data);
    }
}
