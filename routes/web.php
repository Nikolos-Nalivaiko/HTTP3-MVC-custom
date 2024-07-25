<?php

use App\Middlewares\AuthMiddleware;
use App\Middlewares\GuestMiddleware;

$router->get('', 'HomeController@index');

$router->get('sign-up/select', 'AccountController@select', [GuestMiddleware::class]);
$router->get('sign-up/user', 'AccountController@signUpUser', [GuestMiddleware::class]);
$router->post('sign-up/user', 'AccountController@signUpUser');

$router->get('cargo/create', 'CargoController@create', [AuthMiddleware::class]);

$router->get('sign-in', 'AccountController@signIn', [GuestMiddleware::class]);
$router->post('sign-in', 'AccountController@signIn');