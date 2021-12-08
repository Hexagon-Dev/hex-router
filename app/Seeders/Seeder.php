<?php

namespace Hexagon\Seeders;

use Hexagon\Models\Model;
use Throwable;

class Seeder
{
    /**
     * @throws Throwable
     */
    public static function create(): string
    {
        Model::query('
            create table posts
            (
                id int primary key auto_increment,
                title varchar(255),
                content text(2048)
            );
        ');

        return json_encode(['message' => 'table created'], JSON_THROW_ON_ERROR);
    }

    /**
     * @throws Throwable
     */
    public static function seed($size): string
    {
        for ($i = 1; $i <= $size; $i++) {
            Model::query("
                insert into router.posts (id, title, content)
                values  ($i, 'Test" . $i . "', 'Content" . $i . "');
            ");
        }
        return json_encode(['message' => 'table seeded'], JSON_THROW_ON_ERROR);
    }

    /**
     * @throws Throwable
     */
    public static function drop(): string
    {
        Model::query('drop table router.posts;');

        return json_encode(['message' => 'table dropped'], JSON_THROW_ON_ERROR);
    }
}