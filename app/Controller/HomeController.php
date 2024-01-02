<?php

namespace App\Controller;

use Artem\PhpFramework\Http\Response;

class HomeController
{
    public function index(): Response
    {
        $content = '<h1>Some content</h1>';
        return new Response($content);
    }
}
