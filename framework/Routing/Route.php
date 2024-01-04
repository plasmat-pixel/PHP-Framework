<?php

namespace Artem\PhpFramework\Routing;

use Artem\PhpFramework\Routing\RouteContracts\RegistrarInterface;

class Route implements RegistrarInterface
{
    // TODO: сократить подобную реализацию
    public static function get(string $uri, array $handler): mixed
    {
        return ['GET', $uri, $handler];
    }

    public static function post(string $uri, array $handler): mixed
    {
        return ['POST', $uri, $handler];
    }
}
