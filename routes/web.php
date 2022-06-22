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

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);
Route::get('/', 'HomeController@index')->name('home');
Route::get('/login/{provider}', '\App\Http\Controllers\Auth\LoginController@redirectToProvider')->where('provider', 'google|twitter');
Route::get('/login/{provider}/callback', '\App\Http\Controllers\Auth\LoginController@callbackFromProvider')->where('provider', 'google|twitter');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->middleware('auth');

Route::get('/board', '\App\Http\Controllers\BoardController@index')->middleware('auth');

Route::post('/capture', '\App\Http\Controllers\CaptureController@index');
Route::get('/create/prepare', '\App\Http\Controllers\PrecreateController@index');
Route::get('/create/board', '\App\Http\Controllers\PrecreateController@board')->middleware('auth');

Route::resource('/post','\App\Http\Controllers\PostController', ['only'=>['create', 'store', 'show', 'update', 'destroy']])->middleware('auth');
Route::resource('/user','\App\Http\Controllers\UserController', ['only'=>['show', 'edit', 'update', 'destroy']])->middleware('auth');
Route::resource('/comment','\App\Http\Controllers\CommentController', ['only'=>['store']])->middleware('auth');

Route::post('/relationship/follow', '\App\Http\Controllers\RelationshipController@follow');
Route::post('/relationship/unfollow', '\App\Http\Controllers\RelationshipController@unfollow');
Route::get('/relationship/follow/{id}', '\App\Http\Controllers\RelationshipController@followList');
Route::get('/relationship/follower/{id}', '\App\Http\Controllers\RelationshipController@followerList');

Route::get('/like/{postId}', '\App\Http\Controllers\LikeController@add');
Route::get('/unlike/{postId}', '\App\Http\Controllers\LikeController@remove');