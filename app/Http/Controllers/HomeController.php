<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\User;
use App\PostType;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function landing()
    {
         if (Auth::check()) {
            return redirect()->route('home');
        }

        $categories = Category::orderBy('created_at','desc')->get();
        $type       = PostType::where('type','published')->first()->id;
        $posts      = Post::where('post_type',$type)->orderBy('created_at','desc')->get();
        return view('welcome',compact('categories','posts'));
    }

    public function index()
    {
        if(Auth::guest())
        {
            return redirect()->route('landing');
        }
        
        $categories = Category::orderBy('created_at','desc')->get();
        $type       = PostType::where('type','published')->first()->id;
        $posts      = Post::where('post_type',$type)->orderBy('created_at','desc')->get();
        return view('home',compact('categories','posts'));
    }


    public function details($pid)
    {
        $post       = Post::findOrFail($pid);
        return view('admins.posts.individualPost',compact('post','user'));
    }

    public function viewCategory($cid){
        $type    = PostType::where('type','published')->first()->id;
        $posts   = Post::where('category_id',$cid)
                        ->where('post_type',$type)
                        ->orderBy('created_at','desc')
                        ->get();
        $user = Auth::user();
        $categories = Category::orderBy('created_at','desc')->get();
        return view('categories.viewAllCat',compact('posts','categories','user'));
    }

    public function postDetails($cid,$pid)
    {
        $post = Post::findOrFail($pid);
        $user = Auth::user();
        $categories = Category::orderBy('created_at','desc')->get();
        return view('posts.postDetails',compact('post','categories','user'));
    }
     public function blogSearch(Request $request)
    {
            $search = $request->search_value;
            if(empty($search))
            {
                return back();
            }
            $results = Post::Where('post_type',1)
                                  -> where('title','LIKE',"%{$search}%")     
                                  ->orWhere('body','LIKE',"%{$search}%") 
                                  ->get();
            $categories = Category::orderBy('created_at','desc')->get();
            return view('posts.searchResult',compact('results','categories'));

    }

}
