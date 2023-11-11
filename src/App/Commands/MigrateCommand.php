<?php

namespace HexagonDev\App\Commands;

use HexagonDev\Core\Command;
use HexagonDev\Core\MigrationManager;

class MigrateCommand extends Command
{
    public string $signature = 'migrate';

    public function handle(): int
    {
        $migrationManager = new MigrationManager();

        $migrationManager->run();

        return 0;
    }
}