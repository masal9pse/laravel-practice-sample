<?php
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
 error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
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

Auth::routes();

Route::get('/', 'SongController@index')->name('songs.index');
Route::resource('/songs', 'SongController')->only(['show', 'store']);
Route::resource('/tags', 'TagController', ['only' => ['index', 'create', 'show', 'edit']]);
Route::resource('/problems', 'ProblemController')->only(['store']);
Route::resource('/user', 'UserController');

Route::group(['middleware' => 'auth:user'], function () {
 Route::resource('/songs', 'SongController', ['except' => ['index', 'create', 'store', 'show']]);
 Route::resource('/comments', 'CommentController');
 Route::post('/tags/destroy/{id}', 'TagController@destroy')->name('tags.destroy');
 Route::post('/tags/update/{id}', 'TagController@update')->name('tags.update');
});
/*
|--------------------------------------------------------------------------
| 3) Admin 認証不要
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function () {
 Route::get('/', function () {
  return redirect('/admin/create');
 });
 Route::get('login',     'Admin\LoginController@showLoginForm')->name('admin.login');
 Route::post('login',    'Admin\LoginController@login');
});
/*
|--------------------------------------------------------------------------
| 4) Admin ログイン後
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
 Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
 Route::get('create', 'Admin\SongController@create')->name('admin.create');
 Route::get('show/{id}', 'Admin\SongController@show')->name('admin.show');
 Route::post('store', 'Admin\SongController@store')->name('admin.store');
 Route::get('edit/{id}', 'Admin\SongController@edit')->name('admin.edit');
 Route::post('destroy/{id}', 'Admin\SongController@destroy')->name('admin.destroy');
 Route::post('update/{id}', 'Admin\SongController@update')->name('admin.update');
 Route::resource('/tags', 'TagController', ['only' => ['destroy', 'update', 'store']]);
});
