<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('admin')->group(function () {
    
	Route::get('/', [
		'uses'	=>	'AdminController@index',
		'as'	=>	'admin.index'
		]);

	Route::get('/users', [
		'uses'	=>	'AdminController@userindex',
		'as'	=>	'admin.user.index'
		]);

	Route::get('/user/{user}', [
		'uses'	=>	'AdminController@useredit',
		'as'	=>	'admin.user.edit'
		]);

	Route::put('/user/{user}', [
		'uses'	=>	'AdminController@userupdate',
		'as'	=>	'admin.user.update'
		]);

	Route::get("/roles", [
		'uses'	=>	'AdminController@roleindex',
		'as'	=>	'admin.roles.index'
		]);

	Route::get('/role/create', [
		'uses'	=>	'AdminController@rolecreate',
		'as'	=>	'admin.role.create'
		]);

	Route::post('/role/create', [
		'uses'	=>	'AdminController@rolestore',
		'as'	=>	'admin.role.store'
		]);

	Route::delete('/role/{role}', [
		'uses'	=>	'AdminController@roledelete',
		'as'	=>	'admin.role.destory'
		]);

	Route::get('/permissions', [
		'uses'	=>	'AdminController@permissionindex',
		'as'	=>	'admin.permission.index'
		]);

	Route::get('/permissions/create', [
		'uses'	=>	'AdminController@permissioncreate',
		'as'	=>	'admin.permission.create'
		]);

	Route::post('/permissions/create', [
		'uses'	=>	'AdminController@permissionstore',
		'as'	=>	'admin.permission.store'
		]);

	Route::delete('/permissions/{permission}', [
		'uses'	=>	'AdminController@permissiondelete',
		'as'	=>	'admin.permission.destroy'
		]);

	Route::get('/sliders', [
		'uses'	=>	'AdminController@sliderindex',
		'as'	=>	'admin.slider.index'
		]);

	Route::post('/sliders', [
		'uses'	=>	'AdminController@sliderpost',
		'as'	=>	'admin.slider.post'
		]);

	Route::get('/slider/{slider}', [
		'uses'	=>	'AdminController@slideredit',
		'as'	=>	'admin.slider.edit'
		]);

	Route::put('/slider/{slider}', [
		'uses'	=>	'AdminController@sliderupdate',
		'as'	=>	'admin.slider.update'
		]);

	Route::delete('/slider/{slider}', [
		'uses'	=>	'AdminController@sliderdelete',
		'as'	=>	'admin.slider.delete'
		]);


	Route::get('/blogs', [
		'uses'	=>	'AdminController@blogindex',
		'as'	=>	'admin.blog.index'
		]);

	Route::post('/blogs', [
		'uses'	=>	'AdminController@blogpost',
		'as'	=>	'admin.blog.post'
		]);

	Route::get('/blog/{blog}/edit', [
		'uses'	=>	'AdminController@blogedit',
		'as'	=>	'admin.blog.edit'
		]);

	Route::put('/blog/{blog}/edit', [
		'uses'	=>	'AdminController@blogeditupdate',
		 'as'	=>	'admin.blog.update'
		]);

	Route::delete('/blogs/{blog}', [
		'uses'	=>	'AdminController@blogdelete',
		'as'	=>	'admin.blog.delete'
		]);

	Route::get('/tags/blog', [
		'uses'	=>	'AdminController@tagblogindex',
		'as'	=>	'admin.tag.blog.index'
		]);

	Route::post('/tags/blog/', [
		'uses'	=>	'AdminController@tagblogpost',
		'as'	=>	'admin.tag.blog.post'
		]);

	Route::put('/tags/blog/{tag}', [
		'uses'	=>	'AdminController@tagblogedit',
		'as'	=>	'admin.tag.blog.edit'
		]);

	Route::delete('/tags/blog/{tag}', [
		'uses'	=>	'AdminController@tagblogdelete',
		'as'	=>	'admin.tag.blog.delete'
		]);

	Route::get('/portfolios', [
		'uses'	=>	'AdminController@portfolioindex',
		'as'	=>	'admin.portfolio.index'
		]);

	Route::post('/portfolios', [
		'uses'	=>	'AdminController@portfoliopost',
		'as'	=>	'admin.portfolio.post'
		]);

	Route::put('/portfolios/{image}', [
		'uses'	=>	'AdminController@portfolioupdate',
		'as'	=>	'admin.portfolio.update'
		]);

	Route::delete('/portfolios/{image}', [
		'uses'	=>	'AdminController@portfoliodelete',
		'as'	=>	'admin.portfolio.delete'
		]);

	/**
	 * Route's for Video's
	 */
	Route::get('/videos', [
		'uses'	=>	'AdminController@videoindex',
		'as'	=>	'admin.video.index'
	]);

	Route::post('/videos', [
		'uses'	=>	'AdminController@videopost',
		'as'	=>	'admin.video.post'
	]);

	Route::delete('/videos/{video}', [
		'uses'	=>	'AdminController@videodelete',
		'as'	=>	'admin.video.delete'
	]);

	/**
	 * Trash Route for blogs
	 */
	Route::get('/blogtrash', [
		'uses'	=>	'AdminController@blogtrashindex',
		'as'	=>	'admin.blog.trash.index'
		]);

	Route::post('/blogtrash/restore/{blog}', [
		'uses'	=>	'AdminController@blogtrashrestore',
		'as'	=>	'admin.blog.restore'
		]);

	Route::delete('/blogtrash/permadelete/{blog}', [
		'uses'	=>	'AdminController@blogtrashpermadelete',
		'as'	=>	'admin.blog.permadelete'
	]);

	/**
	 * Trash for Slider's
	 */
	Route::get('/slidertrash', [
		'uses'	=>	'AdminController@slidertrashindex',
		'as'	=>	'admin.slider.trash.index'
		]);

	Route::post('/slidertrash/restore/{slider}', [
		'uses'	=>	'AdminController@sliderrestore',
		'as'	=>	'admin.slider.restore'
		]);

	Route::post('/slidertrash/parmadelete/{slider}', [
		'uses'	=>	'AdminController@sliderpermadelete',
		'as'	=>	'admin.slider.permadelete'
		]);

	/**
	 * Trash Route's for Portfolio
	 */
	Route::get('/portfoliotrash', [
		'uses'	=>	'AdminController@portfoliotrashindex',
		'as'	=>	'admin.portfolio.trash.index'
	]);

	Route::post('/portfoliotrash/restore/{portfolio}', [
		'uses'	=> 'AdminController@portfoliorestore',
		'as'	=>	'admin.portfolio.restore'
	]);

	Route::delete('/portfoliotrash/parmadelete/{portfolio}', [
		'uses'	=>	'AdminController@portfolioparmadelete',
		'as'	=>	'admin.portfolio.parmadelete'
	]);

	Route::get('/videotrash', [
		'uses'	=>	'AdminController@videotrashindex',
		'as'	=>	'admin.video.trash.index'
	]);


});


