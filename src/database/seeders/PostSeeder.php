<?php

namespace HexagonDev\database\seeders;

use HexagonDev\App\Models\Post;
use HexagonDev\Core\Contracts\SeederContract;

class PostSeeder implements SeederContract
{
    public static function seed(): void
    {
        self::createPosts(10);
    }

    public static function createPosts($size): void
    {
        for ($i = 1; $i <= $size; $i++) {
            Post::query()->create([
                'title' => 'Post №' . $i,
                'content' => 'Content ' . $i,
            ]);
        }
    }
}