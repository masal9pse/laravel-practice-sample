<?php

//use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['api']], function () {
 Route::resource('user', 'Api\UserController', ['except' => ['create', 'edit']]);
 Route::post('/books', 'Api\UserController@book_store')->name('books.book_store');
 Route::post('/user/{song}/like', 'Api\UserController@like');
 Route::post('/user/{song}/unlike', 'Api\UserController@unlike');
 Route::get('/index', 'Api\SongController@index');
 Route::post('/store', 'Api\SongController@store');
 Route::post('/file_request', 'Api\SongController@fileRequest');
 Route::post('/posts/{song}/delete', 'Api\SongController@destroy');
 Route::post('/posts/{song}/like', 'Api\LikesController@like');
 Route::post('/posts/store', 'Api\SongController@store');
 Route::post('/posts/{song}/unlike', 'Api\LikesController@unlike');
 Route::get('/gets/index', 'Api\LikesController@index');
 Route::get('/gets/{song}/show', 'Api\LikesController@show');
});
