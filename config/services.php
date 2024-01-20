<?php

use Artem\PhpFramework\Http\Kernel;
use League\Container\Container;
use Artem\PhpFramework\Routing\RouteContracts\RouterInterface;
use Artem\PhpFramework\Routing\Router;

$container = new Container();

$container->add(RouterInterface::class, Router::class);
$container->delegate(new League\Container\ReflectionContainer());

return $container;
