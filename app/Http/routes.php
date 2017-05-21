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

Route::group(['middeware' => ['web']], function() {

	Route::get('/', [
		'uses' => 'PostController@getBlogIndex',
		'as' => 'blog.index'
	]);

	Route::get('/blog', [
		'uses' => 'PostController@getBlogIndex',
		'as' => 'blog.index'
	]);

	Route::get('/blog/{post_id}&{end}', [
		'uses' => 'PostController@getSinglePost',
		'as' => 'blog.single'
	]);

	/*Other Routes*/

	Route::get('/about', function() {	//No need for controller as we have to just return the view
		return view('frontend.other.about');	
	})->name('about');

	Route::get('/contact', [
		'uses' => 'ContactMessageController@getContactIndex',
		'as' => 'contact'
	]);

	Route::post('/contact/sendmail', [
		'uses' => 'ContactMessageController@postSendMessage',
		'as' => 'contact.send'
	]);

	Route::get('/admin/login', [				//generally get is used for click in a tag
		'uses' => 'AdminController@getLogin',
		'as' => 'admin.login'
	]);

	Route::post('/admin/login', [				//post is used after form is submit
		'uses' => 'AdminController@postLogin',
		'as' => 'admin.login'
	]);

	Route::group([ 						/*have created group for /admin, written admin routes here*/
		'prefix' => '/admin'
	], function() {

		Route::get('/', [
			'uses' => 'AdminController@getIndex',
			'as' => 'admin.index'
		]);

		Route::get('/logout', [
			'uses' => 'AdminController@getLogout',
			'as' => 'admin.logout'
		]);

		Route::get('/blog/posts', [
			'uses' => 'PostController@getPostIndex',
			'as' => 'admin.blog.index'
		]);

		Route::get('/blog/categories', [
			'uses' => 'CategoryController@getCategoryIndex',
			'as' => 'admin.blog.categories'

		]);

		Route::get('/blog/post/{post_id}&{end}', [
			'uses' => 'PostController@getSinglePost',
			'as' => 'admin.blog.post'
		]);

		Route::get('/blog/posts/create', [
			'uses' => 'PostController@getCreatePost',
			'as' => 'admin.blog.create_post'
		]);

		Route::post('/blog/post/create', [
			'uses' => 'PostController@postCreatePost',
			'as' => 'admin.blog.post.create'
		]);

		Route::post('/blog/category/create', [			//This route is received from ajax from categories.js
			'uses' => 'CategoryController@postCreateCategory',
			'as' => 'admin.blog.category.create'
		]);

		Route::get('/blog/post/{post_id}/edit', [
			'uses' => 'PostController@getUpdatePost',
			'as' => 'admin.blog.post.edit'
		]);

		Route::post('/blog/post/update', [
			'uses' => 'PostController@postUpdatePost',
			'as' => 'admin.blog.post.update'
		]);

		Route::post('/blog/categories/update', [	//url given in ajax update i.e. in saveEdit 												in categories.js i.e line 67
			'uses' => 'CategoryController@postUpdateCategory',
			'as' => 'admin.blog.category.update'

		]);

		Route::get('/blog/post/{post_id}/delete', [
			'uses' => 'PostController@getDeletePost',
			'as' => 'admin.blog.post.delete'
		]);

		Route::get('/blog/category/{category_id}/delete', [
			'uses' => 'CategoryController@getDeleteCategory',
			'as' => 'admin.blog.category.delete'
		]);

		Route::get('/contact/messages', [
			'uses' => 'ContactMessageController@getContactMessageIndex',
			'as' => 'admin.contact.index'
		]);

		Route::get('/contact/message/{message_id}/delete', [
			'uses' => 'ContactMessageController@getDeleteMessage',
			'as' => 'admin.contact.delete'
		]);
	});



});














/*Route::get('login', 'AdminController@login');
Route::post('login', 'AdminController@login');

Route::get('signup', 'AdminController@signup');
Route::post('signup', 'AdminController@signup');
Route::get('/edit/{id}','AdminController@edit');
Route::post('update', 'AdminController@update');

Route::get('/home','AdminController@home');
Route::post('home', 'AdminController@home');

Route::get('/delete/{id}','AdminController@delete');
Route::get('logout', 'AdminController@logout');
*/


