<?php

namespace Hexagon\Model;

use PDO;
use PDOException;

class Model {
    public static function init()
    {
        $config = require '../Config/Database.php';
        $connection = 'mysql:host=' . $config['host'] . ';dbname=' . $config['database'];
        return new PDO($connection, $config['user'], $config['password']);
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
        return null;
    }

    public static function table($sql, $parameters = []): array
    {
        $database = self::init();
        $statement = $database->prepare($sql);
        $statement->execute($parameters);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}