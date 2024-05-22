
<div id="pindah_prodi_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pindah Prodi</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="" id="form_pindah_prodi" enctype="multipart/form-data">
                <input type="hidden" name="id_registration" id="id_registration_pindah_prodi">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6 mt-3">
                            <label class="form-label">Prodi Pilihan 1</label>
                            <select name="prodi1" id="prodi1" class="form-select" required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Prodi</option>
                                @foreach($prodi as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 mt-3" id="prodi_select">
                            <label for="" class="form-label">Prodi Pilihan 2</label>
                            <select name="prodi2" id="prodi2" class="form-select" data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Prodi</option>
                                @foreach($prodi as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success waves-effect waves-light text-white btn_pindah_prodi" data-bs-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div id="pindah_jalur_seleksi_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pindah Jalur Seleksi</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="" id="form_pindah_jalur_seleksi" enctype="multipart/form-data">
                <input type="hidden" name="id_registration" id="id_registration_pindah_jalur_seleksi">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12 mt-3">
                            <label class="form-label">Jalur Seleksi</label>
                            <select name="id_jalur_seleksi" id="id_jalur_seleksi" class="form-select" required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Jalur Seleksi</option>
                                @foreach($jalur_seleksi as $row)
                                    <option value="{{$row->id}}">{{$row->name}} Gelombang {{$row->gelombang}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success waves-effect waves-light text-white btn_pindah_jalur_seleksi" data-bs-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div id="edit_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit pengguna</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="" id="form_edit_pengguna" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_edit">
                    <div class="row">
                        <div class="form-group col-6 mt-3">
                            <label class="form-label">Role</label>
                            <select name="role" id="role_edit" class="form-select" required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Role</option>
                            </select>
                        </div>
                        <div class="form-group col-6 mt-3" id="prodi_select" style="display: none">
                            <label for="" class="form-label">Prodi</label>
                            <select name="id_prodi" id="prodi_select_edit" class="form-select" data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Prodi</option>
                            </select>
                        </div>
                        <div class="form-group col-6 mt-3">
                            <label for="recipient-name" class="form-label">Nama Pengguna</label>
                            <input type="text" class="form-control" name="name" id="name_edit" placeholder="Masukan Nama Pengguna" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-3">
                            <label for="recipient-name" class="form-label">Email Pengguna</label>
                            <input type="email" class="form-control" name="email" id="email_edit" placeholder="Masukan Email Pengguna" required data-parsley-type="email" data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-3">
                            <label for="recipient-name" class="form-label">No Telpon</label>
                            <input type="text" class="form-control" name="phone" id="phone_edit" placeholder="Masukan No Telpon Pengguna" required data-parsley-type="integer" data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-3">
                            <label for="recipient-name" class="form-label">No ID (NIP/NIK/NIDN)</label>
                            <input type="text" class="form-control" name="id_no" id="id_no_edit" placeholder="Masukan Nomor ID (NIP/NIK/NIDN) Pengguna" required data-parsley-type="integer" data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-3">
                            <label for="">Alamat</label>
                            <textarea id="address_edit" name="address" class="form-control" placeholder="Masukan Alamat"></textarea>
                        </div>
                        <div class="col-12 mt-4">
                            <b>Informasi</b> <br>
                            <p>
                                Password default akun adalah 123 ,<br>
                                 mohon mengganti password dengan cara login menggunakan akun tersebut.
                            </p>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" id="edit_modal_close" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success waves-effect waves-light text-white update" data-bs-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div id="detail_pendaftar_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Calon Mahasiswa Baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class="col-1">

                    </div>
                    <div class="col-md-3" style="margin-top: 3px;">
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">No Identitas</div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Nama Lengkap</div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Tempat, Tanggal Lahir</div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Jenis Kelamin</div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Asal Sekolah</div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Jurusan</div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Tahun Lulus</div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;height:50px;">No Telpon</div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Email</div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Pilihan Prodi 1</div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Pilihan Prodi 2</div>
                        <div class="row" style="font-size:16px;">Berkas Mahasiswa</div>
                    </div>
                    <div class="col-md-8" style="margin-top: 3px;">
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="id_no_detail_peminat"></div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="name_detail_peminat"></div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="ttl_detail_peminat"></div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="gender_detail_peminat"></div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="school_detail_peminat"></div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="jurusan_detail_peminat"></div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="tahun_lulus_detail_peminat"></div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;height:50px;" id="phone_detail_peminat"></div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="email_detail_peminat"></div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="id_prodi1_detail_peminat"></div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="id_prodi2_detail_peminat"></div>
                        <div class="row" style="padding:2px;font-size:16px;" id="file_detail_peminat">
                            <div class="order-actions" id="btn_files">

                            </div>
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
