<?php

namespace App\Controller;

use Artem\PhpFramework\Controller\AbstractController;
use Artem\PhpFramework\Http\Response;

class PostController extends AbstractController
{
    public function show(int $id): Response
    {
        return $this->render('posts.twig', [
            'PostId' => $id
        ]);
    }

    public function create(): Response
    {
        return $this->render('create_posts.twig');
    }
}
