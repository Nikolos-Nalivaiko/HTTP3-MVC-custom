<?php

namespace Core;

class View 
{
    public static function render($view, $data = [])
    {
        extract($data);

        ob_start();
        // В принципі ось це припустимо, але прям ідеально було би це винести в конфіг
        require __DIR__ . '/../app/Views/' . $view . '.php';
        $content = ob_get_clean();

        // Як дав би зараз підзатильника. Кор файли не повинні знати який в тебе лейаут. Ти в самих вьюшках повинен це вказати, через умовний extends, чи щось таке
        require __DIR__ . '/../app/Views/layouts/main.php';
    }

    public static function errorCode($code) {
        http_response_code($code);

        // Same shit like with layouts
        require 'app/Views/errors/'.$code.'.php';
        exit;
    }
}