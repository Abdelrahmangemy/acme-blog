<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::count();
        $users = User::where('role_as', '0')->count();
        $admins = User::where('role_as', '1')->count();
        return view('admin.dashboard', compact('posts', 'users', 'admins'));
    }
}
