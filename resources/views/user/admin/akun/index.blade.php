@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">
                <div class="row g-3">
                    <div class="col-xxl-3 col-lg-4 col-md-4">
                        <div class="list-group list-group-custom sticky-top me-xl-4" style="top: 100px;">
                            <a class="list-group-item list-group-item-action" href="#list-item-1">Profile Details</a>
                            <a class="list-group-item list-group-item-action" href="#list-item-2">Change Password</a>
                        </div>
                    </div>
                    <div class="col-xxl-8 col-lg-8 col-md-8">
                        <div id="list-item-1" class="card fieldset border border-muted mt-0">

                            <span class="fieldset-tile text-muted bg-body">Profile Details:</span>
                            <div class="card">
                                <form action="{{url('account-update')}}" method="POST" enctype="multipart/form-data">
                                    <div class="card-body">
                                        @csrf
                                        <div class="row mb-3">
                                            <label class="col-md-3 col-sm-4 col-form-label">Foto Profil</label>
                                            <div class="col-md-9 col-sm-8">
                                                <div class="image-input avatar xxl rounded-4" style="background-image: url('{{ asset('image/user/'.auth()->user()->profile_image)}}')">
                                                    <div class="avatar-wrapper rounded-4" style="background-image: url('{{ asset('image/user/'.auth()->user()->profile_image)}}')"></div>
                                                    <div class="file-input">
                                                        <input type="file" class="form-control" name="image" id="file-input">
                                                        <label for="file-input" class="fa fa-pencil shadow text-muted"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-3 col-sm-4 col-form-label">Nama Lengkap</label>
                                            <div class="col-md-9 col-sm-6">
                                                <input type="text" name="name" class="form-control form-control-lg" value="{{$registration->name}}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-3 col-sm-4 col-form-label">No ID</label>
                                            <div class="col-md-9 col-sm-8">
                                                <input type="text" class="form-control" id="id_no" name="id_no" required value="{{$registration->id_no}}" placeholder="Masukan nomor ID (NIP/NIK)">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-3 col-sm-4 col-form-label">No. Telpon</label>
                                            <div class="col-md-9 col-sm-8">
                                                <input type="text" name="phone" class="form-control form-control-lg" value="{{$registration->phone}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">
                                        <button class="btn btn-lg btn-light me-2" type="reset">Discard</button>
                                        <button class="btn btn-lg btn-primary" type="submit">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="list-item-2" class="card fieldset border border-muted mt-5">
                            <form action="{{url('change-password')}}" method="POST" id="form_change_pass">
                                @csrf
                                <span class="fieldset-tile text-muted bg-body">Change Password</span>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" name="email" value="{{auth()->user()->email}}" placeholder="Email" disabled>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <h6 class="border-top pt-2 mt-2 mb-3">Change Password</h6>
                                                <div class="mb-3">
                                                    <input type="password" id="pass1" class="form-control form-control-lg" placeholder="Current Password">
                                                </div>
                                                <div class="mb-1">
                                                    <input type="password" id="pass2" name="pass2" class="form-control form-control-lg" placeholder="New Password">
                                                </div>
                                                <div>
                                                    <input type="password" id="pass3" name="pass3" class="form-control form-control-lg" placeholder="Confirm New Password">
                                                    {{-- <span class="text-muted small">Minimum 8 characters</span> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">
                                        <button class="btn btn-lg btn-light me-2" type="reset">Discard</button>
                                        <button class="btn btn-lg btn-primary" id="change_pass_btn" type="button">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(session('msg'))
    <script>
        $(document).ready(function(){
            swal.fire({
                icon : 'success',
                title : 'Update berhasil',
            })
        })
    </script>
@endif
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#school_select').select2({
            placeholder: "Masukkan NPSN / Nama Sekolah",
            minimumInputLength: 2,
            ajax: {
                type : 'POST',
                url: '{{url('get-school')}}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
        $("#change_pass_btn").click(function(){
            var pass = $("#pass1").val();
            var pass2 = $("#pass2").val();
            var pass3 = $("#pass3").val();
            $.ajax({
                type:'POST',
                url: 'check-pass',
                data: {
                    pass: pass,
                },
                success:function(response){
                    if(response.msg == false){
                        swal.fire({
                            icon: 'error',
                            title: 'Password yang anda masukkan salah!',
                            text : 'Current Password Salah',
                        });
                        $("#pass1").focus();
                    }else{
                        if(pass2 === pass3){
                            swal.fire({
                                icon: 'success',
                                title: 'Ganti Password berhasil',
                            });
                            $("#form_change_pass").submit();
                        }else{
                            swal.fire({
                                icon: 'error',
                                title: 'Password yang anda masukkan tidak cocok!',
                            });
                            $("#pass3").focus();
                        }
                    }
                }
            })
        })

    })
</script>
@endsection
