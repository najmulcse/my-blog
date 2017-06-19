<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use Validate;
class AdminController extends Controller
{
    public function __construct()
    {
    	 $this->middleware('auth');
    	 $this->middleware('isAdmin');
    }

    public function index()
    {
    	return view('admins.index');
    }

    public function category()
    {
        $categories = Category::orderBy('created_at','desc')->get();
        return view('categories.category',compact('categories'));
    }
    public function categoryStore(Request $request){

        $rules = [
        'title' => 'required'
        ];
        $this->validate($request,$rules);
        $categoryObj = new Category;
        $categoryObj->title = $request->title ;
        $categoryObj->save();
        return back()->with('msg', "Category added successfully");
    }

    public function createPost()
    {
        $categories = Category::orderBy('created_at','desc')->get();
        return view('posts.create',compact('categories'));
    }

    public function valid(Request $req)
    {
    	$v=$this->validate($req,['my' =>'required']);
			
		return $req->all();
    }
}
