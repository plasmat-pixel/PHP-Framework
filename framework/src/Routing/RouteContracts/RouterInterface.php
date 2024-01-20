<?php

namespace Artem\PhpFramework\Routing\RouteContracts;

use Artem\PhpFramework\Http\Request;
use League\Container\Container;

interface RouterInterface
{
    public function dispatch(Request $request, Container $container): array;

    public function registerRoutes(array $routes): void;
}
