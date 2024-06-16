<?php

namespace App\Services;

class Cookie
{
    public function set($name, $value, $expiry = 30 * 24 * 60 * 60, $path = '/')
    {
        setcookie($name, $value, time() + $expiry, $path);
    }

    public function get($name)
    {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }

    public function delete($name, $path = '/')
    {
        if(isset($_COOKIE[$name]))
        {
            setcookie($name, '', time() - 30 * 24 * 60 * 60, $path);
            unset($_COOKIE[$name]);
        }
    }
}