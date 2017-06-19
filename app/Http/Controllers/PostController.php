<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Category;
use App\PostType;
use App\Content;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    


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

    public function allPostSeeByAdmin(){
        $posts   = Post::all();
        return view('admins.posts.allPosts',compact('posts'));
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

    public function details($pid)
    {
        $post       = Post::findOrFail($pid);
        return view('admins.posts.individualPost',compact('post'));
    }

    public function viewCategory($cid){
        $posts   = Post::where('category_id',$cid)
                        ->orderBy('created_at','desc')
                        ->get();
        $categories = Category::all();
        return view('categories.viewAllCat',compact('posts','categories'));
    }
}
