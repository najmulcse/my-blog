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


});

Route::group(['middlewaregroups' =>['web']],function(){
		Route::auth();
		Route::get('/', 'HomeController@index');
		Route::get('blank',function(){
			return view('blank.b');
		});
		Route::post('blank/store','AdminController@valid');

			

});
		
