<?php

namespace Hexagon\Controllers;

use Hexagon\Models\Post;

class PostController
{
    public static function getAllPosts(): bool|string
    {
        return json_encode(Post::getAllPosts(), JSON_THROW_ON_ERROR);
    }

    public static function getPost($id): bool|string
    {
        return json_encode(Post::getPost($id), JSON_THROW_ON_ERROR);
    }
}