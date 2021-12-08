<?php

namespace Hexagon\Routes;

use Exception;
use Throwable;

class Router
{
    public string $uri;
    public array $routes;

    /**
     * @throws Throwable
     */
    public function add(string $uri, array $action): void
    {
        try {
            new $action[0];
        } catch (Exception $e) {
            throw new Exception('Controller ' . $action[0] . ' not found');
        }

        /** @var String $uri */
        $uri = preg_replace_callback(
                '/{[a-zA-Z]+}/',
                static function () {
                    return '(.*?)';
                },
                $uri
            );

        $uri = '#' .  $uri . '$#';

        $this->routes[] = new Route($uri, $action);
    }

    /**
     * @throws Throwable
     */
    public function match($needle): string
    {
        /** @var null|Route $matchedRoute */
        $matchedRoute = null;

        foreach ($this->routes as $route) {
            if (preg_match_all($route->uri, $needle, $parameters, PREG_SET_ORDER)) {
                $matchedRoute = $route;
                array_shift($parameters[0]);
                $matchedRoute->parameters = $parameters[0];
            }
        }

        if (null === $matchedRoute) {
            $this->headerCode(404);
            return json_encode(['error' => 'page not found'], JSON_THROW_ON_ERROR);
        }

        return $matchedRoute->executeAction();
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
}

