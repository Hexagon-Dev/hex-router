<?php

namespace HexagonDev\Core;

use Exception;
use ReflectionException;
use ReflectionMethod;
use Throwable;

class Router
{
    /** @var Route[] */
    public array $routes = [];

    /**
     * @throws Throwable
     */
    public function match($needle, $method): mixed
    {
        /** @var null|Route $matchedRoute */
        $matchedRoute = null;

        foreach ($this->routes as $route) {
            if (
                preg_match_all($route->uri, $needle, $parameters, PREG_SET_ORDER)
                && strtolower($method) === $route->method->value
            ) {
                $matchedRoute = $route;

                array_shift($parameters[0]);

                $matchedRoute->parameters = $parameters[0];
            }
        }

        if (is_null($matchedRoute)) {
            $this->headerCode(404);

            return json_encode(['error' => 'Page not found'], JSON_THROW_ON_ERROR);
        }

        return $this->executeAction($matchedRoute->controller, $matchedRoute->action, $matchedRoute->parameters);
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function executeAction($controller, $action, $parameters)
    {
        $reflection = new ReflectionMethod($controller, $action);

        if ($reflection->getNumberOfParameters() !== count($parameters)) {
            throw new Exception('Parameters mismatch');
        }

        return call_user_func([new $controller, $action], ...$parameters);
    }

    public function headerCode($code): void
    {
        switch ($code)
        {
            case 404:
                header('HTTP/1.1 404 Not Found');
                break;
            case 403:
                header('HTTP/1.1 403 Forbidden');
                break;
            case 401:
                header('HTTP/1.1 401 Unauthorized');
                break;
            case 422:
                header('HTTP/1.1 422 Unprocessable Entity');
                break;
        }
    }

    public function addRoutes(array $routes): void
    {
        $this->routes = array_merge($this->routes, $routes);
    }
}

