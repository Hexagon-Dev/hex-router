<?php

namespace Hexagon\Models;

class Post extends Model
{
    public static function getAllPosts(): array
    {
        return parent::table('SELECT * FROM router.posts');
    }

    public static function getPost($id)
    {
        return parent::query('SELECT * FROM router.posts WHERE id = :id', ['id' => $id]);
    }

    public static function getPostTwo($id, $title)
    {
        return parent::query('SELECT * FROM router.posts WHERE id = :id AND title = :title',
            [
                'id' => $id,
                'title' => $title,
            ]);
    }
}