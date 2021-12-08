<?php

namespace Hexagon\Config;

class Database
{
    public static function config(): array
    {
        return [
            'host' => 'mariadb',
            'database' => 'router',
            'user' => 'root',
            'password' => 'password',
        ];
    }
}