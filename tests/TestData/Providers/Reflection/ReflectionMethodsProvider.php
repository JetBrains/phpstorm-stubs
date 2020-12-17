<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers\Reflection;

use Generator;
use StubTests\Model\StubProblemType;
use StubTests\TestData\Providers\EntitiesFilter;
use StubTests\TestData\Providers\ReflectionStubsSingleton;

class ReflectionMethodsProvider
{
    public static function classMethodsProvider(): ?Generator
    {
        return self::yieldFilteredMethods();
    }

    public static function classMethodsWithAccessProvider(): ?Generator
    {
        return self::yieldFilteredMethods(StubProblemType::FUNCTION_ACCESS);
    }

    public static function classFinalMethodsProvider(): ?Generator
    {
        return self::yieldFilteredMethods(StubProblemType::FUNCTION_IS_FINAL);
    }

    public static function classStaticMethodsProvider(): ?Generator
    {
        return self::yieldFilteredMethods(StubProblemType::FUNCTION_IS_STATIC);
    }

    public static function classMethodsWithParametersProvider(): ?Generator
    {
        return self::yieldFilteredMethods(StubProblemType::FUNCTION_PARAMETER_MISMATCH);
    }

    private static function yieldFilteredMethods(int ...$problemTypes): ?Generator
    {
        $classesAndInterfaces = ReflectionStubsSingleton::getReflectionStubs()->getClasses() +
            ReflectionStubsSingleton::getReflectionStubs()->getInterfaces();
        foreach (EntitiesFilter::getFiltered($classesAndInterfaces) as $class) {
            foreach (EntitiesFilter::getFiltered($class->methods, null, ...$problemTypes) as $method) {
                yield "Method {$class->name}::{$method->name}" => [$class, $method];
            }
        }
    }
}
