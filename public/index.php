<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Kernel;
use Core\Router;
use Core\Request;
use Core\Response;
use Core\Route;
use Core\View;

$config = require __DIR__ . '/../config/views.php';
View::init($config);

$router = new Router;
$request = new Request;
$response = new Response;

Route::init($router);

require_once __DIR__ . '/../routes/web.php';

$kernel = new Kernel($router, $request, $response);

$kernel->addMiddleware(App\Middlewares\UserMiddleware::class);

$kernel->handle();