<?php

use Twig\Environment;
use League\Container\Container;
use Twig\Loader\FilesystemLoader;
use Artem\PhpFramework\Http\Kernel;
use Symfony\Component\Dotenv\Dotenv;
use Artem\PhpFramework\Routing\Router;
use League\Container\ReflectionContainer;
use Artem\PhpFramework\Dbal\ConnectionFactory;
use League\Container\Argument\Literal\ArrayArgument;
use Artem\PhpFramework\Controller\AbstractController;
use League\Container\Argument\Literal\StringArgument;
use Artem\PhpFramework\Routing\RouteContracts\RouterInterface;
use Doctrine\DBAL\Connection;

$dotenv = new Dotenv();
$dotenv->load(BASE_PATH . '/.env');

$routes = include BASE_PATH . '/routes/web.php';
$appEnv = $_ENV['APP_ENV'];
$viewsPath = BASE_PATH . '/resource/view';
$databaseUrl = 'pdo-pgsql://postgres@postgres:5432/database';

$container = new Container();

$container->delegate(new ReflectionContainer(true));

$container->add('APP_ENV', new StringArgument($appEnv));

$container->add(RouterInterface::class, Router::class);

$container->extend(RouterInterface::class)
    ->addMethodCall(
        'registerRoutes',
        [new ArrayArgument($routes)]
    );

$container->add(Kernel::class)
    ->addArguments([RouterInterface::class, $container]);

$container->addShared('twig-loader', FilesystemLoader::class)
    ->addArgument(new StringArgument($viewsPath));

$container->addShared('twig', Environment::class)
    ->addArgument('twig-loader');

$container->add(AbstractController::class)
    ->addMethodCall('setContainer', [$container]);

$container->inflector(AbstractController::class)
    ->invokeMethod('setContainer', [$container]);

$container->add(ConnectionFactory::class)
    ->addArgument(new StringArgument($databaseUrl));

$container->addShared(Connection::class, function () use ($container): Connection {
    return $container->get(ConnectionFactory::class)->create();
});
return $container;
