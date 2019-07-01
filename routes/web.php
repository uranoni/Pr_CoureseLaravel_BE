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

Route::get('/', function () {
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

// Route::get('/posts', function () {
//     $posts=[1,2,3,4,5];
//     return view('posts.list',['posts'=>$posts]);
// });

// Route::get('/posts/{id}', function ($id) {
//     return view('posts.show');
// });

Route::get('/posts/admin','PostController@admin');
//提前擺放路由 會先找create 沒有metch 會往下找post show 的部分
Route::get('/posts/create','PostController@create');
Route::get('/posts/show/{post}','PostController@show');

//CRUD
//3 rountion
//路由 由上往下找
Route::post('/posts','PostController@store');
Route::get('/posts/{post}','PostController@show');
Route::put('/posts/{post}','PostController@update');
Route::delete('/posts/{post}','PostController@destory');


Route::get('/posts/{post}/edit','PostController@edit');
Route::get('/posts','PostController@index');
