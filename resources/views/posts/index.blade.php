@extends('layouts.frontend')

@section('page-title')
<section class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-uppercase">Blog Listing
                    @if (request()->category)
                    /{{ request()->category->name }}

                    @endif
                </h4>
                <ol class="breadcrumb">
                    <li><a href="/">Home</a>
                    </li>
                    <li class="active"><a href="/posts">Blog</a>
                    </li>
                    <li class="active">Blog Listing</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!--classic image post-->
                @foreach ($posts as $key => $post)
                <div class="blog-classic">
                    <div class="date">
                        {{ $post->created_at->day}}
                        <span>
                            {{ strtoupper($post->created_at->shortEnglishMonth) }}
                            {{ $post->created_at->year}}
                        </span>
                    </div>
                    <div class="blog-post">
                        <div class="full-width">
                            <img src="/assets/img/post/p12.jpg" alt="" />
                        </div>
                        <h4 class="text-uppercase"><a href="/posts/{{$post->id}}">{{ $post->title }}</a></h4>
                        <ul class="post-meta">
                            <li><i class="fa fa-user"></i>posted by <a href="#">{{$post->user->name}}</a>
                            </li>
                            @if ($post->category)
                            <li><i class="fa fa-folder-open"></i> <a
                                    href="/posts/category/{{$post->category_id}}">{{$post->category->name}}</a></li>
                            @endif
                            <li><i class="fa fa-comments"></i> <a href="#">4 comments</a>
                            </li>
                        </ul>
                        <p>{{ str_limit($post->content, 250) }}</p>
                        <a href="/posts/{{$post->id}}" class="btn btn-small btn-dark-solid  "> Continue Reading</a>
                    </div>
                </div>
                @endforeach

                <!--classic image post-->



                <!--pagination-->
                <div class="text-center">
                    <ul class="pagination custom-pagination">
                        <li><a href="#">Prev</a>
                        </li>
                        <li class="active"><a href="#">1</a>
                        </li>
                        <li><a href="#">2</a>
                        </li>
                        <li><a href="#">3</a>
                        </li>
                        <li><a href="#">4</a>
                        </li>
                        <li><a href="#">5</a>
                        </li>
                        <li><a href="#">Next</a>
                        </li>
                    </ul>
                </div>
                <!--pagination-->

            </div>
            <div class="col-md-4">
                @include('posts._sidebar')
            </div>
        </div>
    </div>
</div>
@endsection
