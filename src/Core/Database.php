<?php

namespace HexagonDev\Core;

use Exception;
use PDO;
use PDOException;

class Database
{
    public PDO $connection;

    private static Database $instance;

    protected function __construct() {}

    protected function __clone() {}

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new Exception('Cannot unserialize a singleton.');
    }

    protected static function getInstance(): Database
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();

            try {
                self::$instance->connection = new PDO(
                    'mysql:dbname=' . config('database.database') . ';host=' . config('database.host') . ';charset=utf8;',
                    config('database.user'),
                    config('database.password'),
                );
            } catch (PDOException $exception) {
                ExceptionHandler::report($exception);

                throw $exception;
            }
        }

        return self::$instance;
    }

    public static function first(string $sql, array $parameters = [])
    {
        try {
            $statement = self::getInstance()->connection->prepare($sql);

            $statement->execute($parameters);

            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result ?: null;
        } catch (PDOException $exception) {
            ExceptionHandler::report($exception);

            throw $exception;
        }
    }

    public static function get($sql, $parameters = []): array
    {
        $statement = self::getInstance()->connection->prepare($sql);

        $statement->execute($parameters);

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result ?: [];
    }

    public static function create(string $sql, array $data): int
    {
        $stmt = self::getInstance()->connection->prepare($sql);

        $stmt->execute(array_values($data));

        return self::getInstance()->connection->lastInsertId();
    }

    public static function execute(string $sql, array $parameters = []): bool
    {
        try {
            $statement = self::getInstance()->connection->prepare($sql);

            return $statement->execute($parameters);
        } catch (PDOException $exception) {
            ExceptionHandler::report($exception);

            throw $exception;
        }
    }
}