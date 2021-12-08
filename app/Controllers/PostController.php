<?php

namespace Hexagon\Controllers;

use Hexagon\Models\Post;

class PostController
{
    public static function getAllPosts(): string
    {
        return json_encode(Post::getAllPosts(), JSON_THROW_ON_ERROR);
    }

    public static function getPost($id): string
    {
        return json_encode(Post::getPost($id), JSON_THROW_ON_ERROR);
    }

    public static function getPostTwo($id, $title): string
    {
        return json_encode(Post::getPostTwo($id, $title), JSON_THROW_ON_ERROR);
    }
}