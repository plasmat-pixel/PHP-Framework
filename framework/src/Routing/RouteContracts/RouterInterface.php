<?php

namespace Artem\PhpFramework\Routing\RouteContracts;

use Artem\PhpFramework\Http\Request;

interface RouterInterface
{
    public function dispatch(Request $request): array;

    public function registerRoutes(array $routes): void;
}
