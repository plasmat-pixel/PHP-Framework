<?php

namespace App\Controller;

use App\Services\YoutubeService;
use Artem\PhpFramework\Http\Response;
use Twig\Environment;

class HomeController
{
    public function __construct(
        private readonly YoutubeService $youtubeService,
        private readonly Environment $environment
    ) {
    }

    public function index(): Response
    {
        dd($this->environment);
        $content = '<h1>Some content</h1>';
        $content .= "<a href=\"{$this->youtubeService->getChannelUrl()}\">Youtube Click</a>";
        return new Response($content);
    }
}
