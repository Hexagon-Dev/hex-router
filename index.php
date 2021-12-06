<?php

require __DIR__ . '/vendor/autoload.php';

use Hexagon\Routes\Router;

$router = new Router();

print_r($router->init());