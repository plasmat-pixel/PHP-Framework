<?php

use App\Someone;
use Artem\PhpFramework\Http\Kernel;
use Artem\PhpFramework\Http\Request;
use Artem\PhpFramework\Http\Response;

require_once dirname(__DIR__) .  '/vendor/autoload.php';

$request = Request::createFromGlobals();

$kernel = new Kernel();
$response = $kernel->handle($request);

$response->send();
