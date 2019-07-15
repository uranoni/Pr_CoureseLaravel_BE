<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogPost;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    public function admin()
    {
        $posts = Post::all();
        return view('posts.admin', ['posts' => $posts]);
    }

    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();
        $tags = Tag::has('posts')->withCount('posts')->orderBy('posts_count', 'desc')->get();
        return view('posts.index', ['posts' => $posts, 'categories' => $categories, 'tags' => $tags]);
    }
    public function indexWithCategory(Category $category)
    {
        $posts = Post::Where('category_id', $category->id)->get();
        $categories = Category::all();
        return view('posts.index', ['posts' => $posts, 'categories' => $categories]);
    }

    public function indexWithTag(Tag $tag)
    {
        $posts = $tag->posts;
        $categories = Category::all();
        // $tags = Tag::all();
        $tags = Tag::has('posts')->withCount('posts')->orderBy('posts_count', 'desc')->get();
        return view('posts.index', ['posts' => $posts, 'categories' => $categories, 'tags' => $tags]);
    }

    public function create()
    {
        $post = new Post;
        $categories = Category::all();
        return view('posts.create', ['post' => $post, 'categories' => $categories]);
    }

    public function store(StoreBlogPost $request)
    {
        $path = $request->file('thumbnail')->store('public');
        $path = str_replace('public/', "/storage/", $path);

        $post = new Post;
        $post->fill($request->all());
        $post->user_id = Auth::id();
        $post->thumbnail = $path;
        $post->save();

        $tags = $this->stringToTags(($request->tags));

        $this->addTagsToPost($tags, $post);

        return redirect('/posts');
    }
    private function stringToTags($string)
    {
        $tags  = explode(',', $string);
        $tags = array_filter($tags);

        foreach ($tags as $key => $tag) {
            $tags[$key] = trim($tag);
        }
        return $tags;
    }

    private function addTagsToPost($tags, $post)
    {
        foreach ($tags as $key => $tag) {
            $model = Tag::firstOrCreate(['name' => $tag]);
            $post->tags()->attach($model->id);
        }
    }

    public function show(Post $post)
    {
        $tags = Tag::has('posts')->withCount('posts')->orderBy('posts_count', 'desc')->get();
        $categories = Category::all();
        return view('posts.show', ['post' => $post, 'categories' => $categories, 'tags' => $tags]);
    }

    public function showByAdmin(Post $post)
    {
        $categories = Category::all();
        return view('posts.showByAdmin', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', ['post' => $post, 'categories' => $categories]);
    }

    public function update(StoreBlogPost $request, Post $post)
    {

        $post->fill($request->all());
        $post->save();

        $post->tags()->detach();
        // foreach($post->tags as $key => $tag){
        //     $post->tags()->detach($tag->id);
        // }

        $tags = $this->stringToTags($request->tags);
        $this->addTagsToPost($tags, $post);

        return redirect('/posts/admin');
    }

    public function destory(Post $post)
    {
        $post->delete();
        // return redirect('/posts/admin');
    }
}
