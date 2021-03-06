<?php

use Illuminate\Http\Request;
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

date_default_timezone_set("Asia/Taipei");
Route::get('/', function () {
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/posts/admin', 'PostController@admin');
    Route::get('/posts/create', 'PostController@create');
    Route::get('/posts/show/{post}', 'PostController@showByAdmin');


    Route::post('/posts', 'PostController@store');
    Route::get('/posts/{post}', 'PostController@show');
    Route::put('/posts/{post}', 'PostController@update');
    Route::delete('/posts/{post}', 'PostController@destory');

    Route::resource('categories', 'CategoryController')->except(['show']);
    Route::resource('tags', 'TagController')->only(['index', 'destory']);
});

Route::resource('comments', 'CommentController')->only(['store', 'update', 'destory']);
Route::delete('/comments/{comment}', 'CommentController@destroy');
Route::get('/posts/{post}/edit', 'PostController@edit');
Route::get('/posts', 'PostController@index');
Route::get('/posts/category/{category}', 'PostController@indexWithCategory');
Route::get('/posts/tag/{tag}', 'PostController@indexWithTag');
Route::get('/posts/{post}', 'PostController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
