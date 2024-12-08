<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers\Stubs;

use Exception;
use Generator;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPEnum;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Model\StubProblemType;
use StubTests\Parsers\ParserUtils;
use StubTests\TestData\Providers\EntitiesFilter;
use StubTests\TestData\Providers\PhpStormStubsSingleton;

class StubsParametersProvider
{
    public static function classMethodsParametersForScalarTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = self::getFilterFunctionForLanguageLevel(PHPClass::class, 7);
        return self::yieldFilteredMethodParameters(PHPClass::class, $filterFunction, StubProblemType::PARAMETER_HAS_SCALAR_TYPEHINT);
    }

    public static function interfaceMethodsParametersForScalarTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = self::getFilterFunctionForLanguageLevel(PHPInterface::class, 7);
        return self::yieldFilteredMethodParameters(PHPInterface::class, $filterFunction, StubProblemType::PARAMETER_HAS_SCALAR_TYPEHINT);
    }

    public static function enumMethodsParametersForScalarTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = self::getFilterFunctionForLanguageLevel(PHPEnum::class, 7);
        return self::yieldFilteredMethodParameters(PHPEnum::class, $filterFunction, StubProblemType::PARAMETER_HAS_SCALAR_TYPEHINT);
    }

    public static function classMethodsParametersForNullableTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = self::getFilterFunctionForLanguageLevel(PHPClass::class, 7.1);
        return self::yieldFilteredMethodParameters(PHPClass::class, $filterFunction, StubProblemType::HAS_NULLABLE_TYPEHINT);
    }

    public static function interfaceMethodsParametersForNullableTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = self::getFilterFunctionForLanguageLevel(PHPInterface::class, 7.1);
        return self::yieldFilteredMethodParameters(PHPInterface::class, $filterFunction, StubProblemType::HAS_NULLABLE_TYPEHINT);
    }

    public static function enumMethodsParametersForNullableTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = self::getFilterFunctionForLanguageLevel(PHPEnum::class, 7.1);
        return self::yieldFilteredMethodParameters(PHPEnum::class, $filterFunction, StubProblemType::HAS_NULLABLE_TYPEHINT);
    }

    public static function classMethodsParametersForUnionTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = self::getFilterFunctionForLanguageLevel(PHPClass::class, 8);
        return self::yieldFilteredMethodParameters(PHPClass::class, $filterFunction, StubProblemType::HAS_UNION_TYPEHINT);
    }

    public static function interfaceMethodsParametersForUnionTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = self::getFilterFunctionForLanguageLevel(PHPInterface::class, 8);
        return self::yieldFilteredMethodParameters(PHPInterface::class, $filterFunction, StubProblemType::HAS_UNION_TYPEHINT);
    }

    public static function enumMethodsParametersForUnionTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = self::getFilterFunctionForLanguageLevel(PHPEnum::class, 8);
        return self::yieldFilteredMethodParameters(PHPEnum::class, $filterFunction, StubProblemType::HAS_UNION_TYPEHINT);
    }

    public static function classMethodsParametersForAllowedScalarTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForAllowedTypeHintsInLanguageLevel(PHPClass::class, 7);
        return self::yieldFilteredMethodParameters(PHPClass::class, $filterFunction, StubProblemType::PARAMETER_TYPE_MISMATCH);
    }

    public static function interfaceMethodsParametersForAllowedScalarTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForAllowedTypeHintsInLanguageLevel(PHPInterface::class, 7);
        return self::yieldFilteredMethodParameters(PHPInterface::class, $filterFunction, StubProblemType::PARAMETER_TYPE_MISMATCH);
    }

    public static function enumMethodsParametersForAllowedScalarTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForAllowedTypeHintsInLanguageLevel(PHPEnum::class, 7);
        return self::yieldFilteredMethodParameters(PHPEnum::class, $filterFunction, StubProblemType::PARAMETER_TYPE_MISMATCH);
    }

    public static function classMethodsParametersForAllowedNullableTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForAllowedTypeHintsInLanguageLevel(PHPClass::class, 7.1);
        return self::yieldFilteredMethodParameters(PHPClass::class, $filterFunction, StubProblemType::PARAMETER_TYPE_MISMATCH);
    }

    public static function interfaceMethodsParametersForAllowedNullableTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForAllowedTypeHintsInLanguageLevel(PHPInterface::class, 7.1);
        return self::yieldFilteredMethodParameters(PHPInterface::class, $filterFunction, StubProblemType::PARAMETER_TYPE_MISMATCH);
    }

    public static function enumMethodsParametersForAllowedNullableTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForAllowedTypeHintsInLanguageLevel(PHPEnum::class, 7.1);
        return self::yieldFilteredMethodParameters(PHPEnum::class, $filterFunction, StubProblemType::PARAMETER_TYPE_MISMATCH);
    }

    public static function classMethodsParametersForAllowedUnionTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForAllowedTypeHintsInLanguageLevel(PHPClass::class, 8);
        return self::yieldFilteredMethodParameters(PHPClass::class, $filterFunction, StubProblemType::HAS_UNION_TYPEHINT);
    }

    public static function interfaceMethodsParametersForAllowedUnionTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForAllowedTypeHintsInLanguageLevel(PHPInterface::class, 8);
        return self::yieldFilteredMethodParameters(PHPInterface::class, $filterFunction, StubProblemType::HAS_UNION_TYPEHINT);
    }

    public static function enumMethodsParametersForAllowedUnionTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForAllowedTypeHintsInLanguageLevel(PHPEnum::class, 8);
        return self::yieldFilteredMethodParameters(PHPEnum::class, $filterFunction, StubProblemType::HAS_UNION_TYPEHINT);
    }

    private static function yieldFilteredMethodParameters(string $classType, callable $filterFunction, int ...$problemTypes): ?Generator
    {
        $classes = match ($classType) {
            PHPClass::class => PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses(),
            PHPInterface::class => PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces(),
            PHPEnum::class => PhpStormStubsSingleton::getPhpStormStubs()->getCoreEnums(),
            default => throw new Exception("Unkown class type"),
        };
        $filtered = EntitiesFilter::getFiltered($classes);
        $toYield = array_filter(
            array_map(
                fn ($class) => array_filter(
                    array_map(
                        fn (PHPMethod $method) => array_filter(
                            EntitiesFilter::getFilteredParameters($method, null, ...$problemTypes),
                            function ($parameter) use ($filterFunction, $class, $method) {
                            if (!empty($parameter->availableVersionsRangeFromAttribute)) {
                                $firstSinceVersion = max(ParserUtils::getDeclaredSinceVersion($method), min($parameter->availableVersionsRangeFromAttribute));
                            } else {
                                $firstSinceVersion = ParserUtils::getDeclaredSinceVersion($method);
                            }
                            return $filterFunction($class, $method, $firstSinceVersion) === true;
                        }
                        ),
                        EntitiesFilter::getFilteredStubsMethods($class)
                    ),
                    fn ($parameters) => !empty($parameters)
                ),
                $filtered
            ),
            fn ($methods) => !empty($methods)
        );
        if (empty($toYield)) {
            yield [null, null, null];
        }else {
            foreach ($filtered as $class) {
                foreach (EntitiesFilter::getFilteredStubsMethods($class) as $method) {
                    foreach (EntitiesFilter::getFilteredParameters($method, null, ...$problemTypes) as $parameter) {
                        if (!empty($parameter->availableVersionsRangeFromAttribute)) {
                            $firstSinceVersion = max(ParserUtils::getDeclaredSinceVersion($method), min($parameter->availableVersionsRangeFromAttribute));
                        } else {
                            $firstSinceVersion = ParserUtils::getDeclaredSinceVersion($method);
                        }
                        if ($filterFunction($class, $method, $firstSinceVersion) === true) {
                            yield "method $class->id::$method->name($parameter->name)_[$method->stubObjectHash]" => [$class->stubObjectHash, $method->stubObjectHash, $parameter->name];
                        }
                    }
                }
            }
        }
    }

    private static function getFilterFunctionForLanguageLevel(string $classType, float $languageVersion): callable
    {
        return match ($classType) {
            PHPClass::class => fn (PHPClass $class, PHPMethod $method, ?float $firstSinceVersion) => !$method->isFinal &&
                !$class->isFinal && $firstSinceVersion !== null && $firstSinceVersion < $languageVersion,
            PHPInterface::class => fn (PHPInterface $class, PHPMethod $method, ?float $firstSinceVersion) => !$method->isFinal &&
                !$class->isFinal && $firstSinceVersion !== null && $firstSinceVersion < $languageVersion,
            PHPEnum::class => fn (PHPEnum $class, PHPMethod $method, ?float $firstSinceVersion) => !$method->isFinal &&
                !$class->isFinal && $firstSinceVersion !== null && $firstSinceVersion < $languageVersion,
            default => throw new Exception("Unknown class type"),
        };
    }
}
