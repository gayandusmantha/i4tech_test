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

Route::middleware('auth:api')->prefix('/project')->group(function () {
    Route::GET('lit', 'ProjectController@show')->middleware('role:administrator|manager');;
    Route::GET('dropdown', 'ProjectController@dropdown')->middleware('role:administrator|manager');;
    Route::POST('create', 'ProjectController@create')->middleware('role:administrator');
});
