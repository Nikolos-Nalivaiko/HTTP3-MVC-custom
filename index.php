<?php

require_once __DIR__ . '/vendor/autoload.php';

use Core\Kernel;
use Core\Router;
use Core\Request;
use Core\Response;

$router = new Router;
$request = new Request;
$response = new Response;

// Імпортуйте маршрути
require_once __DIR__ . '/routes/web.php';

$kernel = new Kernel($router, $request, $response);

$kernel->addMiddleware(App\Middlewares\UserMiddleware::class);

$kernel->handle();