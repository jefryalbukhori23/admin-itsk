@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2>Data Konten</h2>
                    <br>
                    <b class="text-muted">*Konten memuat pengumuman,info pendaftara,berita,artikel dll</b>
                </div>

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
                                <th>Kategori</th>
                                <th>Judul</th>
                                <th>Tampil Di</th>
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
                <h4 class="modal-title">Form Tambah Konten</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="{{route('konten.store')}}" id="add_form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="recipient-name" class="form-label">kategori Konten</label>
                            <select name="id_kategori" class="form-select" id="">
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach ($kategori as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="recipient-name" class="form-label">Tampilkan di subdomain?</label>
                            <select name="id_sub" class="form-select" id="">
                                <option value="1" disabled selected>Semua Sub</option>
                                @foreach ($sub as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="recipient-name" class="form-label">Judul Konten</label>
                            <input type="text" class="form-control" id="name" name="title" placeholder="Masukan Judul Konten">
                        </div>
                        <div class="form-group col-12">
                            <label for="">Isi Konten</label>
                            <textarea name="desc" id="desc" class="form-control" placeholder="Masukan isi konten disini"></textarea>
                        </div>
                        <div class="form-group col-6">
                            <h6>Cover Image</h6>
                            <input type="file" name="image" class="dropify" accept="image/*" data-allowed-file-extensions="jpg png jpeg" required>
                        </div>
                        <div class="form-group col-6">
                            <h6>File Attachment</h6>
                            <input type="file" name="att" class="dropify" data-allowed-file-extensions="jpg png jpeg word xlsx pdf">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light text-white save_data">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- <div id="edit_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit Konten</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="form-label">Nama Konten</label>
                    <input type="hidden" name="" id="id_edit" >
                    <input type="text" class="form-control" id="name_edit" placeholder="Masukan Nama Konten" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" id="edit_modal_close" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success waves-effect waves-light text-white update" data-bs-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div> --}}

<div id="edit_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah Konten</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="{{url('konten-update')}}" id="add_form" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id_edit">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="recipient-name" class="form-label">kategori Konten</label>
                            <select name="id_kategori" class="form-select" id="kategori_edit">
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach ($kategori as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="recipient-name" class="form-label">Tampilkan di subdomain?</label>
                            <select name="id_sub" class="form-select" id="sub_edit">
                                <option value="1" selected>Semua Sub</option>
                                @foreach ($sub as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="recipient-name" class="form-label">Judul Konten</label>
                            <input type="text" class="form-control" id="title_edit" name="title" placeholder="Masukan Judul Konten">
                        </div>
                        <div class="form-group col-12">
                            <label for="">Isi Konten</label>
                            <textarea name="desc" id="desc_edit" class="form-control" placeholder="Masukan isi konten disini"></textarea>
                        </div>
                        <div class="form-group col-6">
                            <h6>Cover Image</h6>
                            <input type="file" name="image" id="image_edit" class="dropify" accept="image/*" data-allowed-file-extensions="jpg png jpeg" required>
                        </div>
                        <div class="form-group col-6">
                            <h6>File Attachment</h6>
                            <input type="file" name="att" id="att_edit" class="dropify" data-allowed-file-extensions="jpg png jpeg word xlsx pdf">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light text-white save_data">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="detail_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Prodi per Konten</h4>
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

<script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>
<script>
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
    ClassicEditor
        .create( document.querySelector( '#desc' ), {
            // ...
            updateSourceElementOnDestroy: true
        } )
        .catch( error => {
            console.error( error );
    } );
    ClassicEditor
        .create( document.querySelector( '#desc_edit' ), {
            // ...
            updateSourceElementOnDestroy: true
        } )
        .catch( error => {
            console.error( error );
    } );
</script>
<script>
    $(document).ready(function(){
        var table = $('#tabel').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('get-konten') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'kategori', name: 'kategori'},
                {data: 'title', name: 'title'},
                {data: 'sub', name: 'sub'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        // $("body").on('click','.save_data',function(){
        //     var url_save = '{{route('konten.store')}}';
        //     var form = $('#add_form')[0];
        //     var data = new FormData(form);
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax({
        //         type : 'POST',
        //         url : url_save,
        //         enctype: 'multipart/form-data',
        //         processData: false,
        //         data: data,
        //         contentType: false,
        //         cache: false,
        //         success:function(response){
        //             console.log(response);
        //             swal.fire({
        //                 icon: 'success',
        //                 title: 'Data konten berhasil ditambahkan !'
        //             });
        //             $('#tabel').DataTable().ajax.reload();
        //         }
        //     })
        // })
        $(".save_data").click(function(){
            swal.fire({
                icon:'success',
                title: 'Konten berhasil di upload',
            })
        })

        $("body").on('click','.edit',function(){
            var id = $(this).val();
            var url_detail = "{{ route('konten.show', ':id') }}";
            url_detail = url_detail.replace(':id', id);
            $("#id_edit").val(id);
            $.ajax({
                type : 'GET',
                url : url_detail,
                success:function(response){
                    $("#title_edit").val(response.data['title']);
                    $('#kategori_edit option[value="'+response.data['id_kategori']+'"]').attr('selected','selected');
                    $("#desc_edit").val(response.data['desc'])
                    $("#image_edit").val(response.data['image']);
                    $("#att_edit").val(response.data['att']);

                }
            })
        });
        $("#edit_modal_close").click(function(){
            $("#name_edit").prop('readonly',true);
        })

        $("body").on('click','.update',function(){
            // alert('tes');
            var id = $("#id_edit").val();
            var url_update = "{{ route('konten.update', ':id') }}";
            url_update = url_update.replace(':id', id);
            $.ajax({
                type : 'PUT',
                url : url_update,
                data : {
                    _token: '{{ csrf_token() }}',
                    name : $("#name_edit").val(),
                },
                success:function(response){
                    $("#name_edit").val('');
                    // get_konten();
                    swal.fire({
                        icon: 'success',
                        title: 'Data Konten berhasil diupdate !'
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
                    var url_delete = "{{ route('konten.destroy', ':id') }}";
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
                            // get_konten();
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
