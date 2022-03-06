<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Post::orderBy('created_at', 'desc')->paginate(5);
      return view('list', ['posts' => $posts]);
//      return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $posts = null;
      return view('form', ['posts' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
      $post = new Post();
      $post->title = $request->input('title');
      $post->content = $request->input('content');
      $post->user_id = Auth::id();
      $post->save();

      return redirect('/posts/' . $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      return view('post', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
      $user = Auth::user();
      if ($user->cannot('update', $post)) {
        return back()->withErrors('msg', '無權限更新此篇文章');
      }

      return view('form', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
      $user = Auth::user();
      if ($user->cannot('update', $post)) {
        return redirect('/posts/' . $post->id)->withErrors('msg', '無權限更新此篇文章');
      }

      $validated = $request->validated();
      $post->update($validated);
      return redirect('/posts/' . $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
      $user = Auth::user();
      if ($user->cannot('delete', $post)) {
        return redirect('/posts/' . $post->id)->withErrors('msg', '無權限刪除此篇文章');
      }

      $post->delete();
    }

    /**
     * Display a listing of the resource of the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function list(User $user)
    {
      $user = Auth::user();
      $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(5);
      return view('list', ['posts' => $posts]);
    }
}