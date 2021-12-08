<?php

namespace Hexagon\Seeders;

use Hexagon\Models\Model;

class Seeder
{
    public static function create()
    {
        Model::query('
            create table posts
            (
                id int primary key auto_increment,
                title varchar(255),
                content text(2048)
            );
        ');

        return 'Table created';
    }

    public static function seed($size)
    {
        for ($i = 1; $i <= $size; $i++) {
            Model::query("
                insert into router.posts (id, title, content)
                values  ($i, 'Test" . $i . "', 'Content" . $i . "');
            ");
        }
        return 'Table seeded';
    }
}