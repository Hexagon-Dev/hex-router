<?php

namespace HexagonDev\Core;

use HexagonDev\Core\Enums\ConsoleColorsEnum;

class Console
{
    public static function info($message): void
    {
        echo ConsoleColorsEnum::ANSI_GREEN->value . $message . ConsoleColorsEnum::ANSI_RESET->value . PHP_EOL;
    }

    public static function error(string $message): void
    {
        echo ConsoleColorsEnum::ANSI_RED->value . $message . ConsoleColorsEnum::ANSI_RESET->value . PHP_EOL;
    }
}