<?php

namespace Hexagon\Routes;

use Hexagon\Controllers\PostController;
use Exception;
use http\Exception\InvalidArgumentException;
use HttpUrlException;

class Router
{
    public string $uri;

    public function __construct()
    {
        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $this->get('/index.php', PostController::getAllPosts());
        $this->get('/index.php/show', function() {
            if ($_GET['id'] === null) {
                throw new InvalidArgumentException();
            }
            PostController::getPost($_GET['id']);
        });

        header('HTTP/1.1 404 Not Found');
        echo '<html lang="en"><body><h1>Page Not Found</h1></body></html>';
    }

    /**
     * @throws HttpUrlException
     * @throws Exception
     */
    public function get($uri, $action)
    {
        if ($uri !== $this->uri) {
            throw new HttpUrlException('Unknown route, current route: ' . $this->uri);
        }

        return $action;
    }
}

