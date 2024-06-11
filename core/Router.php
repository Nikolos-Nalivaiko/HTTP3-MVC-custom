<?php

namespace Core;

use ReflectionClass;

class Router
{
    protected $routes = [];

    public function get($uri, $controller, $middleware = [])
    {
        $this->addRoute('GET', $uri, $controller, $middleware);
    }

    public function post($uri, $controller, $middleware = [])
    {
        $this->addRoute('POST', $uri, $controller, $middleware);
    }

    protected function addRoute($method, $uri, $controller, $middleware)
    {
        $this->routes[$method][$uri] = [
            'controller' => $controller,
            'middleware' => $middleware,
        ];
    }

    public function direct($request, $response)
    {
        $uri = $this->parseUri($request->getUri());
        $method = $request->getMethod();

        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $route => $routeDetails) {
                if (preg_match($this->convertToRegex($route), $uri, $matches)) {
                    array_shift($matches); // Видаляємо повний збіг
                    $controllerClass = explode('@', $routeDetails['controller'])[0];
                    $action = explode('@', $routeDetails['controller'])[1];
                    $middleware = $routeDetails['middleware'];

                    // Обробляємо middleware перед викликом контролера
                    $response = $this->handleMiddleware($middleware, $request, $response);
                    
                    // Якщо middleware не встановило контент, тоді викликаємо контролер
                    if (!$response->getContent()) {
                        return $this->callAction($controllerClass, $action, $request, $response, $matches);
                    }
                    
                    // Якщо контент встановлено middleware, повертаємо його без виклику контролера
                    return $response;
                }
            }
        }

        $response->setStatusCode(404);
        $response->setContent('Page not found');
        return $response;
    }

    protected function handleMiddleware($middleware, $request, $response)
    {
        // Почати з виклику першого middleware
        $next = function ($request, $response) {
            // Порожня функція зворотного виклику
            // Якщо не заданий інший middleware або контролер, буде викликано кінець ланцюжка
            return $response;
        };

        // Перебір middleware з кінця до початку, щоб забезпечити правильний порядок виконання
        foreach (array_reverse($middleware) as $middlewareClass) {
            $middlewareInstance = new $middlewareClass;
            $next = function ($request, $response) use ($middlewareInstance, $next) {
                return $middlewareInstance->handle($request, $response, $next);
            };
        }

        // Виклик зворотнього виклику для початку виконання ланцюжка middleware
        return $next($request, $response);
    }

    protected function callAction($controller, $action, $request, $response, $parameters = [])
    {
        $controller = "App\\Controllers\\{$controller}";
        if (!class_exists($controller)) {
            throw new \Exception("Class {$controller} not found.");
        }

        $controller = $this->resolveClass($controller, $request, $response);

        if (!method_exists($controller, $action)) {
            throw new \Exception("{$controller} does not respond to the {$action} action.");
        }

        return call_user_func_array([$controller, $action], array_merge([$request, $response], $parameters));
    }

    protected function resolveClass($className, $request, $response)
    {
        $reflector = new ReflectionClass($className);
        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return new $className;
        }

        $parameters = $constructor->getParameters();
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $parameterType = $parameter->getType();
            if ($parameterType && !$parameterType->isBuiltin()) {
                $dependencies[] = $this->resolveDependency($parameterType->getName(), $request, $response);
            }
        }

        return $reflector->newInstanceArgs($dependencies);
    }

    protected function resolveDependency($className, $request, $response)
    {
        if ($className === Request::class) {
            return $request;
        }

        if ($className === Response::class) {
            return $response;
        }

        return new $className;
    }

    protected function parseUri($uri)
    {
        if ($position = strpos($uri, '?')) {
            return substr($uri, 0, $position);
        }

        return trim($uri, '/');
    }

    protected function convertToRegex($route)
    {
        return "/^" . str_replace('/', '\/', $route) . "$/";
    }
}