<?php

namespace Artem\PhpFramework\Http;

use App\Controller\HomeController;
use Artem\PhpFramework\Http\Exceptions\HttpException;
use Artem\PhpFramework\Http\Exceptions\MethodNotAllowedException;
use Artem\PhpFramework\Http\Exceptions\RouteNotFoundException;
use Artem\PhpFramework\Routing\RouteContracts\RouterInterface;
use FastRoute\RouteCollector;
use League\Container\Container;
use Throwable;

use function FastRoute\simpleDispatcher;

class Kernel
{
    use Helper;
    public function __construct(
        private RouterInterface $router,
        private Container $container
    ) {
        $this->appEnv = $this->container->get('APP_ENV');
    }
    public function handle(Request $request): Response
    {
        try {
            [$routeHandler, $vars] = $this->router->dispatch($request, $this->container);
            $response = call_user_func_array($routeHandler, $vars);
        } catch (\Exception $e) {
            $response = $this->createExceptionResponse($e);
        }
        return $response;
    }
}
