<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon.ico') }}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <!--===============================================================================================-->
    @error('msg')
    <script>
        alert('{{ $message }}');
    </script>
    @enderror
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="/">Taiwanese Drama Club</a>
    </div>
</nav>
<div class="limiter">
    <div class="container-login100" style="background-image: url({{ asset('assets/img/bg-01.jpg') }});">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            @yield('form')
        </div>
    </div>
</div>

<div id="dropDownSelect1"></div>
<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>