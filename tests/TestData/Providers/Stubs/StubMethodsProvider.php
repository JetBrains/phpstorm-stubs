<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers\Stubs;

use Generator;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Model\StubProblemType;
use StubTests\StubsTypeHintsTest;
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
        $filterFunction = fn(PHPClass|PHPInterface $class, PHPMethod $method, $firstSinceVersion) => $class !== null && !$method->isFinal && !$class->isFinal && $firstSinceVersion !== -1 && $firstSinceVersion < 7;
        return self::yieldFilteredMethods($filterFunction, StubProblemType::FUNCTION_HAS_RETURN_TYPEHINT);
    }

    public static function methodsForNullableReturnTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = fn(PHPClass|PHPInterface $class, PHPMethod $method, $firstSinceVersion) => $class !== null && !$method->isFinal && !$class->isFinal && $firstSinceVersion !== -1 && $firstSinceVersion < 7.1;
        return self::yieldFilteredMethods($filterFunction, StubProblemType::HAS_NULLABLE_TYPEHINT);
    }

    public static function methodsForUnionReturnTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = fn(PHPClass|PHPInterface $class, PHPMethod $method, $firstSinceVersion) => $class !== null && !$method->isFinal && !$class->isFinal && $firstSinceVersion !== -1 && $firstSinceVersion < 8;
        return self::yieldFilteredMethods($filterFunction, StubProblemType::HAS_UNION_TYPEHINT);
    }

    public static function yieldFilteredMethods(callable $filterFunction, int ...$problemTypes): ?Generator
    {
        $coreClassesAndInterfaces = PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses() +
            PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces();
        foreach (EntitiesFilter::getFiltered($coreClassesAndInterfaces) as $className => $class) {
            foreach (EntitiesFilter::getFiltered($class->methods, ...$problemTypes) as $methodName => $method) {
                $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method); //please vote WI-57343 to fix inspection warning
                if ($filterFunction($class, $method, $firstSinceVersion) === true) {
                    yield "method {$className}::{$methodName}" => [$method];
                }
            }
        }
    }
}
