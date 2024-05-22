<!doctype html>
<html lang="en">
<head>
    <title>ITSK - Sugeng Hartono</title>
    <meta charset="utf-8">
    <!-- Meta -->
    <meta name="keywords" content="" />
    <meta name="author" content="">
    <meta name="robots" content="" />
    <meta name="description" content="" />

    <!-- this styles only adds some repairs on idevices  -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('landing/images/logo.png') }}">

    <!-- Google fonts - witch you want to use - (rest you can just remove) -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js') }}"></script>
    <![endif]-->

    <!-- Stylesheets -->
    <link rel="stylesheet" media="screen" href="{{ asset('landing/js/bootstrap/bootstrap.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('landing/js/mainmenu/menu.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('landing/css/default.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('landing/css/layouts.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('landing/css/shortcodes.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('landing/css/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" media="screen" href="{{ asset('landing/css/responsive-leyouts.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('landing/js/masterslider/style/masterslider.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/Simple-Line-Icons-Webfont/simple-line-icons.css') }}" media="screen" />
    <link rel="stylesheet" href="{{ asset('landing/css/et-line-font/et-line-font.css') }}">
    <link href="{{ asset('landing/js/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/js/tabs/assets/css/responsive-tabs.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/js/style-swicher/style-swicher.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('landing/js/custom-scrollbar/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/colors/lightblue.css') }}" />

    <script>
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
    </script>
</head>
<body>
    <div class="site_wrapper">
        @include('landing.layout.header')
        @yield('content')
        @include('landing.layout.footer')
    </div>

<!-- ========== end style swicher ========== -->

<!-- ============ JS FILES ============ -->

<script type="text/javascript" src="{{ asset('landing/js/universal/jquery.js') }}"></script>
<script src="{{ asset('landing/js/bootstrap/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('landing/js/masterslider/jquery.easing.min.js') }}"></script>
<script src="{{ asset('landing/js/masterslider/masterslider.min.js') }}"></script>
<script type="text/javascript">
(function($) {
 "use strict";
	var slider = new MasterSlider();
	// adds Arrows navigation control to the slider.
	slider.control('arrows');
	slider.control('bullets');

	slider.setup('masterslider' , {
		 width:1600,    // slider standard width
		 height:630,   // slider standard height
		 space:0,
		 speed:45,
		 layout:'fullwidth',
		 loop:true,
		 preload:0,
		 autoplay:true,
		 view:"parallaxMask"
	});

})(jQuery);
</script>
<script type="text/javascript">
(function($) {
 "use strict";
	var slider = new MasterSlider();

	 slider.setup('masterslider2' , {
		 width:570,    // slider standard width
		 height:300,   // slider standard height
		 space:0,
		 speed:27,
		 layout:'boxed',
		 loop:true,
		 preload:0,
		 autoplay:true,
		 view:"basic",
	});
})(jQuery);
</script>
<script src="{{ asset('landing/js/mainmenu/customeUI.js') }}"></script>
<script src="{{ asset('landing/js/owl-carousel/owl.carousel.js') }}"></script>
<script src="{{ asset('landing/js/owl-carousel/custom.js') }}"></script>
<script type="text/javascript" src="{{ asset('landing/js/tabs/smk-accordion.js') }}"></script>
<script type="text/javascript" src="{{ asset('landing/js/tabs/custom.js') }}"></script>
<script src="{{ asset('landing/js/scrolltotop/totop.js') }}"></script>
<script src="{{ asset('landing/js/mainmenu/jquery.sticky.js') }}"></script>
<script src="{{ asset('landing/js/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('landing/js/style-swicher/style-swicher.js') }}"></script>
<script src="{{ asset('landing/js/style-swicher/custom.js') }}"></script>
<script src="{{ asset('landing/js/scripts/functions.js') }}" type="text/javascript"></script>

</body>
</html>
