<?php

declare(strict_types=1);

namespace App\Models;

use Core\Database;
use Core\QueryBuilder;

class Model
{
    protected $db;
    protected $queryBuilder;

    public function __construct()
    {
        $connect = Database::getInstance();
        $pdo = $connect->getPDO();
        $this->queryBuilder = new QueryBuilder($pdo);
    }
}