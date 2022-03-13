<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
      $posts = Post::orderBy('created_at', 'desc')->with('user')->paginate(5);
      return view('list', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
      return view('form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(PostRequest $request)
    {
      $post = new Post($request->validated());
      $post->user_id = Auth::id();
      $post->save();

      return redirect('/posts/' . $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(Post $post)
    {
      return view('post', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(Post $post)
    {
      $user = Auth::user();
      if ($user->cannot('update', $post)) {
        return back()->withErrors(['msg' => '無權限更新此篇文章!']);
      }

      return view('form', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(PostRequest $request, Post $post)
    {
      $user = Auth::user();
      if ($user->cannot('update', $post)) {
        return redirect('/posts/' . $post->id)->withErrors(['msg' => '無權限更新此篇文章!']);
      }

      $validated = $request->validated();
      $post->update($validated);
      return redirect('/posts/' . $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Post $post)
    {
      $user = Auth::user();
      if ($user->cannot('delete', $post)) {
        return redirect('/posts/' . $post->id)->withErrors(['msg' => '無權限刪除此篇文章!']);
      }

      $post->delete();
      return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Display a listing of the resource of the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function list(User $user)
    {
      $posts = $user->posts()->with('user')->orderBy('created_at', 'desc')->paginate(5);
      return view('list', ['posts' => $posts]);
    }
}