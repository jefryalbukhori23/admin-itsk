<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="{{ asset('style/assets/img/logo.png ') }}" type="image/x-icon">
        <title>ITSK Sugeng Hartono</title>


        <link rel="stylesheet" href="{{ asset('style/assets/css/luno-style.css') }}">

        <script src="{{ asset('style/assets/js/plugins.js') }}"></script>
    </head>
    <body id="layout-1" data-luno="theme-blue">

    <div class="wrapper">
        <div class="page-body auth px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
            <div class="container-fluid">
                <div class="row g-0">
                    <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center">
                        <div style="max-width: 25rem;">
                            <div class="mb-4">
                                <a href="{{url('/')}}">
                                    <img src="{{ asset('style/assets/img/logo.png ') }}" style="max-height:100px;" alt="">
                                </a>
                            </div>
                            <div class="mb-5">
                                <h2 class="color-900">ITSK Sugeng Hartono</h2>
                            </div>

                            <ul class="list-unstyled mb-5">
                                <li>
                                    <span class="color-600">
                                        Sistem Informasi
                                        <br>
                                        ITSK Sugeng Hartono
                                    </span>
                                </li>
                            </ul>
                            <div>
                                <a href="#" class="me-3 color-400"><i class="fa fa-facebook-square fa-lg"></i></a>
                                <a href="#" class="me-3 color-400"><i class="fa fa-github-square fa-lg"></i></a>
                                <a href="#" class="me-3 color-400"><i class="fa fa-linkedin-square fa-lg"></i></a>
                                <a href="#" class="me-3 color-400"><i class="fa fa-twitter-square fa-lg"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-center align-items-center">
                        <div class="card shadow-sm w-100 p-4 p-md-5" style="max-width: 32rem;">
                            <div class="col-12 text-center mb-4">
                                <img src="{{ asset('style/assets/img/auth-two-step.svg') }}" class="w240 mb-4" alt="" />
                                <h1 class="display-1">401</h1>
                                <h5>OOPS! YOU ARE NOT ALLOWERD</h5>
                                <span class="text-muted">Sorry,your account cannot access this page.</span>
                            </div>
                            <div class="col-12 text-center">
                                <a href="{{url('dashboard')}}" title="" class="btn btn-lg btn-block btn-dark lift text-uppercase">Back to Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('style/dist/bootstrap-show-password.min.js') }}"></script>

    </div>




        <script src="{{ asset('style/assets/js/theme.js') }}"></script>


    </body>
</html>
