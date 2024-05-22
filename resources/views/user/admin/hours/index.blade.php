@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2>Data Jam Pelajaran</h2>
                    <br>
                    <b class="text-muted">*Jam Pelajaran yang tidak bisa dihapus dikarenakan ada Jadwal didalamnya</b>
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
                                <th>Name</th>
                                <th>Mulai</th>
                                <th>Berakhir</th>
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
                <h4 class="modal-title">Form Tambah Jam Pelajaran</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" placeholder="Masukan Nama hours">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="form-label">Jam Mulai</label>
                    <input type="time" class="form-control" id="start" placeholder="Masukan Jam Mulai">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="form-label">Jam Selesai</label>
                    <input type="time" class="form-control" id="end" placeholder="Masukan Jam Selesai">
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
                <h4 class="modal-title">Form Edit Jam Pelajaran</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="form-label">Nama</label>
                    <input type="hidden" name="id" id="id_edit" >
                    <input type="text" class="form-control" id="name_edit" placeholder="Masukan Nama">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="form-label">Jam Mulai</label>
                    <input type="time" class="form-control" id="start_edit" placeholder="Masukan Jam Mulai">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="form-label">Jam Selesai</label>
                    <input type="time" class="form-control" id="end_edit" placeholder="Masukan Jam Selesai">
                </div>
            </div>
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
            ajax: "{{ url('get-hours') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'start', name: 'start'},
                {data: 'end', name: 'end'},
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
                var url_save = '{{route('hours.store')}}';
                $.ajax({
                    type : 'POST',
                    url : url_save,
                    data : {
                        _token: '{{ csrf_token() }}',
                        name : $("#name").val(),
                        start : $("#start").val(),
                        end : $("#end").val(),
                    },
                    success:function(response){
                        $("#name").val('');
                        $("#end").val('');
                        $("#start").val('');
                        swal.fire({
                            icon: 'success',
                            title: 'Data Jam Pelajaran berhasil ditambahkan !',
                            timer : 1500
                        });
                        $('#tabel').DataTable().ajax.reload();
                }
                })

            }
        })

        $("body").on('click','.edit',function(){
            var id = $(this).val();
            var url_detail = "{{ route('hours.show', ':id') }}";
            url_detail = url_detail.replace(':id', id);
            $("#id_edit").val(id);
            $.ajax({
                type : 'GET',
                url : url_detail,
                success:function(response){
                    $("#name_edit").val(response.data['name']);
                    $("#start_edit").val(response.data['start']);
                    $("#end_edit").val(response.data['end']);
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
            var url_update = "{{ route('hours.update', ':id') }}";
            url_update = url_update.replace(':id', id);
            $.ajax({
                type : 'PUT',
                url : url_update,
                data : {
                    _token: '{{ csrf_token() }}',
                    name : $("#name_edit").val(),
                    start : $("#start_edit").val(),
                    end : $("#end_edit").val(),
                },
                success:function(response){
                    $("#name_edit").val('');
                    // get_hours();
                    swal.fire({
                        icon: 'success',
                        title: 'Data Jam Pelajaran berhasil diupdate !',
                        timer : 1500
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
                if (result.isConfirmed) {
                    var id = $(this).val();
                    var url_delete = "{{ route('hours.destroy', ':id') }}";
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
                            // get_hours();
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
