<?php

namespace App\Controller;

use App\Services\YoutubeService;
use Artem\PhpFramework\Http\Response;

class HomeController
{
    public function __construct(
        private readonly YoutubeService $youtubeService
    ) {
    }

    public function index(): Response
    {
        $content = '<h1>Some content</h1>';
        $content .= "<a href=\"{$this->youtubeService->getChannelUrl()}\">Youtube Click</a>";
        return new Response($content);
    }
}
