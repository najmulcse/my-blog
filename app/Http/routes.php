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
		Route::get('post/create',['as' => 'createPost' ,'uses' => 'AdminController@createPost']);
		Route::post('post/store', ['as' => 'storePost' ,'uses' => 'PostController@storePost']);
		Route::get('allposts',['as' => 'allPostAdmin','uses' => 'PostController@allPostSeeByAdmin']);
		Route::get('post/{pid}/edit',['as'=>'editPost' ,'uses'=>'PostController@edit']);
		Route::patch('post/{pid}/update',['as' => 'postUpdate','uses' =>'PostController@update']);
		Route::get('post/{pid}/details',['as' =>'individualPostDetails','uses' =>'PostController@details']);
		Route::get('categoryEditAjax',['as' => 'cat_ajax','uses'=>'PostController@categoryEditAjax']);

});

Route::group(['middlewaregroups' =>['web']],function(){
		Route::auth();
		Route::get('/', 'HomeController@index');
		Route::get('category/{cid}/view',['as' =>'viewCategory','uses' =>'PostController@viewCategory']);
		Route::get('blank',function(){
			return view('blank.b');
		});
		Route::post('blank/store','AdminController@valid');

			

});
		
