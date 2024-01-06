<?php

namespace Artem\PhpFramework\Tests;

use PHPUnit\Framework\TestCase;
use Artem\PhpFramework\Container\Container;

class ContainerTest extends TestCase
{
    public function test_getting_service_from_container()
    {
        $container = new Container();
        $container->add('artem-class', ArtemClass::class);
        $this->assertInstanceOf(ArtemClass::class, $container->get('artem-class'));
    }
}
