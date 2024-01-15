<?php

namespace Artem\PhpFramework\Container;

use Artem\PhpFramework\Container\Exceptions\ContainerException;
use Psr\Container\ContainerInterface;

/**
 * класс Container создания с целью работы для внедрения зависимостей
 */
class Container implements ContainerInterface
{
    private array $services = [];
    /** метод для создания контейнера в нем происходит проверка $concrete and $id, а также присвание $services[] $concrete*/
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

    /** метод для получения контейнера */
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

    private function resolveClassDependencies(array $constructorParams): array
    {
        $classDependencies = [];
        /** @var \ReflectionParameter $constructorParam */
        foreach ($constructorParams as $constructorParam) {
            $serviceType = $constructorParam->getType();
            /** @var \ReflectionNamedType $serviceType */
            $service = $this->get($serviceType->getName());
            $classDependencies[] = $service;
        }

        return $classDependencies;
    }
    /** метод для проверки существуют ли контейнер */
    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }
}
