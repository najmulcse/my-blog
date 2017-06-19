<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\User;
use App\PostType;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at','desc')->get();
        $type       = PostType::where('type','public')->first()->id;
        $posts      = Post::where('post_type',$type)->orderBy('created_at','desc')->get();
        return view('welcome',compact('categories','posts'));
    }
}
