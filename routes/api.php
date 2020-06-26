<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

/*
|--------------------------------------------------------------------------
| API Version 1
|--------------------------------------------------------------------------
|
| Currently our version is V1
| All routes are in v1
|
*/

Route::group(['prefix' => 'v1'], function () {
    // make your routes
/*
|--------------------------------------------------------------------------
| Make auth routes so we have to make a group with auth
|--------------------------------------------------------------------------
*/
    Route::group(['prefix' => 'auth'], function () {
    /*
    |--------------------------------------------------------------------------
    | @route  Post api/v1/login
    | @desc   Login
    | @access Public
    |--------------------------------------------------------------------------
     */
        Route::post('login', 'Auth\AuthController@login');
    /*
    |--------------------------------------------------------------------------
    | @route  Post api/v1/Register
    | @desc   Register the user
    | @access Public
    |--------------------------------------------------------------------------
    */
        Route::post('register', 'Auth\AuthController@register');
    });
});