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

Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin'], 'namespace'=>'Admin'], function () {
    Route::get('home', 'HomeController@index')->name('admin_home');
    Route::resource('users', 'UserController');
    Route::get('users/changeStatus/{id}/{status}', 'UserController@changeStatus');
    Route::resource('applications', 'ApplicationController');
    Route::get('applications/changeStatus/{id}/{status}', 'ApplicationController@changeStatus');
    Route::get('applications/changeApprove/{id}/{status}', 'ApplicationController@changeApprove');
    Route::get('applications/generateKeys/{scope}', 'ApplicationController@generateKeys');
    Route::resource('serviceGroups', 'ServiceGroupController');
    Route::get('serviceGroups/changeStatus/{id}/{status}', 'ServiceGroupController@changeStatus');
});