<?php

namespace Hexagon\Controllers;

use Hexagon\Models\Post;

class PostController
{
    public static function getAllPosts(): array
    {
        return Post::getAllPosts();
    }

    public static function getPost($id)
    {
        return Post::getPost($id);
    }
}