@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Data Tahun Akademik</h2>
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
                                <th>Name</th>
                                <th>Status</th>
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
                <h4 class="modal-title">Form Tambah Tahun Akademik</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="form-label">Tahun Akademik</label>
                    <input type="text" class="form-control" id="name" placeholder="Masukkan Tahun Akademik"  inputmode="text">
                </div>
                <div class="form-goup">
                    <label for="">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option disabled selected>Pilih Status</option>
                        <option value="Y">Aktif</option>
                        <option value="N">Tidak Aktif</option>
                        <option value="P">Aktif PMB</option>
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
                <h4 class="modal-title">Form Edit Tahun Akademik</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="form-label">Nama Tahun Akademik</label>
                    <input type="hidden" name="" id="id_edit" >
                    <input type="text" class="form-control" id="name_edit" placeholder="Masukan Tahun Akademik"  inputmode="text" readonly>
                </div>
                <div class="form-goup">
                    <label for="">Status</label>
                    <select name="status" id="status_edit" class="form-control">
                        <option value="Y">Aktif</option>
                        <option value="N">Tidak Aktif</option>
                        <option value="P">Aktif PMB</option>
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
                <h4 class="modal-title">Data Tahun Akademik <span id="by_name"></span></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
               <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Semester</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="sub_by_table">

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
            ajax: "{{ url('get-batch_year') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'status', name: 'status'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        $("body").on('click','.save_data',function(){
            var name = $("#name").val();
            if(name == ""){
                swal.fire({
                    icon : 'error',
                    title : 'Ada data yang masih kosong!',
                    text: 'mohon isi semua data',
                });
            }else {
                var url_save = '{{route('batch_year.store')}}';
                $.ajax({
                    type : 'POST',
                    url : url_save,
                    data : {
                        _token: '{{ csrf_token() }}',
                        name : $("#name").val(),
                        status : $("#status").val(),
                    },
                    success:function(response){
                        $("#name").val('');
                        swal.fire({
                            icon: 'success',
                            title: 'Data Tahun Akademik berhasil ditambahkan !',
                            timer: 1500,
                        });
                        $('#tabel').DataTable().ajax.reload();
                }
                })

            }
        })

        $("body").on('click','.edit',function(){
            var id = $(this).val();
            var url_detail = "{{ route('batch_year.show', ':id') }}";
            url_detail = url_detail.replace(':id', id);
            $("#id_edit").val(id);
            $.ajax({
                type : 'GET',
                url : url_detail,
                success:function(response){
                    $("#name_edit").val(response.data['name']);
                    $('#status_edit option[value="'+response.data['status']+'"]').attr('selected','selected');
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
            var url_update = "{{ route('batch_year.update', ':id') }}";
            url_update = url_update.replace(':id', id);
            $.ajax({
                type : 'PUT',
                url : url_update,
                data : {
                    _token: '{{ csrf_token() }}',
                    name : $("#name_edit").val(),
                    status : $("#status_edit").val(),
                },
                success:function(response){
                    $("#name_edit").val('');
                    // get_batch_year();
                    swal.fire({
                        icon: 'success',
                        title: 'Data Tahun Akademik berhasil diupdate !',
                        timer: 1500,
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
                    var url_delete = "{{ route('batch_year.destroy', ':id') }}";
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
                            // get_batch_year();
                            $('#tabel').DataTable().ajax.reload();

                        }
                    })
                }else{
                    swal.fire({
                        icon: 'info',
                        title : 'Aksi dibatalkan',
                        timer: 1500,
                    });
                }
            });
        });

        $('body').on('click','.detail',function(){
            var id = $(this).val();
            var url = "{{url('get-sub_by/{id}')}}";
            url = url.replace('{id}',id);
            $.ajax({
                type:'GET',
                url: url,
                success:function(res){
                    $("#sub_by_table").empty();
                    $.each(res.sub, function(key,item){

                        if(item.status == "Y"){
                            var stats = '<span class="badge bg-success text-white">Aktif</span>';
                            var btn = '';
                        }else{
                            var stats = '<span class="badge bg-danger text-white">Tidak Aktif</span>';
                            if(res.status == "Y"){
                                var btn ='<button class="btn btn-success active_sub_by" title="Aktifkan" value="'+item.id+'"> \
                                            <i class="fa fa-check-circle"></i> \
                                        </button>';
                            }else{
                                var btn ='<button class="btn btn-success dis_active_sub_by" title="Aktifkan"> \
                                            <i class="fa fa-check-circle"></i> \
                                        </button>';
                            }
                        }

                        $("#sub_by_table").append('<tr> \
                            <td>'+item.code+'</td>\
                            <td>'+item.name+'</td>\
                            <td>'+stats+'</td>\
                            <td>'+btn+'</td>\
                        </tr>')
                    })
                }
            })
        })
        $("body").on('click','.dis_active_sub_by',function(){
            swal.fire({
                icon:'error',
                title: 'Akses ditolak',
                text: 'dikarenakan tahun akademik tidak aktif!',
            });
        })
        $("body").on('click','.active_sub_by',function(){
            Swal.fire({
                icon:'question',
                title: 'Apakah Anda Yakin Untuk Mengaktifkan Semester ini?',
                showDenyButton: true,
                confirmButtonText: 'Iya',
                denyButtonText: 'Batal',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var id = $(this).val();
                    var url_delete = "{{ url('update-sub-by') }}";
                    $.ajax({
                        type : 'POST',
                        url : url_delete,
                        data : {
                            _token : '{{csrf_token()}}',
                            id:id,
                        },
                        success:function(response){
                            swal.fire({
                                icon: 'success',
                                title : 'Aksi berhasil',
                                timer: 1500,
                            });
                            // get_batch_year();
                            $("#detail_modal .btn-close").click();
                            $('#tabel').DataTable().ajax.reload();
                        }
                    })
                }else{
                    swal.fire({
                        icon: 'info',
                        title : 'Aksi dibatalkan',
                        timer: 1500,
                    });
                }
            });
        });
    });
</script>
@endsection
