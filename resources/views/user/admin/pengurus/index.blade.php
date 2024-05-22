@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2>Data pengurus</h2>
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
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>No.Id</th>
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
                <h4 class="modal-title">Form Tambah pengurus</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="" id="form_add_pengurus" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label class="form-label">Nama pengurus</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Masukan Nama pengurus" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label" for="">Jabatan Pengurus</label>
                            <select name="jabatan" id="jabatan" class="form-select form-select-add" data-placeholder="Pilih Jabatan" required data-parsley-trigger="change">
                                <option value=""></option>
                                @foreach ($jabatan_pengurus as $row)
                                    <option value="{{$row->name}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label">No Id pengurus (Boleh Kosong)</label>
                            <input type="text" class="form-control" name="no_id" id="no_id" placeholder="Masukan No.id pengurus beserta nama, cth : NIP.123546" data-parsley-trigger="keyup">
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah pengurus</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="" id="form_edit_pengurus" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="" id="id_edit">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label class="form-label">Nama pengurus</label>
                            <input type="text" class="form-control" name="name" id="name_edit" placeholder="Masukan Nama pengurus" required data-parsley-trigger="keyup">
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label" for="">Jabatan Pengurus</label>
                            <select name="jabatan" id="jabatan_edit" class="form-select form-select-edit" data-placeholder="Pilih Jabatan" required data-parsley-trigger="change">
                                <option value=""></option>
                                @foreach ($jabatan_pengurus as $row)
                                    <option value="{{$row->name}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label">No Id pengurus (Boleh Kosong)</label>
                            <input type="text" class="form-control" name="no_id" id="no_id_edit" placeholder="Masukan No.id pengurus beserta nama, cth : NIP.123546" data-parsley-trigger="keyup">
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect close" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success waves-effect waves-light text-white btn_edit">Save changes</button>
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
            ajax: "{{ url('get-pengurus') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'jabatan', name: 'jabatan'},
                {data: 'no_id', name: 'no_id'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        $('#form_add_pengurus').parsley();
        $('#form_edit_pengurus').parsley();

        $(".form-select-add").select2({
            dropdownParent: $("#add_modal")
        });
        $(".form-select-edit").select2({
            dropdownParent: $("#edit_modal")
        });
        $("body").on('click','.save_data',function(){
            if($('#form_add_pengurus').parsley().isValid()){
                $("#add_modal .close").click();
                $("#overlay").fadeIn();
                var url_save = '{{route('pengurus.store')}}';

                var form = $('#form_add_pengurus')[0];
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
                            title: 'Data  pengurus berhasil ditambahkan!',
                            timer: 1500,
                        });
                        $('#tabel').DataTable().ajax.reload();
                        $("#overlay").fadeOut();
                        $('#form_add_pengurus')[0].reset();
                    $("#jabatan").val([]).trigger("change");
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
        $("body").on('click','.edit',function(){
            var id = $(this).val();
            var url_detail = "{{ route('pengurus.show', ':id') }}";
            url_detail = url_detail.replace(':id', id);
            $("#id_edit").val(id);
            $.ajax({
                type : 'GET',
                url : url_detail,
                success:function(response){
                    $("#name_edit").val(response.data['name']);
                    $("#no_id_edit").val(response.data['no_id']);
                    $("#jabatan").val([response.data['jabatan']]).trigger("change");
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
        $("body").on('click','.btn_edit',function(){
            // alert('tes');
            var id = $("#id_edit").val();
            var url_update = "{{ route('pengurus.update', ':id') }}";
            url_update = url_update.replace(':id', id);
            var form = $('#form_edit_pengurus')[0];
            var data = new FormData(form);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if($('#form_edit_pengurus').parsley().isValid()){
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
                            title: 'Data  pengurus berhasil diupdate !'
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
                    var url_delete = "{{ route('pengurus.destroy', ':id') }}";
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
                            // get_pengurus();
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

    });

</script>
@endsection
