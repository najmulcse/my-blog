<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function commentStore(Request $request)
    {
    	$rules =[
    	'body'  =>'required'
    	];

    	$this->validate($request,$rules);

    	$comment  = new Comment;
    	$comment->post_id  = $request->p_comment_id;
    	$comment->user_id  = Auth::id();
    	$comment->body     = $request->body;
    	$comment->save();
    	return back();
    }
}
