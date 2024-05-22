@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Tanggal KRS</h2>
                {{-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal">
                    <i class="fa fa-plus"></i> Tambah Data
                </button> --}}
            </div>
            <div class="card-body">
                <p class="text-muted">Tanggal KRS digunakan untuk memberikan akses kepada Mahasiswa maupun Dosen untuk merubah KRS Mahasiswa</p>
                <div class="table-responsive mt-5">
                    <table class="table table-striped" id="tabel">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun Ajaran</th>
                                <th>Tgl Mulai</th>
                                <th>Tgl Berakhir</th>
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
                <h4 class="modal-title">Form Tambah Tanggal KRS</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="" id="form_add_krs_date" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="recipient-name" class="form-label">Tahun Ajaran</label>
                            <select name="id_batch_year" id="id_batch_year" class="form-select" data-placeholder="Pilih Tahun Ajaran" data-parsley-trigger="change" required>
                                <option value="" disabled selected>Pilih Tahun Ajaran</option>
                                @foreach ($batch_year as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="" class="form-label">Tanggal Mulai</label>
                            <input type="date" min="{{date('Y-m-d')}}" name="start" id="start" class="form-control" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="" class="form-label">Tanggal Berakhir</label>
                            <input type="date" min="{{date('Y-m-d')}}" name="end" id="end" class="form-control" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-goup col-12">
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option disabled selected>Pilih Status</option>
                                <option value="Y">Aktif</option>
                                <option value="N">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success waves-effect waves-light text-white save_data" data-bs-dismiss="modal">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="edit_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah Tanggal KRS</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="" id="form_edit_krs_date" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" id="id_edit">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="recipient-name" class="form-label">Tahun Ajaran</label>
                            <select name="id_batch_year" id="id_batch_year_edit" class="form-select" data-placeholder="Pilih Tahun Ajaran" data-parsley-trigger="change" required>
                                <option value="" disabled selected>Pilih Tahun Ajaran</option>
                                @foreach ($batch_year as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="" class="form-label">Tanggal Mulai</label>
                            <input type="date" min="{{date('Y-m-d')}}" name="start" id="start_edit" class="form-control" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="" class="form-label">Tanggal Berakhir</label>
                            <input type="date" min="{{date('Y-m-d')}}" name="end" id="end_edit" class="form-control" data-parsley-trigger="keyup" required>
                        </div>
                        <div class="form-goup col-12">
                            <label for="">Status</label>
                            <select name="status" id="status_edit" class="form-control">
                                <option disabled selected>Pilih Status</option>
                                <option value="Y">Aktif</option>
                                <option value="N">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success waves-effect waves-light text-white update" data-bs-dismiss="modal">Save changes</button>
                </div>
            </form>
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
            ajax: "{{ url('get-krs_date') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'by', name: 'by'},
                {data: 'start', name: 'start'},
                {data: 'end', name: 'end'},
                {data: 'status', name: 'status'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        $('#form_add_krs_date').parsley();
        $("body").on('click','.save_data',function(){
                var url_save = '{{route('krs_date.store')}}';
                var form = $('#form_add_krs_date')[0];
                var data = new FormData(form);
                $.ajax({
                    type : 'POST',
                    url : url_save,
                    processData: false,
                    data: data,
                    contentType: false,
                    cache: false,
                    success:function(response){
                        swal.fire({
                            icon: 'success',
                            title: 'Data berhasil ditambahkan !',
                            timer: 800,
                        });
                        $('#tabel').DataTable().ajax.reload();
                        $("#overlay").fadeOut();
                        $('#form_add_krs_date')[0].reset();
                }
                })
        })

        $("body").on('click','.edit',function(){
            var id = $(this).val();
            var url_detail = "{{ route('krs_date.show', ':id') }}";
            url_detail = url_detail.replace(':id', id);
            $("#id_edit").val(id);
            $.ajax({
                type : 'GET',
                url : url_detail,
                success:function(response){
                    $("#start_edit").val(response.data['start']);
                    $("#end_edit").val(response.data['end']);
                    $('#status_edit option[value="'+response.data['status']+'"]').attr('selected','selected');
                    $('#id_batch_year_edit option[value="'+response.data['id_batch_year']+'"]').attr('selected','selected');
                }
            })
        });

        $("body").on('click','.update',function(){
            alert('tes');
            var id = $("#id_edit").val();
            var url_update = "{{ route('krs_date.update', ':id') }}";
            url_update = url_update.replace(':id', id);
            $.ajax({
                type : 'PUT',
                url : url_update,
                data : {
                    _token: '{{ csrf_token() }}',
                    id_batch_year : $("#id_batch_year_edit").val(),
                    start : $("#start_edit").val(),
                    end : $("#end_edit").val(),
                    status : $("#status_edit").val(),
                },
                success:function(response){
                    $("#name_edit").val('');
                    // get_krs_date();
                    swal.fire({
                        icon: 'success',
                        title: 'Tanggal KRS berhasil diupdate !'
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
                    var url_delete = "{{ route('krs_date.destroy', ':id') }}";
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
                            // get_krs_date();
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
