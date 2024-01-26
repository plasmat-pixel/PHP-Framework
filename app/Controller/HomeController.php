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
        dd($this->container->get('twig'));
        $content = '<h1>Some content</h1>';
        $content .= "<a href=\"{$this->youtubeService->getChannelUrl()}\">Youtube Click</a>";
        return new Response($content);
    }
}
