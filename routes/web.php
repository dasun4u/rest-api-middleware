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
    Route::get('serviceGroups/getServicesByGroupID/{id}', 'ServiceGroupController@getServicesByGroupID');
    Route::resource('services', 'ServiceController');
    Route::get('services/changeStatus/{id}/{status}', 'ServiceController@changeStatus');
    Route::get('services/changeApprove/{id}/{status}', 'ServiceController@changeApprove');
    Route::resource('subscriptions', 'SubscriptionController');
    Route::get('subscriptions/changeApprove/{id}/{status}', 'SubscriptionController@changeApprove');
    Route::resource('messages', 'MessageController');
    Route::get('messages/sendMessages/showList', 'MessageController@sendMessages');
    Route::get('messages/sendMessages/{id}', 'MessageController@sendMessageShow');
});

Route::group(['prefix' => 'developer', 'middleware' => ['auth','developer'], 'namespace'=>'Developer'], function () {
    Route::get('home', 'HomeController@index')->name('developer_home');
    Route::resource('applications', 'ApplicationController');
    Route::get('applications/changeStatus/{id}/{status}', 'ApplicationController@changeStatus');
    Route::get('applications/generateKeys/{scope}', 'ApplicationController@generateKeys');
    Route::resource('serviceGroups', 'ServiceGroupController');
    Route::get('serviceGroups/changeStatus/{id}/{status}', 'ServiceGroupController@changeStatus');
    Route::get('serviceGroups/getServicesByGroupID/{id}', 'ServiceGroupController@getServicesByGroupID');
    Route::resource('services', 'ServiceController');
    Route::get('services/changeStatus/{id}/{status}', 'ServiceController@changeStatus');
    Route::resource('subscriptions', 'SubscriptionController');
    Route::resource('messages', 'MessageController');
    Route::get('messages/sendMessages/showList', 'MessageController@sendMessages');
    Route::get('messages/sendMessages/{id}', 'MessageController@sendMessageShow');
});