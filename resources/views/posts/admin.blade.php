@extends('layouts.app')

@section('page-title')
<section class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-uppercase">Blog Admin Pannel</h4>
                <ol class="breadcrumb">
                    <li><a href="/">Home</a>
                    </li>
                    <li class="active">Blog Admin Panel</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<div class="page-content">
    <div class="container">

        <div class="clearfix toolbox">
            <a href="/posts/create" class="btn btn-primary pull-right">Create post</a>
        </div>
        <div class="list-group">
            @foreach ($posts as $key =>$post)
            <a href="#" class="list-group-item">
                {{ $post->title }}
            </a>
            @endforeach


        </div>
    </div>
</div>
@endsection
