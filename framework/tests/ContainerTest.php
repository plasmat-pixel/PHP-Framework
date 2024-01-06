<?php

namespace Artem\PhpFramework\Tests;

use PHPUnit\Framework\TestCase;
use Artem\PhpFramework\Container\Container;
use Artem\PhpFramework\Container\Exceptions\ContainerException;

class ContainerTest extends TestCase
{
    public function test_getting_service_from_container()
    {
        $container = new Container();
        $container->add('artem-class', ArtemClass::class);
        $this->assertInstanceOf(ArtemClass::class, $container->get('artem-class'));
    }

    public function test_container_has_exception_ContainerException_if_there_is_add_error()
    {
        $container = new Container();
        $this->expectException(ContainerException::class);
        $container->add('no-class');
    }

    public function test_has_method_exists()
    {
        $container = new Container();
        $container->add('artem-class', ArtemClass::class);
        $this->assertTrue($container->has('artem-class'));
        $this->assertFalse($container->has('no-class'));
    }
}
