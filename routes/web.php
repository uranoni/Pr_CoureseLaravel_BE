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
    Route::get('/posts/admin','PostController@admin');
    Route::get('/posts/create','PostController@create');
    Route::get('/posts/show/{post}','PostController@show');


    Route::post('/posts','PostController@store');
    Route::get('/posts/{post}','PostController@show');
    Route::put('/posts/{post}','PostController@update');
    Route::delete('/posts/{post}','PostController@destory');
});


Route::get('/posts/{post}/edit','PostController@edit');
Route::get('/posts','PostController@index');
Route::get('/posts/{post}','PostController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
