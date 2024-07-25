<?php

declare(strict_types=1);

namespace Core;

class Kernel
{
    protected Router $router;
    
    protected Request $request;
    
    protected Response $response;
    
    protected array $middlewares = [];

    public function __construct(Router $router, Request $request, Response $response)
    {
        $this->router = $router;
        $this->request = $request;
        $this->response = $response;
    }

    public function handle() :void
    {
        // Обробка middleware перед основною логікою
        $response = $this->handleMiddleware($this->middlewares, $this->request, $this->response, function($request, $response) {
            // Обробка маршруту та формування відповіді
            return $this->router->direct($request, $response);
        });

        //response не null
        if (is_null($response)) {
            $response = $this->response;
        }

        // Відправка відповіді клієнту
        $this->sendResponse($response);
    }

    // Додавання middleware
    public function addMiddleware($middleware) :void
    {
        $this->middlewares[] = $middleware;
    }

    // Відправка відповіді клієнту
    protected function sendResponse($response) 
    {

        if($response instanceof View)
        {
            View::render($response->getView(), $response->getData());
        } else
        {
            http_response_code($response->getStatusCode());

            foreach ($response->getHeaders() as $name => $value) {
                header("{$name}: {$value}");
            }
    
            echo $response->getContent();
        }

        exit;
    }

    // Обробка middleware
    protected function handleMiddleware(array $middlewares, Request $request, Response $response, $next) :?View
    {
        // Перебір middleware з кінця до початку, щоб забезпечити правильний порядок виконання
        foreach (array_reverse($middlewares) as $middleware) {
            $next = function($request, $response) use ($middleware, $next) {
                $instance = new $middleware();
                return $instance->handle($request, $response, $next);
            };
        }

        // Виклик зворотнього виклику для початку виконання ланцюжка middleware
        return $next($request, $response);
    }
}