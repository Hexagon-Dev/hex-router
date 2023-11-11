<?php

namespace HexagonDev\Core;

use Throwable;

class App
{
    public Router $router;

    /**
     * @throws Throwable
     */
    public function __construct()
    {
        $this->router = new Router();

        $this->router->addRoutes(include __DIR__ . '/../routes/api.php');

        $output = $this->router->match(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
            $_SERVER['REQUEST_METHOD'],
        );

        echo $output;
    }
}