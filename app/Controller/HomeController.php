<?php

namespace App\Controller;

use App\Services\YoutubeService;
use Artem\PhpFramework\Controller\AbstractController;
use Artem\PhpFramework\Http\Response;
use Twig\Environment;

class HomeController extends AbstractController
{
    public function __construct(
        private readonly YoutubeService $youtubeService,
    ) {
    }

    public function index(): Response
    {
        return $this->render('home.twig', [
            'YoutubeChanel' => $this->youtubeService->getChannelUrl()
        ]);
    }
}
