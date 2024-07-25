<?php

namespace App\Controllers;

use Core\View;
use Core\Request;
use Core\Response;
use App\Services\Session;

class CargoController
{
    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function create(Request $request, Response $response)
    {

        View::render('cargo/create', [
            'title' => 'HTTP - Cargo Create',
            'user' => $request->getBodyParam('user')
        ]);
    }

}
