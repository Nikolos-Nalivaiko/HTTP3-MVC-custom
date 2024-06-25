<?php

// В цілому виглядає нормально. Але по ідеї цей файл повинен в тебе бути в папці public, щоб з інтернету не могли постучатись в корінні файли (там де в тебе зазвичай і лежать env файли)

require_once __DIR__ . '/vendor/autoload.php';

use Core\Kernel;
use Core\Router;
use Core\Request;
use Core\Response;

$router = new Router;
$request = new Request;
$response = new Response;

// Імпортуйте маршрути // Пахне ChatGPT :)
require_once __DIR__ . '/routes/web.php';

$kernel = new Kernel($router, $request, $response);

$kernel->addMiddleware(App\Middlewares\UserMiddleware::class);

$kernel->handle();