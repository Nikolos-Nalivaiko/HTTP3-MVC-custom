<?php

declare(strict_types=1);

namespace App\Middlewares;

use Core\Request;
use Core\Response;
use App\Services\Authenticator;

class UserMiddleware
{ 
    protected $auth;

    public function __construct()
    {
        $this->auth = new Authenticator();        
    }

    public function handle(Request $request, Response $response, $next)
    {
        if($this->auth->check())
        {
            $request->set('user', $this->auth->user());
        } 
        return $next($request, $response);
    }
}