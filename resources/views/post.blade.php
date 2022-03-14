@extends('layouts.app')

@section('main-content')
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <table>
                        <tbody>
                        <tr>
                            <td>
                                @can('update', $post)
                                    <form method="GET" action="/posts/{{ $post->id }}/edit">
                                        <button type="submit" class="btn btn-primary btn-sm">編輯</button>
                                    </form>
                                @endcan
                            </td>
                            <td>
                                @can('delete', $post)
                                    <form onsubmit="return confirm('確定要刪除此文章嗎?')" method="POST" action="/posts/{{ $post->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-secondary btn-sm">刪除</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    @can('follow', $post)
                        <form method="POST" action="/follow/{{ $post->id }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">加入收藏</button>
                        </form>
                    @endcan
                    @can('cancel', $post)
                        <form onsubmit="return confirm('確定要取消收藏嗎?')" method="POST" action="/follow/{{ $post->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-secondary btn-sm">取消收藏</button>
                        </form>
                    @endcan
                    <h1>{{ $post->title }}</h1>
                    <span class="meta">
                    Posted by
                    <a href="/{{ $post->user->user_nick }}">{{ $post->user->user_nick }}</a>
                    on {{ date('F j, Y', strtotime($post->created_at)) }}
                </span><br>
                </div>
            </div>
        </div>
    </div>

    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <p></p>
                    <span style="white-space: pre-line;">{{ $post->content }}</span>
                </div>
            </div>
        </div>
    </article>
@endsection