<?php

declare(strict_types=1);

namespace App\Middlewares;

use Core\Request;
use Core\Response;
use App\Services\Authenticator;
use Core\View;

class AuthMiddleware
{
    protected $auth;

    public function __construct()
    {
        $this->auth = new Authenticator();        
    }

    public function handle(Request $request, Response $response, $next) :Response 
    {
        return $this->auth->check()
        ? $next($request, $response)
        : View::errorCode(403);
    }
}