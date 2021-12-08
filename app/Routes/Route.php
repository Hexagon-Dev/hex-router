<?php

namespace Hexagon\Routes;

use Exception;
use ReflectionException;
use ReflectionMethod;

class Route
{
    public string $uri;
    public string $controller;
    public string $method;
    public array $parameters;

    public function __construct(string $uri, array $action)
    {
        $this->uri = $uri;
        $this->controller = $action[0];
        $this->method = $action[1];
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function executeAction()
    {
        try {
            $reflection = new ReflectionMethod($this->controller, $this->method);

            if ($reflection->getNumberOfParameters() !== count($this->parameters)) {
                throw new Exception('Parameters mismatch');
            }

            return $reflection->invokeArgs(null, $this->parameters);
        } catch (ReflectionException $e) {
            throw new ReflectionException('Error calling ' . $this->method . ' on ' . $this->controller);
        }
    }
}