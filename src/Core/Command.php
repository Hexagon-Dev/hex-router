<?php

namespace HexagonDev\Core;

class Command
{
    public string $signature;

    public function getSignature(): string
    {
        return $this->signature;
    }

    public function handle(): int
    {
        return 0;
    }
}