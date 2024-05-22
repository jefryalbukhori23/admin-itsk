<script>
    $(document).ready(function(){
        $(document).ajaxError(function() {
            swal.fire({
                icon : 'error',
                html : '<h3>Ada Kesalahan sistem</h3><br><b>silahkan coba lagi </b><br><p>Jika pesan ini masih muncul , silahkan reload halaman!</p>',
                timer: 1500,
            })
            $('#overlay').hide();
        });
        var table = $('#tabel').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('get-pindah-pendaftar') }}",
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'kode', name: 'kode'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'progres', name: 'progres'},
                {data: 'prodi1', name: 'prodi1'},
                {data: 'prodi2', name: 'prodi2'},
                {data: 'jalur_seleksi', name: 'jalur_seleksi'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        $("#role_select").select2();
        $("#prodi1").select2({
            dropdownParent:$("#pindah_prodi_modal")
        });
        $("#prodi2").select2({
            dropdownParent:$("#pindah_prodi_modal")
        });
        $("#id_jalur_seleksi").select2({
            dropdownParent:$("#pindah_jalur_seleksi_modal")
        });
        $("#role_edit").select2({
            dropdownParent:$("#edit_modal")
        });
        $("body").on('click','.detail_peminat', function(){
            var id = $(this).val();
            url_detail = 'detail-calon_mahasiswa_baru/'+id;
            $.ajax({
                type: 'GET',
                url : url_detail,
                success:function(response){
                    $("#id_no_detail_peminat").html(response.data['id_no']);
                    $("#name_detail_peminat").html(response.data['name']);
                    $("#ttl_detail_peminat").html(response.data['place_birth']+', '+response.data['date_birth']);
                    $("#gender_detail_peminat").html(response.data['gender']);
                    $("#school_detail_peminat").html(response.data['school']);
                    $("#jurusan_detail_peminat").html(response.data['jurusan']);
                    $("#tahun_lulus_detail_peminat").html(response.data['tahun_lulus']);
                    var phone_number = response.data['phone'].substr(0,1);
                    if(phone_number == "0"){
                        var no_telp = response.data['phone'].substr(2);
                        var nomer_telpon = phone_number.replace('0','62');
                        var telp = phone_number+no_telp;
                    }else{
                        var telp = response.data['phone'];
                    }
                    $("#phone_detail_peminat").html('<div class="order-actions">'+response.data['phone']+'<a target="_blank" href="https://wa.me/'+telp+'"><button class="btn btn-sm btn-success"><i class="fa fa-phone"></i></button></a></div>');
                    $("#email_detail_peminat").html(response.data['email']);
                    $("#id_prodi1_detail_peminat").html(response.data['prodi1']);
                    $("#id_prodi2_detail_peminat").html(response.data['prodi2']);
                    $("#nama_rekomendasi").html(response.data['nama_rekomendasi']);
                    $("#btn_files").html('');
                    $.each(response.files, function(key,item){
                        $("#btn_files").append(item);
                    })
                }
            })
        })
        $('body').on('click','.pindah_prodi', function(){
            var id = $(this).val();
            var prodi1 = $(this).data('prodi1');
            var prodi2 = $(this).data('prodi2');
            $("#prodi1").val(prodi1).trigger('change')
            $("#prodi2").val(prodi2).trigger('change')
            $("#id_registration_pindah_prodi").val(id);
        })
        $('body').on('click','.pindah_jalur_seleksi', function(){
            var id = $(this).val();
            var jalur_seleksi = $(this).data('id_jalur_seleksi');
            $("#id_jalur_seleksi").val(jalur_seleksi).trigger('change')
            $("#id_registration_pindah_jalur_seleksi").val(id);
        })
        $("body").on('click','.btn_pindah_prodi',function(){
                $("#pindah_prodi_modal .close").click();
                $("#overlay").fadeIn();
                var url_save = '{{url('pindah-prodi-store')}}';

                var form = $('#form_pindah_prodi')[0];
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
                        swal.fire({
                            icon: 'success',
                            title: 'Data berhasil di update !',
                            timer: 1500,
                        });
                        $('#tabel').DataTable().ajax.reload();
                        $("#overlay").fadeOut();
                        $('#form_pindah_prodi')[0].reset();
                    }
                })


            // }
        })
        $("body").on('click','.btn_pindah_jalur_seleksi',function(){
                $("#pindah_jalur_seleksi_modal .close").click();
                $("#overlay").fadeIn();
                var url_save = '{{url('pindah-jalur_seleksi-store')}}';

                var form = $('#form_pindah_jalur_seleksi')[0];
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
                        swal.fire({
                            icon: 'success',
                            title: 'Data berhasil di update !',
                            timer: 1500,
                        });
                        $('#tabel').DataTable().ajax.reload();
                        $("#overlay").fadeOut();
                        $('#form_pindah_jalur_seleksi')[0].reset();
                    }
                })


            // }
        })

    });
</script>
