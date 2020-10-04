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

Auth::routes();
Route::get('/', 'PostsController@index');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/my-posts', 'PostsController@getPostsOfAuthUser')->name('myposts');

});
Route::resource('posts', 'PostsController')->except('show');
