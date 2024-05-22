@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2>Data Daftar Ulang Menunggu Approval</h2>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="tabel">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Calon Mahasiswa</th>
                                <th>Total Biaya</th>
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

<div id="detail_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Rincian Biaya</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
               <table class="table table-striped" id="tbl_detail">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Biaya</th>
                            <th>Nominal</th>
                            <th>Beasiswa</th>
                            <th>Tagihan</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot></tfoot>
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
    function formatRupiah(number) {
        var rupiah = "Rp" + number.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
        return rupiah;
    }
    $(document).ready(function(){
        var table = $('#tabel').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: "{{ url('get-daftar-ulang-owner') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'total', name: 'total'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ],
            drawCallback: function( settings, start, end, max, total, pre ) {
                $('#count-data').html(this.fnSettings().fnRecordsTotal())
            },
        });
        $("#edit_modal_close").click(function(){
            $("#name_edit").prop('readonly',true);
        })

        $('body').on('click','.detail', function(){
            var id = $(this).val();
            var url = "{{route('daftar-ulang-owner.show', ':id')}}"
            url = url.replace(':id',id);
            $.ajax({
                type:'GET',
                url : url,
                success:function(res){
                    $("#tbl_detail tbody").empty();
                    $("#tbl_detail tfoot").empty();
                    var nomer = 1;
                    var total = 0;
                    $.each(res.tagihan_detail, function(key,item){
                        $("#tbl_detail tbody").append('<tr>\
                                                <td>'+nomer+'</td>\
                                                <td>'+item.nama_tagihan+'</td>\
                                                <td>'+formatRupiah(item.nominal)+'</td>\
                                                <td>'+item.beasiswa+'%</td>\
                                                <td>'+formatRupiah(item.nominal - (item.nominal*item.beasiswa/100))+'</td>\
                                            </tr>');
                            total = total + ( item.nominal - (item.nominal*item.beasiswa/100));
                            nomer++
                    })
                    $("#tbl_detail tfoot").append('<tr><td colspan=4></td><td>'+formatRupiah(total)+'</td><tr>');

                }
            })
        })
        $("body").on('click','.acc',function(){
            Swal.fire({
                icon:'question',
                title: 'Apakah Anda Yakin Untuk Menyetujui Dokumen ini?',
                text: 'Masukan Catatan dibawah',
                html : '<textarea class="form-control" placeholder="Remark..." id="remark_owner"></textarea>',
                showDenyButton: true,
                confirmButtonText: 'Iya',
                denyButtonText: 'Batal',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var id = $(this).val();
                    var url_acc = "{{url('acc-daftar-ulang-owner')}}";
                    $.ajax({
                        type : 'POST',
                        url : url_acc,
                        data : {
                            _token : '{{csrf_token()}}',
                            id : id,
                            status : "A",
                            remark : $("#remark_owner").val(),
                        },
                        success:function(response){
                            swal.fire({
                                icon: 'success',
                                title : 'Approval berhasil',
                            });
                            // get_daftar-ulang-owner();
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
        $("body").on('click','.deny',function(){
            Swal.fire({
                icon:'warning',
                title: 'Apakah Anda Yakin Untuk Menolak Dokumen ini?',
                text: 'Masukan Catatan dibawah',
                html : '<textarea class="form-control" placeholder="Remark..." id="remark_owner"></textarea>',
                showDenyButton: true,
                confirmButtonText: 'Iya',
                denyButtonText: 'Batal',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var id = $(this).val();
                    var url_acc = "{{url('acc-daftar-ulang-owner')}}";
                    $.ajax({
                        type : 'POST',
                        url : url_acc,
                        data : {
                            _token : '{{csrf_token()}}',
                            id : id,
                            status : "D",
                            remark : $("#remark_owner").val(),
                        },
                        success:function(response){
                            swal.fire({
                                icon: 'success',
                                title : 'Approval berhasil',
                            });
                            // get_daftar-ulang-owner();
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
