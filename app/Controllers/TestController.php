<?php

namespace Hexagon\Controllers;

class TestController
{
    public static function testPlusTen(int $value): int
    {
        return $value + 10;
    }
}