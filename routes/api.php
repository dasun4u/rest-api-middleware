<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'api_service'], function () {
    Route::post('/token_generate', 'AuthController@tokenGenerate');
    Route::any('{group_context}/{service_context}/{any}', 'ProxyController@proxyCall')->where('any', '.*');
});