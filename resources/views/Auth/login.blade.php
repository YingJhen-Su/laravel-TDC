@extends('layouts.auth')

@section('title')
    TDC - 登入頁
@endsection

@section('form')
    <form class="login100-form validate-form" method="post" action="/login">
        @csrf
        <span class="login100-form-title p-b-49">
            Login
        </span>

        <div class="wrap-input100 validate-input m-b-23" data-validate="Username is reauired">
            <span class="label-input100">Username</span>
            @error('user_nick')
            <br>
            <span class="label-input100 text-danger" role="alert">
                {{ $message }}
            </span>
            @enderror
            <input class="input100" type="text" name="user_nick" value="{{ old('user_nick') }}" placeholder="Type your username" required>
            <span class="focus-input100" data-symbol="&#xf007;"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Password is required">
            <span class="label-input100">Password</span>
            @error('password')
            <br>
            <span class="label-input100 text-danger" role="alert">
                {{ $message }}
            </span>
            @enderror
            <input class="input100" type="password" name="password" placeholder="Type your password" required>
            <span class="focus-input100" data-symbol="&#xf023;"></span>
        </div>

        <div class="text-right p-t-8 p-b-31">
        </div>

        <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button class="login100-form-btn" type="submit">
                    Login
                </button>
            </div>
        </div>

        <div class="txt1 text-center p-t-54 p-b-20">
            <span>
                Or Login Using
            </span>
        </div>

        <div class="flex-c-m">
            <a href="/google-login" class="login100-social-item bg3">
                <i class="fa fa-google"></i>
            </a>
        </div>

        <div class="flex-col-c p-t-30">
            <span class="txt1 p-b-17">
                Or Sign Up Using
            </span>

            <a href="/register" class="txt2">
                Sign Up
            </a>
        </div>
    </form>
@endsection