<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Social;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Google\Client;
use Google\Service\Oauth2;
use Exception;

class GoogleController extends Controller
{
    public function auth()
    {
      $client = new Client();
      $client->setClientId(env('GOOGLE_CLIENT_ID'));
      $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
      $client->setRedirectUri('http://127.0.0.1:8000/google-callback');
      $client->addScope('profile');
      $client->addScope('email');
      $url = $client->createAuthUrl();

      return redirect($url);
    }

    public function login(Request $request)
    {
      $client = new Client();
      $client->setClientId(env('GOOGLE_CLIENT_ID'));
      $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
      $client->setRedirectUri('http://127.0.0.1:8000/google-callback');
      $client->fetchAccessTokenWithAuthCode($request->code);
      $service = new Oauth2($client);
      $userData = $service->userinfo->get();
      $socialId = $userData['id'];

      $socialUser = Social::where('platform', 'google')->where('social_id', $socialId)->first();
      if (!empty($socialUser)) {
        Auth::login($socialUser->user, true);
        return redirect()->intended(RouteServiceProvider::HOME);
      } else {
        $dataKey = Hash::make(uniqid());
        $dataValue = array(
          'platform' => 'google',
          'data'     => array(
            'id'    => $socialId,
            'email' => $userData['email']
          )
        );

        Cache::put($dataKey, $dataValue, 1800);
        return redirect('/google-register?token=' . $dataKey);
      }
    }

    public function create(Request $request)
    {
      $token = $request->query('token');
      return view('auth.google-register', ['token' => $token]);
    }

    public function store(Request $request)
    {
      $request->validate([
        'user_nick' => ['required', 'alpha_num', 'max:24', 'unique:users']
      ]);

      $dataKey  = $request->query('token');
      $dataArr  = Cache::get($dataKey);
      // ??????????????????????????????
      if (empty($dataArr)) {
        return redirect('/login')->withErrors(['msg' => '????????????????????????????????????']);
      }
      // ???????????????????????????
      $platform = $dataArr['platform'];
      if ($platform !== 'google') {
        return redirect('/login')->withErrors(['msg' => '???????????????????????????????????????????????????!']);
      }

      $socialId  = $dataArr['data']['id'];
      $userEmail = $dataArr['data']['email'];
      // ????????????????????????Email
      if (empty($userEmail)) {
        $userEmail = '-';
      }

      DB::beginTransaction();
      try {
        $user = User::create([
          'user_nick' => $request->user_nick,
          'email'     => $userEmail,
          'password'  => null
        ]);

        Social::create([
          'user_id'   => $user->id,
          'platform'  => $platform,
          'social_id' => $socialId
        ]);

        DB::commit();
      } catch (Exception $e) {
        DB::rollBack();
        return redirect('/login')->withErrors(['msg' => '????????????????????????????????????']);
      }

      Auth::login($user, true);

      return redirect(RouteServiceProvider::HOME);
    }
}