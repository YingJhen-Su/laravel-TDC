@extends('layouts.app')

@section('main-content')
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <h1>@empty($post)發表新文章@else文章編輯@endempty</h1>
                    <div class="my-5">
                        <form id="contactForm" class="form" method="POST" action={{ isset($post) ? "/posts/$post->id" : "/posts"}}>
                            @csrf
                            @isset($post)
                                @method('PUT')
                            @endisset
                            <div class="form-group">
                                <label class="form-label" for="title">標題</label>
                                <input type="text" class="form-control" id="title" name="title" value="@empty($post){{ old('title') }}@else{{ $post->title }}@endempty" placeholder="Enter your title..." required>
                                @error('title')
                                    <span class="text-danger" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="content">內容</label>
                                <textarea rows="15" cols="50" name="content" class="form-control" id="content" placeholder="Enter your content here..." required>@empty($post){{ old('content') }}@else{{ $post->content }}@endempty</textarea>
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
@endsection