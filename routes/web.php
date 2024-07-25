<?php

use core\Route;

Route::get('', 'HomeController@index');

Route::get('sign-in', 'AccountController@signInShow');
Route::post('sign-in', 'AccountController@signIn');

Route::get('sign-up/select', 'AccountController@select');

Route::get('sign-up/user', 'AccountController@showSignUpUser');
Route::post('sign-up/user', 'AccountController@showSignUpUser');

Route::post('create/user', 'AccountController@registerUser');
Route::post('uploadImage/user', 'AccountController@uploadImageUser');