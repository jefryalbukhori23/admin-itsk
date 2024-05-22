@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Data Kategori Konten</h2>
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
                                <th>Nama</th>
                                <th>Tampil di Menu atas</th>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah Kategori Konten</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="" id="form_add_kategori_konten" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="recipient-name" class="form-label">Judul Kategori Konten</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Masukan judul Kategori Konten">
                        </div>
                        <div class="form-group col-6">
                            <label for="">Tampilkan Sebagai Menu ?</label>
                            <select name="tampil_menu" id="" class="form-control">
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="Y">Tampil</option>
                                <option value="N">Tidak Tampil</option>
                            </select>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit Kategori Konten</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="" id="form_edit_kategori_konten" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="recipient-name" class="form-label">Nama Kategori Konten</label>
                            <input type="text" class="form-control" name="name" id="name_edit" placeholder="Masukan judul Kategori Konten">
                        </div>
                        <div class="form-group col-6">
                            <label for="">Tampilkan Sebagai Menu ?</label>
                            <select name="tampil_menu" id="tampil_menu_edit" class="form-select">
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="Y">Tampil</option>
                                <option value="N">Tidak Tampil</option>
                            </select>
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


{{-- JS --}}
<script>
    $(document).ready(function(){
        var table = $('#tabel').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('get-kategori_konten') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'tampil_menu', name: 'tampil_menu'},
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
            var image = $("#image").val();
            if(image == ""){
                swal.fire({
                    icon : 'error',
                    title : 'Ada data yang masih kosong!',
                    text: 'mohon isi semua data',
                });
            }else {
                var url_save = '{{route('kategori_konten.store')}}';

                var form = $('#form_add_kategori_konten')[0];
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
                            title: 'Data kategori_konten berhasil ditambahkan !'
                        });
                        $('#tabel').DataTable().ajax.reload();
                    }
                })

            }
        })

        $("body").on('click','.edit',function(){
            var id = $(this).val();
            var url_detail = "{{ route('kategori_konten.show', ':id') }}";
            url_detail = url_detail.replace(':id', id);
            $("#id_edit").val(id);
            $.ajax({
                type : 'GET',
                url : url_detail,
                success:function(response){
                    $("#name_edit").val(response.data['name']);
                    $('#tampil_menu_edit option[value="'+response.data['tampil_menu']+'"]').attr('selected','selected');
                }
            })
        });
        $("#edit_modal_close").click(function(){
            $("#name_edit").prop('readonly',true);
        })

        $("body").on('click','.update',function(){
            // alert('tes');
            var id = $("#id_edit").val();
            var url_update = "{{ route('kategori_konten.update', ':id') }}";
            url_update = url_update.replace(':id', id);
            var form = $('#form_edit_kategori_konten')[0];
            var data = new FormData(form);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type : 'PUT',
                url : url_update,
                enctype: 'multipart/form-data',
                processData: false,
                data: data,
                contentType: false,
                cache: false,
                success:function(response){
                    $("#name_edit").val('');
                    swal.fire({
                        icon: 'success',
                        title: 'Data kategori_konten berhasil ditambahkan !'
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
                    var url_delete = "{{ route('kategori_konten.destroy', ':id') }}";
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
                            });
                            // get_kategori_konten();
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

        $("body").on('click','.images',function(){
            var img = $(this).val();
            $("#image_preview").attr("src",'image/kategori_konten/'+img);
        })
    });
</script>
@endsection
