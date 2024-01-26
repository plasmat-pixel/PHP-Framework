<?php

use App\Controller\HomeController;
use App\Controller\PostController;
use Artem\PhpFramework\Http\Response;
use Artem\PhpFramework\Routing\Route;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/posts/{id}', [PostController::class, 'show']),

];
