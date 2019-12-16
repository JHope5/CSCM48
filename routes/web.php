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

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/users', function() {
    return view('users');
});*/

//Route::get('/users', 'UserController@index');

//Route::get('/users/{id}', 'UserController@show');

//Route::get('/users/{id}/posts', 'UserController@posts');

Route::resource('/users', 'UserController');

Route::resource('/posts', 'PostController');

Route::get('/contact', function() {
    return view('contact');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

