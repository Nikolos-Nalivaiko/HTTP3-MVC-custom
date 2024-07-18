<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\Request;
use Core\Response;
use Core\View;

class HomeController
{

    public function index(Request $request, Response $response) 
    {
        
        return View::view('home/index', [
            'title' => 'HTTP - Home page',
            'user' => $request->getBodyParam('user') 
        ]);

    }

}
