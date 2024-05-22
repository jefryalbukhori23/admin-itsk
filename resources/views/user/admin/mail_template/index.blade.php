@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h2>Template Email</h2>

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
            <form action="{{route('mail_template.store')}}" id="add_form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="recipient-name" class="form-label">Nama Template</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Template Email" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="recipient-name" class="form-label">Subject Email</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Masukan Subject Email" required>
                        </div>
                        <div class="form-group col-12">
                            <label for="">Isi Template</label>
                            <textarea name="desc" id="desc" class="form-control" placeholder="Masukan Template Email disini untuk data dinamis seperti *nama mahasiswa*,  berikan tanda __ (double underscore), contoh : __email , __nama "></textarea>
                        </div>
                        <div class="form-group col-12">
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
<div id="edit_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit Konten</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="{{url('mail_template-update')}}" id="edit_form" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id_edit">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="recipient-name" class="form-label">Nama Template</label>
                            <input type="text" class="form-control" id="name_edit" name="name" placeholder="Masukan Nama Template Email" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="recipient-name" class="form-label">Subject Email</label>
                            <input type="text" class="form-control" id="subject_edit" name="subject" placeholder="Masukan Subject Email" required>
                        </div>
                        <div class="form-group col-12">
                            <label for="">Isi Template</label>
                            <textarea name="desc" id="desc_edit" class="form-control" placeholder="Masukan Template Email disini untuk data dinamis seperti *nama mahasiswa*, berikan tanda __ (double underscore), contoh : __email , __nama ">

                            </textarea>
                        </div>
                        <div class="form-group col-12">
                            <h6>File Attachment</h6>
                            <input type="file" name="att" id="att_edit" class="dropify" data-allowed-file-extensions="jpg png jpeg docx xlsx pdf">
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
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Template</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div id="isi_template">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="same_edit" value="no">

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
</script>
<script>
    $(document).ready(function(){
        var table = $('#tabel').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('get-mail_template') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        $(".save_data").click(function(){
            swal.fire({
                icon:'success',
                title: 'Template berhasil di simpan',
            })
        })
        $(".update_data").click(function(){
            swal.fire({
                icon:'success',
                title: 'Template berhasil di simpan',
            })
        })

        $("body").on('click','.detail',function(){
            var id = $(this).val();
            var url_detail = "{{ route('mail_template.show', ':id') }}";
            url_detail = url_detail.replace(':id', id);
            $.ajax({
                type : 'GET',
                url : url_detail,
                success:function(response){
                    $("#isi_template").html(response.data['desc']);

                }
            })
        });
        $("body").on('click','.edit',function(){
            var id = $(this).val();
            var id_before = $("#same_edit").val();
            var url_detail = "{{ route('mail_template.show', ':id') }}";
            url_detail = url_detail.replace(':id', id);
            $("#desc_edit").attr("id","desc_edit_"+id);
            if(id_before != id){
                $.ajax({
                    type : 'GET',
                    url : url_detail,
                    success:function(response){
                        console.log(response.data);
                        $("#name_edit").val(response.data['name']);
                        $("#subject_edit").val(response.data['subject']);
                        $("#desc_edit_"+id).val(response.data['desc']);
                        // $("#att_edit").val(response.data['att']);
                        ClassicEditor
                            .create( document.querySelector( '#desc_edit_'+id ), {
                                updateSourceElementOnDestroy: true

                            } )
                            .catch( error => {
                                console.error( error );
                        } );
                        $("#same_edit").val(id);

                    }
                })
            }
        });

        // $("body").on('click','.update',function(){
        //     // alert('tes');
        //     var id = $("#id_edit").val();
        //     var url_update = "{{ route('mail_template.update', ':id') }}";
        //     url_update = url_update.replace(':id', id);
        //     $.ajax({
        //         type : 'PUT',
        //         url : url_update,
        //         data : {
        //             _token: '{{ csrf_token() }}',
        //             name : $("#name_edit").val(),
        //         },
        //         success:function(response){
        //             $("#name_edit").val('');
        //             // get_mail_template();
        //             swal.fire({
        //                 icon: 'success',
        //                 title: 'Data Konten berhasil diupdate !'
        //             });
        //             $('#tabel').DataTable().ajax.reload();

        //         }
        //     })
        // })

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
                    var url_delete = "{{ route('mail_template.destroy', ':id') }}";
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
                            // get_mail_template();
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
