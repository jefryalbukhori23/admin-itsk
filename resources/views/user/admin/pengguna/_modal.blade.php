
<div id="add_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah Pengguna</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="" id="form_add_pengguna" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6 mt-3">
                            <label class="form-label">Role</label>
                            <select name="role" id="role" class="form-select" required data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Role</option>
                                @foreach ($roles as $row)
                                    <option value="{{$row->id}}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 mt-3" id="prodi_select" style="display: none">
                            <label for="" class="form-label">Prodi</label>
                            <select name="id_prodi" id="id_prodi" class="form-select" data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Prodi</option>
                                @foreach ($prodi as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 mt-3">
                            <label for="recipient-name" class="form-label">Nama Pengguna</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Masukan Nama Pengguna" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-3">
                            <label for="recipient-name" class="form-label">Email Pengguna</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Masukan Email Pengguna" required data-parsley-type="email" data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-3">
                            <label for="recipient-name" class="form-label">No Telpon</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Masukan Nomor Telpon Pengguna" required data-parsley-type="integer" data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-3">
                            <label for="recipient-name" class="form-label">No ID (NIP/NIK/NIDN)</label>
                            <input type="text" class="form-control" name="id_no" id="id_no" placeholder="Masukan Nomor ID (NIP/NIK/NIDN) Pengguna" required data-parsley-type="integer" data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6 mt-3">
                            <label for="">Alamat</label>
                            <textarea id="address" name="address" class="form-control" placeholder="Masukan Alamat"></textarea>
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
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success waves-effect waves-light text-white save_data" data-bs-dismiss="modal">Save changes</button>
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
                                @foreach ($roles_edit as $row)
                                    <option value="{{$row->id}}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 mt-3" id="prodi_select" style="display: none">
                            <label for="" class="form-label">Prodi</label>
                            <select name="id_prodi" id="prodi_select_edit" class="form-select" data-parsley-trigger="change">
                                <option value="" disabled selected>Pilih Prodi</option>
                                @foreach ($prodi as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
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
