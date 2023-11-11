<?php

namespace HexagonDev\Routes;

use HexagonDev\App\Controllers\PostController;
use HexagonDev\Core\Route;

return [
    Route::get('/api/posts', [PostController::class, 'index']),
    Route::get('/api/posts/{id}', [PostController::class, 'get']),
    Route::get('/api/posts/{id}/{magic}', [PostController::class, 'getPostTwo']),
];