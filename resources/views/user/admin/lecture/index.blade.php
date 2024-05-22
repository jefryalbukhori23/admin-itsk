@extends('layout.app')
@section('content')
{{-- loadiing screen --}}
<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span><br>
        <h3 style="color: white;">Data Sedang di Proses...</h3>
    </div>
</div>
{{-- konten --}}
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Data Dosen</h2>
                <div class="order-actions">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal">
                        <i class="fa fa-plus"></i> Tambah Data
                    </button>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#import_modal">
                        <i class="fa fa-download"></i> Import Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="tabel">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIDN</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Prodi</th>
                                <th>Jabatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- modal --}}

<div id="add_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Form Tambah Dosen
                    <br>
                    <p class="text-muted">Jika data kosong isi dengan tanda - (strip)</p>
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="" id="form_add_lecture" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">NIDN Dosen</label>
                            <input type="text" class="form-control" name="nidn" id="nidn" placeholder="Masukan NIDN Dosen" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Nama Dosen</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Masukan Nama Dosen" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">NIK Dosen</label>
                            <input type="text" class="form-control" name="nik" id="nik" placeholder="Masukan NIK Dosen" data-parsley-pattern="^[0-9]+$" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">No KK Dosen</label>
                            <input type="text" class="form-control" name="no_kk" id="no_kk" placeholder="Masukan No KK Dosen" data-parsley-pattern="^[0-9]+$" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label" for="">Prodi</label>
                            <select class="form-select province_select"  id="id_prodi" name="id_prodi" required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Prodi</option>
                                @foreach ($prodi as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label" for="">Bank</label>
                            <select class="form-select province_select"  id="bank" name="bank" required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Bank</option>
                                @foreach ($bank as $row)
                                    <option value="{{$row->name}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Nama Rekening</label>
                            <input type="text" class="form-control" name="nama_rekening" id="nama_rekening" placeholder="Masukan Nama Pada Rekening" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">No Rekening</label>
                            <input type="text" class="form-control" name="no_rek" id="no_rek" placeholder="Masukan No Rekening" data-parsley-pattern="^[0-9]+$" required data-parsley-trigger="keyup" required>
                        </div>
                        <div class="col-12">
                            <hr>
                                <h6 class="text-center"><b>Alamat</b></h6>
                            <hr>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label for="">Provinsi</label>
                            <select class="form-select province_select"  id="province" name="province" required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Provinsi</option>
                                @foreach ($default_province as $row)
                                    <option value="{{$row->name}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label for="">Kabupaten / Kota</label>
                            <select class="form-select province_select" id="regency" name="regency" disabled required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Kabupaten/Kota</option>
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label for="">Kecamatan </label>
                            <select class="form-select province_select" id="district" name="district" disabled required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Kecamatan</option>
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label for="">Desa / Kelurahan </label>
                            <select class="form-select province_select" id="village" name="village" disabled required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Desa/Kelurahan</option>
                            </select>
                        </div>
                        <div class="form-group col-4 mt-1">
                            <label class="form-label">RT</label>
                            <input type="text" class="form-control" name="rt" id="rt" placeholder="Masukan RT" data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-4 mt-1">
                            <label class="form-label">RW</label>
                            <input type="text" class="form-control" name="rw" id="rw" placeholder="Masukan RW" data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-4 mt-1">
                            <label class="form-label">Kode POS</label>
                            <input type="text" class="form-control" name="kode_pos" id="kode_pos" placeholder="Masukan Kode POS" data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="address" id="address" placeholder="Masukan Alamat Dosen" class="form-control" required data-parsley-trigger="keyup"></textarea>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Jabatan Dosen</label>
                            <select name="id_position" id="" class="form-select" required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Jabatan Dosen</option>
                                @foreach ($position as $row)
                                    <option value="{{$row->id}}">{{ Helper::haha(Helper::yohohoho($row->desc),$row->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label for="" class="form-label">Agama</label>
                            <select name="agama" id="" class="form-select" required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                                <option value="Tidak Ingin Memberi Tahu">Tidak Ingin Memberi Tahu</option>
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-check-label me-3">Gender <sup class="text-danger">*</sup></label><br>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="flexRadioDefault1">Laki-laki</label>
                            <input class="form-check-input" type="radio" id="flexRadioDefault1" value="Laki-laki" name="gender" required data-parsley-errors-container="#error-radio">
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="flexRadioDefault2">Prempuan</label>
                            <input class="form-check-input" type="radio" id="flexRadioDefault2" value="Perempuan" name="gender">
                            </div>
                            <p id="error-radio"></p>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-check-label me-3">Status Perkawinan <sup class="text-danger">*</sup></label><br>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="flexRadioDefault3">Kawin</label>
                            <input class="form-check-input" type="radio" id="flexRadioDefault3" value="Kawin" name="status_perkawinan" required data-parsley-errors-container="#error-radios">
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="flexRadioDefault4">Belum Kawin</label>
                            <input class="form-check-input" type="radio" id="flexRadioDefault4" value="Belum Kawin" name="status_perkawinan">
                            </div>
                            <p id="error-radios"></p>
                        </div>
                        <div class="form-group col-12 mt-1">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="alamat@email.dosen" required  data-parsley-type="email" data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">No.HP</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Masukan No.HP" data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">No.Telpon</label>
                            <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="Masukan No.Telpon" data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Masukan Tempat Lahir Dosen" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Tanggal Lahir Dosen</label>
                            <input type="date" max="{{date('Y-m-d')}}" class="form-control" name="date_birth" id="date_birth"  placeholder="Masukan Tanggal Lahir Dosen" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Tahun Masuk</label>
                            <input type="number" min="1980" max="{{date('Y')}}" class="form-control" name="tahun_masuk" id="year" placeholder="Masukan Tahun Masuk Dosen" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Pendidikan Terakhir</label>
                            <input type="text" class="form-control" name="pendidikan_terakhir" id="pendidikan_terakhir" placeholder="Masukan Pendidikan Terakhir Dosen" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Nama Pasangan</label>
                            <input type="text" class="form-control" name="nama_pasangan" id="nama_pasangan" placeholder="Masukan Nama Pasangan" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">NIK Pasangan</label>
                            <input type="text" class="form-control" name="nik_pasangan" id="nik_pasangan" placeholder="Masukan NIK Pasangan" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Pekerjaan Pasangan</label>
                            <input type="text" class="form-control" name="pekerjaan_pasangan" id="pekerjaan_pasangan" placeholder="Masukan Pekerjaan Pasangan" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Jumlah Anak</label>
                            <input type="number" class="form-control" name="jml_anak" id="jml_anak" placeholder="Masukan Jumlah Anak" min="0" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">No NPWP</label>
                            <input type="text" class="form-control" name="no_npwp" id="no_npwp" placeholder="Masukan No NPWP" data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Nama NPWP</label>
                            <input type="text" class="form-control" name="nama_npwp" id="nama_npwp" placeholder="Masukan Nama NPWP" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-12 mt-1">
                            <label for="form-label">Foto Profil</label>
                            <input type="file" name="image" class="dropify" accept="img/*" data-allowed-file-extensions="png jpg jpeg" id="image">
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect close" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success waves-effect waves-light text-white save_data">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div id="edit_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit Dosen</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="" id="form_edit_lecture" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="id_edit">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">NIDN Dosen</label>
                            <input type="text" class="form-control" name="nidn" id="nidn_edit" placeholder="Masukan NIDN Dosen" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Nama Dosen</label>
                            <input type="text" class="form-control" name="name" id="name_edit" placeholder="Masukan Nama Dosen" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">NIK Dosen</label>
                            <input type="text" class="form-control" name="nik" id="nik_edit" placeholder="Masukan NIK Dosen" data-parsley-pattern="^[0-9]+$" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">No KK Dosen</label>
                            <input type="text" class="form-control" name="no_kk" id="no_kk_edit" placeholder="Masukan No KK Dosen" data-parsley-pattern="^[0-9]+$" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label" for="">Prodi</label>
                            <select class="form-select province_select"  id="id_prodi_edit" name="id_prodi" required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Prodi</option>
                                @foreach ($prodi as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label" for="">Bank</label>
                            <select class="form-select province_select"  id="bank_edit" name="bank" required data-parsley-trigger="change">
                                @foreach ($bank as $row)
                                    <option value="{{$row->name}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Nama Rekening</label>
                            <input type="text" class="form-control" name="nama_rekening" id="nama_rekening_edit" placeholder="Masukan Nama Pada Rekening" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">No Rekening</label>
                            <input type="text" class="form-control" name="no_rek" id="no_rek_edit" placeholder="Masukan No Rekening" data-parsley-pattern="^[0-9]+$" required data-parsley-trigger="keyup" required>
                        </div>
                        <div class="col-12">
                            <hr>
                                <h6 class="text-center"><b>Alamat</b></h6>
                            <hr>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label for="">Provinsi</label>
                            <select class="form-select province_select"  id="province_edit" name="province" required data-parsley-trigger="change">
                                @foreach ($default_province as $row)
                                    <option value="{{$row->name}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label for="">Kabupaten / Kota</label>
                            <select class="form-select province_select" id="regency_edit" name="regency" disabled required data-parsley-trigger="change">
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label for="">Kecamatan </label>
                            <select class="form-select province_select" id="district_edit" name="district" disabled required data-parsley-trigger="change">
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label for="">Desa / Kelurahan </label>
                            <select class="form-select province_select" id="village_edit" name="village" disabled required data-parsley-trigger="change">
                            </select>
                        </div>
                        <div class="form-group col-4 mt-1">
                            <label class="form-label">RT</label>
                            <input type="text" class="form-control" name="rt" id="rt_edit" placeholder="Masukan RT" data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-4 mt-1">
                            <label class="form-label">RW</label>
                            <input type="text" class="form-control" name="rw" id="rw_edit" placeholder="Masukan RW" data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-4 mt-1">
                            <label class="form-label">Kode POS</label>
                            <input type="text" class="form-control" name="kode_pos" id="kode_pos_edit" placeholder="Masukan Kode POS" data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="address" id="address_edit" placeholder="Masukan Alamat Dosen" class="form-control" required data-parsley-trigger="keyup"></textarea>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Jabatan Dosen</label>
                            <select name="id_position" id="jabatan_edit" class="form-select" required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Jabatan Dosen</option>
                                @foreach ($position as $row)
                                    <option value="{{$row->id}}">{{ Helper::haha(Helper::yohohoho($row->desc),$row->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label for="" class="form-label">Agama</label>
                            <select name="agama" id="agama_edit" class="form-select" required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                                <option value="Tidak Ingin Memberi Tahu">Tidak Ingin Memberi Tahu</option>
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-check-label me-3">Gender <sup class="text-danger">*</sup></label><br>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="flexRadioDefault11">Laki-laki</label>
                            <input class="form-check-input" type="radio" id="flexRadioDefault11" value="Laki-laki" name="gender" required data-parsley-errors-container="#error-radio">
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="flexRadioDefault21">Prempuan</label>
                            <input class="form-check-input" type="radio" id="flexRadioDefault21" value="Perempuan" name="gender">
                            </div>
                            <p id="error-radio"></p>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-check-label me-3">Status Perkawinan <sup class="text-danger">*</sup></label><br>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="flexRadioDefault31">Kawin</label>
                            <input class="form-check-input" type="radio" id="flexRadioDefault31" value="Kawin" name="status_perkawinan" required data-parsley-errors-container="#error-radios">
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="flexRadioDefault41">Belum Kawin</label>
                            <input class="form-check-input" type="radio" id="flexRadioDefault41" value="Belum Kawin" name="status_perkawinan">
                            </div>
                            <p id="error-radios"></p>
                        </div>
                        <div class="form-group col-12 mt-1">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email_edit" placeholder="alamat@email.dosen" required  data-parsley-type="email" data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">No.HP</label>
                            <input type="text" class="form-control" name="phone" id="phone_edit" placeholder="Masukan No.HP" data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">No.Telpon</label>
                            <input type="text" class="form-control" name="no_telp" id="no_telp_edit" placeholder="Masukan No.Telpon" data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir_edit" placeholder="Masukan Tempat Lahir Dosen" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Tanggal Lahir Dosen</label>
                            <input type="date" max="{{date('Y-m-d')}}" class="form-control" name="date_birth" id="date_birth_edit"  placeholder="Masukan Tanggal Lahir Dosen" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Tahun Masuk</label>
                            <input type="number" min="1980" max="{{date('Y')}}" class="form-control" name="tahun_masuk" id="year_edit" placeholder="Masukan Tahun Masuk Dosen" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Pendidikan Terakhir</label>
                            <input type="text" class="form-control" name="pendidikan_terakhir" id="pendidikan_terakhir_edit" placeholder="Masukan Pendidikan Terakhir Dosen" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Nama Pasangan</label>
                            <input type="text" class="form-control" name="nama_pasangan" id="nama_pasangan_edit" placeholder="Masukan Nama Pasangan" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">NIK Pasangan</label>
                            <input type="text" class="form-control" name="nik_pasangan" id="nik_pasangan_edit" placeholder="Masukan NIK Pasangan" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Pekerjaan Pasangan</label>
                            <input type="text" class="form-control" name="pekerjaan_pasangan" id="pekerjaan_pasangan_edit" placeholder="Masukan Pekerjaan Pasangan" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Jumlah Anak</label>
                            <input type="number" class="form-control" name="jml_anak" id="jml_anak_edit" placeholder="Masukan Jumlah Anak" min="0" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">No NPWP</label>
                            <input type="text" class="form-control" name="no_npwp" id="no_npwp_edit" placeholder="Masukan No NPWP" data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Nama NPWP</label>
                            <input type="text" class="form-control" name="nama_npwp" id="nama_npwp_edit" placeholder="Masukan Nama NPWP" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-12 mt-1">
                            <label for="form-label">Foto Profil</label>
                            <input type="file" name="image" class="dropifys" accept="img/*" data-allowed-file-extensions="png jpg jpeg" id="image">
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect close" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success waves-effect waves-light text-white update_data">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div id="detail_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Data Dosen</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <img src="" id="img_dosen" style="width: 100%;" alt="">
                    </div>
                    <div class="col-9">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>NIDN</th>
                                    <td id="nidn_detail"></td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td id="name_detail"></td>
                                </tr>
                                <tr>
                                    <th>Jabatan</th>
                                    <td id="jabatan_detail"></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td id="gender_detail"></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td id="email_detail"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>NIK</th>
                                    <td id="nik_detail"></td>
                                    <th>No KK</th>
                                    <td id="no_kk_detail"></td>
                                </tr>
                                <tr>
                                    <th>Nama NPWP</th>
                                    <td id="nama_npwp_detail"></td>
                                    <th>No NPWP</th>
                                    <td id="no_npwp_detail"></td>
                                </tr>
                                <tr>
                                    <th>Bank</th>
                                    <td id="bank_detail"></td>
                                    <th>No Rekening</th>
                                    <td id="no_rek_detail"></td>
                                </tr>
                                <tr>
                                    <th>Status Perkawinan</th>
                                    <td id="status_perkawinan_detail"></td>
                                    <th>Agama</th>
                                    <td id="agama_detail"></td>
                                </tr>
                                <tr>
                                    <th>No HP</th>
                                    <td id="phone_detail"></td>
                                    <th>No Telpon</th>
                                    <td id="no_telp_detail"></td>
                                </tr>
                                <tr>
                                    <th>Tahun Masuk</th>
                                    <td id="tahun_masuk_detail"></td>
                                    <th>Pendidikan Terakhir</th>
                                    <td id="pendidikan_terakhir_detail"></td>
                                </tr>
                                <tr>
                                    <th>Tempat Lahir</th>
                                    <td id="tempat_lahir_detail"></td>
                                    <th>Tanggal Lahir</th>
                                    <td id="date_birth_detail"></td>
                                </tr>
                                <tr>
                                    <th colspan="4">Alamat Dosen</th>
                                </tr>
                                <tr>
                                    <th>Provinsi</th>
                                    <td id="province_detail"></td>
                                    <th>Kabupaten / Kota</th>
                                    <td id="regency_detail"></td>
                                </tr>
                                <tr>
                                    <th>Kecamatan</th>
                                    <td id="district_detail"></td>
                                    <th>Kelurahan / Desa</th>
                                    <td id="village_detail"></td>
                                </tr>
                                <tr>
                                    <th>RT</th>
                                    <td id="rt_detail"></td>
                                    <th>RW</th>
                                    <td id="rw_detail"></td>
                                </tr>
                                <tr>
                                    <th>Alamat Lengkap</th>
                                    <td colspan="3" id="address_detail"></td>
                                </tr>
                                <tr>
                                    <th>NIK Pasangan</th>
                                    <td id="nik_pasangan_detail"></td>
                                    <th>Nama Pasangan</th>
                                    <td id="nama_pasangan_detail"></td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan Pasangan</th>
                                    <td id="pekerjaan_pasangan_detail"></td>
                                    <th>Jumlah Anak</th>
                                    <td id="jml_anak_detail"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="import_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Import Dosen</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="{{url('import-lecture')}}" id="form_import" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card ribbon mb-3">
                        <div class="option-10 position-absolute text-light"><i class="fa fa-file-excel-o fa-lg"></i></div>
                        <div class="card-body p-4 mt-4">
                            <p>Anda harus menggunakan template ini untuk import Dosen</p>
                            <br>
                            <b>
                                <a href="{{url('download-form-import-lecture')}}" id="download_btn">
                                    Download Disini
                                </a>
                            </b>
                            <span>

                                <div class="centers" style="display: none">
                                    <div class="wave"></div>
                                    <div class="wave"></div>
                                    <div class="wave"></div>
                                    <div class="wave"></div>
                                    <div class="wave"></div>
                                    <div class="wave"></div>
                                    <div class="wave"></div>
                                    <div class="wave"></div>
                                    <div class="wave"></div>
                                    <div class="wave"></div>
                                </div>
                            </span>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h6>Upload File</h6>
                            <input type="file" name="excel" class="dropify" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" data-allowed-file-extensions="xlsx" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect close" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light text-white import_data">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JS --}}
<script>
    $(document).ready(function(){
        var table = $('#tabel').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('get-lecture') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nidn', name: 'nidn'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'prodi', name: 'prodi'},
                {data: 'jabatan', name: 'jabatan'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        $(".province_select").select2({
            dropdownParent: $('#add_modal')
        })
        $("#id_prodi_edit").select2({
            dropdownParent: $("#edit_modal")
        })
        $("#bank_edit").select2({
            dropdownParent: $("#edit_modal")
        })
        $("#province_edit").select2({
            dropdownParent: $("#edit_modal")
        })
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
        $("body").on('change','#province', function(){
            var id = $(this).val();
            var url = '../get-regencies/'+id;
            $.ajax({
                type : 'GET',
                url : url,
                success:function(response){
                    $("#regency").prop('disabled',false);
                    $("#regency").empty();
                    $.each(response.data, function(key,item){
                        $("#regency").append('<option value="'+item.name+'">'+item.name+'</option>')
                    })
                }
            })
        })
        $("body").on('change','#regency', function(){
            var id = $(this).val();
            var url = '../get-districts/'+id;
            $.ajax({
                type : 'GET',
                url : url,
                success:function(response){
                    $("#district").prop('disabled',false);
                    $("#district").empty();
                    $.each(response.data, function(key,item){
                        $("#district").append('<option value="'+item.name+'">'+item.name+'</option>')
                    })
                }
            })
        })
        $("body").on('change','#district', function(){
            var id = $(this).val();
            var url = '../get-villages/'+id;
            $.ajax({
                type : 'GET',
                url : url,
                success:function(response){
                    $("#village").prop('disabled',false);
                    $("#village").empty();
                    $.each(response.data, function(key,item){
                        $("#village").append('<option value="'+item.name+'">'+item.name+'</option>')
                    })
                }
            })
        })
        $("body").on('change','#province_edit', function(){
            var id = $(this).val();
            var url = '../get-regencies/'+id;
            $.ajax({
                type : 'GET',
                url : url,
                success:function(response){
                    $("#regency_edit").prop('disabled',false);
                    $("#regency_edit").empty();
                    $.each(response.data, function(key,item){
                        $("#regency_edit").append('<option value="'+item.name+'">'+item.name+'</option>')
                    })
                }
            })
        })
        $("body").on('change','#regency_edit', function(){
            var id = $(this).val();
            var url = '../get-districts/'+id;
            $.ajax({
                type : 'GET',
                url : url,
                success:function(response){
                    $("#district_edit").prop('disabled',false);
                    $("#district_edit").empty();
                    $.each(response.data, function(key,item){
                        $("#district_edit").append('<option value="'+item.name+'">'+item.name+'</option>')
                    })
                }
            })
        })
        $("body").on('change','#district_edit', function(){
            var id = $(this).val();
            var url = '../get-villages/'+id;
            $.ajax({
                type : 'GET',
                url : url,
                success:function(response){
                    $("#village_edit").prop('disabled',false);
                    $("#village_edit").empty();
                    $.each(response.data, function(key,item){
                        $("#village_edit").append('<option value="'+item.name+'">'+item.name+'</option>')
                    })
                }
            })
        })
        $('#form_add_lecture').parsley();
        $('#form_edit_lecture').parsley();
        $('#form_import').parsley();
        $("body").on('click','.import_data', function(){
            if($('#form_import').parsley().isValid()){
                $("#import_modal .close").click();
                $("#overlay").fadeIn();
            }
        })
        $("body").on('click','.save_data',function(){
            if($('#form_add_lecture').parsley().isValid()){
                $("#add_modal .close").click();
                $("#overlay").fadeIn();
                var url_save = '{{route('lecture.store')}}';

                var form = $('#form_add_lecture')[0];
                var data = new FormData(form);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type : 'POST',
                    url : url_save,
                    enctype: 'multipart/form-data',
                    processData: false,
                    data: data,
                    contentType: false,
                    cache: false,
                    success:function(response){
                        $("#name").val('');
                        swal.fire({
                            icon: 'success',
                            title: 'Data lecture berhasil ditambahkan !',
                            timer: 1500,
                        });
                        $('#tabel').DataTable().ajax.reload();
                        $("#overlay").fadeOut();
                        $('#form_add_lecture')[0].reset();
                    }
                })

            }else{
                swal.fire({
                    icon:'error',
                    title: 'Ada data yang salah',
                })
            }

            // }
        })
        $(function() {
            $('.dropify').dropify();
            var drEvent = $('#dropify-event').dropify();
            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });
            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });
        });
        $("body").on('click','.edit',function(){
            var id = $(this).val();
            var url_detail = "{{ route('lecture.show', ':id') }}";
            url_detail = url_detail.replace(':id', id);
            $("#id_edit").val(id);
            $.ajax({
                type : 'GET',
                url : url_detail,
                success:function(response){
                    var image_file = "{{ url('image/user/:img') }}";
                    image_file = image_file.replace(':img',response.img);
                    // console.log(image_file);
                    $("#image_edit").attr('data-default-file',image_file);
                    var drEvent = $('.dropifys').dropify(
                    {
                        defaultFile: image_file
                    });
                    drEvent = drEvent.data('dropify');
                    drEvent.resetPreview();
                    drEvent.clearElement();
                    drEvent.settings.defaultFile = image_file;
                    drEvent.destroy();
                    drEvent.init();
                    $("#nidn_edit").val(response.data['nidn']);
                    $("#name_edit").val(response.data['name']);
                    $('input[name=gender][value="'+response.data['gender']+'"]').prop("checked",true);
                    $("#gender_edit").val(response.data['gender']);
                    $("#address_edit").val(response.data['address']);
                    $('#jabatan_edit option[value="'+response.data['id_position']+'"]').attr('selected','selected');
                    $('#id_prodi_edit option[value="'+response.data['id_prodi']+'"]').attr('selected','selected');
                    $('input[name=status_perkawinan][value="'+response.data['status_perkawinan']+'"]').prop("checked",true);
                    $('#agama_edit option[value="'+response.data['agama']+'"]').attr('selected','selected');
                    $("#email_edit").val(response.data['email']);
                    $("#phone_edit").val(response.data['phone']);
                    $("#date_birth_edit").val(response.data['tgl_lahir']);
                    $("#year_edit").val(response.data['tahun_masuk']);
                    $("#nik_edit").val(response.data['nik']);
                    $("#tempat_lahir_edit").val(response.data['tempat_lahir']);
                    $("#rt_edit").val(response.data['rt']);
                    $("#rw_edit").val(response.data['rw']);
                    $("#kode_pos_edit").val(response.data['kode_pos']);
                    $("#no_kk_edit").val(response.data['no_kk']);
                    $("#no_npwp_edit").val(response.data['no_npwp']);
                    $("#nama_npwp_edit").val(response.data['nama_npwp']);
                    $("#nama_pasangan_edit").val(response.data['nama_pasangan']);
                    $("#nik_pasangan_edit").val(response.data['nik_pasangan']);
                    $("#pekerjaan_pasangan_edit").val(response.data['pekerjaan_pasangan']);
                    $("#no_rek_edit").val(response.data['no_rek']);
                    $("#bank_edit").val(response.data['bank']);
                    $("#no_telp_edit").val(response.data['no_telp']);
                    $("#nama_rekening_edit").val(response.data['nama_rekening']);
                    $("#jml_anak_edit").val(response.data['jml_anak']);
                    $("#pendidikan_terakhir_edit").val(response.data['pendidikan_terakhir']);
                    $('#province_edit option[value="'+response.data['province']+'"]').attr('selected','selected');
                    $("#regency_edit").append('<option value="'+response.data['regency']+'">'+response.data['regency']+'</option>');
                    $("#district_edit").append('<option value="'+response.data['district']+'">'+response.data['district']+'</option>');
                    $("#village_edit").append('<option value="'+response.data['village']+'">'+response.data['village']+'</option>');
                }
            })
        });
        $("#download_btn").click(function(){
            $("#download_btn") .fadeOut();
            $(".centers").fadeIn();
            setTimeout(() => {
                $("#download_btn").fadeIn();
                $(".centers").fadeOut();
            }, 3000);
        })
        $("body").on('click','.update_data',function(){
            // alert('tes');
            var id = $("#id_edit").val();
            var url_update = "{{ route('lecture.update', ':id') }}";
            url_update = url_update.replace(':id', id);
            var form = $('#form_edit_lecture')[0];
            var data = new FormData(form);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if($('#form_edit_lecture').parsley().isValid()){
                $("#edit_modal .close").click();
                $("#overlay").fadeIn();
                $.ajax({
                    type : 'POST',
                    url : url_update,
                    enctype: 'multipart/form-data',
                    processData: false,
                    data: data,
                    contentType: false,
                    cache: false,
                    success:function(response){
                        $("#title").val('');
                        swal.fire({
                            icon: 'success',
                            title: 'Data lecture berhasil diupdate !'
                        });
                        $('#tabel').DataTable().ajax.reload();
                        $("#overlay").fadeOut();
                    }
                })
            }else{
                swal.fire({
                    icon:'error',
                    title: 'Ada data yang salah',
                })
            }
        })

        $("body").on('click','.hapus',function(){
            Swal.fire({
                icon:'question',
                title: 'Apakah Anda Yakin Untuk Menghapus Data ini?',
                showDenyButton: true,
                confirmButtonText: 'Iya',
                denyButtonText: 'Batal',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $("#overlay").fadeIn();
                    var id = $(this).val();
                    var url_delete = "{{ route('lecture.destroy', ':id') }}";
                    url_delete = url_delete.replace(':id', id);
                    $.ajax({
                        type : 'DELETE',
                        url : url_delete,
                        data : {
                            _token : '{{csrf_token()}}'
                        },
                        success:function(response){
                            swal.fire({
                                icon: 'success',
                                title : 'Hapus data berhasil',
                                timer: 1500,
                            });
                            // get_lecture();
                            $('#tabel').DataTable().ajax.reload();
                            $("#overlay").fadeOut();

                        }
                    })
                }else{
                    swal.fire({
                        icon: 'info',
                        title : 'Aksi dibatalkan',
                    });
                }
            });
        });

        $("body").on('click','.detail',function(){
            var id = $(this).val();
            var url_detail = "{{ route('lecture.show', ':id') }}";
            url_detail = url_detail.replace(':id', id);
            $.ajax({
                type : 'GET',
                url : url_detail,
                success:function(response){
                    $("#img_dosen").attr('src','image/user/'+response.img);
                    $("#nidn_detail").html(response.data['nidn']);
                    $("#name_detail").html(response.data['name']);
                    $("#gender_detail").html(response.data['gender']);
                    $("#address_detail").html(response.data['address']);
                    $("#jabatan_detail").html(response.data['jabatan']);
                    $("#status_perkawinan_detail").html(response.data['status_perkawinan']);
                    $("#agama_detail").html(response.data['agama']);
                    $("#email_detail").html(response.data['email']);
                    $("#phone_detail").html(response.data['phone']);
                    $("#date_birth_detail").html(response.data['date_birth']);
                    $("#tahun_masuk_detail").html(response.data['tahun_masuk']);
                    $("#nik_detail").html(response.data['nik']);
                    $("#tempat_lahir_detail").html(response.data['tempat_lahir']);
                    $("#rt_detail").html(response.data['rt']);
                    $("#rw_detail").html(response.data['rw']);
                    $("#province_detail").html(response.data['province']);
                    $("#regency_detail").html(response.data['regency']);
                    $("#district_detail").html(response.data['district']);
                    $("#village_detail").html(response.data['village']);
                    $("#kode_pos_detail").html(response.data['kode_pos']);
                    $("#no_kk_detail").html(response.data['no_kk']);
                    $("#no_npwp_detail").html(response.data['no_npwp']);
                    $("#nama_npwp_detail").html(response.data['nama_npwp']);
                    $("#nama_pasangan_detail").html(response.data['nama_pasangan']);
                    $("#nik_pasangan_detail").html(response.data['nik_pasangan']);
                    $("#pekerjaan_pasangan_detail").html(response.data['pekerjaan_pasangan']);
                    $("#no_rek_detail").html(response.data['no_rek']);
                    $("#bank_detail").html(response.data['bank']);
                    $("#no_telp_detail").html(response.data['no_telp']);
                    $("#nama_rekening_detail").html(response.data['nama_rekening']);
                    $("#jml_anak_detail").html(response.data['jml_anak']);
                    $("#pendidikan_terakhir_detail").html(response.data['pendidikan_terakhir']);
                }
            })
        });
    });

</script>
@endsection
