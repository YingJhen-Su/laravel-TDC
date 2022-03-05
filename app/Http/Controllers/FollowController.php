<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();
      $follows = $user->follows()->with('user')->orderBy('created_at', 'desc')->paginate(5);
      return view('list', ['post' => $follows]);
    }

  /**
   * Store a follow relationship.
   *
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function follow(Post $post)
  {
    $user = Auth::user();
    if (!$user->follows->contains($post)) {
      $user->follows()->attach($post->id);
    }
  }

  /**
   * Cancel a follow relationship.
   *
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function cancel(Post $post)
  {
    $user = Auth::user();
    if ($user->follows->contains($post)) {
      $user->follows()->detach($post->id);
    }
  }
}