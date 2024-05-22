
<div id="check_tes_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hasil Tes Calon Mahasiswa</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="" id="form_acc_tes" method="POST">
                @csrf
                <input type="hidden" name="id" id="id_tes_registration" >
                <input type="hidden" id="id_calon_mhs1">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label>Nama Calon Mahasiswa</label>
                            <input type="text" class="form-control" id="name_check" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Waktu Tes</label>
                            <input type="text" class="form-control" id="waktu_check" readonly>
                        </div>
                        <br>
                        <div class="form-group col-12 mt-4">
                            <h3 id="jml_benar"></h3> <br>
                            <h2 id="nilai_tes"></h2>
                        </div>
                        <br>
                        <div class="form-group col-6">
                            <label for="">Status Mahasiswa</label>
                            <select name="status" id="tes_status" class="form-control" required>
                                <option value="" disabled selected>Pilih Status Mahasiswa</option>
                                <option value="diterima">Diterima</option>
                                <option value="tidak diterima">Tidak Diterima</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Prodi Diterima</label>
                            <select name="prodi_diterima" id="prodi_diterima_tes" class="form-control" disabled>
                                <option value="" disabled selected>Pilih Prodi</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Beasiswa</label>
                            <select name="is_beasiswa" id="is_beasiswa1" class="form-control" required>
                                <option value="" disabled selected>Apakah Calon Mahasiswa Mendapatkan Beasiswa ?</option>
                                <option value="Y">Mendapat Beasiswa</option>
                                <option value="N">Tidak Mendapat Beasiswa</option>
                            </select>
                        </div>
                        <div class="form-group col-6 mb-2">
                            <label for="">Jumlah Beasiswa (%)</label>
                            <input type="number" min="0" value="0" name="beasiswa" id="jml_beasiswa1" class="form-control" disabled>
                        </div>
                        <br>
                        <hr>
                        <div class="col-12 mt-2" id="tabel_daftar_ulang_price" style="display:none">
                            <h5 class="text-center">Rincian Biaya Daftar Ulang</h5>
                            <table class="table table-striped mt-2" id="tabel_daftar_ulang">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nominal</th>
                                        <th>Beasiswa (%)</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success waves-effect waves-light text-white btn_acc_tes" data-bs-dismiss="modal">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="check_tes_modal2" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hasil Tes Calon Mahasiswa</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="" id="form_acc_tes2" method="POST">
                @csrf
                <input type="hidden" name="id" id="id_tes_registration2" >
                <input type="hidden" id="id_calon_mhs2">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Nama Calon Mahasiswa</label>
                            <input type="text" class="form-control" id="name_check2" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Status Mahasiswa</label>
                            <select name="status" id="tes_status2" class="form-control" required>
                                <option value="" disabled selected>Pilih Status Mahasiswa</option>
                                <option value="diterima">Diterima</option>
                                <option value="tidak diterima">Tidak Diterima</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Prodi Diterima</label>
                            <select name="prodi_diterima" id="prodi_diterima_tes2" class="form-control" disabled>
                                <option value="" disabled selected>Pilih Prodi</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Beasiswa</label>
                            <select name="is_beasiswa" id="is_beasiswa12" class="form-control" required>
                                <option value="" disabled selected>Apakah Calon Mahasiswa Mendapatkan Beasiswa ?</option>
                                <option value="Y">Mendapat Beasiswa</option>
                                <option value="N">Tidak Mendapat Beasiswa</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Jumlah Beasiswa (%)</label>
                            <input type="number" min="0" value="0" name="beasiswa" id="jml_beasiswa12" class="form-control" disabled>
                        </div>
                        <br>
                        <hr>
                        <div class="col-12 mt-2" id="tabel_daftar_ulang_price2" style="display:none">
                            <h5 class="text-center">Rincian Biaya Daftar Ulang</h5>
                            <table class="table table-striped mt-2" id="tabel_daftar_ulang2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nominal</th>
                                        <th>Beasiswa (%)</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success waves-effect waves-light text-white btn_acc_tes2" data-bs-dismiss="modal">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="bukti_transfer_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bukti Transfer</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 mt-2">
                        <label>Nama Calon Mahasiswa</label>
                        <input type="text" class="form-control" id="name_bukti_transfer" readonly>
                    </div>
                    <div class="form-group col-6 mt-2">
                        <label for="">Waktu Transaksi</label>
                        <input type="text" class="form-control" id="waktu_bukti_transfer" readonly>
                    </div>
                    <div class="form-group col-6 mt-2">
                        <label>Nama Pada Rekening</label>
                        <input type="text" class="form-control" id="nama_rekening_bukti_transfer" readonly>
                    </div>
                    <div class="form-group col-6 mt-2">
                        <label for="">No Rekening</label>
                        <input type="text" class="form-control" id="no_rekening_bukti_transfer" readonly>
                    </div>
                    <br>
                    <div class="form-group col-12 mt-2">
                        <label for="" class="form-label"> Bukti Transfer
                            <a href="#" id="btn_download_bukti1">
                                <button class="btn btn-sm btn-primary">
                                    <i class="fa fa-download"></i>Download
                                </button>
                            </a>
                        </label>
                        <img src="" id="bukti_transfer_img" style="width:100%;" alt="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="bukti_daftar_ulang_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bukti Transfer</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 mt-2">
                        <label>Nama Calon Mahasiswa</label>
                        <input type="text" class="form-control" id="name_bukti_daftar_ulang" readonly>
                    </div>
                    <div class="form-group col-6 mt-2">
                        <label for="">Waktu Transaksi</label>
                        <input type="text" class="form-control" id="waktu_bukti_daftar_ulang" readonly>
                    </div>
                    <div class="form-group col-6 mt-2">
                        <label>Nama Pada Rekening</label>
                        <input type="text" class="form-control" id="nama_rekening_bukti_daftar_ulang" readonly>
                    </div>
                    <div class="form-group col-6 mt-2">
                        <label for="">No Rekening</label>
                        <input type="text" class="form-control" id="no_rekening_bukti_daftar_ulang" readonly>
                    </div>
                    <br>
                    <div class="form-group col-12 mt-2">
                        <label for="">Bukti Transfer
                            <a href="#" id="btn_download_bukti2">
                                <button class="btn btn-sm btn-primary">
                                    <i class="fa fa-download"></i>Download
                                </button>
                            </a>
                        </label>
                        <img src="" id="bukti_daftar_ulang_img" style="width:100%;" alt="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="acc_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Konfirmasi Pendaftaran Calon Mahasiswa Baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="" method="POST" id="form_acc_pendaftaran">
                <input type="hidden" id="id_calon_mhs3">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id" id="id_acc_registration" >
                        <div class="form-group col-6">
                            <label for="recipient-name" class="form-label">Nama Calon Mahasiswa Baru</label>
                            <input type="text" class="form-control" id="name_edit" placeholder="Masukan Nama calon_mahasiswa_baru" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label for="recipient-name" class="form-label">Nominal Pendaftaran (Rp)</label>
                            <input type="text" name="nominal" class="form-control" id="nominal_pendaftaran" placeholder="Masukan Nominal Pendaftaran (Rp)">
                        </div>
                        <div class="form-group col-6">
                            <label for="">Pilihan Prodi 1</label>
                            <input type="text" class="form-control" id="pilihan_prodi_1_acc" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Pilihan Prodi 2</label>
                            <input type="text" class="form-control" id="pilihan_prodi_2_acc" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Status Mahasiswa</label>
                            <select name="status" id="acc_status" class="form-control" required>
                                <option value="" disabled selected>Pilih Status Mahasiswa</option>
                                <option value="diterima">Diterima</option>
                                <option value="tes">Tes Potensi Akademik</option>
                                <option value="upload_ulang_pembayaran">Upload Ulang Pembayaran</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Prodi Diterima</label>
                            <select name="prodi_diterima" id="prodi_diterima_acc" class="form-control" disabled>
                                <option value="" disabled selected>Pilih Prodi</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Beasiswa</label>
                            <select name="is_beasiswa" id="is_beasiswa" class="form-control" required>
                                <option value="" disabled selected>Apakah Calon Mahasiswa Mendapatkan Beasiswa ?</option>
                                <option value="Y">Mendapat Beasiswa</option>
                                <option value="N">Tidak Mendapat Beasiswa</option>
                            </select>
                        </div>
                        <div class="form-group col-6 mb-2">
                            <label for="">Jumlah Beasiswa (%)</label>
                            <input type="number" min="0" value="0" name="beasiswa" id="jml_beasiswa" class="form-control" disabled>
                        </div>
                        <br>
                        <hr>
                        <div class="col-12 mt-2" id="tabel_daftar_ulang_price3" style="display:none">
                            <h5 class="text-center">Rincian Biaya Daftar Ulang</h5>
                            <table class="table table-striped mt-2" id="tabel_daftar_ulang3">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nominal</th>
                                        <th>Beasiswa (%)</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" id="edit_modal_close" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success waves-effect waves-light text-white btn_acc" data-bs-dismiss="modal">Save changes</button>
                </div>
            </form>
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
<div id="detail_peminat_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">No Telpon</div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Email</div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Pilihan Prodi 1</div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Pilihan Prodi 2</div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Nama Rekomendasi</div>
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
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="phone_detail_peminat"></div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="email_detail_peminat"></div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="id_prodi1_detail_peminat"></div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="id_prodi2_detail_peminat"></div>
                        <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="nama_rekomendasi"></div>
                        <div class="row" style="padding:2px;font-size:16px;" id="file_detail_peminat"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="detail_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Data Mahasiswa</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <img src="" id="img_mahasiswa" style="width: 100%;" alt="">
                    </div>
                    <div class="col-9">
                        <table class="table">
                            <tr>
                                <th>NIM</th>
                                <td id="nim"></td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <td id="name"></td>
                            </tr>
                            <tr>
                                <th>Tempat,Tgl Lahir</th>
                                <td id="ttl_mhs"></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td id="gender"></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td id="address"></td>
                            </tr>
                            <tr>
                                <th>Prodi</th>
                                <td id="prodi"></td>
                            </tr>
                            <tr>
                                <th>Sistem Kuliah</th>
                                <td id="sistem_kuliah"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12">
                        <table class="table">
                            <tr>
                                <th>Status Perkawinan</th>
                                <td id="status_perkawinan"></td>
                                <th>Agama</th>
                                <td id="agama"></td>
                            </tr>
                            <tr>
                                <th>NISN</th>
                                <td id="nisn"></td>
                                <th>Email</th>
                                <td id="email"></td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                                <td id="phone"></td>
                                <th>No.HP Orang Tua</th>
                                <td id="no_hp_ortu"></td>
                            </tr>
                            <tr>
                                <th>Nama Ayah</th>
                                <td id="nama_ayah"></td>
                                <th>Nama Ibu</th>
                                <td id="nama_ibu"></td>
                            </tr>
                            <tr>
                                <th>Pekerjaan Ayah</th>
                                <td id="pekerjaan_ayah"></td>
                                <th>Pekerjaan Ibu</th>
                                <td id="pekerjaan_ibu"></td>
                            </tr>
                            <tr>
                                <th>Nama Wali</th>
                                <td id="nama_wali"></td>
                                <th>Alamat Orang Tua</th>
                                <td id="alamat_ortu"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="add_berkas_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload Berkas Mahasiswa</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="{{url('upload-berkas-mahasiswa')}}" id="form_upload_berkas_mahasiswa" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" name="id_mahasiswa" id="id_mahasiswa_berkas">
                <div class="modal-body">
                    <div id="loading_screen" style="display: none;">
                        <div class="form-group col-11 text-center">
                            <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="row g-2" id="upload_form_berkas" style="display: none;">
                        @foreach ($berkas as $row)
                            <div class="form-group col-md-5 col-11 m-2">
                                <h6>{{$row->name}}</h6>
                                <input type="file" name="{{$row->id}}" id="berkas_{{$row->id}}" data-nama="{{$row->name}}" class="dropify" data-allowed-file-extensions="{{$row->type}}" {{$row->is_required}}>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" id="edit_modal_close" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success waves-effect waves-light text-white btn_berkas" data-bs-dismiss="modal">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="biaya_daftar_ulang_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Biaya Daftar Ulang Calon Mahasiswa Baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class="col-5">
                        <label for="" class="form-label">Nama</label>
                        <input type="text" id="name_du_modal" class="form-control" readonly>
                    </div>
                    <div class="col-5">
                        <label for="" class="form-label">Status</label><br>
                        <span id="status_du_modal">
                        </span>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="table-responsive">
                            <table class="table table-striped" id="tbl_biaya_du">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Beasiswa</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <h4>Keterangan : </h4>
                        <p id="remark_owner_du_modal"></p>
                    </div>
                </div>
            </div>
            <input type="hidden" id="id_reg_du_modal">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success waves-effect send_mhs_du_modal" id="send_mhs_du" data-bs-dismiss="modal" >Submit</button>
                <button class="btn btn-danger text-white cancel_du" title="Batalkan" id="cancel_du"  data-bs-dismiss="modal"><i class="fa fa-times-circle"></i> Batalkan </button>
            </div>
        </div>
    </div>
</div>
