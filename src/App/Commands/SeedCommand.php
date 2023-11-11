<?php

namespace HexagonDev\App\Commands;

use HexagonDev\Core\Command;
use HexagonDev\Core\Console;
use HexagonDev\database\seeders\Seeder;

class SeedCommand extends Command
{
    public string $signature = 'seed';

    public function handle(): int
    {
        new Seeder();

        Console::info('Successfully seeded database.');

        return 0;
    }
}