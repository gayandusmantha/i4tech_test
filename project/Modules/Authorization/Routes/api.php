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

//Route::middleware('auth:api')->get('/authorization', function (Request $request) {
//    return $request->user();
//});


Route::POST('backend/validate', 'AuthorizationController@validateToken');
Route::POST('backend/login',  'LoginController@login');
Route::GET('backend/login',  'LoginController@login')->name('login-screen');
Route::middleware('auth:api')->prefix('authorization')->group(function () {
    Route::prefix('permission')->group(function () {
     //   Route::GET('list', 'PermissionController@index');//->middleware('permission:authorization.permission.list');
     //   Route::POST('store', 'PermissionController@store');//->middleware('permission:authorization.permission.store');
    });

    Route::prefix('registration')->group(function () {
        Route::GET('list', 'RegisterController@index');//->middleware('permission:authorization.registration.list');
        Route::POST('store', 'RegisterController@create');//->middleware('permission:authorization.registration.store');
        Route::POST('change-password', 'RegisterController@changePassword');//->middleware('permission:authorization.registration.store');
        Route::GET('show/{id}', 'RegisterController@show');//->middleware('permission:authorization.registration.show');
        Route::POST('update/{id}', 'RegisterController@update');//->middleware('permission:authorization.registration.update');
    });

    Route::prefix('role')->group(function () {
         Route::GET('list', 'RoleController@index');//->middleware('permission:authorization.role.list');
         Route::POST('store', 'RoleController@store');//->middleware('permission:authorization.role.store');
         Route::GET('show/{id}', 'RoleController@show');//->middleware('permission:authorization.role.show');
         Route::POST('update/{id}', 'RoleController@update');//->middleware('permission:authorization.role.update');
    });

});
