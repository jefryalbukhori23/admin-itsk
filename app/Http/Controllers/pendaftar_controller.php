<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;



use App\Models\{

    batch_year,

    registration,

    prodi,

    jalur_seleksi,

    jalur_seleksi_class,

    sistem_kuliah,

    jawaban_ujian,

    jawaban_ujian_detail,

    jawaban_soal,

    ujian,

    ujian_soal,

    kategori_soal,

    berkas_pendaftaran,

    berkas_pendaftaran_mahasiswa,

    daftar_ulang,

    daftar_ulang_mahasiswa,

    mahasiswa,

    User,

    kategori_mail,

    sub_kategori_mail,

    mail_template,

    transaksi_pendaftaran,

    tagihan_daftar_ulang_mahasiswa,

    tagihan_daftar_ulang_mahasiswa_detail,

};

use Mail;

use App\Mail\notification_mail;

use DataTables;



class pendaftar_controller extends Controller

{
    public function index(Request $request){
        
        $by = batch_year::where('status','P')->first();
        $data = [
            'active_by' => $by->id,
            'data_by' => batch_year::where('name','like','%PMB%')->orderBy('id','desc')->get(),
            'menu' => 'master_pmb',
            'submenu' => 'pendaftar',
            'jml_peminat' => registration::join('jalur_seleksi','registration.id_jalur_seleksi','jalur_seleksi.id')
                                ->select('jalur_seleksi.name as jalur_seleksi','registration.*','registration.email as kontak','jalur_seleksi.periode as periode')
                                ->where('registration.status','waiting')
                                ->count(),
            'jml_pendaftar' =>  registration::join('jalur_seleksi','registration.id_jalur_seleksi','jalur_seleksi.id')
                                ->select('jalur_seleksi.name as jalur_seleksi','registration.*','registration.email as kontak','jalur_seleksi.periode as periode')
                                ->where('registration.status','wait approval')
                                ->count(),
            'jml_tes' => registration::join('jalur_seleksi','registration.id_jalur_seleksi','jalur_seleksi.id')
                                ->select('jalur_seleksi.name as jalur_seleksi','registration.*','registration.email as kontak','jalur_seleksi.periode as periode')
                                ->where('registration.status','LIKE','%tes%')
                                ->count(),
            'jml_diterima' => registration::join('jalur_seleksi','registration.id_jalur_seleksi','jalur_seleksi.id')
                                ->select('jalur_seleksi.name as jalur_seleksi','registration.*','registration.email as kontak','jalur_seleksi.periode as periode')
                                ->where('registration.status','diterima')->orWhere('registration.status','after daftar ulang')
                                ->count(),
            'jml_mahasiswa' => mahasiswa::where('id_batch_year',$by->id)->count(),
            'berkas' => berkas_pendaftaran::where('lokasi','pendaftaran')->get(),
        ];

        return view('user.admin.pendaftar.index',$data);
    }

    public function get_data(Request $request,$id_by){
        if ($request->ajax()) {
            $status = ['waiting','upload_ulang_pembayaran'];
            $data = registration::join('jalur_seleksi','registration.id_jalur_seleksi','jalur_seleksi.id')
                                ->select('jalur_seleksi.name as jalur_seleksi','registration.*','registration.email as kontak','jalur_seleksi.periode as periode')
                                ->where('registration.id_batch_year',$id_by)
                                ->whereIn('registration.status',$status)
                                ->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '  <button class="btn btn-sm btn-info text-white detail_peminat" title="Detail data peminat" data-bs-toggle="modal" data-bs-target="#detail_pendaftar_modal" value="'.$row->id.'">
                                        <i class="fa fa-info-circle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-success text-white add_berkas" title="Tambah Berkas Mahasiswa" data-bs-toggle="modal" data-bs-target="#add_berkas_modal" value="'.$row->id.'">
                                        <i class="fa fa-file"></i>
                                    </button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function get_data_pendaftar(Request $request,$id_by){
        if ($request->ajax()) {
            $data = registration::join('jalur_seleksi','registration.id_jalur_seleksi','jalur_seleksi.id')
                                ->select('jalur_seleksi.name as jalur_seleksi','registration.*','registration.email as kontak','jalur_seleksi.periode as periode')
                                ->where('registration.status','wait approval')
                                ->where('registration.id_batch_year',$id_by)
                                ->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status_du', function($row){
                    $cek_tagihan_daftar_ulang = tagihan_daftar_ulang_mahasiswa::where('id_registration',$row->id)->first();
                    if($cek_tagihan_daftar_ulang){
                        if($cek_tagihan_daftar_ulang->status == "W"){
                            $btn_daftar_ulang = '<button class="btn btn-sm btn-warning text-white du_modal" data-bs-toggle="modal" data-bs-target="#biaya_daftar_ulang_modal" value="'.$row->id.'" title="Menunggu Approval Owner">
                                                    <i class="fa fa-clock-o"></i> Dokumen Daftar Ulang
                                                </button>';
                        }elseif($cek_tagihan_daftar_ulang->status == "A"){
                            $btn_daftar_ulang = '<button class="btn btn-sm btn-success text-white du_modal" data-bs-toggle="modal" data-bs-target="#biaya_daftar_ulang_modal" value="'.$row->id.'" title="Sudah di Setujui Owner">
                                                    <i class="fa fa-check-circle"></i> Dokumen Daftar Ulang
                                                </button>';
                        }elseif($cek_tagihan_daftar_ulang->status == "D"){
                            $btn_daftar_ulang = '<button class="btn btn-sm btn-danger text-white du_modal" data-bs-toggle="modal" data-bs-target="#biaya_daftar_ulang_modal" value="'.$row->id.'" title="DiTolak Owner">
                                                    <i class="fa fa-times-circle"></i> Dokumen Daftar Ulang
                                                </button>';
                        }else{
                            $btn_daftar_ulang = '';
                        }
                    }else{
                        $btn_daftar_ulang = '-';
                    }
                    return $btn_daftar_ulang;
                })
                ->addColumn('action', function($row){
                    $waktu = date('l, d F Y H:i:s',strtotime($row->datetime_transaksi))." WIB";
                    $cek_tagihan_daftar_ulang = tagihan_daftar_ulang_mahasiswa::where('id_registration',$row->id)->first();
                    if($cek_tagihan_daftar_ulang){
                        $actionBtn = '  <button class="btn btn-sm btn-info text-white detail_peminat" title="Detail data peminat" data-bs-toggle="modal" data-bs-target="#detail_pendaftar_modal" value="'.$row->id.'">
                                            <i class="fa fa-info-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success img_bukti_transfer" title="Bukti Transfer Calon Mahasiswa" data-bs-toggle="modal" data-bs-target="#bukti_transfer_modal" data-name="'.$row->name.'" data-nama_rekening="'.$row->nama_rekening.'" data-no_rekening="'.$row->no_rekening.'" data-waktu="'.$waktu.'" data-img="'.$row->bukti_pembayaran.'">
                                            <i class="fa fa-image"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success text-white add_berkas" title="Tambah Berkas Mahasiswa" data-bs-toggle="modal" data-bs-target="#add_berkas_modal" value="'.$row->id.'">
                                            <i class="fa fa-file"></i>
                                        </button>';
                    }else{
                        $actionBtn = '  <button class="btn btn-sm btn-info text-white detail_peminat" title="Detail data peminat" data-bs-toggle="modal" data-bs-target="#detail_pendaftar_modal" value="'.$row->id.'">
                                            <i class="fa fa-info-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success img_bukti_transfer" title="Bukti Transfer Calon Mahasiswa" data-bs-toggle="modal" data-bs-target="#bukti_transfer_modal" data-name="'.$row->name.'" data-nama_rekening="'.$row->nama_rekening.'" data-no_rekening="'.$row->no_rekening.'" data-waktu="'.$waktu.'" data-img="'.$row->bukti_pembayaran.'">
                                            <i class="fa fa-image"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning acc_pendaftaran" title="Konfirmasi Pendaftaran" data-bs-toggle="modal" data-bs-target="#acc_modal" value="'.$row->id.'">
                                            <i class="fa fa-check-square-o"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success text-white add_berkas" title="Tambah Berkas Mahasiswa" data-bs-toggle="modal" data-bs-target="#add_berkas_modal" value="'.$row->id.'">
                                            <i class="fa fa-file"></i>
                                        </button>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action','status_du'])
                ->make(true);
        }
    }
    public function get_data_tes(Request $request,$id_by){
        if ($request->ajax()) {
            $data = registration::join('jalur_seleksi','registration.id_jalur_seleksi','jalur_seleksi.id')
                                ->select('jalur_seleksi.name as jalur_seleksi','registration.*','registration.email as kontak','jalur_seleksi.periode as periode')
                                ->where('registration.status','LIKE','%tes%')
                                ->where('registration.id_batch_year',$id_by)
                                ->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status_du', function($row){
                    $cek_tagihan_daftar_ulang = tagihan_daftar_ulang_mahasiswa::where('id_registration',$row->id)->first();
                    if($cek_tagihan_daftar_ulang){
                        if($cek_tagihan_daftar_ulang->status == "W"){
                            $btn_daftar_ulang = '<button class="btn btn-sm btn-warning text-white du_modal" data-bs-toggle="modal" data-bs-target="#biaya_daftar_ulang_modal" value="'.$row->id.'" title="Menunggu Approval Owner">
                                                    <i class="fa fa-clock-o"></i> Dokumen Daftar Ulang
                                                </button>';
                        }elseif($cek_tagihan_daftar_ulang->status == "A"){
                            $btn_daftar_ulang = '<button class="btn btn-sm btn-success text-white du_modal" data-bs-toggle="modal" data-bs-target="#biaya_daftar_ulang_modal" value="'.$row->id.'" title="Sudah di Setujui Owner">
                                                    <i class="fa fa-check-circle"></i> Dokumen Daftar Ulang
                                                </button>';
                        }elseif($cek_tagihan_daftar_ulang->status == "D"){
                            $btn_daftar_ulang = '<button class="btn btn-sm btn-danger text-white du_modal" data-bs-toggle="modal" data-bs-target="#biaya_daftar_ulang_modal" value="'.$row->id.'" title="DiTolak Owner">
                                                    <i class="fa fa-times-circle"></i> Dokumen Daftar Ulang
                                                </button>';
                        }else{
                            $btn_daftar_ulang = '';
                        }
                    }else{
                        $btn_daftar_ulang = '-';
                    }
                    return $btn_daftar_ulang;
                })
                ->addColumn('action', function($row){
                    $waktu = date('l, d F Y H:i:s',strtotime($row->datetime_tes))." WIB";
                    $kateogri_soal = kategori_soal::where('name','TPA')->first();
                    $ujian = ujian::where('id_kategori',$kateogri_soal->id)->first();
                    $jawaban = jawaban_ujian::where('id_registration',$row->id)->where('id_ujian',$ujian->id)->first();
                    // cek dokumen daftar ulang
                    $cek_tagihan_daftar_ulang = tagihan_daftar_ulang_mahasiswa::where('id_registration',$row->id)->first();
                    if($cek_tagihan_daftar_ulang){
                        if($row->status == "tes"){
                            $actionBtn = '<button class="btn btn-sm btn-info text-white detail_peminat" title="Detail data peminat" data-bs-toggle="modal" data-bs-target="#detail_pendaftar_modal" value="'.$row->id.'">
                                                <i class="fa fa-info-circle"></i>
                                            </button>
                                            <button class="btn btn-sm btn-success text-white add_berkas" title="Tambah Berkas Mahasiswa" data-bs-toggle="modal" data-bs-target="#add_berkas_modal" value="'.$row->id.'">
                                                <i class="fa fa-file"></i>
                                            </button>';
                        }else{
                           $actionBtn =    '<button class="btn btn-sm btn-info text-white detail_peminat" title="Detail data peminat" data-bs-toggle="modal" data-bs-target="#detail_pendaftar_modal" value="'.$row->id.'">
                                                <i class="fa fa-info-circle"></i>
                                            </button>
                                            <button class="btn btn-sm btn-success text-white add_berkas" title="Tambah Berkas Mahasiswa" data-bs-toggle="modal" data-bs-target="#add_berkas_modal" value="'.$row->id.'">
                                                <i class="fa fa-file"></i>
                                            </button>';
                        }
                    }else{
                        if($row->status == "tes"){
                            $actionBtn = '<button class="btn btn-sm btn-info text-white detail_peminat" title="Detail data peminat" data-bs-toggle="modal" data-bs-target="#detail_pendaftar_modal" value="'.$row->id.'">
                                                <i class="fa fa-info-circle"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger text-white check_tes2" title="Belum Melakukan Tes" data-bs-toggle="modal" data-bs-target="#check_tes_modal2" data-name="'.$row->name.'"data-id="'.$row->id.'">
                                                <i class="fa fa-times-circle"></i> Belum Melakukan Tes
                                            </button>
                                            <button class="btn btn-sm btn-success text-white add_berkas" title="Tambah Berkas Mahasiswa" data-bs-toggle="modal" data-bs-target="#add_berkas_modal" value="'.$row->id.'">
                                                <i class="fa fa-file"></i>
                                            </button>';
                        }else{
                           $actionBtn =    '<button class="btn btn-sm btn-info text-white detail_peminat" title="Detail data peminat" data-bs-toggle="modal" data-bs-target="#detail_pendaftar_modal" value="'.$row->id.'">
                                                <i class="fa fa-info-circle"></i>
                                            </button>
                                            <button class="btn btn-sm btn-success text-white check_tes" title="Lihat Jawaban Tes" data-bs-toggle="modal" data-bs-target="#check_tes_modal" data-name="'.$row->name.'" data-waktu="'.$waktu.'" data-id="'.$row->id.'" value="'.$jawaban->id.'">
                                                <i class="fa fa-check-circle-o"></i> Lihat Hasil
                                            </button>
                                            <button class="btn btn-sm btn-success text-white add_berkas" title="Tambah Berkas Mahasiswa" data-bs-toggle="modal" data-bs-target="#add_berkas_modal" value="'.$row->id.'">
                                                <i class="fa fa-file"></i>
                                            </button>';
                        }
                    }

                    return $actionBtn;
                })
                ->rawColumns(['action','status_du'])
                ->make(true);
        }
    }
    public function get_data_diterima(Request $request,$id_by){
        if ($request->ajax()) {
            $status = ['diterima','after daftar ulang'];
            $data = registration::join('jalur_seleksi','registration.id_jalur_seleksi','jalur_seleksi.id')
                                ->select('jalur_seleksi.name as jalur_seleksi','registration.*','registration.email as kontak','jalur_seleksi.periode as periode')
                                ->where('registration.id_batch_year',$id_by)
                                ->whereIn('registration.status',$status)
                                ->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    if($row->status == "after daftar ulang"){
                        $btn = '    <button class="btn btn-sm btn-success text-white">
                                        <i class="fa fa-check-circle-o"></i> Sudah Melakukan Daftar Ulang
                                    </button>';
                    }else{
                        $btn = '    <button class="btn btn-sm btn-danger text-white" title="Belum Melakukan Tes" disabled>
                                        <i class="fa fa-times-circle"></i> Belum Melakukan Daftar Ulang
                                    </button>';
                    }
                    return $btn;
                })
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    if($row->status == "after daftar ulang"){
                        $daftar_ulang_mahasiswa = daftar_ulang_mahasiswa::where('id_registration',$row->id)->first();
                        if($daftar_ulang_mahasiswa){
                            $waktu = date('l, d F Y H:i:s',strtotime($daftar_ulang_mahasiswa->datetime))." WIB";
                            $file_daftar_ulang = $daftar_ulang_mahasiswa->file;
                            $nama_rekening = $daftar_ulang_mahasiswa->nama_rekening;
                            $no_rekening = $daftar_ulang_mahasiswa->no_rekening;
                        }else{
                            $waktu = "-";
                            $file_daftar_ulang = "-";
                            $nama_rekening = "-";
                            $no_rekening = "-";
                        }
                        $actionBtn ='  <button class="btn btn-sm btn-info text-white detail_peminat" title="Detail data peminat" data-bs-toggle="modal" data-bs-target="#detail_pendaftar_modal" value="'.$row->id.'">
                                            <i class="fa fa-info-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success img_bukti_daftar_ulang" title="Bukti Transfer Calon Mahasiswa" data-bs-toggle="modal" data-bs-target="#bukti_daftar_ulang_modal" data-name="'.$row->name.'" data-nama_rekening="'.$nama_rekening.'" data-no_rekening="'.$no_rekening.'" data-waktu="'.$waktu.'" data-img="'.$file_daftar_ulang.'">
                                            <i class="fa fa-image"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning acc_daftar_ulang" title="Konfirmasi Daftar Ulang" value="'.$row->id.'" data-img="'.$file_daftar_ulang.'">
                                            <i class="fa fa-check-square-o"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success text-white add_berkas" title="Tambah Berkas Mahasiswa" data-bs-toggle="modal" data-bs-target="#add_berkas_modal" value="'.$row->id.'">
                                            <i class="fa fa-file"></i>
                                        </button>';
                    }else{
                        $actionBtn ='  <button class="btn btn-sm btn-info text-white detail_peminat" title="Detail data peminat" data-bs-toggle="modal" data-bs-target="#detail_pendaftar_modal" value="'.$row->id.'">
                                            <i class="fa fa-info-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success text-white add_berkas" title="Tambah Berkas Mahasiswa" data-bs-toggle="modal" data-bs-target="#add_berkas_modal" value="'.$row->id.'">
                                            <i class="fa fa-file"></i>
                                        </button>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
    }
    public function detail($id){
        $registration = registration::find($id)->toArray();
        $prodi1 = prodi::join('jenjang','prodi.id_jenjang','jenjang.id')
                        ->select('prodi.*','jenjang.name as jenjang')
                        ->where('prodi.id',$registration['id_prodi1'])->first();
        $prodi2 = prodi::join('jenjang','prodi.id_jenjang','jenjang.id')
                        ->select('prodi.*','jenjang.name as jenjang')
                        ->where('prodi.id',$registration['id_prodi2'])->first();

        $registration['prodi1'] = $prodi1->jenjang." ".$prodi1->name;
        $registration['prodi2'] = $prodi2->jenjang." ".$prodi2->name;
        $berkas_mahasiswa = berkas_pendaftaran_mahasiswa::join('berkas_pendaftaran','berkas_pendaftaran_mahasiswa.id_berkas_pendaftaran','berkas_pendaftaran.id')
                            ->where('id_registration',$id)->get();
        $filenames = array();
        if(count($berkas_mahasiswa) > 0){
            foreach($berkas_mahasiswa as $key => $row){
                $files[$key] = '<a href="/download-att-registration/'.$row->file.'" class="m-2"><button class="btn btn-sm btn-success" title="Download '.$row->name.'"><i class="fa fa-download"></i></button></a>';
                $file_name[$key]['name'] = $row->file;
                $file_name[$key]['id_berkas'] = $row->id_berkas_pendaftaran;
                $file_name[$key]['status'] = 'Y';
            }
        }else{
            $files = "Tidak ada file";
            $berkass = berkas_pendaftaran::where('lokasi','pendaftaran')->get();
            foreach($berkass as $key => $rows){
                $file_name[$key]['name'] = 'File tidak ditemukan';
                $file_name[$key]['id_berkas'] = $rows->id;
                $file_name[$key]['status'] = 'N';
            }
        }

        return response()->json(
            [
                'data' => $registration,
                'files' => $files,
                'filename' => $file_name,
            ],
            200
        );
    }
    public function get_detail_du($id){
        $registration = registration::find($id);
        $tagihan = tagihan_daftar_ulang_mahasiswa::where('id_registration',$id)->first();
        $tagihan_detail = tagihan_daftar_ulang_mahasiswa_detail::where('id_tagihan_daftar_ulang_mahasiswa',$tagihan->id)->get();

        return response()->json(
            [
                'registration' => $registration,
                'tagihan' => $tagihan,
                'tagihan_detail' => $tagihan_detail,
            ],200
        );
    }
    public function acc_pendaftaran(Request $request){
        date_default_timezone_set("Asia/Jakarta");
        $Today=date('y:m:d');

        $by = batch_year::where('status','P')->first();
        // add 3 days to date
        $NewDate=Date('d F Y', strtotime('+3 days'));

        $registration = registration::find($request->id);
        $registration->id_user_acc = auth()->user()->id;
        $registration->beasiswa = $request->beasiswa;
        if($request->status == "upload_ulang_pembayaran"){
            $registration->status = $request->status;
            $file_path = public_path() . "/file/payment/pendaftaran/".$registration->bukti_pembayaran;
            // cek jika ada
            if(file_exists($file_path)){
                // jalankan hapus file
                unlink($file_path);
            }
        }elseif($request->status == "tes"){
            $registration->status = $request->status;
            $jalur_seleksi = jalur_seleksi::find($registration->id_jalur_seleksi);
            $pricess = "Rp. ".number_format( $jalur_seleksi->price, 2, ",", ".");
            // insert transaksi pendaftaran
            $kode_transaksi = "REG-".date('YmdHis').$registration->id;
            $transaksi_pendaftaran = new transaksi_pendaftaran();
            $transaksi_pendaftaran->code = $kode_transaksi;
            $transaksi_pendaftaran->id_batch_year = $by->id;
            $transaksi_pendaftaran->id_registration = $registration->id;
            $transaksi_pendaftaran->id_user = $registration->id_user;
            $transaksi_pendaftaran->id_user_acc = auth()->user()->id;
            $transaksi_pendaftaran->nominal = $request->nominal;
            $transaksi_pendaftaran->image = $registration->bukti_pembayaran;
            $transaksi_pendaftaran->datetime_acc = date('Y-m-d H:i:s');
            $transaksi_pendaftaran->save();

            // get data kategori mail PMB
            $kategori_mail = kategori_mail::find(1);
            // get data sub_katategori_mail (pendaftaran)
            $sub_kategori_mail = sub_kategori_mail::where('id_kategori',$kategori_mail->id)->where('name','konfirmasi pendaftaran')->first();
            // Kirim email jika template di temukan
            if($sub_kategori_mail){
                $nominal_pendaftaran = "Rp. ".number_format( $transaksi_pendaftaran->nominal, 2, ",", ".");
                $mail_template = mail_template::where('id_kategori',$kategori_mail->id)->where('id_sub_kategori',$sub_kategori_mail->id)->first();
                $konten = str_replace("__nama_mahasiswa",$registration->name,$mail_template->desc);
                $konten = str_replace("__email_mahasiswa",$registration->email,$konten);
                $konten = str_replace("__biaya_pendaftaran",$nominal_pendaftaran,$konten);
                $konten = str_replace("__batas_waktu_pendaftaran",$NewDate,$konten);

                if($mail_template->att != ""){
                    $att = $mail_template->att;
                }else{
                    $att = "N";
                }

                $mail_data = [
                    'subject' => $mail_template->subject,
                    'id_registration' => $registration->id,
                    'email' => $registration->email,
                    'content' => $konten,
                    'att' => $att,
                ];

                try{
                    Mail::to($registration->email)->send(new notification_mail($mail_data));
                }catch(\Exception $e){

                }

            }

        }elseif($request->status == "diterima"){
            $jalur_seleksi = jalur_seleksi::find($registration->id_jalur_seleksi);
            $registration->prodi_diterima = $request->prodi_diterima;
            // insert transaksi pendaftaran
            if($request->nominal == true){
                $kode_transaksi = "REG-".date('YmdHis').$registration->id;
                $transaksi_pendaftaran = new transaksi_pendaftaran();
                $transaksi_pendaftaran->code = $kode_transaksi;
                $transaksi_pendaftaran->id_batch_year = $by->id;
                $transaksi_pendaftaran->id_registration = $registration->id;
                $transaksi_pendaftaran->id_user = $registration->id_user;
                $transaksi_pendaftaran->id_user_acc = auth()->user()->id;
                $transaksi_pendaftaran->nominal = $request->nominal;
                $transaksi_pendaftaran->image = $registration->bukti_pembayaran;
                $transaksi_pendaftaran->datetime_acc = date('Y-m-d H:i:s');
                $transaksi_pendaftaran->save();
            }
            // insert tagihan daftar ulang
            $check = tagihan_daftar_ulang_mahasiswa::where('id_registration',$registration->id)->count();
            if($check > 0){
                $tagihan_daftar_ulang_mhs =  tagihan_daftar_ulang_mahasiswa::where('id_registration',$registration->id)->first();
                $delete_old = tagihan_daftar_ulang_mahasiswa_detail::where('id_tagihan_daftar_ulang_mahasiswa',$tagihan_daftar_ulang_mhs->id)->get();
                foreach($delete_old as $row){
                    $hapus = tagihan_daftar_ulang_mahasiswa_detail::find($row->id);
                    $hapus->delete();
                }
            }else{
                $tagihan_daftar_ulang_mhs = new tagihan_daftar_ulang_mahasiswa();
            }
            $tagihan_daftar_ulang_mhs->id_registration = $registration->id;
            $tagihan_daftar_ulang_mhs->id_user = $registration->id_user;
            $tagihan_daftar_ulang_mhs->status = "A";
            $tagihan_daftar_ulang_mhs->save();
            // insert detail tagihan daftar ulang
            $total_tagihan_daftar_ulang = 0;
            for($i=0;$i<count($request->id_daftar_ulang);$i++){
                $daftar_ulang_data = daftar_ulang::find($request->id_daftar_ulang[$i]);
                if($request->beasiswa_per_item == true){
                    if($request->beasiswa_per_item[$i] == true){
                        $beasiswa_per_item = $request->beasiswa_per_item[$i];
                    }else{
                        $beasiswa_per_item = 0;
                    }
                }else{
                    $beasiswa_per_item = 0;
                }


                $tagihan_daftar_ulang_detail = new tagihan_daftar_ulang_mahasiswa_detail();
                $tagihan_daftar_ulang_detail->id_tagihan_daftar_ulang_mahasiswa = $tagihan_daftar_ulang_mhs->id;
                $tagihan_daftar_ulang_detail->nama_tagihan = $daftar_ulang_data->name;
                $tagihan_daftar_ulang_detail->nominal = $daftar_ulang_data->price - ($daftar_ulang_data->price*$beasiswa_per_item/100);
                $tagihan_daftar_ulang_detail->beasiswa = $beasiswa_per_item;
                $tagihan_daftar_ulang_detail->save();

                $total_tagihan_daftar_ulang = $total_tagihan_daftar_ulang + ($daftar_ulang_data->price - ($daftar_ulang_data->price*$beasiswa_per_item/100));
            }
            // update total
            $tagihan_daftar_ulang_update = tagihan_daftar_ulang_mahasiswa::find($tagihan_daftar_ulang_mhs->id);
            $tagihan_daftar_ulang_update->total = $total_tagihan_daftar_ulang;
            $tagihan_daftar_ulang_update->save();

            // $pricee = $jalur_seleksi->price*(100-$registration->beasiswa)/100;
            // $pricess = "Rp. ".number_format($pricee, 2, ",", ".");
            // get data kategori mail PMB
            // $kategori_mail = kategori_mail::find(1);
            // // get data sub_katategori_mail (pendaftaran)
            // $sub_kategori_mail = sub_kategori_mail::where('id_kategori',$kategori_mail->id)->where('name','konfirmasi pendaftaran')->first();
            // // Kirim email jika template di temukan
            // if($sub_kategori_mail){
            //     $mail_template = mail_template::where('id_kategori',$kategori_mail->id)->where('id_sub_kategori',$sub_kategori_mail->id)->first();
            //     $konten = str_replace("__nama_mahasiswa",$registration->name,$mail_template->desc);
            //     $konten = str_replace("__email_mahasiswa",$registration->email,$konten);
            //     // $konten = str_replace("__biaya_pendaftaran",$pricess,$konten);

            //     if($mail_template->att != ""){
            //         $att = $mail_template->att;
            //     }else{
            //         $att = "N";
            //     }

            //     $mail_data = [
            //         'subject' => $mail_template->subject,
            //         'id_registration' => $registration->id,
            //         'email' => $registration->email,
            //         'content' => $konten,
            //         'att' => $att,
            //     ];

            //     try{
            //         Mail::to($registration->email)->send(new notification_mail($mail_data));
            //     }catch(\Exception $e){

            //     }

            // }

            // $pricess = "Rp. ".number_format($jalur_seleksi->price, 2, ",", ".");
            // // get data kategori mail PMB
            // $kategori_mail = kategori_mail::find(1);
            // // get data sub_katategori_mail (pendaftaran)
            // $sub_kategori_mail = sub_kategori_mail::where('id_kategori',$kategori_mail->id)->where('name','diterima')->first();
            // // Kirim email jika template di temukan
            // if($sub_kategori_mail){
            //     $mail_template = mail_template::where('id_kategori',$kategori_mail->id)->where('id_sub_kategori',$sub_kategori_mail->id)->first();
            //     $konten = str_replace("__nama_mahasiswa",$registration->name,$mail_template->desc);
            //     $konten = str_replace("__email_mahasiswa",$registration->email,$konten);
            //     $konten = str_replace("__biaya_pendaftaran",$pricess,$konten);

            //     if($mail_template->att != ""){
            //         $att = $mail_template->att;
            //     }else{
            //         $att = "N";
            //     }

            //     $mail_data = [
            //         'subject' => $mail_template->subject,
            //         'id_registration' => $registration->id,
            //         'email' => $registration->email,
            //         'content' => $konten,
            //         'att' => $att,
            //     ];
            //     // Mail::to($registration->email)->send(new notification_mail($mail_data));
            // }
        }elseif($request->status == "diterima_final"){
            $registration->status = 'diterima';
            $jalur_seleksi = jalur_seleksi::find($registration->id_jalur_seleksi);

            // $pricee = $jalur_seleksi->price*(100-$registration->beasiswa)/100;
            // $pricess = "Rp. ".number_format($pricee, 2, ",", ".");
            // get data kategori mail PMB
            $kategori_mail = kategori_mail::find(1);
            // get data sub_katategori_mail (pendaftaran)
            $sub_kategori_mail = sub_kategori_mail::where('id_kategori',$kategori_mail->id)->where('name','rincian biaya daftar ulang')->first();
            // Kirim email jika template di temukan
            if($sub_kategori_mail){
                $tagihan_daftar_ulang_mahasiswa = tagihan_daftar_ulang_mahasiswa::where('id_registration',$registration->id)->first();
                $tagihan_daftar_ulang_mahasiswa_detail = tagihan_daftar_ulang_mahasiswa_detail::where('id_tagihan_daftar_ulang_mahasiswa',$tagihan_daftar_ulang_mahasiswa->id)->get();
                $rincian_biaya = '<table style="width: 50%; border-collapse: collapse;"><thead><tr><th  style="border: 1px solid black; padding: 8px;">No</th><th style="border: 1px solid black; padding: 8px;">Nama</th><th style="border: 1px solid black; padding: 8px;">Nominal</th></tr></thead><tbody>';
                foreach($tagihan_daftar_ulang_mahasiswa_detail as $key => $row){
                    $urutan = $key+1;
                    $rincian_biaya = $rincian_biaya.'<tr><td style="border: 1px solid black; padding: 8px;">'.$urutan.'</td><td style="border: 1px solid black; padding: 8px;">'.$row->nama_tagihan.'</td><td style="border: 1px solid black; padding: 8px;">Rp. '.number_format($row->nominal, 2, ",", ".").'</td></tr>';
                }
                $rincian_biaya = $rincian_biaya.'</tbody><tfoot><tr><th colspan="2" style="border: 1px solid black; padding: 8px;">Total </th><th style="border: 1px solid black; padding: 8px;"> '.'Rp. '.number_format($tagihan_daftar_ulang_mahasiswa->total, 2, ",", ".").'</th></tr></tfoot></table>';
                $mail_template = mail_template::where('id_kategori',$kategori_mail->id)->where('id_sub_kategori',$sub_kategori_mail->id)->first();
                $konten = str_replace("__nama_mahasiswa",$registration->name,$mail_template->desc);
                $konten = str_replace("__rincian_biaya_daftar_ulang",$rincian_biaya,$konten);
                // $konten = str_replace("__biaya_pendaftaran",$pricess,$konten);

                if($mail_template->att != ""){
                    $att = $mail_template->att;
                }else{
                    $att = "N";
                }

                $mail_data = [
                    'subject' => $mail_template->subject,
                    'id_registration' => $registration->id,
                    'email' => $registration->email,
                    'content' => $konten,
                    'att' => $att,
                ];
                try{
                    Mail::to($registration->email)->send(new notification_mail($mail_data));
                }catch(\Exception $e){

                }
            }

            $pricess = "Rp. ".number_format($jalur_seleksi->price, 2, ",", ".");
            // get data kategori mail PMB
            $kategori_mail = kategori_mail::find(1);
            // get data sub_katategori_mail (pendaftaran)
            $sub_kategori_mail = sub_kategori_mail::where('id_kategori',$kategori_mail->id)->where('name','diterima')->first();
            // Kirim email jika template di temukan
            if($sub_kategori_mail){
                $mail_template = mail_template::where('id_kategori',$kategori_mail->id)->where('id_sub_kategori',$sub_kategori_mail->id)->first();
                $konten = str_replace("__nama_mahasiswa",$registration->name,$mail_template->desc);
                $konten = str_replace("__email_mahasiswa",$registration->email,$konten);
                $konten = str_replace("__biaya_pendaftaran",$pricess,$konten);

                if($mail_template->att != ""){
                    $att = $mail_template->att;
                }else{
                    $att = "N";
                }

                $mail_data = [
                    'subject' => $mail_template->subject,
                    'id_registration' => $registration->id,
                    'email' => $registration->email,
                    'content' => $konten,
                    'att' => $att,
                ];
                // Mail::to($registration->email)->send(new notification_mail($mail_data));
            }
        }
        $registration->save();


        return response()->json(
            [
                'msg' => 'success',
            ],200
        );
    }
    public function acc_daftar_ulang(Request $request){
        date_default_timezone_set("Asia/Jakarta");
        $registration = registration::find($request->id);
        $registration->status = "done";
        $registration->save();

        $batch_year = batch_year::where('status','P')->first();
         if($registration->prodi_diterima != null){
              $count_mhs = mahasiswa::where('id_prodi',$registration->prodi_diterima)->where('id_batch_year',$batch_year->id)->count();
         }else{
             $count_mhs = mahasiswa::where('id_prodi',$registration->id_prodi1)->where('id_batch_year',$batch_year->id)->count();
         }

        //if(strlen($count_mhs) == "1"){
        //    $no_urut = "00".$count_mhs+1;
        //}elseif(strlen($count_mhs) == "2"){
        //    $no_urut = "0".$count_mhs+1;
        //}elseif(strlen($count_mhs) == "3"){
        //    $no_urut = $count_mhs+1;
        //}

        if(strlen($count_mhs+1) == "1"){
            $no_urut = "00".$count_mhs+1;
        }elseif(strlen($count_mhs+1) == "2"){
            $no_urut = "0".$count_mhs+1;
        }elseif(strlen($count_mhs+1) == "3"){
            $no_urut = $count_mhs+1;
        }

        $by = explode('/',$batch_year->name);

        $year = date('y',strtotime($by[0]));

        $user_mhs = User::find($registration->id_user);
        if($registration->prodi_diterima == null){
            $prodi = prodi::find($registration->id_prodi1);
        }else{
            $prodi = prodi::find($registration->prodi_diterima);
        }

        $nim = "06".$year.$prodi->kode.$no_urut;

      	if($registration->agama != null){
        	$agama_reg = $registration->agama;
        }else{
        	$agama_reg = "Tidak ingin memberi tahu";
        }

        $mahasiswa = new mahasiswa();
        $mahasiswa->semester = 1;
        if($registration->prodi_diterima != null){
            $mahasiswa->id_prodi = $registration->prodi_diterima;
        }else{
            $mahasiswa->id_prodi = $registration->id_prodi1;
        }
        $mahasiswa->id_batch_year = $batch_year->id;
        // $mahasiswa->nim = $nim;
        $mahasiswa->nim = "Belum";
        $mahasiswa->gender = $registration->gender;
        $mahasiswa->name = $registration->name;
        $mahasiswa->phone = $registration->phone;
        $mahasiswa->email = $registration->email;
        $mahasiswa->date_birth = $registration->date_birth;
        $mahasiswa->place_birth = $registration->place_birth;
        $mahasiswa->id_user = $registration->id_user;
        $mahasiswa->nisn = $registration->nisn;
        $mahasiswa->id_sistem_kuliah =$registration->id_sistem_kuliah;
        $mahasiswa->address = $registration->address;
        $mahasiswa->status_perkawinan = $registration->status_perkawinan;
        $mahasiswa->nama_ayah = $registration->nama_ayah;
        $mahasiswa->nama_ibu = $registration->nama_ibu;
        $mahasiswa->nama_wali = $registration->nama_wali;
        $mahasiswa->pekerjaan_ayah = $registration->pekerjaan_ayah;
        $mahasiswa->pekerjaan_ibu = $registration->pekerjaan_ibu;
        $mahasiswa->no_hp_ortu = $registration->no_hp_ortu;
        $mahasiswa->alamat_ortu = $registration->alamat_ortu;
        $mahasiswa->image = $user_mhs->profile_image;
        $mahasiswa->agama = $agama_reg;
        $mahasiswa->id_jalur_seleksi = $registration->id_jalur_seleksi;
        $mahasiswa->tahun_masuk = $by[0];
        $mahasiswa->status = "Mahasiswa Baru";
        $mahasiswa->save();

        $mhs_user = User::find($registration->id_user);
        $mhs_user->role = '3';
        $mhs_user->id_prodi = $registration->prodi_diterima;
        $mhs_user->save();

        $total = daftar_ulang::where('kategori_pembayaran','pendaftaran')
                                    ->where('id_jalur_seleksi',$registration->id_jalur_seleksi)
                                    ->where('id_prodi',$registration->prodi_diterima)
                                    ->sum('price');
        $totale = $total*(100-$registration->beasiswa)/100;
        $totals = "Rp. ".number_format($totale, 2, ",", ".");
        // get data kategori mail PMB
        $kategori_mail = kategori_mail::find(1);
        // get data sub_katategori_mail (pendaftaran)
        $sub_kategori_mail = sub_kategori_mail::where('id_kategori',$kategori_mail->id)->where('name','daftar ulang')->first();
        // Kirim email jika template di temukan
        if($sub_kategori_mail){
            $mail_template = mail_template::where('id_kategori',$kategori_mail->id)->where('id_sub_kategori',$sub_kategori_mail->id)->first();
            $konten = str_replace("__nama_mahasiswa",$registration->name,$mail_template->desc);
            $konten = str_replace("__email_mahasiswa",$registration->email,$konten);
            $konten = str_replace("__total_biaya_daftar_ulang",$totals,$konten);

            if($mail_template->att != ""){
                $att = $mail_template->att;
            }else{
                $att = "N";
            }

            $mail_data = [
                'subject' => $mail_template->subject,
                'id_registration' => $registration->id,
                'email' => $registration->email,
                'content' => $konten,
                'att' => $att,
            ];

            try{
                Mail::to($registration->email)->send(new notification_mail($mail_data));
            }catch(\Exception $e){

            }
        }


        // insert transaksi daftar ulang
        $total = $request->total;
        $code_transaksi = "DUMHS-".date('YmdHis').$mahasiswa->nim;

        // insert transaksi
        $transaksi_daftar_ulang = new transaksi_daftar_ulang();
        $transaksi_daftar_ulang->id_mahasiswa = $mahasiswa->id;
        $transaksi_daftar_ulang->id_batch_year = $batch_year->id;
        $transaksi_daftar_ulang->id_registration = $registration->id;
        $transaksi_daftar_ulang->id_user = $mahasiswa->id_user;
        $transaksi_daftar_ulang->desc = "Pembayaran Daftar Ulang";
        $transaksi_daftar_ulang->code = $code_transaksi;
        $transaksi_daftar_ulang->total = $total;
        $transaksi_daftar_ulang->bukti = $request->img;
        $transaksi_daftar_ulang->id_user_acc = auth()->user()->id;
        $transaksi_daftar_ulang->date = date("Y-m-d");
        $transaksi_daftar_ulang->status = "Y";
        $transaksi_daftar_ulang->save();

        $tagihan_daftar_ulang_mahasiswa = tagihan_daftar_ulang_mahasiswa::where('id_registration',$registration->id)->first();
        $tagihan_daftar_ulang_mahasiswa_detail = tagihan_daftar_ulang_mahasiswa_detail::where('id_tagihan_daftar_ulang_mahasiswa',$tagihan_daftar_ulang_mahasiswa->id)->get();
        $bayar = $total;
        foreach($tagihan_daftar_ulang_mahasiswa_detail as $row){
            if($bayar > $row->nominal){
                $dibayar = $row->nominal;
                $bayar = $bayar-$row->nominal;
            }else{
                if($bayar > 0){
                    $dibayar = $bayar;
                    $bayar = $bayar-$row->nominal;
                }else{
                    $dibayar = 0;
                }
            }
            // insert transaksi detail
            $transaksi_daftar_ulang_detail = new transaksi_daftar_ulang_detail();
            $transaksi_daftar_ulang_detail->id_transaksi_daftar_ulang = $transaksi_daftar_ulang->id;
            $transaksi_daftar_ulang_detail->id_tagihan_daftar_ulang_mahasiswa = $tagihan_daftar_ulang_mahasiswa->id;
            $transaksi_daftar_ulang_detail->id_tagihan_daftar_ulang_mahasiswa_detail = $row->id;
            $transaksi_daftar_ulang_detail->bayar = $dibayar;
            $transaksi_daftar_ulang_detail->save();
        }


        return response()->json(
            [
                'msg' => 'success',
            ],
            200
        );
    }
    public function coba(){
        $total = 2100000;
        echo $total."<br><br>";
        $tagihan = [1250000,250000,300000,1000000,250000];
        foreach($tagihan as $row){
            if($total > $row){
                $dibayar = $row;
                $total = $total-$row;
            }else{
                if($total > 0){
                    $dibayar = $total;
                    $total = $total-$row;
                }else{
                    $dibayar = 0;
                }
            }
            echo $row." - ".$dibayar."<br>";
            echo $total."<br><br><br>";
        }
    }
    public function update_berkas_mahasiswa(Request $request){
        // delete old berkas
        $berkas_old_check = berkas_pendaftaran_mahasiswa::where('id_registration',$request->id_mahasiswa)->count();
        if($berkas_old_check > 0){
            $berkas_old = berkas_pendaftaran_mahasiswa::where('id_registration',$request->id_mahasiswa)->get();
            foreach($berkas_old as $row){
                $delete_old_berkas = berkas_pendaftaran_mahasiswa::find($row->id);
                $delete_old_berkas->delete();
            }
        }
        $berkas = berkas_pendaftaran::where('lokasi','pendaftaran')->get();
        $registator = registration::find($request->id_mahasiswa);
        $user = user::find($registator->id_user);
        foreach($berkas as $row){
            $id_berkas = (string)$row->id;
            if($request->$id_berkas == true){
                $file_name1 = "registration_file_".$row->name."_".$request->email.uniqid().".".$request->$id_berkas->extension();
                $file_name1 = str_replace("/","_",$file_name1);
                $request->$id_berkas->move(public_path('file/registration'),$file_name1);
                $berkas_file = new berkas_pendaftaran_mahasiswa();
                $berkas_file->id_berkas_pendaftaran = $row->id;
                $berkas_file->id_registration = $request->id_mahasiswa;
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

        return response()->json(
            [
                'msg' => 'success',
            ],
            200
        );
    }
    public function export_pendaftaran($jenis,$id_by){
       	if($jenis == 'tes'){
            $registration = registration::where('status','LIKE','%tes%')->where('id_batch_year',$id_by)->get();
        }elseif($jenis == "diterima"){
            $status_diterima = ['diterima','aftar daftar ulang'];
            $registration = registration::whereIn('status', $status_diterima)->where('id_batch_year',$id_by)->get();
        }elseif($jenis == 'pendaftar'){
            $registration = registration::where('status','wait approval')->where('id_batch_year',$id_by)->get();
        }else{
            $registration = registration::where('status',$jenis)->where('id_batch_year',$id_by)->get();
        }

        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load(public_path('excel/form_export_pendaftar.xlsx'));
        // set main data
        $sheet = $spreadsheet->getActiveSheet();
        $baris = 4;
        $nomer = 1;
        foreach($registration as $row){
            switch($row->status){
                case "wait approval";
                	$status = "Menunggu persetujuan Admin";
                break;
                case "waiting";
                    $status = "Hanya mengisi formulir tapi belum melakukan pembayaran";
                break;
                case "tes";
                    $status = "Harus Melakukan Tes Potensi Akademik";
                break;
                case "wait after tes";
                    $status = "Sudah Melakukan Tes , tapi admin belum melakuakn ACC";
                break;
                case "diterima";
                    $status = "Harus Melakukan Daftar Ulang";
                break;
                case "after daftar ulang";
                    $status = "Sudah Daftar Ulang, tapi admin belum melakukan ACC";
                break;
                case "done";
                    $status = "Sudah Diterima sebagai mahasiswa";
                break;
            }

            $jalur_seleksis = jalur_seleksi::find($row->id_jalur_seleksi);
            $jalur_seleksi = $jalur_seleksis->name;

            $sistem_kuliahs = sistem_kuliah::find($row->id_sistem_kuliah);
            $sistem_kuliah = $sistem_kuliahs->name;

            $prodis1 = prodi::find($row->id_prodi1);
            $prodi1 = $prodis1->name;

            $prodis2 = prodi::find($row->id_prodi2);
            $prodi2 = $prodis2->name;

            if($row->prodi_diterima != null){
                $prodi_diterimas = prodi::find($row->prodi_diterima);
                $prodi_diterima = $prodi_diterimas->name;
            }else{
                $prodi_diterima = "";
            }
            $tgl_daftar = date('d F Y',strtotime($row->created_at));
            $jam_daftar = date('H:i:s',strtotime($row->created_at));
            $update_terakhir = date('d F Y H:i:s',strtotime($row->updated_at));

            $mhs = mahasiswa::where('id_user',$row->id_user)->first();
            if($mhs){
                $nim = $mhs->nim;
            }else{
                $nim = 'Belum';
            }

            $sheet->setCellValue('A'.$baris,$nomer);
            $sheet->setCellValue('B'.$baris,$nim);
            $sheet->setCellValue('D'.$baris,$row->nisn);
            $sheet->setCellValue('F'.$baris,$row->name);
            $sheet->setCellValue('G'.$baris,"'".$row->id_no);
            $sheet->setCellValue('H'.$baris,$row->email);
            $sheet->setCellValue('I'.$baris,$row->phone);
            $sheet->setCellValue('J'.$baris,$row->gender);
            $sheet->setCellValue('K'.$baris,$row->agama);
            $sheet->setCellValue('L'.$baris,$row->school);
            $sheet->setCellValue('M'.$baris,$row->jurusan);
            $sheet->setCellValue('N'.$baris,$row->nationality);
            $sheet->setCellValue('O'.$baris,$row->address);
            $sheet->setCellValue('P'.$baris,$row->bank);
            $sheet->setCellValue('Q'.$baris,$row->nama_rekening);
            $sheet->setCellValue('R'.$baris,$row->no_rekening);
            $sheet->setCellValue('S'.$baris,$row->nama_ayah);
            $sheet->setCellValue('T'.$baris,$row->nama_ibu);
            $sheet->setCellValue('U'.$baris,$row->nama_wali);
            $sheet->setCellValue('V'.$baris,$row->pekerjaan_ayah);
            $sheet->setCellValue('W'.$baris,$row->pekerjaan_ibu);
            $sheet->setCellValue('X'.$baris,$row->no_hp_ortu);
            $sheet->setCellValue('Y'.$baris,$tgl_daftar);
            $sheet->setCellValue('Z'.$baris,$jam_daftar);
            $sheet->setCellValue('AA'.$baris,$update_terakhir);
            $sheet->setCellValue('AB'.$baris,$jalur_seleksi);
            $sheet->setCellValue('AC'.$baris,$sistem_kuliah);
            $sheet->setCellValue('AD'.$baris,$prodi1);
            $sheet->setCellValue('AE'.$baris,$prodi2);
            $sheet->setCellValue('AF'.$baris,$prodi_diterima);
            $sheet->setCellValue('AG'.$baris,$status);
            $sheet->setCellValue('AH'.$baris,$row->nama_rekomendasi);
            $sheet->setCellValue('AI'.$baris,$row->tahun_lulus);
            $baris++;
            $nomer++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Rekap Pendaftaran.xlsx"');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        return $writer->save('php://output');
    }
    public function cancel_du(Request $request){
        $tagihan_daftar_ulang_mhs = tagihan_daftar_ulang_mahasiswa::where('id_registration',$request->id)->first();
        if($tagihan_daftar_ulang_mhs){
            $tagihan_mhs = tagihan_daftar_ulang_mahasiswa_detail::where('id_tagihan_daftar_ulang_mahasiswa',$tagihan_daftar_ulang_mhs->id)->get();
            foreach($tagihan_mhs as $row){
                $delete = tagihan_daftar_ulang_mahasiswa_detail::find($row->id);
                $delete->delete();
            }
            $tagihan_daftar_ulang_mhs->delete();
            return response()->json(
                [
                    'msg' => 'success',
                ],200
            );
        }else{
            return response()->json(
                [
                    'msg' => 'no data',
                ],200
            );
        }
    }
    
    public function get_mahasiswa(Request $request,$id_by){
        $by = batch_year::where('status','P')->first();
        if ($request->ajax()) {
            $registration = registration::where('id_batch_year',$id_by)->pluck('id_user')->toArray();
            $data = mahasiswa::join('prodi','mahasiswa.id_prodi','prodi.id')->join('users','mahasiswa.id_user','users.id')->join('registration','users.id','registration.id_user')->select('mahasiswa.*','prodi.name as prodi','registration.kode as kode')->where('mahasiswa.new',null)->whereIn('mahasiswa.id_user',$registration)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('slider', function($row){
                    if($row->status == "AKTIF"){
                        $check_btn = '';
                    }else{
                        $check_btn = '  <div class="check_box">
                                            <label class="switch">
                                                <input type="checkbox" class="checked_box" name="id_mhs[]" value="'.$row->id.'">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>';
                    }
                    return $check_btn;
                })
                ->addColumn('status', function($row){
                    if($row->status == "AKTIF"){
                        return '<span class="badge bg-success text-white">'.$row->status.'</span>';
                    }else{
                        return '<span class="badge bg-info text-dark">'.$row->status.'</span>';
                    }
                })
                ->addColumn('action', function($row){
                        $actionBtn = '  <button class="btn btn-sm btn-primary text-white detail" data-bs-toggle="modal" title="Detail Data Mahasiswa" data-bs-target="#detail_modal" value="'.$row->id.'">
                                            <i class="fa fa-info-circle"></i>
                                        </button>';

                    return $actionBtn;
                })
                ->rawColumns(['action','status','slider'])
                ->make(true);
        }
    }
    public function get_daftar_ulang_calon_mhs(Request $request,$id,$id_prodi){

        if($request->ajax()){

            $registration = registration::find($id);

            if($registration){

                $data = daftar_ulang::where('kategori_pembayaran','pendaftaran')

                                        ->where('id_jalur_seleksi',$registration->id_jalur_seleksi)

                                        ->where('id_prodi',$id_prodi)

                                        ->get();

            }else{

                $data = [];

            }

            return Datatables::of($data)

                ->addIndexColumn()

                ->addColumn('biaya', function($row){

                    $biaya = "Rp. ".number_format($row->price, 2, ",", ".");

                    return $biaya;

                })

                ->addIndexColumn()

                ->addColumn('action', function($row){

                    $input = '<input type="hidden" name="id_daftar_ulang[]" value="'.$row->id.'">

                                <input type="number" min="0" max="100" placeholder="Masukan Prosentase beasiswa" class="form-control input_beasiswa" name="beasiswa_per_item[]" disabled>';

                    return $input;

                })

                ->rawColumns(['action'])

            ->make(true);

        }

    }

    // Pindah Pendaftar
    public function pindah_pendaftar(){
        $active_by = batch_year::where('status','P')->first();
        $data = [
            'active_by' => $active_by,
            'menu' => 'master_pmb',
            'submenu' => 'pindah',
            'prodi' => prodi::all(),
            'jalur_seleksi' => jalur_seleksi::all(),
        ];

        return view('user.admin.pindah_pendaftar.index',$data);
    }
    public function get_pindah_pendaftar(Request $request){
        if($request->ajax()){
            $active_by = batch_year::where('status','P')->first();
            $data = registration::where('id_batch_year',$active_by->id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('progres', function($row){
                    $status_peminat = ['waiting','upload_ulang_pembayaran'];
                    $status_du = ['diterima','after daftar ulang'];
                    if(in_array($row->status,$status_peminat)){
                        return 'Peminat';
                    }elseif($row->status == 'wait approval'){
                        return 'Pendaftar';
                    }elseif(strpos($row->status, 'tes')){
                        return 'Tes';
                    }elseif(in_array($row->status,$status_du)){
                        return 'Daftar Ulang';
                    }else{
                        return 'Diterima';
                    }
                    
                })
                ->addColumn('prodi1', function($row){
                    $prodi = prodi::find($row->id_prodi1);
                    if($prodi){
                        return $prodi->name;
                    }else{
                        return '-';
                    }
                })
                ->addColumn('prodi2', function($row){
                    $prodi = prodi::find($row->id_prodi2);
                    if($prodi){
                        return $prodi->name;
                    }else{
                        return '-';
                    }
                })
                ->addColumn('jalur_seleksi', function($row){
                    $jalur_seleksi = jalur_seleksi::find($row->id_jalur_seleksi);
                    if($jalur_seleksi){
                        return $jalur_seleksi->name;
                    }else{
                        return '-';
                    }
                })
                ->addColumn('action', function($row){
                        $actionBtn = '  <button class="btn btn-sm btn-info text-white detail_peminat" data-bs-toggle="modal" title="Detail Data" data-bs-target="#detail_pendaftar_modal" value="'.$row->id.'">
                                            <i class="fa fa-info-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary text-white pindah_prodi" data-prodi1="'.$row->id_prodi1.'" data-prodi2="'.$row->id_prodi2.'" data-bs-toggle="modal" title="Pindah Prodi" data-bs-target="#pindah_prodi_modal" value="'.$row->id.'">
                                            <i class="fa fa-mortar-board"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success text-white pindah_jalur_seleksi" data-id_jalur_seleksi="'.$row->id_jalur_seleksi.'" data-bs-toggle="modal" title="Pindah Jalur Seleksi" data-bs-target="#pindah_jalur_seleksi_modal" value="'.$row->id.'">
                                            <i class="fa fa-code-fork"></i>
                                        </button>
                                        ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
            ->make(true);
        }
    }
    public function pindah_prodi_store(Request $request){
        $registration = registration::find($request->id_registration);
        $registration->id_prodi1 = $request->prodi1;
        $registration->id_prodi2 = $request->prodi2;
        $registration->save();

        return response()->json([
            'msg'=> 'success',
        ],200);
    }
    public function pindah_jalur_seleksi_store(Request $request){
        $registration = registration::find($request->id_registration);
        $registration->id_jalur_seleksi = $request->id_jalur_seleksi;
        $registration->save();

        return response()->json([
            'msg'=> 'success',
        ],200);

    }
}

