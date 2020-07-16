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

Route::get('/user/revokerole/{revoke}/{id}/{process}', 'UserController@revokerole')->name('user.revokerole')->middleware('permission:delete comment|show post');

Route::group(['prefix' => '/user', 'middleware' => ['permission:create comment']], function () {

    Route::get('/assignpermissiontouser/{user}/{permission}', 'UserController@assignpermissiontouser')->name('user.assignpermissiontouser');
    Route::get('/assignpermissiontorole/{role}/{permission}', 'UserController@assignpermissiontorole')->name('user.assignpermissiontorole');
    Route::get('/assignrole/{user}/{role}', 'UserController@assignrole')->name('user.assignrole');
});

Route::group(['middleware' => ['permission:show post|delete post']], function () {
    Route::resource('user', 'UserController')->except(['edit']);
});

Route::resource('post', 'PostController')->except(['edit'])->middleware('role:admin');
