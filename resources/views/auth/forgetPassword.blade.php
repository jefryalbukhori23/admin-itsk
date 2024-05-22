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
                <div class="row g-3">
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
                                    <span class="d-block mb-1 fs-4 fw-light">Lupa Password ?</span>
                                    <span class="color-600">
                                        Masukkan Email anda untuk mendapatkan link merubah password
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-center align-items-center">
                        <div class="card shadow-sm w-100 p-4 p-md-5" style="max-width: 32rem;">
                            <form class="row g-3"  action="{{ route('forget.password.post') }}" method="POST">
                                @csrf
                                <div class="col-12 text-center mb-5">
                                    <img src="{{ asset('style/assets/img/auth-password-reset.svg')}}" class="w240 mb-4" alt="" />
                                    <h1>Forgot password?</h1>
                                    <span>Enter the email address you used when you joined and we'll send you
                                        instructions to reset your password.</span>
                                </div>
                                @if(session('msg'))
                                    <span class="text-danger">{{session('msg')}}</span>
                                @endif
                                <div class="col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Email address</label>
                                        <input type="email" id="email_address" name="email" class="form-control form-control-lg"
                                            placeholder="name@example.com">

                                    </div>
                                </div>
                                <div class="col-12 text-center mt-4">
                                    <button  title=""
                                        class="btn btn-lg btn-block btn-dark lift text-uppercase">SUBMIT</button>
                                </div>
                                <div class="col-12 text-center mt-4">
                                    <span class="text-muted"><a href="{{url('/')}}">Back to Sign in</a></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{asset('style/assets/js/theme.js')}}"></script>
</body>

</html>
