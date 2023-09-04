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

Route::middleware('auth:api')->prefix('/task')->group(function () {
    Route::POST('create', 'TaskController@create')->middleware('role:administrator');;
    Route::POST('update/{id}', 'TaskController@update')->middleware('role:administrator');;
    Route::GET('show', 'TaskController@show')->middleware('role:administrator|manager');
});
