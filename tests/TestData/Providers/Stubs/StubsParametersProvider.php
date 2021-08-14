<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers\Stubs;

use Generator;
use RuntimeException;
use StubTests\Model\StubProblemType;
use StubTests\Parsers\ParserUtils;
use StubTests\TestData\Providers\EntitiesFilter;
use StubTests\TestData\Providers\PhpStormStubsSingleton;
use StubTests\TestData\Providers\ReflectionStubsSingleton;

class StubsParametersProvider
{
    /**
     * @throws RuntimeException
     */
    public static function parametersForScalarTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForLanguageLevel(7);
        return self::yieldFilteredMethodParameters($filterFunction, StubProblemType::PARAMETER_HAS_SCALAR_TYPEHINT);
    }

    /**
     * @throws RuntimeException
     */
    public static function parametersForNullableTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForLanguageLevel(7.1);
        return self::yieldFilteredMethodParameters($filterFunction, StubProblemType::HAS_NULLABLE_TYPEHINT);
    }

    /**
     * @throws RuntimeException
     */
    public static function parametersForUnionTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForLanguageLevel(8);
        return self::yieldFilteredMethodParameters($filterFunction, StubProblemType::HAS_UNION_TYPEHINT);
    }

    /**
     * @throws RuntimeException
     */
    public static function parametersForAllowedScalarTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForAllowedTypeHintsInLanguageLevel(7);
        return self::yieldFilteredMethodParameters($filterFunction, StubProblemType::PARAMETER_TYPE_MISMATCH);
    }

    /**
     * @throws RuntimeException
     */
    public static function parametersForAllowedNullableTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForAllowedTypeHintsInLanguageLevel(7.1);
        return self::yieldFilteredMethodParameters($filterFunction, StubProblemType::PARAMETER_TYPE_MISMATCH);
    }

    /**
     * @throws RuntimeException
     */
    public static function parametersForAllowedUnionTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForAllowedTypeHintsInLanguageLevel(8);
        return self::yieldFilteredMethodParameters($filterFunction, StubProblemType::HAS_UNION_TYPEHINT);
    }

    /**
     * @throws RuntimeException
     */
    private static function yieldFilteredMethodParameters(callable $filterFunction, int ...$problemTypes): ?Generator
    {
        $coreClassesAndInterfaces = PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses() +
            PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces();
        foreach (EntitiesFilter::getFiltered($coreClassesAndInterfaces) as $class) {
            if (!empty(getenv('PECL')) &&
                (!empty(ReflectionStubsSingleton::getReflectionStubsNoPecl()->getClass($class->name)) ||
                    !empty(ReflectionStubsSingleton::getReflectionStubsNoPecl()->getInterface($class->name)))
            ) {
                continue;
            }
            foreach (EntitiesFilter::getFilteredFunctions($class, false) as $method) {
                foreach (EntitiesFilter::getFilteredParameters($method, null, ...$problemTypes) as $parameter) {
                    if (!empty($parameter->availableVersionsRangeFromAttribute)) {
                        $firstSinceVersion = max(ParserUtils::getDeclaredSinceVersion($method), min($parameter->availableVersionsRangeFromAttribute));
                    } else {
                        $firstSinceVersion = ParserUtils::getDeclaredSinceVersion($method);
                    }
                    if ($filterFunction($class, $method, $firstSinceVersion) === true) {
                        yield "method $class->name::$method->name($parameter->name)" => [$class, $method, $parameter];
                    }
                }
            }
        }
    }
}
