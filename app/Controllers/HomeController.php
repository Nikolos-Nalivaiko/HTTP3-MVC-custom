<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\Request;
use Core\View;
use App\Services\Session;
use App\Services\Cookie;

class HomeController
{

    public function __construct(
        public Session $session,
        public Cookie $cookie
    ){

    }

    public function index(Request $request) :View
    {
        return View::view('home/index', [
            'title' => 'HTTP - Home page',
            'user' => $request->getBodyParam('user') 
        ]);
    }

}
