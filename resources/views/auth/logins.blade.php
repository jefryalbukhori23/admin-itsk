<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" href="{{ asset('style/assets/img/logo.png ') }}" type="image/x-icon">
<title>ITSK Sugeng Hartono - Sign In</title>


<link rel="stylesheet" href="{{ asset('style/assets/css/luno-style.css') }}">

<script src="{{ asset('style/assets/js/plugins.js') }}"></script>
   <style>
        #overlay{
            top: 0;
            background:gray;
            opacity: 0.8;
            z-index: 100;
            width: 100%;
            height:100%;
            position: fixed;
            display: none;
        }
        .cv-spinner {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .spinner {
            width: 120px;
            height: 120px;
            border: 4px #ddd solid;
            border-top: 4px #2e93e6 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }
        @keyframes sp-anime {
            100% {
                transform: rotate(360deg);
            }
        }
        .is-hide{
            display:none;
        }

        .centers {
            height: 25%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .wave {
            width: 5px;
            height: 100px;
            background: linear-gradient(45deg, cyan, #02169a);
            margin: 10px;
            animation: wave 1s linear infinite;
            border-radius: 20px;
        }
        .wave:nth-child(2) {
        animation-delay: 0.1s;
        }
        .wave:nth-child(3) {
        animation-delay: 0.2s;
        }
        .wave:nth-child(4) {
        animation-delay: 0.3s;
        }
        .wave:nth-child(5) {
        animation-delay: 0.4s;
        }
        .wave:nth-child(6) {
        animation-delay: 0.5s;
        }
        .wave:nth-child(7) {
        animation-delay: 0.6s;
        }
        .wave:nth-child(8) {
        animation-delay: 0.7s;
        }
        .wave:nth-child(9) {
        animation-delay: 0.8s;
        }
        .wave:nth-child(10) {
        animation-delay: 0.9s;
        }

        @keyframes wave {
        0% {
            transform: scale(0);
        }
        50% {
            transform: scale(1);
        }
        100% {
            transform: scale(0);
        }
        }



    </style>
</head>
<body id="layout-1" data-luno="theme-blue">

<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span><br>
        <h3 style="color: white;">Data Sedang di Proses...</h3>
    </div>
</div>
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
    Portal Login <br> Sistem Informasi <br> Institut Teknologi Sains Kesehatan <br> Sugeng Hartono
</span>
</li>
</ul>
<div class="mb-2">
<a href="#" class="me-3 color-600">Home</a>
<a href="#" class="me-3 color-600">About Us</a>
<a href="#" class="me-3 color-600">FAQs</a>
</div>
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

<form class="row g-3" id="form_login" action="{{url('loginAction')}}" method="POST">
    @csrf
<div class="col-12 text-center mb-5">
<h1>Sign in</h1>
<span class="text-muted">Login to access to our dashboard.</span>
@if(session()->has('fail'))
<div role="alert" class="alert alert-danger">
    {{ session('fail') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
</div>
<div class="col-12 text-center mb-4">
{{-- <a class="btn btn-lg btn-outline-secondary btn-block" href="#">
<span class="d-flex justify-content-center align-items-center">
<img class="avatar xs me-2" src="{{ asset('style/assets/img/google.svg') }}" alt="Image Description"> Sign in with Google </span>
</a> --}}
<span class="dividers text-muted mt-4"></span>
</div>
<div class="col-12">
<div class="mb-2">
<label class="form-label">Email address</label>
<input type="email" value="{{$email}}" name="email" class="form-control form-control-lg" placeholder="name@example.com">
</div>
</div>
<div class="col-12">
<div class="mb-2">
<div class="form-label">
{{-- <span class="d-flex justify-content-between align-items-center"> Password <a class="text-primary" href="auth-password-reset.html">Forgot Password?</a> --}}
</span>
</div>
<input id="password" name="password" value="{{$pass}}" class="form-control form-control-lg" type="password" maxlength="10" placeholder="Enter the password">
</div>
</div>
<div class="col-12">
{{-- <div class="form-check">
<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
<label class="form-check-label" for="flexCheckDefault"> Remember me </label>
</div> --}}
</div>
<div class="col-12 text-center mt-4">
<button type="submit" class="btn btn-lg btn-block btn-dark lift text-uppercase" title="">SIGN IN</button>

</div>
<div class="col-12 text-center mt-4">
{{-- <span class="text-muted">Don't have an account yet? <a href="auth-signup.html">Sign up here</a></span> --}}
</div>
</form>

</div>
</div>
</div>
</div>
</div>
<script src="{{ asset('style/dist/bootstrap-show-password.min.js') }}"></script>
<script>
      $(function() {
        $('#password').password()
      })
  		  $(document).ready(function(){
             $("#overlay").fadeIn();
          	setTimeout(() => {
                $("#form_login").submit();
            }, 150);
          })
  </script>
</div>

<script src="{{ asset('style/assets/js/theme.js') }}"></script>


</body>
</html>
