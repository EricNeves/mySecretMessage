<?php

namespace App\Infrastructure\Http;

use ReflectionClass;

class Controller
{
    public static function resolveDependecies(string $class): object
    {
        $reflectionClass = new ReflectionClass($class);

        $contructor = $reflectionClass->getConstructor();

        if (!$contructor) {
            return $reflectionClass->newInstance();
        }

        $parameters = $contructor->getParameters();

        $newParams = [];

        foreach ($parameters as $parameter) {
            $dependency  = $parameter->getType()->getName();
            $newParams[] = new $dependency();
        }

        return $reflectionClass->newInstanceArgs($newParams);
    }
}
