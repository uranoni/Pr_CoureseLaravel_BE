@extends('layouts.app')

@section('page-title')
<section class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-uppercase">Blog Admin Pannel</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a>
                    </li>
                    <li class="active breadcrumb-item">Blog Admin Panel</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<div class="page-content">
    <div class="container">

        <div class="toolbox">
            <a href="/posts/create" class="btn btn-primary">Create post</a>
        </div>
        <ul class="list-group">
            @foreach ($posts as $key =>$post)
            <li class="list-group-item clearfix">
                <div class="float-left">
                    <div class="title">{{ $post->title }}</div>
                    <div class="author">{{ $post->user->name }}</div>
                </div>
                <span class="float-right">
                    <a href="/posts/show/{{ $post->id }}" class="btn btn-success">View </a>
                    <a href="/posts/{{ $post->id }}/edit" class="btn btn-warning">Edit</a>
                    <button class="btn btn-danger" onclick="deletePost({{ $post->id }})">Delete</button>
                </span>
            </li>
            @endforeach


        </ul>
    </div>
</div>

{{-- <form id="delete-form" action="/post/id" method="POST">
    <input type="hidden" name="_method" value="delete">
    @csrf
</form> --}}
@endsection


{{-- @section('script')
<script>

</script>

@endsection --}}
