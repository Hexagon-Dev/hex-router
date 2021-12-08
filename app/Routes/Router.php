<?php

namespace Hexagon\Routes;

use Exception;

class Router
{
    public string $uri;
    public array $routes;

    /**
     * @throws Exception
     */
    public function add(string $uri, array $action): void
    {
        try {
            new $action[0];
        } catch (Exception $e) {
            throw new Exception('Class ' . $action[0] . ' not found');
        }

        $uri = preg_replace('/\//', '\/', $uri);
        $uri = '/' . preg_replace('/{(?:[^{}]|((?R)))+}/', '(.*?)', $uri) . '$/';

        $this->routes[] = new Route($uri, $action);
    }

    /**
     * @throws Exception
     */
    public function match($needle): string
    {
        foreach ($this->routes as $route) {
            if (preg_match($route->uri, $needle)) {
                $match = $route;
            }
        }
        // Если никакой не совпал то 404
        if (!isset($match)) {
            $this->headerCode(404);
            return '<html lang="en"><body><h1>Page Not Found</h1></body></html>';
        }

        $match->addParameters($needle);

        return $match->executeAction();
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

