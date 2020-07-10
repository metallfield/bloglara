<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::resource('post', 'PostsController');
Route::resource('tag', 'TagsController');
Route::get('/', 'PostsController@index')->name('post.index');
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/admin/posts', 'AdminController@posts')->name('admin_posts');
Route::get('/admin/tags', 'AdminController@tags')->name('admin_tags');

Auth::routes();

Route::get('/users', 'UserController@index')->name('users');
Route::get('/user/{user}', 'UserController@show')->name('user.show');

