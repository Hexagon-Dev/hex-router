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
                $this->headerCode(404);
                return '<html lang="en"><body><h1>Page Not Found</h1></body></html>';
        }
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

