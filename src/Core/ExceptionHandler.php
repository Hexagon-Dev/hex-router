<?php

namespace HexagonDev\Core;

use Throwable;

class ExceptionHandler
{
    public static function report(Throwable $exception, string $message = null): void
    {
        print_r([
            'message' => $message ?? $exception->getMessage(),
            'code' => $exception->getCode(),
            'line' => $exception->getLine(),
            'file' => $exception->getFile(),
            'trace' => $exception->getTrace(),
        ]);
    }
}