<?php

declare(strict_types=1);

namespace App\Services;

class HasherService
{
    public function hash(string $password) :string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}