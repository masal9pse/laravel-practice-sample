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
 Route::post('/posts/{song}/like', 'Api\LikesController@like');
 Route::post('/posts/{song}/unlike', 'Api\LikesController@unlike');
 Route::get('/gets/index', 'Api\LikesController@index');
 Route::get('/gets/{song}/show', 'Api\LikesController@show');
});
