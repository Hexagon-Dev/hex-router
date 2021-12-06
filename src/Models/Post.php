<?php

namespace Hexagon\Models;

class Post extends Model
{
    public static function getAllPosts(): array
    {
        return parent::table('SELECT * FROM posts');
    }

    public static function getPost($id)
    {
        return parent::query('SELECT * FROM posts WHERE id = :id', ['id' => $id]);
    }
}