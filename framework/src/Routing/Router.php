<?php

namespace Artem\PhpFramework\Routing;

use Artem\PhpFramework\Http\Request;
use Artem\PhpFramework\Routing\RouteContracts\RouterInterface;
use League\Container\Container;

class Router implements RouterInterface
{
    use RouterHelper;
    public function dispatch(Request $request, Container $container): array
    {
        [$handler, $vars] = $this->extractRouteInfo($request);

        if (is_array($handler)) {
            [$controllerId, $method] = $handler;
            $controller = $container->get($controllerId);
            $handler = [$controller, $method];
        }
        return [$handler, $vars];
    }

    public function registerRoutes(array $routes): void
    {
        $this->routes = $routes;
    }
}
