<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function create()
    {
      return view('auth.login');
    }

    public function store(Request $request)
    {
      $credentials = $request->validate([
       'user_nick' => ['required', 'alpha_num', 'max:24'],
       'password'  => ['required', 'string']
     ]);

      if (Auth::attempt($credentials, true)) {
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
      }

      return back()->withErrors([
        'user_nick' => 'The provided credentials do not match our records.',
        'password'  => 'The provided credentials do not match our records.'
      ]);


    }

    public function destroy(Request $request)
    {
      Auth::logout();

      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return redirect(RouteServiceProvider::HOME);
    }
}