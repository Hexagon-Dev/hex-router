<?php

namespace HexagonDev\Core\Enums;

enum ConsoleColorsEnum: string
{
    case ANSI_RESET = "\033[0m";
    case ANSI_GREEN = "\033[0;32m";
    case ANSI_RED = "\033[0;31m";
}
