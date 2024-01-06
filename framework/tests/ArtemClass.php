<?php

namespace Artem\PhpFramework\Tests;

class ArtemClass
{
    public function __construct(
        private readonly Foo $foo
    ) {
    }

    public function getFoo(): Foo
    {
        return $this->foo;
    }
}
