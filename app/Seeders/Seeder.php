<?php

namespace Hexagon\Seeders;

use Hexagon\Models\Model;

class Seeder
{
    public static function seed()
    {
        Model::query('
            create table posts
            (
                id int primary key auto_increment,
                title varchar(255),
                content text(2048)
            );
        ');

        Model::query("
            insert into router.posts (id, title, content)
            values  (1, 'Test1', 'Content1'),
                    (2, 'Test2', 'Content2'),
                    (3, 'Test3', 'Content3');
        ");

        return 'Table seeded.';
    }
}