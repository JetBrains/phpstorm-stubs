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
use StubTests\TestData\Providers\Reflection\ReflectionParametersProvider;
use StubTests\TestData\Providers\Reflection\ReflectionTestDataProviders;

class StubsParametersProvider
{
    public static function parametersForScalarTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = fn(PHPClass|PHPInterface $class, PHPMethod $method, int $firstSinceVersion) =>
            $class !== null && !$method->isFinal && !$class->isFinal && $firstSinceVersion !== -1 && $firstSinceVersion < 7;
        return self::yieldFilteredMethodParameters($filterFunction, StubProblemType::PARAMETER_HAS_SCALAR_TYPEHINT);
    }

    public static function parametersFoNullableTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = fn(PHPClass|PHPInterface $class, PHPMethod $method, int $firstSinceVersion) =>
            $class !== null && !$method->isFinal && !$class->isFinal && $firstSinceVersion !== -1 && $firstSinceVersion < 7.1;
        return self::yieldFilteredMethodParameters($filterFunction, StubProblemType::HAS_NULLABLE_TYPEHINT);
    }

    public static function parametersForUnionTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = fn(PHPClass|PHPInterface $class, PHPMethod $method, int $firstSinceVersion) =>
            $class !== null && !$method->isFinal && !$class->isFinal && $firstSinceVersion !== -1 && $firstSinceVersion < 8;
        return self::yieldFilteredMethodParameters($filterFunction, StubProblemType::HAS_UNION_TYPEHINT);
    }

    public static function yieldFilteredMethodParameters(callable $filterFunction, int ...$problemTypes): ?Generator
    {
        $coreClassesAndInterfaces = PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses() +
            PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces();
        foreach (EntitiesFilter::getFiltered($coreClassesAndInterfaces) as $className => $class) {
            foreach (ReflectionTestDataProviders::getFilteredFunctions($class) as $methodName => $method) {
                $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                if ($filterFunction($class, $method, $firstSinceVersion) === true) {
                    foreach (ReflectionParametersProvider::getFilteredParameters($method, ...$problemTypes) as $parameter) {
                        yield "method {$class->name}::{$method->name}($parameter->name)" => [$method, $parameter];
                    }
                }
            }
        }
    }
}
