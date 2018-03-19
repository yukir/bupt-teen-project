<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| 解析路径的大括号中的参数必须使用英文，但与后面的变量名无关。
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

//活动类
Route::resource('activity','ActivityController');

//评论
Route::post('/activity/{activity}/comment', 'CommentController@store')->name('comment.create');
Route::put('/comment/{comment}', 'CommentController@update')->name('comment.update');
Route::delete('/comment/{comment}', 'CommentController@delete')->name('comment.destroy');