<?php

namespace App\Controller;

use Artem\PhpFramework\Http\Response;

class PostController
{
    public function show(int $id): Response
    {
        $content = "<h1>Post - $id</h1>";
        return new Response($content);
    }
}
