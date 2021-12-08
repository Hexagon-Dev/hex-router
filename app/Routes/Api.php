<?php

namespace Hexagon\Routes;

use Hexagon\Controllers\PostController;
use Hexagon\Seeders\Seeder;

$router = new Router();

$router->add('/api/posts', [PostController::class, 'getAllPosts']);
$router->add('/api/posts/{id}', [PostController::class, 'getPost']);
$router->add('/api/posts/{id}/{magic}', [PostController::class, 'getPostTwo']);
$router->add('/api/table/seed/{size}', [Seeder::class, 'seed']);
$router->add('/api/table/create', [Seeder::class, 'create']);
$router->add('/api/table/drop', [Seeder::class, 'drop']);

print_r($router->match(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));