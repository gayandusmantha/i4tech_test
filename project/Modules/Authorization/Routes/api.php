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

Route::POST('backend/validate', 'AuthorizationController@validateToken');
Route::POST('backend/login',  'LoginController@login');
Route::GET('backend/login',  'LoginController@login')->name('login-screen');
Route::middleware('auth:api')->prefix('authorization')->group(function () {
    Route::POST('logout',  'LoginController@logout');
});
