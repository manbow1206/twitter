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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//NOTE: 投稿一覧　名前:top
Route::get('/', 'PostsController@index')->name('top');
//NOTE: 投稿機能関連
Route::resource('posts', 'PostsController', ['only' => ['create', 'store','show','edit','update','destroy']]);
//NOTE: コメント機能
Route::resource('comments', 'CommentsController', ['only' => ['store']]);
//TODO: ユーザー一覧 -> フォーロー機能追加
Route::get('/users/index','UsersController@index');
//Auth
Auth::routes();
//NOTE: 自分のプロフィール表示
Route::get('profile', 'PostsController@profile')->name('profile');


//TODO: フォーロー機能途中
Route::post('follow/create','LikeController@create')->name('like');
Route::post('follow/delete','LikeController@delete')->name('unlike');
