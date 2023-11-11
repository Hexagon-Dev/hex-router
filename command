#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use HexagonDev\Core\Command;
use HexagonDev\Core\Console;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require __DIR__ . '/src/helpers.php';

array_shift($argv);
$input = array_shift($argv);

$appCommands = [];

$commands = glob('src/App/Commands/*.php');

foreach ($commands as $command) {
    if (!file_exists($command)) {
        Console::error("File $command not found.");

        exit(1);
    }

    $path = explode('/', $command);

    $filename = pathinfo($path[sizeof($path) - 1], PATHINFO_FILENAME);

    require_once $command;

    $class = "\\HexagonDev\\App\\Commands\\$filename";

    if (!class_exists($class)) {
        Console::error("Class $class not found.");

        exit(1);
    }

    /** @var Command $instance */
    $instance = new $class();

    if ($instance->getSignature() === $input) {
        exit($instance->handle());
    }
}

Console::error("No matching command found for input: $input");

exit(1);
