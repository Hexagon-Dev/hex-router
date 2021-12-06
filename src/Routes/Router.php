<?php

namespace Hexagon\Routes;

use Hexagon\Controllers\PostController;
use Hexagon\Seeders\Seeder;
use http\Exception\InvalidArgumentException;

class Router
{
    public string $uri;

    public function init(): string
    {
        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        switch ($this->uri) {
            case '/':
                return PostController::getAllPosts();
            case '/show':
                if ($_GET['id'] === null) {
                    throw new InvalidArgumentException();
                }
                return PostController::getPost($_GET['id']);
            case '/seed':
                return Seeder::seed();
            default:
                header('HTTP/1.1 404 Not Found');
                return '<html lang="en"><body><h1>Page Not Found</h1></body></html>';
        }
    }
}

