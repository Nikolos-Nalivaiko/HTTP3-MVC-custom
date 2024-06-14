<?php

use App\Middlewares\AuthMiddleware;

$router->get('', 'HomeController@index');

$router->get('sign-up/select', 'AccountController@select');
$router->get('sign-up/user', 'AccountController@signUpUser');
$router->post('sign-up/user', 'AccountController@signUpUser');

$router->get('cargo/create', 'CargoController@create', [AuthMiddleware::class]);

$router->get('sign-in', 'AccountController@signIn');