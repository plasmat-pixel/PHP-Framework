<?php

use App\Someone;
use League\Container\Container;
use Artem\PhpFramework\Http\Kernel;
use Artem\PhpFramework\Http\Request;
use Artem\PhpFramework\Http\Response;

define('BASE_PATH',  dirname(__DIR__));
require_once dirname(__DIR__) .  '/vendor/autoload.php';
$request = Request::createFromGlobals();
/** @var Container $container */
$container = require BASE_PATH . '/config/services.php';

$kernel = $container->get(Kernel::class);

$response = $kernel->handle($request);

$response->send();
