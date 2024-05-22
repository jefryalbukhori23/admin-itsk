<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 5 admin dashboard template & web App ui kit.">

    <link rel="icon" href="{{ asset('style/assets/img/logo.png ') }}" type="image/x-icon">
    <title>ITSK Sugeng Hartono : Password Reset</title>

    <link rel="stylesheet" href="{{ asset('style/assets/css/luno-style.css') }}">

    <script src="{{ asset('style/assets/js/plugins.js') }}"></script>
</head>

<body id="layout-1" data-luno="theme-blue">

    <div class="wrapper">

        <div class="page-body auth px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center">
                        <div style="max-width: 25rem;">
                            <div class="mb-4">
                                <a href="{{url('/')}}">
                                    <img src="{{ asset('style/assets/img/logo.png ') }}" style="max-height:100px;" alt="">
                                </a>
                            </div>
                            <div class="mb-5">
                                <h2 class="color-900">ITSK Sugeng Hartono:</h2>
                            </div>

                            <ul class="list-unstyled mb-5">
                                <li class="mb-4">
                                    <span class="d-block mb-1 fs-4 fw-light">Instruksi :</span>
                                    <span class="color-600">
                                        Silahkan masukkan kembali email anda, <br>
                                        Lalu masukkan password baru dan tekan tombol <br> "RESET PASSWORD"
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-center align-items-center">
                        <div class="card shadow-sm w-100 p-4 p-md-5" style="max-width: 32rem;">

                            <form class="row g-3" action="{{ route('reset.password.post') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="col-12 text-center mb-5">
                                    <img src="{{ asset('style/assets/img/auth-two-step.svg') }}" class="w240 mb-4" alt="" />
                                    <h1>2-step Verification</h1>
                                    <span class="text-muted">We have sent a verification to your email.</span>
                                    <br>
                                    @if(session('error'))
                                        <h1 class="text-danger">{{session('error')}}</h1>
                                    @endif
                                </div>
                                <div class="mb-1">
                                    <input type="text" id="email_address" placeholder="Email Address" class="form-control form-control-lg" name="email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="mb-1">
                                    <input type="password" id="pass2" name="password" class="form-control form-control-lg" placeholder="New Password">
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div>
                                    <input type="password" id="pass3" name="password_confirmation" class="form-control form-control-lg" placeholder="Confirm New Password">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                                <div class="col-12 text-center mt-4">
                                    <button title="" id="change_pass_btn"
                                        class="btn btn-lg btn-block btn-dark lift text-uppercase">Reset Password</button>
                                </div>
                                <div class="col-12 text-center mt-4">
                                    <span class="text-muted">Haven't received it? <a href="{{ route('forget.password.get') }}">Resend a new
                                            code.</a></span>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('style/assets/js/theme.js') }}"></script>
</body>

<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#change_pass_btn").click(function(){
            var pass = $("#pass1").val();
            var pass2 = $("#pass2").val();
            var pass3 = $("#pass3").val();

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


        })

    })
</script>
</html>
