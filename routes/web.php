<?php

use Artem\PhpFramework\Routing\Route;

return [
    Route::get('/', ['HomeController::class', 'index'])
];
