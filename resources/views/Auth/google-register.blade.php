<!DOCTYPE html>
<html lang="en">
<head>
    <title>TDC - 註冊頁</title>
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
            <form class="login100-form validate-form" method="POST" action="/google-register?token={{ $token }}">
                @csrf
                <span class="login100-form-title p-b-49">
                    Create
                </span>

                <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
                    <span class="label-input100">Username</span>
                    @error('user_nick')
                    <br><span class="label-input100 text-danger" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                    <input class="input100" type="text" name="user_nick"  value="{{ old('user_nick') }}" placeholder="Type your username">
                    <span class="focus-input100" data-symbol="&#xf007;"></span>
                </div>

                <div class="text-right p-t-8 p-b-31">
                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn" type="submit">
                            Sign Up Using Google
                        </button>
                    </div>
                </div>

                <div class="flex-col-c p-t-30">
                            <span class="txt1 p-b-17">
                                Or Back To
                            </span>

                    <a href="/login" class="txt2">
                        Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>