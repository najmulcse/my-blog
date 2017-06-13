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


});
		Route::get('/', function () {
		    return view('welcome');
		});
		Route::auth();
		Route::get('/home', 'HomeController@index');
		Route::get('blank',function(){
			return view('blank.b');
		});
