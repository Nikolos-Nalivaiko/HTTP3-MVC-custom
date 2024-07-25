<?php

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

    public function handle(Request $request, Response $response, $next)
    {
        if(!$this->auth->check())
        {
            View::errorCode(403);
        }
        return $next($request, $response);
    }
}