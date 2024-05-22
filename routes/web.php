<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    login_controller,
    page_controller,
    lang_controller,
    prodi_controller,
    fakultas_controller,
    jenjang_controller,
    batch_year_controller,
    sistem_kuliah_controller,
    program_controller,
    konten_controller,
    slider_controller,
    download_controller,
    user_controller,
    kategori_konten_controller,
    mail_template_controller,
    landing_menu_controller,
    landing_page_controller,
    lecture_controller,
    position_controller,
    building_room_function_controller,
    hours_controller,
    kegiatan_berbayar_controller,
    krs_date_controller,
    kalender_akademik_controller,
    karyawan_controller,
    pekerjaan_karyawan_controller,
    jabatan_pengurus_controller,
    pengurus_controller,
    kuisioner_dosen_controller,
    ForgotPasswordController,
    general_controller,
    daftar_ulang_owner_controller,
    pendaftar_controller,
    berita_controller,
};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// landing page
//  route::get('/', function(){
//      return redirect('http://acc.sugenghartono.ac.id');
// });
//route::get('/',[login_controller::class,'login']);
route::get('detail-jalur-seleksi/{id}', [page_controller::class, 'jalur_seleksi_detail']);
route::get('registration/{id}', [page_controller::class, 'registration']);
// route::get('info-pendaftaran',[page_controller::class,'info_pendaftaran']);
route::get('konten-kategori/{id}', [page_controller::class, 'konten_kategori']);
route::get('konten-detail/{id}', [page_controller::class, 'konten_detail']);
route::get('get-prodi-jalur-seleksi/{id}', [page_controller::class, 'get_prodi_jalur_seleksi']);

// forgot password


Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

// API
route::get('get-regencies/{id}', [page_controller::class, 'get_regencies']);
route::get('get-districts/{id}', [page_controller::class, 'get_districts']);
route::get('get-villages/{id}', [page_controller::class, 'get_villages']);

// login
route::get('lang/change', [lang_controller::class, 'change'])->name('change_lang');
// Route::get('/login', [login_controller::class, 'login'])->name('login')->middleware('guest');
Route::get('/', [login_controller::class, 'login']);
Route::get('/logins/{params}/{id}/{params2}/{credentials}/{params3}', [login_controller::class, 'logins']);
Route::post('/loginAction', [login_controller::class, 'authenticate']);
Route::post('/logout', [login_controller::class, 'logoutProcess']);
// route::get('change-lang',[lang_controller::class,'change']);

// download route
route::get('download-att-registration/{file_name}', [download_controller::class, 'download_att_registration']);
route::get('download-konten-file/{file_name}', [download_controller::class, 'download_konten_file']);
// Api with login authentication
Route::group(['middleware' => ['auth']], function () {
    route::get('/dashboard', [page_controller::class, 'index']);
    route::get('account-setting', [user_controller::class, 'index']);
    route::get('account-settings', [user_controller::class, 'indexs']);
    route::post('account-update', [user_controller::class, 'account_update']);
    route::post('check-pass', [user_controller::class, 'check_pass']);
    route::post('change-password', [user_controller::class, 'change_pass']);
    route::get('kontens-detail/{id}', [page_controller::class, 'kontens_detail']);
    route::get('get-sub-by/{id}', [general_controller::class, 'get_sub_by']);
});

// Super Admin Role
Route::group(['middleware' => ['auth', 'role:4']], function () {
    // {New} Berita Master Data 
    Route::resource('berita', berita_controller::class);
    Route::get('get-berita', [berita_controller::class, 'get_data']);

    // Master Data

    Route::resource('jabatan_pengurus', jabatan_pengurus_controller::class);
    route::get('get-jabatan_pengurus', [jabatan_pengurus_controller::class, 'get_data']);

    Route::resource('pengurus', pengurus_controller::class);
    route::get('get-pengurus', [pengurus_controller::class, 'get_data']);

    Route::resource('fakultas', fakultas_controller::class);
    route::get('get-fakultas', [fakultas_controller::class, 'get_data']);

    Route::resource('jenjang', jenjang_controller::class);
    route::get('get-jenjang', [jenjang_controller::class, 'get_data']);

    Route::resource('prodi', prodi_controller::class);
    route::get('get-prodi', [prodi_controller::class, 'get_data']);

    Route::resource('kuisioner_dosen', kuisioner_dosen_controller::class);
    route::get('get-soal_kuisioner_dosen', [kuisioner_dosen_controller::class, 'get_soal_kuisioner_dosen']);
    route::get('get-hasil_kuisioner_dosen/{id_by}/{semester}/{id_lecture}', [kuisioner_dosen_controller::class, 'get_hasil_kuisioner_dosen']);
    route::get('get-laporan-kuisioner-soal/{id_by}/{id_sub_by}/{id_lecture}', [kuisioner_dosen_controller::class, 'get_laporan_kuisioner_soal']);
    route::get('report-laporan-kuisioner-soal/{id_by}/{id_sub_by}/{id_lecture}', [kuisioner_dosen_controller::class, 'report_laporan_kuisioner_soal']);
    route::get('get-laporan-kuisioner-dosen/{id_by}/{id_sub_by}', [kuisioner_dosen_controller::class, 'get_laporan_kuisioner_dosen']);
    route::get('report-laporan-kuisioner-dosen/{id_by}/{id_sub_by}', [kuisioner_dosen_controller::class, 'report_laporan_kuisioner_dosen']);

    Route::resource('sistem_kuliah', sistem_kuliah_controller::class);
    route::get('get-sistem_kuliah', [sistem_kuliah_controller::class, 'get_data']);

    Route::resource('batch_year', batch_year_controller::class);
    route::get('get-batch_year', [batch_year_controller::class, 'get_data']);
    route::get('get-sub_by/{id}', [batch_year_controller::class, 'get_sub_by']);
    route::post('update-sub-by', [batch_year_controller::class, 'update_sub_by']);

    Route::resource('kategori_konten', kategori_konten_controller::class);
    route::get('get-kategori_konten', [kategori_konten_controller::class, 'get_data']);

    Route::resource('lecture', lecture_controller::class);
    route::get('get-lecture', [lecture_controller::class, 'get_data']);
    route::get('download-form-import-lecture', [lecture_controller::class, 'download_excel_form']);
    route::post('import-lecture', [lecture_controller::class, 'import_data']);

    Route::resource('pekerjaan_karyawan', pekerjaan_karyawan_controller::class);
    route::get('get-pekerjaan_karyawan', [pekerjaan_karyawan_controller::class, 'get_data']);

    Route::resource('karyawan', karyawan_controller::class);
    route::get('get-karyawan', [karyawan_controller::class, 'get_data']);
    route::get('download-form-import-karyawan', [karyawan_controller::class, 'download_excel_form']);
    route::post('import-karyawan', [karyawan_controller::class, 'import_data']);

    Route::resource('mail_template', mail_template_controller::class);
    route::get('get-mail_template', [mail_template_controller::class, 'get_data']);

    // Master Data For SARPRAS
    Route::resource('building_room_function', building_room_function_controller::class);
    route::get('get-building_room_function', [building_room_function_controller::class, 'get_data']);

    // Master Data For SIAKAD
    //kalender pendidikan
    Route::get('/kalender_akedemik', [kalender_akademik_controller::class, 'index']);
    Route::get('/kalender-index', [kalender_akademik_controller::class, 'index']);
    Route::get('/download-kalender', [kalender_akademik_controller::class, 'download_kalender']);
    Route::post('upload-kalender', [kalender_akademik_controller::class, 'store_upload_kalender']);

    Route::resource('hours', hours_controller::class);
    route::get('get-hours', [hours_controller::class, 'get_data']);

    Route::resource('krs_date', krs_date_controller::class);
    route::get('get-krs_date', [krs_date_controller::class, 'get_data']);

    // Landing Page
    Route::resource('konten', konten_controller::class);
    route::get('get-konten', [konten_controller::class, 'get_data']);

    Route::resource('slider', slider_controller::class);
    route::get('get-slider', [slider_controller::class, 'get_data']);

    route::get('pengguna', [user_controller::class, 'pengguna']);
    route::get('pengguna-detail/{id}', [user_controller::class, 'pengguna_detail']);
    route::get('get-pengguna', [user_controller::class, 'get_data']);
    route::get('get-pengguna-filter/{id}', [user_controller::class, 'get_data2']);
    route::post('reset-password-pengguna', [user_controller::class, 'reset_password_pengguna']);
    route::post('pengguna-store', [user_controller::class, 'pengguna_store']);
    route::post('pengguna-update', [user_controller::class, 'pengguna_update']);
    route::post('pengguna-delete', [user_controller::class, 'pengguna_delete']);
    route::get('check-registered-emails/{email}', [user_controller::class, 'check_registered_email']);

    Route::resource('landing_menu', landing_menu_controller::class);
    route::get('get-landing_menu', [landing_menu_controller::class, 'get_data']);

    Route::resource('landing_page', landing_page_controller::class);
    route::get('get-landing_page', [landing_page_controller::class, 'get_data']);

    Route::resource('position', position_controller::class);
    route::get('get-position', [position_controller::class, 'get_data']);

    // Master Data For Keuagan
    Route::resource('kegiatan_berbayar', kegiatan_berbayar_controller::class);
    route::get('get-kegiatan_berbayar', [kegiatan_berbayar_controller::class, 'get_data']);

    // PMB
    // Data Pendaftar
    route::get('pendaftar', [pendaftar_controller::class, 'index']);
    route::get('get-calon_mahasiswa_baru/{id_by}', [pendaftar_controller::class, 'get_data']);
    route::get('get-calon_mahasiswa_baru_pendaftar/{id_by}', [pendaftar_controller::class, 'get_data_pendaftar']);
    route::get('get-calon_mahasiswa_baru_tes/{id_by}', [pendaftar_controller::class, 'get_data_tes']);
    route::get('get-calon_mahasiswa_baru_diterima/{id_by}', [pendaftar_controller::class, 'get_data_diterima']);
    route::get('detail-calon_mahasiswa_baru/{id}', [pendaftar_controller::class, 'detail']);
    route::get('detail_mhs/{id}', [pendaftar_controller::class, 'detail_mhs']);
    route::get('get-mahasiswa/{id_by}', [pendaftar_controller::class, 'get_mahasiswa']);
    route::get('get-daftar-ulang-calon-mhs/{id}/{id_prodi}', [pendaftar_controller::class, 'get_daftar_ulang_calon_mhs']);
    route::get('get-detail-du-calon-mhs/{id}', [pendaftar_controller::class, 'get_detail_du']);

    route::delete('hapus-pendaftar/{id}', [pendaftar_controller::class, 'hapus_pendaftar']);
    route::delete('hapus-pendaftar2/{id}', [pendaftar_controller::class, 'hapus_pendaftar2']);
    route::delete('hapus-pendaftar3/{id}', [pendaftar_controller::class, 'hapus_pendaftar3']);
    route::post('cancel-du-calon-mhs', [pendaftar_controller::class, 'cancel_du']);
    // End

    // Pindah Prodi
    route::get('pindah-pendaftar', [pendaftar_controller::class, 'pindah_pendaftar']);
    route::get('get-pindah-pendaftar', [pendaftar_controller::class, 'get_pindah_pendaftar']);

    route::post('pindah-prodi-store', [pendaftar_controller::class, 'pindah_prodi_store']);
    route::post('pindah-jalur_seleksi-store', [pendaftar_controller::class, 'pindah_jalur_seleksi_store']);
});
// Owner Role

Route::group(['middleware' => ['auth', 'role:11']], function () {
    route::resource('daftar-ulang-owner', daftar_ulang_owner_controller::class);
    route::get('get-daftar-ulang-owner', [daftar_ulang_owner_controller::class, 'get_data']);
    route::post('acc-daftar-ulang-owner', [daftar_ulang_owner_controller::class, 'acc']);
});
// pendaftar Role
Route::group(['middleware' => ['auth', 'role:2']], function () {
    // pengumuman
    route::get('pengumuman', [page_controller::class, 'pengumuman']);
});
