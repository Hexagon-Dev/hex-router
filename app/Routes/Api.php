<?php

namespace Hexagon\Routes;

use Hexagon\Controllers\PostController;
use Hexagon\Seeders\Seeder;

$router = new Router();

$router->add('/posts', [PostController::class, 'getAllPosts']);
$router->add('/posts/{id}', [PostController::class, 'getPost']);
$router->add('/posts/{id}/{magic}', [PostController::class, 'getPostTwo']);
$router->add('/seed', [Seeder::class, 'seed']);

print_r($router->match(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));