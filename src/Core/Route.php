<?php

namespace HexagonDev\Core;

use Exception;
use HexagonDev\Core\Enums\HttpMethodsEnum;

class Route
{
    public string $uri;
    public string $controller;
    public string $action;
    public HttpMethodsEnum $method;
    public array $parameters;

    public static function get(string $uri, array $action): Route
    {
        return (new self)->addRoute(HttpMethodsEnum::GET, $uri, $action);
    }

    public static function post(string $uri, array $action): Route
    {
        return (new self)->addRoute(HttpMethodsEnum::POST, $uri, $action);
    }

    public static function patch(string $uri, array $action): Route
    {
        return (new self)->addRoute(HttpMethodsEnum::PATCH, $uri, $action);
    }

    public static function put(string $uri, array $action): Route
    {
        return (new self)->addRoute(HttpMethodsEnum::PUT, $uri, $action);
    }

    public static function delete(string $uri, array $action): Route
    {
        return (new self)->addRoute(HttpMethodsEnum::DELETE, $uri, $action);
    }

    public function addRoute(HttpMethodsEnum $method, string $uri, array $action): Route
    {
        $uri = preg_replace_callback(
            '/{[a-zA-Z]+}/',
            static function () {
                return '(.*?)';
            },
            $uri,
        );

        $this->uri = "#$uri$#";

        try {
            new $action[0];
        } catch (Exception $exception) {
            ExceptionHandler::report($exception, 'Controller ' . $action[0] . ' not found.');
        }

        $this->controller = $action[0];
        $this->action = $action[1];
        $this->method = $method;

        return $this;
    }
}