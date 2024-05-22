
{{-- JS --}}
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
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: "{{ url('get-karyawan') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nik', name: 'nik'},
                {data: 'name', name: 'name'},
                {data: 'pekerjaan', name: 'pekerjaan'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        $(".form-select-add").select2({
            dropdownParent: $('#add_modal')
        })
        $(".form-select-edit").select2({
            dropdownParent: $('#edit_modal')
        })
        $("#province_edit").select2({
            dropdownParent: $("#edit_modal")
        })
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
        $("body").on('change','#province', function(){
            var id = $(this).val();
            var url = '../get-regencies/'+id;
            $.ajax({
                type : 'GET',
                url : url,
                success:function(response){
                    $("#regency").prop('disabled',false);
                    $("#regency").empty();
                    $.each(response.data, function(key,item){
                        $("#regency").append('<option value="'+item.name+'">'+item.name+'</option>')
                    })
                }
            })
        })
        $("body").on('change','#regency', function(){
            var id = $(this).val();
            var url = '../get-districts/'+id;
            $.ajax({
                type : 'GET',
                url : url,
                success:function(response){
                    $("#district").prop('disabled',false);
                    $("#district").empty();
                    $.each(response.data, function(key,item){
                        $("#district").append('<option value="'+item.name+'">'+item.name+'</option>')
                    })
                }
            })
        })
        $("body").on('change','#district', function(){
            var id = $(this).val();
            var url = '../get-villages/'+id;
            $.ajax({
                type : 'GET',
                url : url,
                success:function(response){
                    $("#village").prop('disabled',false);
                    $("#village").empty();
                    $.each(response.data, function(key,item){
                        $("#village").append('<option value="'+item.name+'">'+item.name+'</option>')
                    })
                }
            })
        })
        $("body").on('change','#province_edit', function(){
            var id = $(this).val();
            var url = '../get-regencies/'+id;
            $.ajax({
                type : 'GET',
                url : url,
                success:function(response){
                    $("#regency_edit").prop('disabled',false);
                    $("#regency_edit").empty();
                    $.each(response.data, function(key,item){
                        $("#regency_edit").append('<option value="'+item.name+'">'+item.name+'</option>')
                    })
                }
            })
        })
        $("body").on('change','#regency_edit', function(){
            var id = $(this).val();
            var url = '../get-districts/'+id;
            $.ajax({
                type : 'GET',
                url : url,
                success:function(response){
                    $("#district_edit").prop('disabled',false);
                    $("#district_edit").empty();
                    $.each(response.data, function(key,item){
                        $("#district_edit").append('<option value="'+item.name+'">'+item.name+'</option>')
                    })
                }
            })
        })
        $("body").on('change','#district_edit', function(){
            var id = $(this).val();
            var url = '../get-villages/'+id;
            $.ajax({
                type : 'GET',
                url : url,
                success:function(response){
                    $("#village_edit").prop('disabled',false);
                    $("#village_edit").empty();
                    $.each(response.data, function(key,item){
                        $("#village_edit").append('<option value="'+item.name+'">'+item.name+'</option>')
                    })
                }
            })
        })
        $('#form_add_karyawan').parsley();
        $('#form_edit_karyawan').parsley();
        $('#form_import').parsley();
        $("body").on('click','.import_data', function(){
            if($('#form_import').parsley().isValid()){
                $("#import_modal .close").click();
                $("#overlay").fadeIn();
            }
        })
        $("body").on('click','.save_data',function(){
            if($('#form_add_karyawan').parsley().isValid()){
                $("#add_modal .close").click();
                $("#overlay").fadeIn();
                var url_save = '{{route('karyawan.store')}}';

                var form = $('#form_add_karyawan')[0];
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
                            title: 'Data karyawan berhasil ditambahkan !',
                            timer: 1500,
                        });
                        $('#tabel').DataTable().ajax.reload();
                        $("#overlay").fadeOut();
                        $('#form_add_karyawan')[0].reset();
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
        $("body").on('click','.edit',function(){
            var id = $(this).val();
            var url_detail = "{{ route('karyawan.show', ':id') }}";
            url_detail = url_detail.replace(':id', id);
            $("#id_edit").val(id);
            $.ajax({
                type : 'GET',
                url : url_detail,
                success:function(response){
                    var image_file = "{{ url('image/user/:img') }}";
                    image_file = image_file.replace(':img',response.img);
                    // console.log(image_file);
                    $("#image_edit").attr('data-default-file',image_file);
                    var drEvent = $('.dropifys').dropify(
                    {
                        defaultFile: image_file
                    });
                    drEvent = drEvent.data('dropify');
                    drEvent.resetPreview();
                    drEvent.clearElement();
                    drEvent.settings.defaultFile = image_file;
                    drEvent.destroy();
                    drEvent.init();
                    $("#nik_edit").val(response.data['nik']);
                    $("#name_edit").val(response.data['name']);
                    $('input[name=gender][value="'+response.data['gender']+'"]').prop("checked",true);
                    $("#address_edit").val(response.data['address']);
                    $('input[name=status_perkawinan][value="'+response.data['status_perkawinan']+'"]').prop("checked",true);
                    $('#agama_edit option[value="'+response.data['agama']+'"]').attr('selected','selected');
                    $("#email_edit").val(response.data['email']);
                    $("#phone_edit").val(response.data['phone']);
                    $("#date_birth_edit").val(response.data['tgl_lahir']);
                    $("#year_edit").val(response.data['tahun_masuk']);
                    $("#tempat_lahir_edit").val(response.data['tempat_lahir']);
                    $("#rt_edit").val(response.data['rt']);
                    $("#rw_edit").val(response.data['rw']);
                    $("#kode_pos_edit").val(response.data['kode_pos']);
                    $("#no_kk_edit").val(response.data['no_kk']);
                    $("#no_npwp_edit").val(response.data['no_npwp']);
                    $("#nama_npwp_edit").val(response.data['nama_npwp']);
                    $("#no_rek_edit").val(response.data['no_rek']);
                    $("#no_telp_edit").val(response.data['no_telp']);
                    $("#nama_rekening_edit").val(response.data['nama_rekening']);
                    $("#jml_anak_edit").val(response.data['jml_anak']);
                    $("#pendidikan_terakhir_edit").val(response.data['pendidikan_terakhir']);

                    $("#id_pekerjaan_karyawan_edit").val([response.data['id_pekerjaan_karyawan']]).trigger('change');
                    $("#bank_edit").val([response.data['bank']]).trigger('change');
                    $("#province_edit").val([response.data['province']]).trigger('change');

                    $("#regency_edit").append('<option value="'+response.data['regency']+'" selected>'+response.data['regency']+'</option>');
                    $("#district_edit").append('<option value="'+response.data['district']+'" selected>'+response.data['district']+'</option>');
                    $("#village_edit").append('<option value="'+response.data['village']+'" selected>'+response.data['village']+'</option>');
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
        $("body").on('click','.update_data',function(){
            // alert('tes');
            var id = $("#id_edit").val();
            var url_update = "{{ route('karyawan.update', ':id') }}";
            url_update = url_update.replace(':id', id);
            var form = $('#form_edit_karyawan')[0];
            var data = new FormData(form);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if($('#form_edit_karyawan').parsley().isValid()){
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
                            title: 'Data karyawan berhasil diupdate !'
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
                    var url_delete = "{{ route('karyawan.destroy', ':id') }}";
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
                            // get_karyawan();
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

        $("body").on('click','.detail',function(){
            var id = $(this).val();
            var url_detail = "{{ route('karyawan.show', ':id') }}";
            url_detail = url_detail.replace(':id', id);
            $.ajax({
                type : 'GET',
                url : url_detail,
                success:function(response){
                    $("#img_Karyawan").attr('src','image/user/'+response.img);
                    $("#nik_detail").html(response.data['nik']);
                    $("#name_detail").html(response.data['name']);
                    $("#pekerjaan_detail").html(response.pekerjaan)
                    $("#gender_detail").html(response.data['gender']);
                    $("#address_detail").html(response.data['address']);
                    $("#jabatan_detail").html(response.data['jabatan']);
                    $("#status_perkawinan_detail").html(response.data['status_perkawinan']);
                    $("#agama_detail").html(response.data['agama']);
                    $("#email_detail").html(response.data['email']);
                    $("#phone_detail").html(response.data['phone']);
                    $("#date_birth_detail").html(response.data['tgl_lahir']);
                    $("#tahun_masuk_detail").html(response.data['tahun_masuk']);
                    $("#tempat_lahir_detail").html(response.data['tempat_lahir']);
                    $("#rt_detail").html(response.data['rt']);
                    $("#rw_detail").html(response.data['rw']);
                    $("#province_detail").html(response.data['province']);
                    $("#regency_detail").html(response.data['regency']);
                    $("#district_detail").html(response.data['district']);
                    $("#village_detail").html(response.data['village']);
                    $("#kode_pos_detail").html(response.data['kode_pos']);
                    $("#no_npwp_detail").html(response.data['no_npwp']);
                    $("#nama_npwp_detail").html(response.data['nama_npwp']);
                    $("#nama_pasangan_detail").html(response.data['nama_pasangan']);
                    $("#nik_pasangan_detail").html(response.data['nik_pasangan']);
                    $("#pekerjaan_pasangan_detail").html(response.data['pekerjaan_pasangan']);
                    $("#no_rek_detail").html(response.data['no_rek']);
                    $("#bank_detail").html(response.data['bank']);
                    $("#no_telp_detail").html(response.data['no_telp']);
                    $("#nama_rekening_detail").html(response.data['nama_rekening']);
                    $("#jml_anak_detail").html(response.data['jml_anak']);
                    $("#pendidikan_terakhir_detail").html(response.data['pendidikan_terakhir']);
                }
            })
        });
    });

</script>
