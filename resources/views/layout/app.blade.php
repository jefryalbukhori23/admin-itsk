<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="{{ asset('style/assets/img/logo.png ') }}" type="image/x-icon">
    <title>Super Admin - ITSK Sugeng Hartono</title>

    <link rel="stylesheet" href="{{ asset('style/assets/css/luno-style.css') }}">

    <script src="{{ asset('style/assets/js/plugins.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('style/assets/cssbundle/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('style/assets/cssbundle/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/cssbundle/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/cssbundle/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/cssbundle/rangeslider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/cssbundle/jquerysteps.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/cssbundle/bootstrapdatepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/parsleyjs/css/parsley.css') }}">
    {{-- loading / process animation --}}
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
    <style>
        .app-demo {
        position: relative;
        overflow: hidden;
        }

        .app-demo .card-overlay {
        position: absolute;
        top: -60px;
        left: -60px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--secondary-color);
        -webkit-transform: scale(1);
        transform: scale(1);
        -webkit-transition: all .5s;
        transition: all .5s;
        z-index: 1;
        }

        .app-demo:hover .card-overlay {
        -webkit-transform: scale(35);
        transform: scale(35);
        }

        .app-demo:hover .demo-text {
        opacity: 1;
        transform: translateY(0);
        }

        .app-demo .demo-text {
        transition: all .3s;
        transition-delay: .1s;
        transform: translateY(20px);
        display: flex;
        flex-direction: column;
        position: absolute;
        z-index: 2;
        text-align: center;
        justify-content: center;
        width: calc(100% - 1rem);
        height: calc(100% - 1rem);
        align-items: center;
        color: #fff;
        opacity: 0;
        }
    </style>
</head>
<body class="layout-1" data-luno="theme-blue">
{{-- side bar --}}
    @include('layout.nav')
  <div class="wrapper">
    {{-- Header --}}
    @include('layout.header')
    @if(auth()->user()->role == "1")
        @include('layout.page_toolbar')
    @endif
    {{-- Toolbar --}}
    {{-- @include('layout.toolbar') --}}

    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
        @yield('content')
    </div>

  {{-- Footer --}}
    @include('layout.footer')
  </div>

{{-- Modal --}}
    {{-- Project --}}
    @include('layout.modal.project')
    {{-- notes --}}
    @include('layout.modal.notes')
    {{-- Schedule --}}
    @include('layout.modal.schedule')
    {{-- Chat --}}
    @include('layout.modal.chat')
    {{-- Setting --}}
    @include('layout.modal.setting')

    {{-- <script data-cfasync="false" src="{{ asset('style//scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}"></script> --}}
    <script src="{{ asset('style/assets/js/theme.js') }}"></script>

    <script src="{{ asset('style/assets/js/bundle/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('style/assets/js/bundle/sweetalert2.bundle.js') }}"></script>
    <script src="{{ asset('style/assets/js/bundle/sweetalert2.bundle.js') }}"></script>
    <script src="{{ asset('style/assets/js/bundle/select2.bundle.js ') }}"></script>
    <script src="{{ asset('style/assets/js/bundle/inputmask.bundle.js') }}"></script>
    <script src="{{ asset('style/assets/js/bundle/dropify.bundle.js') }}"></script>
    <script src="{{ asset('style/assets/js/bundle/rangeslider.bundle.js') }}"></script>
    <script src="{{ asset('style/assets/js/bundle/jquerysteps.bundle.js') }}"></script>
    <script src="{{ asset('style/assets/js/bundle/bootstrapdatepicker.bundle.js')}}"></script>
    <script src="{{ asset('style/assets/vendor/parsleyjs/js/parsley.js') }}"></script>
    <script>
        var url = "{{ route('change_lang') }}";

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
        $(".change_lang").change(function(){
            window.location.href = url + "?lang="+ $(this).attr('id');
        });
    </script>

</body>
</html>
