<?php

use League\Container\Container;
use Artem\PhpFramework\Http\Kernel;
use Symfony\Component\Dotenv\Dotenv;
use Artem\PhpFramework\Routing\Router;
use League\Container\ReflectionContainer;
use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Argument\Literal\StringArgument;
use Artem\PhpFramework\Routing\RouteContracts\RouterInterface;

$dotenv = new Dotenv();
$dotenv->load(BASE_PATH . '/.env');
$appEnv = $_ENV['APP_ENV'];

$routes = include BASE_PATH . '/routes/web.php';
$container = new Container();

$container->add(RouterInterface::class, Router::class);

$container->delegate(new ReflectionContainer(true));

$container->add('APP_ENV', new StringArgument($appEnv));

$container->extend(RouterInterface::class)
    ->addMethodCall(
        'registerRoutes',
        [new ArrayArgument($routes)]
    );

$container->add(Kernel::class)
    ->addArguments([RouterInterface::class, $container]);

return $container;
