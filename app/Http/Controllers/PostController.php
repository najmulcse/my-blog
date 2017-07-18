<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Category;
use App\PostType;
use App\Content;
use App\Comment;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
        
    }
    public function storePost(Request $request){

    	$rules =[
    		'category'		=> 'required',
    		'post_type'		=> 'required',
    		'title'			=> 'required',
    		'body'			=> 'required',
    	];

    	$this->validate($request , $rules);
        $file = $request->file('postFile');
    	$post = new Post;
    	$post->user_id 	  = Auth::id();
    	$post->category_id   = $request->category ;
    	$post->post_type  = $request->post_type;
    	$post->title 	  = $request->title;
    	$post->body 	  = $request->body;
    	$post->save();
        
        if(!empty($file))
        {
            $name                   = $file->getClientOriginalName();
            $pid                    = $post->id;
            $contentObj             = new Content;
            $contentObj->post_id    = $pid;
            $contentObj->content    = $name ;
            $contentObj->save();
            $file->move('files',$contentObj->id);
        }
    	return back()->with('msg','Post created Successfully');
    }
    public function createPost()
    {
        $categories = Category::orderBy('created_at','desc')->get();
        $postTypes   = PostType::all();
        return view('admins.posts.create',compact('categories','postTypes'));
    }

    public function allPostSeeByAdmin(){
        $posts   = Post::all();
        return view('admins.posts.allPosts',compact('posts'));
    }

    public function myPost()
    {
        $posts = Post::where('user_id',Auth::id())
                        ->orderBy('created_at','desc')
                        ->get();
        $categories = Category::orderBy('created_at','desc')->get();
        return view('posts.userPost',compact('posts','categories'));
    }

    public function edit($pid){
        $categories = Category::all();
        $types       = PostType::all();
        $post      = Post::where('id',$pid)->first();
        return view('admins.posts.editPost',compact('categories','post','types'));
    }

    public function update(Request $request, $pid)
    {
        $rules =[
            'category'      => 'required',
            'post_type'     => 'required',
            'title'         => 'required',
            'body'          => 'required',
        ];

        $this->validate($request , $rules);
        Post::findOrFail($pid)->update([
                        'category_id'   => $request->category,
                        'user_id'       => Auth::id(),
                        'post_type'     => $request->post_type,
                        'title'         => $request->title,
                        'body'          => $request->body
                                     ]);
        $file =$request->file('postFile');
        if(!empty($file))
        {
            $file_Exists=Content::where('post_id',$pid)->first();
            $content=$file->getClientOriginalName();
            if($file_Exists)
                {
                    $db_file=$file_Exists->id;                  
                    unlink(public_path('files/'.$db_file));                  
                    $file_store=Content::where('post_id',$pid)->update(['content' =>$content ]);
                    $file->move('files/',$db_file);
               }
             else
                {
                    $file_store=Content::create(['post_id' =>$pid,'content' =>$content]);
                    $file->move('files/',$file_store->id);
                }
        }

        return back()->with('msg','Post updated Successfully');
    }



    public function categoryEditByAjax($id)
    {
             $cats = Category::findOrFail($id);
            return json_encode($cats);    
       
    }
    public function categoryUpdateByAjax(Request $request , $id)
    {
        
        $cat  = Category::findOrFail($id)->update(['title' => $request->title]);
       
        return response()->json(['cat'=>'success']);
    }
    public function deleteCategory($id){
        $cat = Category::findOrFail($id)->delete();
        Post::where('category_id',$id)->delete();
        return json_encode($cat);
    }

    public function postDelete($id)
    {
        $post = Post::findOrFail($id)
                    ->where('user_id',Auth::id())
                    ->delete();
        if($post)
        {
            Comment::where('post_id',$id)->delete();
            Content::where('post_id',$id)->delete();
            return redirect()->route('home')->with('msg', "Deleted successfully");
        }

        return back();

    }

   

    
}
