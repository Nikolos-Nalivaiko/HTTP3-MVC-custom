<?php

namespace Core\Middlewares;

use Core\Request;
use Core\Response;

class AuthMiddleware
{
    public function handle(Request $request, Response $response, $next)
    {
        // echo "Middleware started";
        // return $next($request, $response);
    }
}