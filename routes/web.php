<?php

use core\Route;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\GuestMiddleware;

Route::get('', 'HomeController@index');

Route::get('sign-in', 'AccountController@signIn', [GuestMiddleware::class]);
Route::post('sign-in', 'AccountController@signIn');

Route::get('sign-up/select', 'AccountController@select', [GuestMiddleware::class]);

Route::get('sign-up/user', 'AccountController@showSignUpUser', [GuestMiddleware::class]);
Route::post('sign-up/user', 'AccountController@showSignUpUser');

Route::post('create/user', 'AccountController@registerUser');
Route::post('uploadImage/user', 'AccountController@uploadImageUser');

Route::post('geo', 'GeoController@geography');

Route::get('cargo/create', 'CargoController@create', [AuthMiddleware::class]);