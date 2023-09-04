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

Route::middleware('auth:api')->prefix('settings')->group(function () {
    Route::GET('programme', 'ProgrammeController@get');
    Route::GET('programme/{id}', 'ProgrammeController@show');
    Route::GET('child', 'ChildController@index');
    Route::GET('child_dd', 'ChildController@dropdown');
    Route::GET('child/{id}', 'ChildController@show');
    Route::GET('parents', 'ParentController@index');
    Route::GET('programme_list', 'ProgrammeController@index');
});
