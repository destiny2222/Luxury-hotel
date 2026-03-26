<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'published')->latest()->paginate(10);
        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 'published')->firstOrFail();
        return view('blog.show', compact('post'));
    }
}
