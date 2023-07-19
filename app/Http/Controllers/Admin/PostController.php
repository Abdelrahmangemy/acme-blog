<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.post.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
            'description' => 'required|string',
            'meta_title' => 'required|string',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'status' => 'nullable',
        ]);

        $post = new Post;

        $post->name = $validatedData['name'];
        $post->slug = str::slug($validatedData['slug']);
        $post->description = $validatedData['description'];
        $post->meta_title = $validatedData['meta_title'];
        $post->meta_description = $validatedData['meta_description'];
        $post->meta_keyword = $validatedData['meta_keyword'];
        $post->status = $request->status == true ? '1':'0';
        $post->created_by = Auth::user()->id;
        $post->save();

        return redirect('admin/posts')->with('message', 'Post Added Successfully');
    }

    public function edit($post_id)
    {
        $post = Post::find($post_id);
        return view('admin.post.edit', compact('post'));
    }

    public function update(Request $request, $post_id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
            'description' => 'required|string',
            'meta_title' => 'required|string',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'status' => 'nullable',
        ]);

        $post = Post::find($post_id);

        $post->name = $validatedData['name'];
        $post->slug = str::slug($validatedData['slug']);
        $post->description = $validatedData['description'];
        $post->meta_title = $validatedData['meta_title'];
        $post->meta_description = $validatedData['meta_description'];
        $post->meta_keyword = $validatedData['meta_keyword'];
        $post->status = $request->status == true ? '1':'0';
        $post->created_by = Auth::user()->id;
        $post->update();

        return redirect('admin/posts')->with('message', 'Post Updated Successfully');
    }

    public function destroy($post_id)
    {
        $post = Post::find($post_id);
        $post->delete();

        return redirect('admin/posts')->with('message', 'Post Deleted Successfully');
    }
}
