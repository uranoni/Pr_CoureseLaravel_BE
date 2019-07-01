<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function admin()
    {
        $posts = Post::all();
        return view('posts.admin',['posts'=>$posts]);
    }

    public function index()
    {
        $posts = Post::all();
        return view('posts.index',['posts'=>$posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $post = new Post;
        $post->fill($request->all());
        $post->save();

        //redirect to index
        return redirect('/posts');
    }
}
