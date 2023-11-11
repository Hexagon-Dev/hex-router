<?php

namespace HexagonDev\Core;

class MigrationManager
{
    public function run(): void
    {
        $migrationFiles = glob(__DIR__ . '/../database/migrations/*.php');

        foreach ($migrationFiles as $migrationFile) {
            $migration = include $migrationFile;

            if ($migration instanceof Migration) {
                $migration->up();

                Console::info('Successfully migrated: ' . basename($migrationFile));
            } else {
                Console::error("Migration in $migrationFile could not be instantiated or is not an instance of HexagonDev\\Core\\Migration.");
            }
        }

        Console::info('Migrations complete.');
    }
}