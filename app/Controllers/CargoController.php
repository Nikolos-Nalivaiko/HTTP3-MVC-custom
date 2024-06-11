<?php

namespace App\Controllers;

use Core\View;

class CargoController
{
    public function create()
    {
        View::render('cargo/create', ['title' => 'HTTP - Cargo Create']);
    }

}
