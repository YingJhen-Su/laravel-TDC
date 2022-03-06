<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class FollowPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

  /**
   * Determine whether the user can follow the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function follow(User $user, Post $post)
  {
    return !$user->follows->contains($post);
  }

  /**
   * Determine whether the user can cancel the follow.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function cancel(User $user, Post $post)
  {
    return $user->follows->contains($post);
  }
}