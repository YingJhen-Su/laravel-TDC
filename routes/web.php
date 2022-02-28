<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\PostController;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
  Route::get('register', [RegisterController::class, 'create'])->name('register');
  Route::post('register', [RegisterController::class, 'store']);

  Route::get('login', [AuthController::class, 'create'])->name('login');
  Route::post('login', [AuthController::class, 'store']);

  Route::get('google-login', [GoogleController::class, 'auth'])->name('google-login');
  Route::get('google-callback', [GoogleController::class, 'login']);

  Route::get('google-register', [GoogleController::class, 'create'])->name('google-register');
  Route::post('google-register', [GoogleController::class, 'store']);
});

Route::middleware('auth')->group(function () {
  Route::get('/', [PostController::class, 'index']);

  Route::resource('posts', PostController::class);

  Route::get('{user_nick}', [PostController::class, 'list']);

  Route::post('follow/{post}', [PostController::class, 'follow']);
  Route::delete('follow/{post}', [PostController::class, 'cancel']);

  Route::post('logout', [AuthController::class, 'destroy'])
    ->name('logout');
});