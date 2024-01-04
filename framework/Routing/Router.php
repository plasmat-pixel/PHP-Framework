<?php

namespace Artem\PhpFramework\Routing;

use Artem\PhpFramework\Http\Exceptions\MethodNotAllowedException;
use Artem\PhpFramework\Http\Exceptions\RouteNotFoundException;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Artem\PhpFramework\Http\Request;

use function FastRoute\simpleDispatcher;
use Artem\PhpFramework\Routing\RouteContracts\RouterInterface;

class Router implements RouterInterface
{
    public function dispatch(Request $request): array
    {
        [$handler, $vars] = $this->extractRouteInfo($request);

        if (is_array($handler)) {
            [$controller, $method] = $handler;
            $handler = [new $controller, $method];
        }
        return [$handler, $vars];
    }

    private function extractRouteInfo(Request $request): array
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $collector) {
            $routes = include BASE_PATH . '/routes/web.php';
            foreach ($routes as $route) {
                $collector->addRoute(...$route);
            }
        });

        $routeInfo = $dispatcher->dispatch(
            $request->getMethod(),
            $request->getPath()
        );

        $result =  match ($routeInfo[0]) {
            Dispatcher::FOUND => [$routeInfo[1], $routeInfo[2]],
            Dispatcher::METHOD_NOT_ALLOWED
            => throw new MethodNotAllowedException("Supported HTTP Method: " . implode(',', $routeInfo[1])),
            default => throw new RouteNotFoundException('Route not found'),
        };
        return $result;
    }
}
