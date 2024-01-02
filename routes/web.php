<?php

use App\Controller\HomeController;
use Artem\PhpFramework\Routing\Route;

return [
    Route::get('/', [HomeController::class, 'index'])
];
