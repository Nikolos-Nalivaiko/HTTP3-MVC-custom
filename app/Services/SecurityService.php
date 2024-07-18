<?php

declare(strict_types=1);

namespace App\Services;

class SecurityService
{
    public function generateSalt() :string
    {
        $salt = '';
        $saltLenght = 10;

        for($i = 0; $i < $saltLenght; $i++) {
            $salt .= chr(mt_rand(33,126));
        }

        return $salt;
    }
}