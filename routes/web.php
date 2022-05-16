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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login/{provider}', '\App\Http\Controllers\Auth\LoginController@redirectToProvider')->where('provider', 'google|twitter');
Route::get('/login/{provider}/callback', '\App\Http\Controllers\Auth\LoginController@callbackFromProvider')->where('provider', 'google|twitter');

Route::get('/board/{id}', '\App\Http\Controllers\BoardController@index');
Route::get('/member/json//', '\App\Http\Controllers\BoardController@getMember');

Route::post('/capture', '\App\Http\Controllers\CaptureController@index');
Route::get('/create/prepare', '\App\Http\Controllers\PrecreateController@index');
Route::get('/create/board/{id}', '\App\Http\Controllers\PrecreateController@board');

Route::resource('/post','\App\Http\Controllers\PostController');
