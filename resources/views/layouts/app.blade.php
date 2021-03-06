<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('dist/img/logo.png')}}" type="image/png">

    <style>
            body{
              background-image: url("{{ asset('img/cafeteria.jpg') }}"); /* The image used */
              background-color: #cccccc; /* Used if the image is unavailable */
              background-position: center; /* Center the image */
              background-repeat: repeat; /* Do not repeat the image */
              background-size: cover; /* Resize the background image to cover the entire container */
            }
    </style>

</head>
<body>
    <div id="app">
        <main class="mt-5">
            @yield('content')
        </main>
    </div>
    @stack('js')
</body>
</html>
