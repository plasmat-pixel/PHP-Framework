<?php

namespace Artem\PhpFramework\Routing;

use Artem\PhpFramework\Http\Exceptions\MethodNotAllowedException;
use Artem\PhpFramework\Http\Exceptions\RouteNotFoundException;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Artem\PhpFramework\Http\Request;

use function FastRoute\simpleDispatcher;
use Artem\PhpFramework\Routing\RouteContracts\RouterInterface;
use League\Container\Container;

class Router implements RouterInterface
{
    private array $routes;
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

    private function extractRouteInfo(Request $request): array
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $collector) {
            foreach ($this->routes as $route) {
                $collector->addRoute(...$route);
            }
        });

        $routeInfo = $dispatcher->dispatch(
            $request->getMethod(),
            $request->getPath()
        );

        return match ($routeInfo[0]) {
            Dispatcher::FOUND => [$routeInfo[1], $routeInfo[2]],
            Dispatcher::METHOD_NOT_ALLOWED => [
                $e = new MethodNotAllowedException("Supported HTTP Method: " . implode(',', $routeInfo[1])),
                $e->setStatusCode(405),
                throw $e
            ],
            default => [
                $e = new RouteNotFoundException('Route not found'),
                $e->setStatusCode(404),
                throw $e
            ],
        };
    }
}
