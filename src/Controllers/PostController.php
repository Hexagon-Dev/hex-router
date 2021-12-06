<?php

namespace Hexagon\Controllers;

use Hexagon\Model\Post;

class PostController
{
    public static function getAllPosts()
    {
        return 'all';
        //return Post::getAllPosts();
    }

    public static function getPost($id)
    {
        return Post::getPost($id);
    }
}