<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers\Stubs;

use Generator;
use StubTests\Model\StubProblemType;
use StubTests\Parsers\Utils;
use StubTests\TestData\Providers\EntitiesFilter;
use StubTests\TestData\Providers\PhpStormStubsSingleton;

class StubMethodsProvider
{
    public static function allMethodsProvider(): ?Generator
    {
        $classesAndInterfaces = PhpStormStubsSingleton::getPhpStormStubs()->getClasses() +
            PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces();
        foreach ($classesAndInterfaces as $className => $class) {
            foreach ($class->methods as $methodName => $method) {
                yield "method {$className}::{$methodName}" => [$methodName, $method];
            }
        }
    }

    public static function methodsForReturnTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForLanguageLevel(7);
        return self::yieldFilteredMethods($filterFunction, StubProblemType::FUNCTION_HAS_RETURN_TYPEHINT);
    }

    public static function methodsForNullableReturnTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForLanguageLevel(7.1);
        return self::yieldFilteredMethods($filterFunction, StubProblemType::HAS_NULLABLE_TYPEHINT);
    }

    public static function methodsForUnionReturnTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForLanguageLevel(8);
        return self::yieldFilteredMethods($filterFunction, StubProblemType::HAS_UNION_TYPEHINT);
    }

    private static function yieldFilteredMethods(callable $filterFunction, int ...$problemTypes): ?Generator
    {
        $coreClassesAndInterfaces = PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses() +
            PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces();
        foreach (EntitiesFilter::getFiltered($coreClassesAndInterfaces) as $className => $class) {
            foreach (EntitiesFilter::getFiltered($class->methods, null, ...$problemTypes) as $methodName => $method) {
                $firstSinceVersion = Utils::getDeclaredSinceVersion($method);
                if ($filterFunction($class, $method, $firstSinceVersion) === true) {
                    yield "method {$className}::{$methodName}" => [$method];
                }
            }
        }
    }
}
