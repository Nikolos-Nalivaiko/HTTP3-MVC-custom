<?php

declare(strict_types=1);

namespace App\Services;

class Cookie
{
    public function set(string $name, string $value, int $expiry = 2592000, string $path = '/'): void
    {
        setcookie($name, $value, time() + $expiry, $path);
    }

    public function get(string $name): ?string
    {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }

    public function delete(string $name, string $path = '/'): void
    {
        if (isset($_COOKIE[$name])) {
            setcookie($name, '', time() - 2592000, $path);
            unset($_COOKIE[$name]);
        }
    }
}
