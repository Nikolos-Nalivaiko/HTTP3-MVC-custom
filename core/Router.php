<?php

namespace Core;

use ReflectionClass;

class Router
{
    protected $routes = [];

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function direct($request, $response)
    {
        $uri = $this->parseUri($request->getUri());
        $method = $request->getMethod();

        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $route => $controller) {
                if (preg_match($this->convertToRegex($route), $uri, $matches)) {
                    array_shift($matches); // Видаляємо повний збіг
                    $controllerClass = explode('@', $controller)[0];
                    $action = explode('@', $controller)[1];
                    return $this->callAction($controllerClass, $action, $request, $response, $matches);
                }
            }
        }

        $response->setStatusCode(404);
        $response->setContent('Page not found');
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
