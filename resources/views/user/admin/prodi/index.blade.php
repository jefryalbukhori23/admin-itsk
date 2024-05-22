@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Data prodi</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal">
                    <i class="fa fa-plus"></i> Tambah Data
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="tabel">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Name</th>
                                <th>Ketua Prodi</th>
                                <th>NIP KAPRODI</th>
                                <th>Fakultas</th>
                                <th>Jenjang</th>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah prodi</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="form-label">Nama prodi</label>
                    <input type="text" class="form-control" id="name" placeholder="Masukan Nama prodi">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="form-label">Kode prodi</label>
                    <input type="text" class="form-control" id="kode" placeholder="Masukan Kode prodi">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="form-label">Ketua prodi</label>
                    <input type="text" class="form-control" id="kaprodi" placeholder="Masukan Ketua prodi">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="form-label">NIP Ketua prodi</label>
                    <input type="text" class="form-control" id="nip_kaprodi" placeholder="Masukan NIP Ketua prodi">
                </div>
                <div class="form-group">
                    <label for="">Fakultas</label>
                    <select name="id_fakultas" id="id_fakultas" class="form-control">
                        <option value="" disabled selected>Pilih Fakultas</option>
                        @foreach ($fakultas as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Jenjang</label>
                    <select name="id_jenjang" id="id_jenjang" class="form-control">
                        <option value="" disabled selected>Pilih Jenjang</option>
                        @foreach ($jenjang as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success waves-effect waves-light text-white save_data" data-bs-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div id="edit_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit prodi</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="form-label">Nama prodi</label>
                    <input type="hidden" name="" id="id_edit" >
                    <input type="text" class="form-control" id="name_edit" placeholder="Masukan Nama prodi" readonly>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="form-label">Kode prodi</label>
                    <input type="text" class="form-control" id="kode_edit" placeholder="Masukan Kode prodi">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="form-label">Ketua prodi</label>
                    <input type="text" class="form-control" id="kaprodi_edit" placeholder="Masukan Ketua prodi">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="form-label">NIP Ketua prodi</label>
                    <input type="text" class="form-control" id="nip_kaprodi_edit" placeholder="Masukan NIP Ketua prodi">
                </div>
                <div class="form-group">
                    <label for="">Fakultas</label>
                    <select name="id_fakultas_edit" id="id_fakultas_edit" class="form-control">
                        @foreach ($fakultas as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Jenjang</label>
                    <select name="id_jenjang_edit" id="id_jenjang_edit" class="form-control">
                        @foreach ($jenjang as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" id="edit_modal_close" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success waves-effect waves-light text-white update" data-bs-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div id="detail_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Prodi per prodi</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
               <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Prodi</th>
                        </tr>
                    </thead>
                    <tbody id="data_prodi">

                    </tbody>
               </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


{{-- JS --}}
<script>
    $(document).ready(function(){
        var table = $('#tabel').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: "{{ url('get-prodi') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'kode', name: 'kode'},
                {data: 'name', name: 'name'},
                {data: 'kaprodi', name: 'kaprodi'},
                {data: 'nip_kaprodi', name: 'nip_kaprodi'},
                {data: 'fakultas', name: 'fakultas'},
                {data: 'jenjang', name: 'jenjang'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        $("body").on('click','.save_data',function(){
            // alert('tes');
            var name = $("#name").val();
            if(name == ""){
                swal.fire({
                    icon : 'error',
                    title : 'Ada data yang masih kosong!',
                    text: 'mohon isi semua data',
                });
            }else {
                var url_save = '{{route('prodi.store')}}';
                $.ajax({
                    type : 'POST',
                    url : url_save,
                    data : {
                        _token: '{{ csrf_token() }}',
                        name : $("#name").val(),
                        id_fakultas : $("#id_fakultas").val(),
                        id_jenjang : $("#id_jenjang").val(),
                        kode : $("#kode").val(),
                        kaprodi : $("#kaprodi").val(),
                        nip_kaprodi : $("#nip_kaprodi").val(),
                    },
                    success:function(response){
                        $("#name").val('');
                        swal.fire({
                            icon: 'success',
                            title: 'Data prodi berhasil ditambahkan !'
                        });
                        $('#tabel').DataTable().ajax.reload();
                }
                })

            }
        })

        $("body").on('click','.edit',function(){
            var id = $(this).val();
            var url_detail = "{{ route('prodi.show', ':id') }}";
            url_detail = url_detail.replace(':id', id);
            $("#id_edit").val(id);
            $.ajax({
                type : 'GET',
                url : url_detail,
                success:function(response){
                    $("#name_edit").val(response.data['name']);
                    $("#kode_edit").val(response.data['kode']);
                    $("#kaprodi_edit").val(response.data['kaprodi']);
                    $("#nip_kaprodi_edit").val(response.data['nip_kaprodi']);
                    $('#id_fakultas_edit option[value="'+response.data['id_fakultas']+'"]').attr('selected','selected');
                    $('#id_jenjang_edit option[value="'+response.data['id_jenjang']+'"]').attr('selected','selected');
                    $("#name_edit").prop('readonly',false);
                }
            })
        });
        $("#edit_modal_close").click(function(){
            $("#name_edit").prop('readonly',true);
        })

        $("body").on('click','.update',function(){
            // alert('tes');
            var id = $("#id_edit").val();
            var url_update = "{{ route('prodi.update', ':id') }}";
            url_update = url_update.replace(':id', id);
            $.ajax({
                type : 'PUT',
                url : url_update,
                data : {
                    _token: '{{ csrf_token() }}',
                    name : $("#name_edit").val(),
                    id_fakultas : $("#id_fakultas_edit").val(),
                    id_jenjang : $("#id_jenjang_edit").val(),
                    kode : $("#kode_edit").val(),
                    kaprodi : $("#kaprodi_edit").val(),
                    nip_kaprodi : $("#nip_kaprodi_edit").val(),
                },
                success:function(response){
                    $("#name_edit").val('');
                    // get_prodi();
                    swal.fire({
                        icon: 'success',
                        title: 'Data prodi berhasil diupdate !'
                    });
                    $('#tabel').DataTable().ajax.reload();

                }
            })
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
                    var id = $(this).val();
                    var url_delete = "{{ route('prodi.destroy', ':id') }}";
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
                                timer : 1500,
                            });
                            // get_prodi();
                            $('#tabel').DataTable().ajax.reload();
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
    });
</script>
@endsection
