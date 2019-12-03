<!DOCTYPE html>
<html lang="es">
<head>
    <title>Inicio</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="kamleshyadav">
    <meta name="MobileOptimized" content="320">
    <!--Start Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front_template/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_template/css/font.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_template/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_template/css/swiper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_template/css/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_template/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_template/css/navigation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_template/css/settings.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_template/css/range.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_template/css/nice-select.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_template/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Favicon Link -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('front_template/images/favicon.png') }}">
    <script src="{{ asset(mix('js/app.js')) }}" defer></script>
</head>
<body>

<div class="clv_main_wrapper index_v1" id="app">

     @include('front.layout.navbar')
     @include('front.layout.breadcrum')


    @yield('content')

    @include('front.layout.footer')
    @include('front.pages.registro')
    @include('front.pages.login')

</div>


        <!--Main js file Style-->
    <script src="{{ asset('front_template/js/jquery.js') }}"></script>
    <script src="{{ asset('front_template/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front_template/js/swiper.min.js') }}"></script>
    <script src="{{ asset('front_template/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front_template/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('front_template/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('front_template/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('front_template/js/jquery.countTo.js') }}"></script>
    <script src="{{ asset('front_template/js/isotope.min.js') }}"></script>
    <script src="{{ asset('front_template/js/nice-select.min.js') }}"></script>
    <script src="{{ asset('front_template/js/range.js') }}"></script>
    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
    <script src="{{ asset('front_template/js/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('front_template/js/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('front_template/js/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('front_template/js/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ asset('front_template/js/revolution.extension.parallax.min.js') }}"></script>
    <script src="{{ asset('front_template/js/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ asset('front_template/js/revolution.extension.video.min.js') }}"></script>
    <script src="{{ asset('front_template/js/custom.js') }}"></script>
    @stack('js')
</body>



