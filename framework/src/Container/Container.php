<?php

namespace Artem\PhpFramework\Container;

use Artem\PhpFramework\Container\Exceptions\ContainerException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private array $services = [];
    public function add(string $id, string|object $concrete = null)
    {
        if (is_null($concrete)) {
            if (!class_exists($id)) {
                throw new ContainerException("Service $id not found");
            }
            $concrete = $id;
        }

        $this->services[$id] = $concrete;
    }

    public function get(string $id)
    {
        if (!$this->has($id)) {
            if (!class_exists($id)) {
                throw new ContainerException("Service $id could not be resolved");
            }
            $this->add($id);
        }
        $instance = $this->resolve($this->services[$id]);
        return $instance;
    }

    private function resolve($class): null|object
    {
        /** сделал объект класса Reflection */

        $reflectionClass = new \ReflectionClass($class);
        /** создал получение метода конструктора класса Reflection */

        $constructor = $reflectionClass->getConstructor();
        /** сделал проверку на сушествование метода конструктора, если его нет создаю инстанс */
        if (is_null($constructor)) {
            return $reflectionClass->newInstance();
        }
        /** получение параметров конструктора */
        $constructorParams = $constructor->getParameters();
        /** получение зависимостей класса */
        $classDependency = $this->resolveClassDependencies($constructorParams);
        /** получение класса с зависимостями */
        $instance =  $reflectionClass->newInstanceArgs($classDependency);
        return $instance;
    }

    // private function resolveClassDependencies()
    // {
    // }

    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }
}
