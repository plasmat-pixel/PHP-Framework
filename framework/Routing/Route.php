<?php

namespace Artem\PhpFramework\Routing;

use Artem\PhpFramework\Routing\RouteContracts\RegistrarInterface;

class Route implements RegistrarInterface
{
    //TODO: сократить подобную реализацию
    public static function get(string $uri, array $handler)
    {
        return ['GET', $uri, $handler];
    }


    public static function post(string $uri, array $handler)
    {
        return ['POST', $uri, $handler];
    }
}
