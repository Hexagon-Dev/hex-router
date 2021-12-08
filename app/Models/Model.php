<?php

namespace Hexagon\Models;

use PDO;
use PDOException;

class Model {
    public static function init(): PDO
    {
        $config = require '../config/Database.php';
        try {
            return new PDO(
                "mysql:dbname={$config['database']};host={$config['host']};charset=utf8;",
                $config['user'],
                $config['password']
            );
        } catch (PDOException $exception) {
            var_dump($config);
            die('Ошибка подключения базы данных: ' . $exception->getMessage());
        }
    }

    public static function query(string $sql, array $parameters = [])
    {
        $database = self::init();
        try {
            $statement = $database->prepare($sql);
            $statement->execute($parameters);

            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            var_dump($exception);
        }
        return false;
    }

    public static function table($sql, $parameters = []): array
    {
        $database = self::init();
        $statement = $database->prepare($sql);
        $statement->execute($parameters);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}