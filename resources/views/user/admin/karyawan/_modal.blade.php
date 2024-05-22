
{{-- modal --}}

<div id="add_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Form Tambah Karyawan
                    <br>
                    <p class="text-muted">Jika data kosong isi dengan tanda - (strip)</p>
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="" id="form_add_karyawan" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">NIK</label>
                            <input type="text" class="form-control" name="nik" id="nik" placeholder="Masukan Nomor Induk Karyawan" required  data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Masukan Nama Karyawan" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Pekerjaan Karyawan</label>
                            <select type="text" class="form-control form-select-add" name="id_pekerjaan_karyawan" id="id_pekerjaan_karyawan" data-placeholder="Pilih Pekerjaan Karyawan"  required data-parsley-trigger="change">
                                <option value=""></option>
                                @foreach ($pekerjaan_karyawan as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label" for="">Bank</label>
                            <select class="form-select form-select-add"  id="bank" name="bank" required data-parsley-trigger="change">
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
                            <input type="text" class="form-control" name="no_rek" id="no_rek" placeholder="Masukan No Rekening"  required data-parsley-trigger="keyup" required>
                        </div>
                        <div class="col-12">
                            <hr>
                                <h6 class="text-center"><b>Alamat</b></h6>
                            <hr>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label for="">Provinsi</label>
                            <select class="form-select form-select-add"  id="province" name="province" required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Provinsi</option>
                                @foreach ($default_province as $row)
                                    <option value="{{$row->name}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label for="">Kabupaten / Kota</label>
                            <select class="form-select form-select-add" id="regency" name="regency" disabled required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Kabupaten/Kota</option>
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label for="">Kecamatan </label>
                            <select class="form-select form-select-add" id="district" name="district" disabled required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Kecamatan</option>
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label for="">Desa / Kelurahan </label>
                            <select class="form-select form-select-add" id="village" name="village" disabled required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Desa/Kelurahan</option>
                            </select>
                        </div>
                        <div class="form-group col-4 mt-1">
                            <label class="form-label">RT</label>
                            <input type="text" class="form-control" name="rt" id="rt" placeholder="Masukan RT"  data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-4 mt-1">
                            <label class="form-label">RW</label>
                            <input type="text" class="form-control" name="rw" id="rw" placeholder="Masukan RW"  data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-4 mt-1">
                            <label class="form-label">Kode POS</label>
                            <input type="text" class="form-control" name="kode_pos" id="kode_pos" placeholder="Masukan Kode POS"  data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="address" id="address" placeholder="Masukan Alamat Karyawan" class="form-control" required data-parsley-trigger="keyup"></textarea>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label for="" class="form-label">Agama</label>
                            <select name="agama" id="" class="form-select form-select-add" required data-parsley-trigger="change">
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
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">No.HP</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Masukan No.HP"  data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Masukan email Karyawan" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Masukan Tempat Lahir Karyawan" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Tanggal Lahir Karyawan</label>
                            <input type="date" max="{{date('Y-m-d')}}" class="form-control" name="date_birth" id="date_birth"  placeholder="Masukan Tanggal Lahir Karyawan" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Tahun Masuk</label>
                            <input type="number" min="1980" max="{{date('Y')}}" class="form-control" name="tahun_masuk" id="year" placeholder="Masukan Tahun Masuk Karyawan" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Pendidikan Terakhir</label>
                            <input type="text" class="form-control" name="pendidikan_terakhir" id="pendidikan_terakhir" placeholder="Masukan Pendidikan Terakhir Karyawan" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Jumlah Anak</label>
                            <input type="number" class="form-control" name="jml_anak" id="jml_anak" placeholder="Masukan Jumlah Anak" min="0" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">No NPWP</label>
                            <input type="text" class="form-control" name="no_npwp" id="no_npwp" placeholder="Masukan No NPWP"  data-parsley-trigger="keyup" required>
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

{{-- <div id="edit_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit Karyawan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="" id="form_edit_karyawan" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="id_edit">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">NIDN Karyawan</label>
                            <input type="text" class="form-control" name="nidn" id="nidn_edit" placeholder="Masukan NIDN Karyawan" required  data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" class="form-control" name="name" id="name_edit" placeholder="Masukan Nama Karyawan" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">NIK Karyawan</label>
                            <input type="text" class="form-control" name="nik" id="nik_edit" placeholder="Masukan NIK Karyawan"  required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">No KK Karyawan</label>
                            <input type="text" class="form-control" name="no_kk" id="no_kk_edit" placeholder="Masukan No KK Karyawan"  required data-parsley-trigger="keyup">
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
                            <input type="text" class="form-control" name="no_rek" id="no_rek_edit" placeholder="Masukan No Rekening"  required data-parsley-trigger="keyup" required>
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
                            <input type="text" class="form-control" name="rt" id="rt_edit" placeholder="Masukan RT"  data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-4 mt-1">
                            <label class="form-label">RW</label>
                            <input type="text" class="form-control" name="rw" id="rw_edit" placeholder="Masukan RW"  data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-4 mt-1">
                            <label class="form-label">Kode POS</label>
                            <input type="text" class="form-control" name="kode_pos" id="kode_pos_edit" placeholder="Masukan Kode POS"  data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="address" id="address_edit" placeholder="Masukan Alamat Karyawan" class="form-control" required data-parsley-trigger="keyup"></textarea>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Jabatan Karyawan</label>
                            <select name="id_position" id="jabatan_edit" class="form-select" required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Jabatan Karyawan</option>
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
                            <input type="email" class="form-control" name="email" id="email_edit" placeholder="alamat@email.Karyawan" required  data-parsley-type="email" data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">No.HP</label>
                            <input type="text" class="form-control" name="phone" id="phone_edit" placeholder="Masukan No.HP"  data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">No.Telpon</label>
                            <input type="text" class="form-control" name="no_telp" id="no_telp_edit" placeholder="Masukan No.Telpon"  data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir_edit" placeholder="Masukan Tempat Lahir Karyawan" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Tanggal Lahir Karyawan</label>
                            <input type="date" max="{{date('Y-m-d')}}" class="form-control" name="date_birth" id="date_birth_edit"  placeholder="Masukan Tanggal Lahir Karyawan" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Tahun Masuk</label>
                            <input type="number" min="1980" max="{{date('Y')}}" class="form-control" name="tahun_masuk" id="year_edit" placeholder="Masukan Tahun Masuk Karyawan" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Pendidikan Terakhir</label>
                            <input type="text" class="form-control" name="pendidikan_terakhir" id="pendidikan_terakhir_edit" placeholder="Masukan Pendidikan Terakhir Karyawan" required data-parsley-trigger="keyup">
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
                            <input type="text" class="form-control" name="no_npwp" id="no_npwp_edit" placeholder="Masukan No NPWP"  data-parsley-trigger="keyup" required>
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
</div> --}}
<div id="edit_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Form Tambah Karyawan
                    <br>
                    <p class="text-muted">Jika data kosong isi dengan tanda - (strip)</p>
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="" id="form_edit_karyawan" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="id_edit">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">NIK</label>
                            <input type="text" class="form-control" name="nik" id="nik_edit" placeholder="Masukan Nomor Induk Karyawan" required  data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" class="form-control" name="name" id="name_edit" placeholder="Masukan Nama Karyawan" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Pekerjaan Karyawan</label>
                            <select type="text" class="form-control form-select-edit" name="id_pekerjaan_karyawan" id="id_pekerjaan_karyawan_edit" data-placeholder="Pilih Pekerjaan Karyawan"  required data-parsley-trigger="change">
                                <option value=""></option>
                                @foreach ($pekerjaan_karyawan as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label" for="">Bank</label>
                            <select class="form-select form-select-edit"  id="bank_edit" name="bank" required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Bank</option>
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
                            <input type="text" class="form-control" name="no_rek" id="no_rek_edit" placeholder="Masukan No Rekening"  required data-parsley-trigger="keyup" required>
                        </div>
                        <div class="col-12">
                            <hr>
                                <h6 class="text-center"><b>Alamat</b></h6>
                            <hr>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label for="">Provinsi</label>
                            <select class="form-select form-select-edit"  id="province_edit" name="province" required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Provinsi</option>
                                @foreach ($default_province as $row)
                                    <option value="{{$row->name}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label for="">Kabupaten / Kota</label>
                            <select class="form-select form-select-edit" id="regency_edit" name="regency" required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Kabupaten/Kota</option>
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label for="">Kecamatan </label>
                            <select class="form-select form-select-edit" id="district_edit" name="district" required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Kecamatan</option>
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label for="">Desa / Kelurahan </label>
                            <select class="form-select form-select-edit" id="village_edit" name="village" required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Desa/Kelurahan</option>
                            </select>
                        </div>
                        <div class="form-group col-4 mt-1">
                            <label class="form-label">RT</label>
                            <input type="text" class="form-control" name="rt" id="rt_edit" placeholder="Masukan RT"  data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-4 mt-1">
                            <label class="form-label">RW</label>
                            <input type="text" class="form-control" name="rw" id="rw_edit" placeholder="Masukan RW"  data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-4 mt-1">
                            <label class="form-label">Kode POS</label>
                            <input type="text" class="form-control" name="kode_pos" id="kode_pos_edit" placeholder="Masukan Kode POS"  data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="address" id="address_edit" placeholder="Masukan Alamat Karyawan" class="form-control" required data-parsley-trigger="keyup"></textarea>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label for="" class="form-label">Agama</label>
                            <select name="agama" id="agama_edit" class="form-select form-select-edit" required data-parsley-trigger="change">
                                <option value="" disabled>Pilih Agama</option>
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
                                <input class="form-check-input form-check-input-edit" type="radio" id="flexRadioDefault1_edit" value="Laki-laki" name="gender" required data-parsley-errors-container="#error-radio">
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="flexRadioDefault2">Prempuan</label>
                                <input class="form-check-input form-check-input-edit" type="radio" id="flexRadioDefault2_edit" value="Perempuan" name="gender">
                            </div>
                            <p id="error-radio"></p>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-check-label me-3">Status Perkawinan <sup class="text-danger">*</sup></label><br>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="flexRadioDefault3">Kawin</label>
                                <input class="form-check-input form-check-input-edit" type="radio" id="flexRadioDefault3_edit" value="Kawin" name="status_perkawinan" required data-parsley-errors-container="#error-radios">
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="flexRadioDefault4">Belum Kawin</label>
                                <input class="form-check-input form-check-input-edit" type="radio" id="flexRadioDefault4_edit" value="Belum Kawin" name="status_perkawinan">
                            </div>
                            <p id="error-radios"></p>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">No.HP</label>
                            <input type="text" class="form-control" name="phone" id="phone_edit" placeholder="Masukan No.HP"  data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email_edit" placeholder="Masukan email Karyawan" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir_edit" placeholder="Masukan Tempat Lahir Karyawan" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Tanggal Lahir Karyawan</label>
                            <input type="date" max="{{date('Y-m-d')}}" class="form-control" name="date_birth" id="date_birth_edit"  placeholder="Masukan Tanggal Lahir Karyawan" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Tahun Masuk</label>
                            <input type="number" min="1980" max="{{date('Y')}}" class="form-control" name="tahun_masuk" id="year_edit" placeholder="Masukan Tahun Masuk Karyawan" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Pendidikan Terakhir</label>
                            <input type="text" class="form-control" name="pendidikan_terakhir" id="pendidikan_terakhir_edit" placeholder="Masukan Pendidikan Terakhir Karyawan" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Jumlah Anak</label>
                            <input type="number" class="form-control" name="jml_anak" id="jml_anak_edit" placeholder="Masukan Jumlah Anak" min="0" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">No NPWP</label>
                            <input type="text" class="form-control" name="no_npwp" id="no_npwp_edit" placeholder="Masukan No NPWP"  data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Nama NPWP</label>
                            <input type="text" class="form-control" name="nama_npwp" id="nama_npwp_edit" placeholder="Masukan Nama NPWP" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-12 mt-1">
                            <label for="form-label">Foto Profil</label>
                            <input type="file" name="image" class="dropifys" accept="img/*" data-allowed-file-extensions="png jpg jpeg" id="image_edit">
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
                <h4 class="modal-title">Detail Data Karyawan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <img src="" id="img_Karyawan" style="width: 100%;" alt="">
                    </div>
                    <div class="col-9">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>NIK</th>
                                    <td id="nik_detail"></td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td id="name_detail"></td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan</th>
                                    <td id="pekerjaan_detail"></td>
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
                                    <th>Jumlah Anak</th>
                                    <td id="jml_anak_detail"></td>
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
                                    <th colspan="4" style="text-align: center;">Alamat Karyawan</th>
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
                <h4 class="modal-title">Form Import Karyawan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="{{url('import-karyawan')}}" id="form_import" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card ribbon mb-3">
                        <div class="option-10 position-absolute text-light"><i class="fa fa-file-excel-o fa-lg"></i></div>
                        <div class="card-body p-4 mt-4">
                            <p>Anda harus menggunakan template ini untuk import Karyawan</p>
                            <br>
                            <b>
                                <a href="{{url('download-form-import-karyawan')}}" id="download_btn">
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
