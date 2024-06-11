<?php

namespace Core;

class Kernel
{
    protected $router;
    protected $request;
    protected $response;
    protected $middlewares = [];

    public function __construct($router, $request, $response)
    {
        $this->router = $router;
        $this->request = $request;
        $this->response = $response;
    }

    public function handle()
    {
        // Обробка middleware перед основною логікою
        foreach ($this->middlewares as $middleware) {
            $instance = new $middleware();
            $instance->handle($this->request, function() {});
        }

        // Обробка маршруту та формування відповіді
        $this->router->direct($this->request, $this->response);

        // Обробка middleware після основної логіки
        foreach ($this->middlewares as $middleware) {
            $instance = new $middleware();
            $instance->terminate($this->request, $this->response);
        }

        // Відправка відповіді клієнту
        $this->sendResponse();
    }

    // Додавання middleware
    public function addMiddleware($middleware)
    {
        $this->middlewares[] = $middleware;
    }

    // Відправка відповіді клієнту
    protected function sendResponse()
    {
        http_response_code($this->response->getStatusCode());

        foreach ($this->response->getHeaders() as $name => $value) {
            header("{$name}: {$value}");
        }

        echo $this->response->getContent();
        exit;
    }
}

