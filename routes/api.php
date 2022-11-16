<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// AUTH ROUTES
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('password/forget', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('password/check-opt', 'Auth\ForgotPasswordController@checkOPT');
Route::post('password/reset', 'Auth\ForgotPasswordController@changePassword');

Route::middleware('auth:api')->group( function () {
    Route::get('details', 'Auth\LoginController@authenticatedUserDetails');


    Route::resource('users', 'UserController');
    Route::resource('posts', 'PostController');

});


