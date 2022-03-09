<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Taiwanese Drama Club</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    @error('msg')
    <script>
        alert('{{ $message }}');
    </script>
    @enderror
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="/">Taiwanese Drama Club</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/">最新</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/{{ Auth::user()->user_nick }}">我的</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/follows">收藏</a></li>
            </ul>
            <form class="ps-lg-5" action="/logout" method="POST">
                @csrf
                <a class="btn hover-top btn-collab" href="/posts/create">發表</a>
                <button class="btn btn-link text-white fw-bold order-1 order-lg-0" name="logout" type="submit">登出</button>
            </form>
        </div>
    </div>
</nav>

<!-- Page Header-->
<header class="masthead" style="background-image: url({{ asset('assets/img/home-bg.jpg') }})">
</header>

<!-- Post Content-->
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
                                <form method="POST" action="/posts/{{ $post->id }}">
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
                    <form method="POST" action="/follow/{{ $post->id }}">
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
<!-- Footer-->
<footer class="border-top">
    <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2021</div>
</footer>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>