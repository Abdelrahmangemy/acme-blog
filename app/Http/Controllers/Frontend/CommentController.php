<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::check()) {

            $validator = Validator::make($request->all(), [
                'comment_body' => 'required|string'
            ]);

            if ($validator->fails()) {

                return redirect()->back()->with('message', 'Comment area is mandatory');
            }
            $post = Post::where('slug', $request->post_slug)->where('status', '1')->first();

            if ($post) {

                $comment = Comment::create([
                    'post_id' => $post->id,
                    'user_id' => Auth::user()->id,
                    'comment_body' => $request->comment_body
                ]);
                return redirect()->back()->with('message', 'Commentend Successfully');
            }else {

                return redirect()->back()->with('message', 'No such post found');
            }
        }else {

            return redirect('login')->with('message', 'please Login first');
        }
    }

    public function destroy(Request $request)
    {
        if (Auth::check()) {

            $comment = Comment::where('id', $request->comment_id)
                                ->where('user_id', Auth::user()->id)
                                ->first();
            $comment->delete();

            if ($comment) {

                return response()->json([
                    'status' => 200,
                    'message' => 'comment deleted successfully'
                ]);
            }else {

                return response()->json([
                    'status' => 500,
                    'message' => 'something went wrong'
                ]);
            }
        }else {

            return response()->json([
                'status' => 401,
                'message' => 'Login to Delete this comment'
            ]);
        }
    }
}
