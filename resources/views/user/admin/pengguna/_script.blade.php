<script>
    $(document).ready(function(){
        var table = $('#tabel').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('get-pengguna') }}",
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'role', name: 'role'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        $("#role_select").select2();
        $("#role").select2({
            dropdownParent:$("#add_modal")
        });
        $("#id_prodi").select2({
            dropdownParent:$("#add_modal")
        });
        $("#id_prodi_edit").select2({
            dropdownParent:$("#edit_modal")
        });
        $("#role_edit").select2({
            dropdownParent:$("#edit_modal")
        });
        $("#role_select").change(function(){
            var id = $(this).val();
            var url_data = "{{url('get-pengguna-filter/{id}')}}";
            url_data = url_data.replace('{id}',id);

            $('#tabel').DataTable().ajax.url(url_data).load();
        })
        $('#form_add_pengguna').parsley();
        $('#form_edit_pengguna').parsley();
        $("body").on('change', '#role', function(){
            var id = $(this).val();
            if(id == 7){
                $("#prodi_select").css('display','block');
            }else{
                $("#prodi_select").css('display','none');
            }
        })
        $("body").on('change', '#role_edit', function(){
            var id = $(this).val();
            if(id == 7){
                $("#prodi_select_edit").css('display','block');
            }else{
                $("#prodi_select_edit").css('display','none');
            }
        })


        $("body").on('click','.save_data',function(){
            if($('#form_add_pengguna').parsley().isValid()){
                $("#add_modal .close").click();
                $("#overlay").fadeIn();
                var url_save = '{{url('pengguna-store')}}';

                var form = $('#form_add_pengguna')[0];
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
                            title: 'Data pengguna ditambahkan !',
                            timer: 1500,
                        });
                        $('#tabel').DataTable().ajax.reload();
                        $("#overlay").fadeOut();
                        $('#form_add_pengguna')[0].reset();
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
            var url_detail = "pengguna-detail/"+id;
            $("#id_edit").val(id);
            $.ajax({
                type : 'GET',
                url : url_detail,
                success:function(response){
                    console.log(response.data)
                    $("#name_edit").val(response.data['name']);
                    $("#email_edit").val(response.data['email']);
                    $("#phone_edit").val(response.data['phone']);
                    $("#address_edit").val(response.data['address']);
                    $("#id_no_edit").val(response.data['id_no']);
                    $("#role_edit").val(response.data['role']).trigger('change');
                }
            })
        });

        $("body").on('click','.update',function(){
            // alert('tes');
            var id = $("#id_edit").val();
            var url_update = "{{ url('pengguna-update') }}";
            var form = $('#form_edit_pengguna')[0];
            var data = new FormData(form);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
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
                        title: 'Data pengguna berhasil di update !'
                    });
                    $('#tabel').DataTable().ajax.reload();
                }
            })
        })

        $("#email").change(function(){
            var email = $(this).val();
            $.ajax({
                type: 'GET',
                url: 'check-registered-emails/'+email,
                success:function(response){
                    if(response.msg == 'error'){
                        swal.fire({
                            icon: 'error',
                            title: 'email sudah terdaftar !',
                        });
                        $(".save_data").prop('disabled',true);
                        $("#email").addClass('error_msg');
                        $("#email").focus();
                    }else{
                        $("#email").removeClass('error_msg');
                        $(".save_data").prop('disabled',false);
                    }
                }
            })
        })
        $("#email_edit").change(function(){
            var email = $(this).val();
            $.ajax({
                type: 'GET',
                url: 'check-registered-emails/'+email,
                success:function(response){
                    if(response.msg == 'error'){
                        swal.fire({
                            icon: 'error',
                            title: 'email sudah terdaftar !',
                        });
                        $(".save_data").prop('disabled',true);
                        $("#email").addClass('error_msg');
                        $("#email").focus();
                    }else{
                        $("#email").removeClass('error_msg');
                        $(".save_data").prop('disabled',false);
                    }
                }
            })
        })

        $("body").on('click','.hapus',function(){
            var id = $(this).val();

            Swal.fire({
                icon:'question',
                title: 'Apakah Anda Yakin Untuk Menghapus Data ini?',
                showDenyButton: true,
                confirmButtonText: 'Iya',
                denyButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = 'pengguna-delete/'+id;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type : 'POST',
                        url : url_save,
                        success:function(response){
                            swal.fire({
                                icon: 'success',
                                title: 'Hapus Data Berhasil!',
                                timer:1500,
                            });
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
        })
        $("body").on('click','.reset_pass',function(){
            Swal.fire({
                icon:'question',
                title: 'Apakah Anda Yakin Untuk Mereset Password Pengguna ini?',
                showDenyButton: true,
                confirmButtonText: 'Iya',
                denyButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon:'question',
                        title: 'Password akan di ubah menjadi : ',
                        text: 'Sugenghartono@user',
                        showDenyButton: true,
                        confirmButtonText: 'Lanjut',
                        denyButtonText: 'Batal',
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            var id = $(this).val();
                            var url_delete = "{{ url('reset-password-pengguna') }}";
                            url_delete = url_delete.replace(':id', id);
                            $.ajax({
                                type : 'POST',
                                url : url_delete,
                                data : {
                                    _token : '{{csrf_token()}}',
                                    id : id,
                                },
                                success:function(response){
                                    swal.fire({
                                        icon: 'success',
                                        title : 'Reset Password berhasil',
                                    });
                                    // get_slider();
                                    $('#tabel').DataTable().ajax.reload();

                                }
                            })
                        }else{
                            swal.fire({
                                icon: 'info',
                                title : 'Aksi dibatalkan',
                            });
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
