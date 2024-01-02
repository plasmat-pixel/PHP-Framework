<?php

namespace Artem\PhpFramework\Http;

use App\Controller\HomeController;
use Artem\PhpFramework\Routing\RouteContracts\RouterInterface;
use FastRoute\RouteCollector;
use Throwable;

use function FastRoute\simpleDispatcher;

class Kernel
{
    public function __construct(
        private RouterInterface $router
    ) {
    }
    public function handle(Request $request): Response
    {
        try {
            [$routeHandler, $vars] = $this->router->dispatch($request);
            $response = call_user_func_array($routeHandler, $vars);
        } catch (Throwable $e) {
            $response = new Response($e->getMessage(), 500);
        }
        return $response;
    }
}
