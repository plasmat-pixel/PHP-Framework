<?php

define('BASE_PATH',  dirname(__DIR__));
require_once dirname(__DIR__) .  '/vendor/autoload.php';

use League\Container\Container;
use Artem\PhpFramework\Http\Kernel;
use Artem\PhpFramework\Http\Request;

$request = Request::createFromGlobals();
/** @var Container $container */
$container = require BASE_PATH . '/config/services.php';

$kernel = $container->get(Kernel::class);

$response = $kernel->handle($request);

$response->send();
