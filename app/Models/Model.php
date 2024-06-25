<?php

declare(strict_types=1);

namespace App\Models;

use Core\Database;

abstract class Model
{
    protected ?Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }
}