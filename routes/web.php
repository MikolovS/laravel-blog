<?php
declare( strict_types = 1 );

Route::get('', 'HomeController@index');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

	Route::get('profile', 'Thread\ThreadController@getUserThreads')
	     ->name('profile');
	Route::get('threads', 'Thread\ThreadController@getFeed')
	     ->name('threads');
	Route::group(['prefix' => 'thread'], function () {
		Route::get('{thread}', 'Thread\ThreadController@getThreadWithReplies')
		     ->name('thread_with_replies');
		Route::group(['middleware' => 'checkCanModifyThread'], function () {
			Route::get('edit/{thread}', 'Thread\ThreadController@get')
			     ->name('edit_thread');
			Route::post('edit/{thread}', 'Thread\ThreadController@update')
			     ->name('update_thread');
			Route::post('delete/{thread}', 'Thread\ThreadController@delete')
			     ->name('delete_thread');
		});
		Route::get('create', 'Thread\ThreadController@getForm');
		Route::post('create', 'Thread\ThreadController@create');
	});
	Route::group(['prefix' => 'reply'], function () {
		Route::post('create', 'ReplyController@create')
		     ->name('create_reply');
	});
});