<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function viewPost()
    {
        $post = Post::where('status', '1')->paginate(5);
        return view('frontend.post.index', compact('post'));
    }

    public function viewPostDetails(string $post_slug)
    {
        $post = Post::where('slug', $post_slug)->where('status', '1')->first();
        return view('frontend.post.view', compact('post'));
    }
}
