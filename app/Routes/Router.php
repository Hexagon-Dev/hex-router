<?php

namespace Hexagon\Routes;

use Exception;
use Hexagon\Controllers\PostController;
use Hexagon\Seeders\Seeder;
use ReflectionException;
use ReflectionFunction;
use ReflectionMethod;

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
                return $this->get('/show/{id}', [PostController::class, 'getPost']);
            case '/seed':
                return Seeder::seed();
            default:
                $this->headerCode(404);
                return '<html lang="en"><body><h1>Page Not Found</h1></body></html>';
        }
    }

    /**
     * @throws Exception
     */
    public function get($uri, $action)
    {
        $uri = explode('/', $uri);
        foreach ($uri as $part) {
            // Если кусок содержит по бокам { и }
            if (preg_match('/{(.*?)}|si/', $part)) {
                // Убираем их
                $var = mb_substr($part, 1, -1);
                // Если параметр с таким названием не передан, убиваем
                if ($_GET[$var] === null) {
                    throw new Exception('Variable ' . $var . ' not found');
                }
                $variables[$var] = $_GET[$var];
            }
        }

        // Если класс существует
        try {
            // Делаем рефлекшн и смотрим параметры
            $reflection = new ReflectionMethod($action[0], $action[1]);

            foreach($reflection->getParameters() AS $arg)
            {
                if ($variables[$arg->name]) {
                    $fire_args[$arg->name] = $_GET[$arg->name];
                } else {
                    $fire_args[$arg->name] = null;
                }
            }

            $result = $reflection->invokeArgs(null, $fire_args);

        } catch (ReflectionException $e) {
            echo 'Error calling method ' . $action[1] . ' on ' . $action[0];
        }
            //$reflectionMethod = new ReflectionMethod($action[0], $action[1]);
            //echo $reflectionMethod->invokeArgs(null, $fire_args);

            echo $result;

            exit;
            return call_user_func_array($action, $fire_args);
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

