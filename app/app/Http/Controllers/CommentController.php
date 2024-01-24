<?php

namespace App\Http\Controllers;

use App\Comment;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function commentStore(Request $request)
    {
        $comment = new Comment;

        $id = Auth::user()->id;
        $comment->user_id = $id;

        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;

        $comment->save();

        return redirect('/');
    }
}
