
{{-- JS --}}
<script>
    function formatRupiah(number) {
        var rupiah = "Rp" + number.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
        return rupiah;
    }
    $(document).ready(function(){
        $(document).ajaxError(function() {
            swal.fire({
                icon : 'error',
                html : '<h3>Ada Kesalahan sistem</h3><br><b>silahkan coba lagi </b><br><p>Jika pesan ini masih muncul , silahkan reload halaman!</p>',
                timer: 1500,
            })
            $('#overlay').hide();
        });
        var opened_tabs = window.location.hash.substring(1);
        if(opened_tabs.includes('nav')){
            $('.nav-item a').removeClass('active');
            $('.tab-content a').removeClass('show');
            $('.tab-content a').removeClass('active');
            $('a[href="#'+opened_tabs+'"]').addClass('active');
            $("#"+opened_tabs).addClass('active');
            $("#"+opened_tabs).addClass('show');
        }else{
            $('a[href="#nav_week1"]').addClass('active');
            $("#nav_week1").addClass('active');
            $("#nav_week1").addClass('show');
        }
        var table = $('#tabel_peminat').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: "{{ url('get-calon_mahasiswa_baru') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'jalur_seleksi', name: 'jalur_seleksi'},
                {data: 'periode', name: 'periode'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        var table_pedaftar = $('#tabel_pendaftar').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: "{{ url('get-calon_mahasiswa_baru_pendaftar') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'jalur_seleksi', name: 'jalur_seleksi'},
                {data: 'periode', name: 'periode'},
                {data: 'status_du', name: 'status_du'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        var table_tes = $('#tabel_tes').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: "{{ url('get-calon_mahasiswa_baru_tes') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'jalur_seleksi', name: 'jalur_seleksi'},
                {data: 'periode', name: 'periode'},
                {data: 'status', name: 'status'},
                {data: 'status_du', name: 'status_du'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        var table_diterima = $('#tabel_harus_daftar_ulang').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: "{{ url('get-calon_mahasiswa_baru_diterima') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'jalur_seleksi', name: 'jalur_seleksi'},
                {data: 'periode', name: 'periode'},
                {data: 'status', name: 'status'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        var table_diterima2 = $('#tabel_diterima').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: "{{ url('get-mahasiswa') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nim', name: 'nim'},
                {data: 'name', name: 'name'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        var tabel_data_daftar_ulang = $('#tabel_daftar_ulang').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: "{{ url('get-daftar-ulang-calon-mhs/0/0') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'biaya', name: 'biaya'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        var tabel_data_daftar_ulang2 = $('#tabel_daftar_ulang2').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: "{{ url('get-daftar-ulang-calon-mhs/0/0') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'biaya', name: 'biaya'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        var tabel_data_daftar_ulang3 = $('#tabel_daftar_ulang3').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: "{{ url('get-daftar-ulang-calon-mhs/0/0') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'biaya', name: 'biaya'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        $("body").on('click','.img_bukti_transfer',function(){
            var img = $(this).data('img');
            var name = $(this).data('name');
            var waktu = $(this).data('waktu');
            var nama_rekening = $(this).data('nama_rekening');
            var no_rekening = $(this).data('no_rekening');

            $("#nama_rekening_bukti_transfer").val(nama_rekening);
            $("#no_rekening_bukti_transfer").val(no_rekening);
            $("#name_bukti_transfer").val(name);
            $("#waktu_bukti_transfer").val(waktu);
            $("#bukti_transfer_img").attr('src','http://pmb.sugenghartono.ac.id/file/payment/pendaftaran/'+img)
            var url_download = "{{url('download-bukti-transfer1/{file_name}')}}";
            url_download = url_download.replace('{file_name}',img);
            $("#btn_download_bukti1").attr('href',url_download)
        })
        $("body").on('click','.img_bukti_daftar_ulang',function(){
            var img = $(this).data('img');
            var name = $(this).data('name');
            var waktu = $(this).data('waktu');
            var nama_rekening = $(this).data('nama_rekening');
            var no_rekening = $(this).data('no_rekening');

            $("#nama_rekening_bukti_daftar_ulang").val(nama_rekening);
            $("#no_rekening_bukti_daftar_ulang").val(no_rekening);
            $("#name_bukti_daftar_ulang").val(name);
            $("#waktu_bukti_daftar_ulang").val(waktu);
            $("#bukti_daftar_ulang_img").attr('src','http://pmb.sugenghartono.ac.id/file/payment/daftar_ulang/'+img)

            var url_download = "{{url('download-bukti-transfer2/{file_name}')}}";
            url_download = url_download.replace('{file_name}',img);
            $("#btn_download_bukti2").attr('href',url_download)
        })
        $("body").on('click','.check_tes',function(){
            var id = $(this).val();
            var name = $(this).data('name');
            var waktu = $(this).data('waktu');
            var id_mahasiswa = $(this).data('id');
            $("#id_calon_mhs1").val(id_mahasiswa);

            $("#name_check").val(name);
            $("#waktu_check").val(waktu);
            var url_detail = "{{ url('get-hasil-ujian/:id') }}";
            url_detail = url_detail.replace(':id', id);
            $.ajax({
                type:'GET',
                url: url_detail,
                success:function(response){
                    $("#jml_benar").html('Jumlah jawaban benar '+response.data['jawaban_benar']+' dari '+response.data['total_soal']+' soal');
                    $("#nilai_tes").html('Nilai : '+response.nilai)
                }
            })
            url_details = 'detail-calon_mahasiswa_baru/'+id_mahasiswa;
            $("#id_tes_registration").val(id);
            $.ajax({
                type : 'GET',
                url : url_details,
                success:function(response){
                    $("#prodi_diterima_tes").empty();
                    $("#id_tes_registration").val(response.data['id']);
                    $("#pilihan_prodi_1_tes").val(response.data['prodi1']);
                    $("#pilihan_prodi_2_tes").val(response.data['prodi2']);
                    $("#prodi_diterima_tes").append('<option disabled selected>Pilih Prodi Diterima</option>');
                    $("#prodi_diterima_tes").append('<option value="'+response.data['id_prodi1']+'">'+response.data['prodi1']+'</option>');
                    if(response.data['id_prodi2'] == '1'){
                        $("#prodi_diterima_tes").append('<option value="'+response.data['id_prodi2']+'" disabled>'+response.data['prodi2']+'</option>');
                    }else{
                        $("#prodi_diterima_tes").append('<option value="'+response.data['id_prodi2']+'">'+response.data['prodi2']+'</option>');
                    }

                }
            })
        })
        $("body").on('click','.check_tes2',function(){
            var id = $(this).val();
            var name = $(this).data('name');

            $("#name_check2").val(name);
            var id_mahasiswa = $(this).data('id');
            $("#id_calon_mhs2").val(id_mahasiswa);
            url_details = 'detail-calon_mahasiswa_baru/'+id_mahasiswa;
            $("#id_tes_registration").val(id);
            $.ajax({
                type : 'GET',
                url : url_details,
                success:function(response){
                    $("#prodi_diterima_tes2").empty();
                    $("#id_tes_registration2").val(response.data['id']);
                    $("#pilihan_prodi_1_tes").val(response.data['prodi1']);
                    $("#pilihan_prodi_2_tes").val(response.data['prodi2']);
                    $("#prodi_diterima_tes2").append('<option disabled selected>Pilih Prodi Diterima</option>');
                    $("#prodi_diterima_tes2").append('<option value="'+response.data['id_prodi1']+'">'+response.data['prodi1']+'</option>');
                    if(response.data['id_prodi2'] == '1'){
                        $("#prodi_diterima_tes2").append('<option value="'+response.data['id_prodi2']+'" disabled>'+response.data['prodi2']+'</option>');
                    }else{
                        $("#prodi_diterima_tes2").append('<option value="'+response.data['id_prodi2']+'">'+response.data['prodi2']+'</option>');
                    }

                }
            })
        })
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
                $("#overlay").fadeIn();
                $.ajax({
                    type : 'POST',
                    url : url_save,
                    data : {
                        _token: '{{ csrf_token() }}',
                        name : $("#name").val(),
                    },
                    success:function(response){
                        $("#name").val('');
                        swal.fire({
                            icon: 'success',
                            title: 'Data calon_mahasiswa_baru berhasil ditambahkan !'
                        });
                        $('#tabel_peminat').DataTable().ajax.reload();
                        $('#tabel_pendaftar').DataTable().ajax.reload();
                        $('#tabel_tes').DataTable().ajax.reload();
                        $('#tabel_diterima').DataTable().ajax.reload();
                        $('#tabel_diterima2').DataTable().ajax.reload();
                        $("#overlay").fadeOut();
                    }
                })

            }
        })
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
        $("body").on('click','.acc_pendaftaran',function(){
            var id = $(this).val();
            $("#id_calon_mhs3").val(id);
            url_detail = 'detail-calon_mahasiswa_baru/'+id;
            $("#id_edit").val(id);
            $.ajax({
                type : 'GET',
                url : url_detail,
                success:function(response){
                    $("#prodi_diterima_acc").empty();
                    $("#name_edit").val(response.data['name']);
                    $("#id_acc_registration").val(response.data['id']);
                    $("#pilihan_prodi_1_acc").val(response.data['prodi1']);
                    $("#pilihan_prodi_2_acc").val(response.data['prodi2']);
                    $("#prodi_diterima_acc").append('<option disabled selected>Pilih Prodi Diterima</option>');
                    $("#prodi_diterima_acc").append('<option value="'+response.data['id_prodi1']+'">'+response.data['prodi1']+'</option>');
                    $("#prodi_diterima_acc").append('<option value="'+response.data['id_prodi2']+'">'+response.data['prodi2']+'</option>');
                }
            })
        });
        $("body").on('change','#acc_status',function(){
            var status = $(this).val();
            if(status == "diterima"){
                $("#prodi_diterima_acc").prop('disabled',false);
            }else{
                $("#prodi_diterima_acc").prop('disabled',true);
                $("#tabel_daftar_ulang_price3").css('display','none');
            }

        })
        $("body").on('change','#tes_status',function(){
            var status = $(this).val();
            if(status == "diterima"){
                $("#prodi_diterima_tes").prop('disabled',false);
            }else{
                $("#prodi_diterima_tes").prop('disabled',true);
                $("#tabel_daftar_ulang_price").css('display','none');
            }

        })
        $("#prodi_diterima_tes").change(function(){
            $("#tabel_daftar_ulang_price").css('display','block');
            var id = $("#id_calon_mhs1").val();
            var id_prodi = $(this).val();
            var url_data_daftar_ulang = "{{url('get-daftar-ulang-calon-mhs/{id}/{id_prodi}')}}";
            url_data_daftar_ulang = url_data_daftar_ulang.replace('{id}',id);
            url_data_daftar_ulang = url_data_daftar_ulang.replace('{id_prodi}',id_prodi);
            tabel_data_daftar_ulang.ajax.url(url_data_daftar_ulang).load();

        })
        $("#prodi_diterima_acc").change(function(){
            $("#tabel_daftar_ulang_price3").css('display','block');
            var id = $("#id_calon_mhs3").val();
            var id_prodi = $(this).val();
            var url_data_daftar_ulang = "{{url('get-daftar-ulang-calon-mhs/{id}/{id_prodi}')}}";
            url_data_daftar_ulang = url_data_daftar_ulang.replace('{id}',id);
            url_data_daftar_ulang = url_data_daftar_ulang.replace('{id_prodi}',id_prodi);
            tabel_data_daftar_ulang3.ajax.url(url_data_daftar_ulang).load();

        })
        $("#prodi_diterima_tes2").change(function(){
            $("#tabel_daftar_ulang_price2").css('display','block');
            var id = $("#id_calon_mhs2").val();
            var id_prodi = $(this).val();
            var url_data_daftar_ulang = "{{url('get-daftar-ulang-calon-mhs/{id}/{id_prodi}')}}";
            url_data_daftar_ulang = url_data_daftar_ulang.replace('{id}',id);
            url_data_daftar_ulang = url_data_daftar_ulang.replace('{id_prodi}',id_prodi);
            tabel_data_daftar_ulang2.ajax.url(url_data_daftar_ulang).load();

        })
        $("#jml_beasiswa").change(function(){
            $(".input_beasiswa").val($(this).val());
        })
        $("#jml_beasiswa1").change(function(){
            $(".input_beasiswa").val($(this).val());
        })
        $("#jml_beasiswa12").change(function(){
            $(".input_beasiswa").val($(this).val());
        })
        $("body").on('change','#tes_status2',function(){
            var status = $(this).val();
            if(status == "diterima"){
                $("#prodi_diterima_tes2").prop('disabled',false);
            }else{
                $("#prodi_diterima_tes2").prop('disabled',true);
                $("#tabel_daftar_ulang_price2").css('display','none');
            }

        })
        $("body").on('click','.update',function(){
            // alert('tes');
            var id = $("#id_edit").val();
            url_update = url_update.replace(':id', id);
            $("#overlay").fadeIn();
            $.ajax({
                type : 'PUT',
                url : url_update,
                data : {
                    _token: '{{ csrf_token() }}',
                    name : $("#name_edit").val(),
                },
                success:function(response){
                    $("#name_edit").val('');
                    // get_calon_mahasiswa_baru();
                    swal.fire({
                        icon: 'success',
                        title: 'Data calon_mahasiswa_baru berhasil diupdate !'
                    });
                        $('#tabel_peminat').DataTable().ajax.reload();
                        $('#tabel_pendaftar').DataTable().ajax.reload();
                        $('#tabel_tes').DataTable().ajax.reload();
                        $('#tabel_diterima').DataTable().ajax.reload();
                        $('#tabel_diterima2').DataTable().ajax.reload();
                        $("#overlay").fadeOut();

                }
            })
        })
        $("body").on('click','.btn_acc',function(){
            var status = $("#acc_status").val();
            if(status == null){
                swal.fire({
                    icon : 'error',
                    title : 'Ada data yang masih kosong!',
                    text: 'mohon isi semua data',
                });
            }else {
                if(status == "diterima"){
                    var prodi_diterima = $("#prodi_diterima_acc").val();
                    if(prodi_diterima == null){
                        swal.fire({
                            icon : 'error',
                            title : 'Ada data yang masih kosong!',
                            text: 'Data Prodi diterima belum dipilih',
                        });
                    }else {
                        var url_acc = '{{url('acc-pendaftaran')}}';

                        var form = $('#form_acc_pendaftaran')[0];
                        var data = new FormData(form);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $("#overlay").fadeIn();
                        $.ajax({
                            type : 'POST',
                            url : url_acc,
                            enctype: 'multipart/form-data',
                            processData: false,
                            data: data,
                            contentType: false,
                            cache: false,
                            success:function(response){
                                $('#acc_status option[value=""]').attr('selected','selected');
                                $("#prodi_diterima_acc").prop('disabled',true);
                                swal.fire({
                                    icon: 'success',
                                    title: 'Konfirmasi Pendaftaran berhasil dilakukan !'
                                });
                                $('#tabel_peminat').DataTable().ajax.reload();
                                $('#tabel_pendaftar').DataTable().ajax.reload();
                                $('#tabel_tes').DataTable().ajax.reload();
                                $('#tabel_diterima').DataTable().ajax.reload();
                                $('#tabel_diterima2').DataTable().ajax.reload();
                                $("#overlay").fadeOut();
                            }
                        })
                    }
                }else{
                    var url_acc = '{{url('acc-pendaftaran')}}';

                        var form = $('#form_acc_pendaftaran')[0];
                        var data = new FormData(form);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $("#overlay").fadeIn();
                        $.ajax({
                            type : 'POST',
                            url : url_acc,
                            enctype: 'multipart/form-data',
                            processData: false,
                            data: data,
                            contentType: false,
                            cache: false,
                            success:function(response){
                                $('#acc_status option[value=""]').attr('selected','selected');
                                $("#prodi_diterima_acc").prop('disabled',true);
                                swal.fire({
                                    icon: 'success',
                                    title: 'Konfirmasi Pendaftaran berhasil dilakukan !'
                                });
                                $('#tabel_peminat').DataTable().ajax.reload();
                                $('#tabel_pendaftar').DataTable().ajax.reload();
                                $('#tabel_tes').DataTable().ajax.reload();
                                $('#tabel_diterima').DataTable().ajax.reload();
                                $('#tabel_diterima2').DataTable().ajax.reload();
                                $("#overlay").fadeOut();
                            }
                        })
                }

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
                    var id = $(this).val();
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
                            // get_calon_mahasiswa_baru();
                            $('#tabel_peminat').DataTable().ajax.reload();
                            $('#tabel_pendaftar').DataTable().ajax.reload();
                            $('#tabel_tes').DataTable().ajax.reload();
                            $('#tabel_diterima').DataTable().ajax.reload();

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
        $("body").on('click','.btn_acc_tes',function(){
            var status = $("#tes_status").val();
            if(status == null){
                swal.fire({
                    icon : 'error',
                    title : 'Ada data yang masih kosong!',
                    text: 'mohon isi semua data',
                });
            }else {
                if(status == "diterima"){
                    var prodi_diterima = $("#prodi_diterima_tes").val();
                    if(prodi_diterima == null){
                        swal.fire({
                            icon : 'error',
                            title : 'Ada data yang masih kosong!',
                            text: 'Data Prodi diterima belum dipilih',
                        });
                    }else {
                        var url_acc = '{{url('acc-pendaftaran')}}';

                        var form = $('#form_acc_tes')[0];
                        var data = new FormData(form);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $("#overlay").fadeIn();
                        $.ajax({
                            type : 'POST',
                            url : url_acc,
                            enctype: 'multipart/form-data',
                            processData: false,
                            data: data,
                            contentType: false,
                            cache: false,
                            success:function(response){
                                $('#tes_status option[value=""]').attr('selected','selected');
                                $("#prodi_diterima_tes").prop('disabled',true);
                                swal.fire({
                                    icon: 'success',
                                    title: 'Konfirmasi Tes berhasil dilakukan !'
                                });

                                $('#tabel_peminat').DataTable().ajax.reload();
                                $('#tabel_pendaftar').DataTable().ajax.reload();
                                $('#tabel_tes').DataTable().ajax.reload();
                                $('#tabel_diterima').DataTable().ajax.reload();
                                $('#tabel_diterima2').DataTable().ajax.reload();
                                $("#overlay").fadeOut();
                            }
                        })
                    }
                }else{
                    var url_acc = '{{url('acc-pendaftaran')}}';

                        var form = $('#form_acc_tes')[0];
                        var data = new FormData(form);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type : 'POST',
                            url : url_acc,
                            enctype: 'multipart/form-data',
                            processData: false,
                            data: data,
                            contentType: false,
                            cache: false,
                            success:function(response){
                                $('#acc_status option[value=""]').attr('selected','selected');
                                $("#prodi_diterima_tes").prop('disabled',true);
                                swal.fire({
                                    icon: 'success',
                                    title: 'Konfirmasi Tes berhasil dilakukan !'
                                });
                                $('#tabel_peminat').DataTable().ajax.reload();
                                $('#tabel_pendaftar').DataTable().ajax.reload();
                                $('#tabel_tes').DataTable().ajax.reload();
                                $('#tabel_diterima').DataTable().ajax.reload();
                            }
                        })
                }

            }
        })
        $("body").on('click','.btn_acc_tes2',function(){
            var status = $("#tes_status2").val();
            if(status == null){
                swal.fire({
                    icon : 'error',
                    title : 'Ada data yang masih kosong!',
                    text: 'mohon isi semua data',
                });
            }else {
                if(status == "diterima"){
                    var prodi_diterima = $("#prodi_diterima_tes2").val();
                    if(prodi_diterima == null){
                        swal.fire({
                            icon : 'error',
                            title : 'Ada data yang masih kosong!',
                            text: 'Data Prodi diterima belum dipilih',
                        });
                    }else {
                        var url_acc = '{{url('acc-pendaftaran')}}';

                        var form = $('#form_acc_tes2')[0];
                        var data = new FormData(form);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $("#overlay").fadeIn();
                        $.ajax({
                            type : 'POST',
                            url : url_acc,
                            enctype: 'multipart/form-data',
                            processData: false,
                            data: data,
                            contentType: false,
                            cache: false,
                            success:function(response){
                                $('#tes_status option[value=""]').attr('selected','selected');
                                $("#prodi_diterima_tes2").prop('disabled',true);
                                swal.fire({
                                    icon: 'success',
                                    title: 'Konfirmasi Tes berhasil dilakukan !'
                                });

                                $('#tabel_peminat').DataTable().ajax.reload();
                                $('#tabel_pendaftar').DataTable().ajax.reload();
                                $('#tabel_tes').DataTable().ajax.reload();
                                $('#tabel_diterima').DataTable().ajax.reload();
                                $('#tabel_diterima2').DataTable().ajax.reload();
                                $("#overlay").fadeOut();
                            }
                        })
                    }
                }else{
                    var url_acc = '{{url('acc-pendaftaran')}}';

                        var form = $('#form_acc_tes2')[0];
                        var data = new FormData(form);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type : 'POST',
                            url : url_acc,
                            enctype: 'multipart/form-data',
                            processData: false,
                            data: data,
                            contentType: false,
                            cache: false,
                            success:function(response){
                                $('#acc_status option[value=""]').attr('selected','selected');
                                $("#prodi_diterima_tes2").prop('disabled',true);
                                swal.fire({
                                    icon: 'success',
                                    title: 'Konfirmasi Tes berhasil dilakukan !'
                                });
                                $('#tabel_peminat').DataTable().ajax.reload();
                                $('#tabel_pendaftar').DataTable().ajax.reload();
                                $('#tabel_tes').DataTable().ajax.reload();
                                $('#tabel_diterima').DataTable().ajax.reload();
                            }
                        })
                }

            }
        })
        $("body").on('click','.acc_daftar_ulang',function(){
            swal.fire({
                icon:'question',
                title:'Apakah anda yakin untuk konfirmasi daftar ulang?',
                showDenyButton: true,
                confirmButtonText: 'Iya',
                denyButtonText: 'Batal',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var id = $(this).val();
                    $("#overlay").fadeIn();
                    $.ajax({
                        type : 'POST',
                        url : 'acc-daftar-ulang',
                        data : {
                            _token : '{{csrf_token()}}',
                            id : id,
                        },
                        success:function(response){
                            swal.fire({
                                icon: 'success',
                                title : 'Konfirmasi Daftar Ulang Berhasil',
                            });
                            // get_calon_mahasiswa_baru();
                            $('#tabel_peminat').DataTable().ajax.reload();
                            $('#tabel_pendaftar').DataTable().ajax.reload();
                            $('#tabel_tes').DataTable().ajax.reload();
                            $('#tabel_diterima').DataTable().ajax.reload();
                            $('#tabel_diterima2').DataTable().ajax.reload();
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
        })
        $("body").on('change','#is_beasiswa',function(){
            var val = $(this).val();
            if(val == "Y"){
                $("#jml_beasiswa").prop('disabled',false)
                $(".input_beasiswa").prop('disabled',false)
            }else{
                $("#jml_beasiswa").val(0)
                $("#jml_beasiswa").prop('disabled',true)
                $(".input_beasiswa").val(0)
                $(".input_beasiswa").prop('disabled',true)
            }
        })
        $("body").on('change','#is_beasiswa1',function(){
            var val = $(this).val();
            if(val == "Y"){
                $("#jml_beasiswa1").prop('disabled',false)
                $(".input_beasiswa").prop('disabled',false)
            }else{
                $("#jml_beasiswa1").val(0)
                $("#jml_beasiswa1").prop('disabled',true)
                $(".input_beasiswa").val(0)
                $(".input_beasiswa").prop('disabled',true)
            }
        })
        $("body").on('change','#is_beasiswa12',function(){
            var val = $(this).val();
            if(val == "Y"){
                $("#jml_beasiswa12").prop('disabled',false)
                $(".input_beasiswa").prop('disabled',false)
            }else{
                $("#jml_beasiswa12").val(0)
                $("#jml_beasiswa12").prop('disabled',true)
                $(".input_beasiswa").val(0)
                $(".input_beasiswa").prop('disabled',true)
            }
        })
        $("body").on('click','.detail',function(){
            var id = $(this).val();
            var url_detail = "{{ url('detail_mhs/:id') }}";
            url_detail = url_detail.replace(':id', id);
            $.ajax({
                type : 'GET',
                url : url_detail,
                success:function(response){
                    $("#img_mahasiswa").attr('src','image/user/'+response.img);
                    $("#nim").html(response.data['nim']);
                    $("#name").html(response.data['name']);
                    $("#gender").html(response.data['gender']);
                    $("#ttl_mhs").html(response.data['place_birth']+', '+response.data['date_birth']);
                    $("#address").html(response.data['address']);
                    $("#prodi").html(response.prodi);
                    $("#sistem_kuliah").html(response.sistem_kuliah);
                    $("#status_perkawinan").html(response.data['status_perkawinan']);
                    $("#agama").html(response.data['agama']);
                    $("#nisn").html(response.data['nisn']);
                    $("#email").html(response.data['email']);
                    $("#phone").html(response.data['phone']);
                    $("#no_hp_ortu").html(response.data['no_hp_ortu']);
                    $("#nama_ayah").html(response.data['nama_ayah']);
                    $("#nama_ibu").html(response.data['nama_ibu']);
                    $("#pekerjaan_ayah").html(response.data['pekerjaan_ayah']);
                    $("#pekerjaan_ibu").html(response.data['pekerjaan_ibu']);
                    $("#nama_wali").html(response.data['nama_wali']);
                    $("#alamat_ortu").html(response.data['alamat_ortu']);
                }
            })
        });

        $(".download_btn").click(function(){
            $(".download_btn") .fadeOut();
            $(".centers").fadeIn();
            setTimeout(() => {
                $(".download_btn").fadeIn();
                $(".centers").fadeOut();
            }, 3000);
        })
        $('body').on('click','.add_berkas', function(){
            $("#loading_screen").fadeIn();
            $("#upload_form_berkas").fadeOut();
            var id = $(this).val();
            $("#id_mahasiswa_berkas").val(id);
            var url_detail = 'detail-calon_mahasiswa_baru/'+id;
            $.ajax({
                type : 'GET',
                url : url_detail,
                success:function(response){
                    $("#loading_screen").fadeOut();
                    $("#upload_form_berkas").fadeIn();
                    $.each(response.filename, function(key,item){
                        if(item.status == "Y"){

                            var file_name = "{{ url('file/registration/:file') }}";
                            file_name = file_name.replace(':file',item.name);
                            $('#berkas_'+item.id_berkas).attr('data-default-file',file_name);

                            var drEvent = $('#berkas_'+item.id_berkas).dropify(
                            {
                                defaultFile: file_name
                            });
                            drEvent = drEvent.data('dropify');
                            drEvent.resetPreview();
                            drEvent.clearElement();
                            drEvent.settings.defaultFile = file_name;
                            drEvent.destroy();
                            drEvent.init();
                        }else{
                            $('#berkas_'+item.id_berkas).attr('data-default-file','File tidak ditemukan');
                            var drEvent = $('#berkas_'+item.id_berkas).dropify({
                                defaultFile: 'file tidak ditemukan'
                            });
                            drEvent = drEvent.data('dropify');
                            drEvent.resetPreview();
                            drEvent.clearElement();
                            drEvent.settings.defaultFile = 'file tidak ditemukan';
                            drEvent.destroy();
                            drEvent.init();
                        }
                    })
                }

            })
        })
        $('#form_upload_berkas_mahasiswa').parsley();
        $("body").on('click','.btn_berkas',function(){
            // alert('tes');
            var id = $("#id_mahasiswa_berkas").val();
            var url_update = "{{ url('update-berkas-mahasiswa') }}";
            var form = $('#form_upload_berkas_mahasiswa')[0];
            var data = new FormData(form);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if($('#form_upload_berkas_mahasiswa').parsley().isValid()){
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
                            title: 'Berkas Mahasiswa berhasil diupdate !'
                        });
                        // $('#tabel').DataTable().ajax.reload();
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
        $('body').on('click','.du_modal', function(){
            var id = $(this).val();
            $("#cancel_du").val(id);
            $("#id_reg_du_modal").val(id);
            var url = "{{url('get-detail-du-calon-mhs/{id}')}}";
            url = url.replace('{id}',id);
            $.ajax({
                type:'GET',
                url : url,
                success:function(res){
                    $("#name_du_modal").val(res.registration.name);
                    if(res.tagihan.status == "W"){
                        $("#status_du_modal").html('<button class="btn btn-sm btn-warning text-white"><i class="fa fa-clock-o"></i> Menunggu Persetujuan Owner</button>');
                    }else if(res.tagihan.status == "A"){
                        $("#status_du_modal").html('<button class="btn btn-sm btn-success"><i class="fa fa-check-circle"></i> Sudah di Setujui Owner</button>');
                    }else if(res.tagihan.status == "D"){
                        $("#status_du_modal").html('<button class="btn btn-sm btn-danger"><i class="fa fa-times-circle"></i> Ditolak Owner</button>');
                    }
                    $("#tbl_biaya_du tbody").empty();
                    $("#tbl_biaya_du tfoot").empty();
                    var nomer = 1;
                    var total = 0;
                    $.each(res.tagihan_detail, function(key,item){
                        $("#tbl_biaya_du tbody").append('<tr>\
                                                <td>'+nomer+'</td>\
                                                <td>'+item.nama_tagihan+'</td>\
                                                <td>'+item.beasiswa+'%</td>\
                                                <td>'+formatRupiah(item.nominal)+'</td>\
                                            </tr>');
                            total = total + item.nominal;
                            nomer++
                    })
                    $("#tbl_biaya_du tfoot").append('<tr><td colspan=3></td><td>'+formatRupiah(total)+'</td><tr>');
                    $("#remark_owner_du_modal").html(res.tagihan.remark_owner);
                }
            })
        })
        $('body').on('click','#cancel_du', function(){
            var id = $(this).val();
            var url = "{{url('cancel-du-calon-mhs')}}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#overlay").fadeIn();
            $.ajax({
                type : 'POST',
                url : url,
                enctype: 'multipart/form-data',
                data: {
                    _token : '{{csrf_token()}}',
                    id : id,
                },
                success:function(response){
                    swal.fire({
                        icon: 'success',
                        title: 'Dokumen Daftar Ulang Mahasiswa dibatalkan!'
                    });
                    $("#overlay").fadeOut();
                    $('#tabel_peminat').DataTable().ajax.reload();
                    $('#tabel_pendaftar').DataTable().ajax.reload();
                    $('#tabel_tes').DataTable().ajax.reload();
                    $('#tabel_diterima').DataTable().ajax.reload();
                    $('#tabel_diterima2').DataTable().ajax.reload();
                }
            })


        })
        $('body').on('click','.send_mhs_du_modal', function(){
            var url = "{{url('acc-pendaftaran')}}";
            var id = $("#id_reg_du_modal").val();
            var status = 'diterima_final';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#overlay").fadeIn();
            $.ajax({
                type : 'POST',
                url : url,
                enctype: 'multipart/form-data',
                data: {
                    _token : '{{csrf_token()}}',
                    id : id,
                    status : status,
                },
                success:function(response){
                    swal.fire({
                        icon: 'success',
                        title: 'Konfirmasi Pendaftaran berhasil dilakukan !'
                    });
                    $("#overlay").fadeOut();
                    $('#tabel_peminat').DataTable().ajax.reload();
                    $('#tabel_pendaftar').DataTable().ajax.reload();
                    $('#tabel_tes').DataTable().ajax.reload();
                    $('#tabel_diterima').DataTable().ajax.reload();
                    $('#tabel_diterima2').DataTable().ajax.reload();
                }
            })
        })

        // new script
        $('body').on('click','.hapus_peminat', function(){
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
                    var url_delete = "{{ url('hapus-pendaftar/:id') }}";
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
                            // get_lecture();
                            $('#tabel_peminat').DataTable().ajax.reload();
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
        })
        $('body').on('click','.hapus_pendaftar', function(){
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
                    var url_delete = "{{ url('hapus-pendaftar2/:id') }}";
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
                            // get_lecture();
                            $('#tabel_peminat').DataTable().ajax.reload();
                            $('#tabel_pendaftar').DataTable().ajax.reload();
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
        })
        $('body').on('click','.batal_du', function(){
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
                    var url_delete = "{{ url('hapus-pendaftar3/:id') }}";
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
                            // get_lecture();d
                            $('#tabel_peminat').DataTable().ajax.reload();
                            $('#tabel_pendaftar').DataTable().ajax.reload();
                            $('#tabel_harus_daftar_ulang').DataTable().ajax.reload();
                            $('#tabel_tes').DataTable().ajax.reload();
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
        })
    });
</script>
