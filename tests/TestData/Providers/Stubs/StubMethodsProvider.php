<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers\Stubs;

use Generator;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPMethod;
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
                yield "method $className::$methodName" => [$method];
            }
        }
    }

    public static function allFunctionAndMethodsWithReturnTypeHintsProvider(): ?Generator
    {
        $coreClassesAndInterfaces = PhpStormStubsSingleton::getPhpStormStubs()->getClasses() +
            PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces();
        $allFunctions = PhpStormStubsSingleton::getPhpStormStubs()->getFunctions();
        $filteredMethods = [];
        foreach (EntitiesFilter::getFiltered($coreClassesAndInterfaces) as $className => $class) {
            $filteredMethods = EntitiesFilter::getFiltered(
                $class->methods,
                fn (PHPMethod $method) => empty($method->returnTypesFromSignature) || empty($method->returnTypesFromPhpDoc)
                    || $method->parentName === '___PHPSTORM_HELPERS\object',
                StubProblemType::TYPE_IN_PHPDOC_DIFFERS_FROM_SIGNATURE
            );
        }
        $filteredMethods += EntitiesFilter::getFiltered(
            $allFunctions,
            fn (PHPFunction $function) => empty($function->returnTypesFromSignature) || empty($function->returnTypesFromPhpDoc),
            StubProblemType::TYPE_IN_PHPDOC_DIFFERS_FROM_SIGNATURE
        );
        foreach ($filteredMethods as $methodName => $method) {
            if ($method instanceof PHPMethod) {
                yield "method $method->parentName::$methodName" => [$method];
            } else {
                yield "function $methodName" => [$method];
            }
        }
    }

    public static function methodsForReturnTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForLanguageLevel(7);
        return self::yieldFilteredMethods(
            $filterFunction,
            StubProblemType::FUNCTION_HAS_RETURN_TYPEHINT,
            StubProblemType::WRONG_RETURN_TYPEHINT
        );
    }

    public static function methodsForNullableReturnTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForLanguageLevel(7.1);
        return self::yieldFilteredMethods(
            $filterFunction,
            StubProblemType::HAS_NULLABLE_TYPEHINT,
            StubProblemType::WRONG_RETURN_TYPEHINT
        );
    }

    public static function methodsForUnionReturnTypeHintTestsProvider(): ?Generator
    {
        $filterFunction = EntitiesFilter::getFilterFunctionForLanguageLevel(8);
        return self::yieldFilteredMethods(
            $filterFunction,
            StubProblemType::HAS_UNION_TYPEHINT,
            StubProblemType::WRONG_RETURN_TYPEHINT
        );
    }

    private static function yieldFilteredMethods(callable $filterFunction, int ...$problemTypes): ?Generator
    {
        $coreClassesAndInterfaces = PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses() +
            PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces();
        foreach (EntitiesFilter::getFiltered($coreClassesAndInterfaces) as $className => $class) {
            foreach (EntitiesFilter::getFiltered(
                $class->methods,
                fn (PHPMethod $method) => $method->parentName === '___PHPSTORM_HELPERS\object',
                ...$problemTypes
            ) as $methodName => $method) {
                $firstSinceVersion = Utils::getDeclaredSinceVersion($method);
                if ($filterFunction($class, $method, $firstSinceVersion) === true) {
                    yield "method $className::$methodName" => [$method];
                }
            }
        }
    }
}
