<?php

namespace Artem\PhpFramework\Http;

use Doctrine\DBAL\Connection;
use League\Container\Container;
use Artem\PhpFramework\Routing\RouteContracts\RouterInterface;

class Kernel
{
    use Helper;
    public function __construct(
        private RouterInterface $router,
        private Container $container
    ) {
        $this->appEnv = $this->container->get('APP_ENV');
    }
    public function handle(Request $request): Response
    {
        try {
            [$routeHandler, $vars] = $this->router->dispatch($request, $this->container);
            $response = call_user_func_array($routeHandler, $vars);
        } catch (\Exception $e) {
            $response = $this->createExceptionResponse($e);
        }
        return $response;
    }
}
