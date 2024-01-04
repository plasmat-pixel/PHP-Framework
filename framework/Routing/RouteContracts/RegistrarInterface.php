<?php

namespace Artem\PhpFramework\Routing\RouteContracts;

interface RegistrarInterface
{
    public static function get(string $uri,  array $handler): mixed;
    public static function post(string $uri,  array $handler): mixed;
}
