<?php

namespace App\Http\Controllers;

use App\Models\Post;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
    }

  /**
   * Store a follow relationship.
   *
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function follow(Post $post)
  {
    //
  }

  /**
   * Cancel a follow relationship.
   *
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function cancel(Post $post)
  {
    //
  }
}