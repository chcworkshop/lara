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
    return redirect()->route('posts.index');
});

Auth::routes();

/*
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
*/

Route::group(['prefix' => 'posts'],function() {
    Route::get('/', 'PostsController@index')->name('posts.index');
    Route::get('/create', 'PostsController@create')->name('posts.create')->middleware('auth');
    Route::post('/store', 'PostsController@store')->name('posts.store')->middleware('auth');
    Route::get('/{post}/show', 'PostsController@show')->name('posts.show');
    Route::get('/{post}/edit', 'PostsController@edit')->name('posts.edit')->middleware('auth');
    Route::patch('/{post}', 'PostsController@update')->name('posts.update')->middleware('auth');
    Route::delete('/{post}', 'PostsController@destroy')->name('posts.destroy')->middleware('auth');
    
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('posts/{post_id}/edit', 'PostsController@edit')->name('posts.edit');
Route::get('/first', function () {
    return view('index', ['name' => 'jack', 'title' => 'my title']);
})->name('first');

Route::get('/jump', function () {
    return redirect()->route('first');
});
Route::get('/show', function () {
    $url = route('first');
    return $url;
});
