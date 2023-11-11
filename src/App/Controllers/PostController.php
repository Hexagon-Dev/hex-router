<?php

namespace HexagonDev\App\Controllers;

use HexagonDev\App\Models\Post;
use Throwable;

class PostController
{
    /**
     * @throws Throwable
     */
    public function index(): string
    {
        $data = Post::query()->get();

        return json_response($data);
    }

    /**
     * @throws Throwable
     */
    public static function get(int $id): string
    {
        $data = Post::query()->where('id', $id)->first();

        return json_response($data);
    }

    /**
     * @throws Throwable
     */
    public static function getPostTwo(int $id, string $title): string
    {
        $data = Post::query()->where('id', $id)->where('title', $title)->first();

        return json_response($data);
    }
}