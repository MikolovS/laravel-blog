<?php
declare( strict_types = 1 );

Route::get('', 'HomeController@index');

Auth::routes();

Route::group(['middleware' => 'auth'], function (){
	Route::get('/profile', 'HomeController@profile');
});