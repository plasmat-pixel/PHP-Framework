<?php

namespace Artem\PhpFramework\Controller;

use Twig\Environment;
use Artem\PhpFramework\Http\Response;
use Psr\Container\ContainerInterface;

abstract class AbstractController
{
    protected ?ContainerInterface $container = null;
    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }

    public function render(string $view, array $parameters = [], ?Response $response = null): Response
    {
        /** @var Environment $twig */
        $twig = $this->container->get('twig');

        $content = $twig->render($view, $parameters);

        $response ??= new Response();
        $response->setContent($content);

        return $response;
    }
}
