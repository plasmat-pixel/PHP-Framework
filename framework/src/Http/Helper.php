<?php

namespace Artem\PhpFramework\Http;

use Artem\PhpFramework\Http\Response;
use Artem\PhpFramework\Http\Exceptions\HttpException;

trait Helper
{
    private string $appEnv;

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
