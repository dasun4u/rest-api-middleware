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

// Auth routes
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', 'Controller@home')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('home', 'Admin\HomeController@index')->name('admin_home');
    Route::resource('users', 'Admin\UserController');
    Route::get('users/changeStatus/{id}/{status}', 'Admin\UserController@changeStatus');
});