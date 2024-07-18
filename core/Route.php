<?php

declare(strict_types=1);

namespace Core;

class Route
{
    protected static Router $router;

    public static function init(Router $router): void
    {
        self::$router = $router;
    }

    public static function get(string $uri, string|array $controller, array $middleware = []): void
    {
        self::$router->get($uri, $controller, $middleware);
    }

    public static function post(string $uri, string|array $controller, array $middleware = []): void
    {
        self::$router->post($uri, $controller, $middleware);
    }
}
