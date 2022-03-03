<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
      return view('auth.register');
    }

    public function store(Request $request)
    {
      $request->validate([
        'user_nick' => ['required', 'alpha_num', 'max:24', 'unique:users'],
        'email'     => ['required', 'string', 'email', 'unique:users'],
        'password'  => ['required', 'string']
      ]);

      $user = User::create([
        'user_nick' => $request->user_nick,
        'email'     => $request->email,
        'password'  => Hash::make($request->password)
      ]);

      Auth::login($user);

      return redirect(RouteServiceProvider::HOME);
    }
}