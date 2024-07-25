<?php

namespace App\Controllers;

use Core\Request;
use Core\View;

class HomeController
{
    public function index(Request $request)
    {
        View::render('home/index', [
            'title' => 'HTTP - Home page',
            'user' => $request->getBodyParam('user') 
        ]);
    }

}
