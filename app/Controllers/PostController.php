<?php

namespace Hexagon\Controllers;

use Hexagon\Models\Post;

class PostController
{
    public static function getAllPosts(): string
    {
        return json_encode(Post::getAllPosts(), JSON_THROW_ON_ERROR);
    }

    /**
     * @param $id
     * @return string
     * @throws \JsonException
     */
    public static function getPost($id): string
    {
        return json_encode(Post::getPost($id), JSON_THROW_ON_ERROR);
    }
}