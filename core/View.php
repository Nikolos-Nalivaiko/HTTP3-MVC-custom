<?php

namespace Core;

class View 
{
    public static function render($view, $data = [])
    {
        extract($data);

        ob_start();
        require __DIR__ . '/../app/Views/' . $view . '.php';
        $content = ob_get_clean();

        require __DIR__ . '/../app/Views/layouts/main.php';
    }

    public static function errorCode($code) {
        http_response_code($code);

        require 'app/Views/errors/'.$code.'.php';
        exit;
    }
}