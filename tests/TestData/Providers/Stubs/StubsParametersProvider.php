<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers\Stubs;

use Generator;
use StubTests\Model\StubProblemType;
use StubTests\Parsers\Utils;
use StubTests\TestData\Providers\EntitiesFilter;
use StubTests\TestData\Providers\PhpStormStubsSingleton;

class StubsParametersProvider
{
    public static function parametersForScalarTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForLanguageLevel(7);
        return self::yieldFilteredMethodParameters($filterFunction, StubProblemType::PARAMETER_HAS_SCALAR_TYPEHINT);
    }

    public static function parametersFoNullableTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForLanguageLevel(7.1);
        return self::yieldFilteredMethodParameters($filterFunction, StubProblemType::HAS_NULLABLE_TYPEHINT);
    }

    public static function parametersForUnionTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForLanguageLevel(8);
        return self::yieldFilteredMethodParameters($filterFunction, StubProblemType::HAS_UNION_TYPEHINT);
    }

    private static function yieldFilteredMethodParameters(callable $filterFunction, int ...$problemTypes): ?Generator
    {
        $coreClassesAndInterfaces = PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses() +
            PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces();
        foreach (EntitiesFilter::getFiltered($coreClassesAndInterfaces) as $className => $class) {
            foreach (EntitiesFilter::getFilteredFunctions($class) as $methodName => $method) {
                $firstSinceVersion = Utils::getDeclaredSinceVersion($method);
                if ($filterFunction($class, $method, $firstSinceVersion) === true) {
                    foreach (EntitiesFilter::getFilteredParameters($method, ...$problemTypes) as $parameter) {
                        yield "method {$class->name}::{$method->name}($parameter->name)" => [$method, $parameter];
                    }
                }
            }
        }
    }
}
