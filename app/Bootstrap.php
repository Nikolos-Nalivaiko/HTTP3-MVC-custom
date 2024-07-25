<?php

declare(strict_types=1);

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Kernel;
use Core\Router;
use Core\Request;
use Core\Response;
use Core\Route;
use Core\View;

class Bootstrap
{
    protected Kernel $kernel;

    public function __construct()
    {
        $this->initializeServices();
    }

    protected function initializeServices() :void
    {
        $config = require __DIR__ . '/../config/views.php';
        View::init($config);

        $router = new Router;
        $request = new Request;
        $response = new Response;

        Route::init($router);

        require_once __DIR__ . '/../routes/web.php';

        $this->kernel = new Kernel($router, $request, $response);

        $this->kernel->addMiddleware(\App\Middlewares\UserMiddleware::class);
    }

    public function handle() :void
    {
        $this->kernel->handle();
    }
}