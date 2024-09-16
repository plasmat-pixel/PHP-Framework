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
    private string $appEnv = 'local';
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

    private function createExceptionResponse(\Exception $e): Response
    {
        if (in_array($this->appEnv, ['local', 'testing'])) {
            throw $e;
        }

        if ($e instanceof HttpException) {
            return new Response($e->getMessage(), $e->getStatusCode());
        }

        return new Response('some server error', 500);
    }
}
