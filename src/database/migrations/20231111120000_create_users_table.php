<?php

namespace HexagonDev\database\migrations;

use HexagonDev\Core\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->execute('
            CREATE TABLE posts (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                content TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ');
    }

    public function down(): void
    {
        $this->execute('DROP TABLE IF EXISTS posts');
    }
};