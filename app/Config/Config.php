<?php

namespace Hexagon\Config;

class Config
{
    public array $database;

    public function __construct()
    {
        $this->database = Database::config();
    }
}