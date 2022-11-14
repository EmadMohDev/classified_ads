<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// AUTH ROUTES
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('password/forget', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\ForgotPasswordController@changePassword');

Route::middleware('auth:api')->group( function () {

    /********************************** START AUTH API ROUTES *********************************************/
    Route::post('save-mobile-token','Auth\LoginController@saveMobileToken');
    Route::get('details', 'Auth\LoginController@authenticatedUserDetails');
    Route::post('refresh_token', 'Auth\LoginController@refresh');
    Route::post('logout', 'Auth\LogoutController@logout');
    /********************************** END AUTH API ROUTES *********************************************/


    Route::resource('users', 'UserController');

});


