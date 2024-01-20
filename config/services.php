<?php

use Artem\PhpFramework\Http\Kernel;
use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Container;
use Artem\PhpFramework\Routing\RouteContracts\RouterInterface;
use Artem\PhpFramework\Routing\Router;

$routes = include BASE_PATH . '/routes/web.php';
$container = new Container();

$container->add(RouterInterface::class, Router::class);

$container->extend(RouterInterface::class)
    ->addMethodCall(
        'registerRoutes',
        [new ArrayArgument($routes)]
    );

$container->delegate(new League\Container\ReflectionContainer());

return $container;
