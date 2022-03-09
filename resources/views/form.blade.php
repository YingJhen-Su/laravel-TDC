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

<!-- Main Content-->
<main class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <h1>@empty($post)發表新文章 @else 文章編輯 @endempty</h1>
                <div class="my-5">
                    <form id="contactForm" class="form" method="POST" action="/posts">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="title">標題</label>
                            <input type="text" class="form-control" id="title" name="title" value="@empty($post){{ old('title') }} @else {{ $post->title }} @endempty" placeholder="Enter your title..." required>
                            @error('title')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="content">內容</label>
                            <textarea rows="15" cols="50" name="content" class="form-control" id="content" placeholder="Enter your content here..." required>@empty($post){{ old('content') }} @else {{ $post->content }} @endempty</textarea>
                            @error('content')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <br />
                        <!-- Submit Button-->
                        <button class="btn btn-primary text-uppercase" type="submit">送出</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Footer-->
<footer class="border-top">
    <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2021</div>
</footer>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('js/scripts.js') }}"></script>
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<!-- * *                               SB Forms JS                               * *-->
<!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
</html>