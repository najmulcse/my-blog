<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['auth','isAdmin']], function(){


		Route::get('admin',['as' =>'admin','uses' => 'AdminController@index']);
		Route::get('category',['as' =>'category' ,'uses' => 'AdminController@category']);
		Route::post('category/store',['as' =>'cStore','uses' => 'AdminController@categoryStore']);
		
		
		Route::get('allposts',['as' => 'allPostAdmin','uses' => 'PostController@allPostSeeByAdmin']);
	

		//ajax called...........
		Route::get('/categoryEditAjax/{id}',['as' => 'cat_ajax','uses'=>'PostController@categoryEditByAjax']);
		Route::post('/categoryUpdateAjax/{id}',['as' =>'cat_ajax_update','uses'=>'PostController@categoryUpdateByAjax']);
		Route::get('deleteCategory/{id}',['as'=>'deleteCat' ,'uses'=>'PostController@deleteCategory']);
		
});

Route::group(['middlewaregroups' =>['web']],function(){
		Route::auth();
		Route::get('/',['as'=>'landing','uses'=>'HomeController@landing']);
		Route::get('/home', ['as'=>'home','uses'=>'HomeController@index']);
		Route::get('category/{cid}/view',['as' =>'viewCategory','uses' =>'HomeController@viewCategory']);

		Route::get('post/create',['as' => 'createPost' ,'uses' => 'PostController@createPost']);
		Route::get('mypost',['as' => 'user.post' ,'uses' => 'PostController@myPost']);
		Route::post('post/store', ['as' => 'storePost' ,'uses' => 'PostController@storePost']);
		Route::get('post/{pid}/edit',['as'=>'editPost' ,'uses'=>'PostController@edit']);
		Route::patch('post/{pid}/update',['as' => 'postUpdate','uses' =>'PostController@update']);
		Route::get('post/{pid}/details',['as' =>'individualPostDetails','uses' =>'HomeController@details']);
		Route::get('post/{pid}/delete',['as' =>'delete.post','uses' =>'PostController@postDelete']);

		Route::get('cat/{cid}/post/{pid}/details',['as'=>'postDetails','uses'=>'HomeController@postDetails']);
		Route::post('commentStore',['as'=>'commentStore','uses' =>'CommentController@commentStore']);
		Route::post('search=',['as'=>'blog.search','uses' =>'HomeController@blogSearch']);

		Route::get('blank',function(){
			return view('blank.b');
		});
		Route::post('blank/store','AdminController@valid');

			

});
		
