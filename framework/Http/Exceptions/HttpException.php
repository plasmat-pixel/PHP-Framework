<?php

namespace Artem\PhpFramework\Http\Exceptions;

class HttpException extends \Exception
{
    private int $statusCode;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }
}
