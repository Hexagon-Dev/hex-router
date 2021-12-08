<?php

namespace Hexagon\Routes;

use Exception;
use ReflectionException;
use ReflectionMethod;

class Route
{
    public string $uri;
    public string $object;
    public string $method;
    public array $parameters;

    public function __construct(string $uri, array $action)
    {
        $this->uri = $uri;
        $this->object = $action[0];
        $this->method = $action[1];
    }

    public function addParameters($requestUri): void
    {
        preg_match_all($this->uri, $requestUri, $matches, PREG_SET_ORDER);

        $matches = $matches[0];
        array_shift($matches);
        $this->parameters = $matches;
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function executeAction()
    {
        try {
            $reflection = new ReflectionMethod($this->object, $this->method);

            if (count($reflection->getParameters()) !== count($this->parameters)) {
                throw new Exception('Parameters mismatch');
            }

            return $reflection->invokeArgs(null, $this->parameters);
        } catch (ReflectionException $e) {
            throw new ReflectionException('Error calling ' . $this->method . ' on ' . $this->object);
        }
    }
}