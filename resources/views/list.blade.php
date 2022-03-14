@extends('layouts.app')

@section('main-content')
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
            @empty($posts[0])
                <p>--尚未有任何內容--</p>
            @else
                @foreach($posts as $post)
                <!-- Post preview-->
                    <div class="post-preview">
                        <a href="/posts/{{ $post->id }}">
                            <h2 class="post-title">{{ $post->title }}</h2>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="/{{ $post->user->user_nick }}">{{ $post->user->user_nick }}</a>
                            on {{ date('F j, Y', strtotime($post->created_at)) }}
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                @endforeach
                <!-- Pager-->
                <div class="d-flex justify-content-end mb-4">
                    {{ $posts->links() }}
                </div>
            @endempty
            </div>
        </div>
    </div>
@endsection