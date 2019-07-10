<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogPost;
use App\Post;
use App\Category;

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
        $categories = Category::all();
        return view('posts.index',['posts'=>$posts,'categories'=>$categories]);
    }
    public function indexWithCategory(Category $category)
    {
        $posts = Post::Where('category_id',$category->id)->get();
        $categories = Category::all();
        return view('posts.index',['posts'=>$posts,'categories'=>$categories]);
    }
    public function create()
    {
        $post = new Post;
        $categories = Category::all();
        return view('posts.create',['post' => $post,'categories'=>$categories]);
    }

    public function store(StoreBlogPost $request)
    {
        // $request->validate([
        //     'title'=>'required|max:255',
        //     'content'=>'required',
        // ]);
        $post = new Post;
        $post->fill($request->all());
        $post->user_id = Auth::id();
        $post->save();

        //redirect to index
        return redirect('/posts');
    }

    public function show(Post $post)
    {
        if(Auth::check()){
            return view('posts.showByAdmin',['post' => $post]);
        }
        return view('posts.show',['post'=>$post]);
    }

    public function edit(Post $post)
    {
        $categories =Category::all();
        return view('posts.edit',['post' => $post , 'categories'=>$categories]);
    }

    public function update(StoreBlogPost $request,Post $post)
    {
        // $request->validate([
        //     'title'=>'required|max:255',
        //     'content'=>'required',
        // ]);
        $post->fill($request->all());

        // $datetime = date("Y-m-d H:i:s");
        // $post->updated_at =  $datetime;
        $post->save();

        return redirect('/posts/admin');
    }

    public function destory(Post $post)
    {
        $post->delete();
        // return redirect('/posts/admin');
    }

}
