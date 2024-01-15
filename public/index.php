<?php

use App\Someone;
use Artem\PhpFramework\Http\Kernel;
use Artem\PhpFramework\Http\Request;
use Artem\PhpFramework\Http\Response;
use Artem\PhpFramework\Routing\Router;


define('BASE_PATH',  dirname(__DIR__));
require_once dirname(__DIR__) .  '/vendor/autoload.php';

$container = require BASE_PATH . '/config/services.php';

dd($container);

$request = Request::createFromGlobals();
$router = new Router();
$kernel = new Kernel($router);
$response = $kernel->handle($request);

$response->send();
