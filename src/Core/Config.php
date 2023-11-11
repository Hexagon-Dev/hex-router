<?php

namespace HexagonDev\Core;

use Exception;

class Config
{
    public array $config = [];

    private static Config $instance;

    protected function __construct() {}

    protected function __clone() {}

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new Exception('Cannot unserialize a singleton.');
    }

    private function loadConfig(): void
    {
        $files = glob(__DIR__ . '/../config/*.php');

        foreach ($files as $file) {
            $path = explode('/', $file);

            $key = str_replace('.php', '', $path[sizeof($path) - 1]);

            $this->config[$key] = include $file;
        }
    }

    protected static function getInstance(): Config
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();

            self::$instance->loadConfig();
        }

        return self::$instance;
    }

    public static function get(): array
    {
        return self::getInstance()->config;
    }
}