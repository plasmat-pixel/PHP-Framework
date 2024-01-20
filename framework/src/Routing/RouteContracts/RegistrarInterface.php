<?php

namespace Artem\PhpFramework\Routing\RouteContracts;

interface RegistrarInterface
{
    public static function get(string $uri,  array|callable $handler): mixed;
    public static function post(string $uri,  array|callable $handler): mixed;
}
