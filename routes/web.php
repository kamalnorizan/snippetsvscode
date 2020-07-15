<?php

use Illuminate\Support\Facades\Route;

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
// DB::listen(function ($event) {
//     dump($event->sql);
// });


Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/test/{role}/{user}', 'UserController@test')->name('user.test');
Route::get('/user/revokerole/{revoke}/{id}/{process}', 'UserController@revokerole')->name('user.revokerole');

Route::get('/user/assignpermissiontouser/{user}/{permission}', 'UserController@assignpermissiontouser')->name('user.assignpermissiontouser');

Route::get('/user/assignpermissiontorole/{role}/{permission}', 'UserController@assignpermissiontorole')->name('user.assignpermissiontorole');
Route::get('/user/assignrole/{user}/{role}', 'UserController@assignrole')->name('user.assignrole');

Route::resource('user', 'UserController')->except(['edit']);
Route::resource('post', 'PostController')->except(['edit']);
