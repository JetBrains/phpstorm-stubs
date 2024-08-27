<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers;

use Exception;
use RuntimeException;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPEnum;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Model\PHPParameter;
use StubTests\Model\StubProblemType;
use StubTests\Parsers\ParserUtils;

class EntitiesFilter
{
    public static function getFiltered(array $entities, ?callable $additionalFilter = null, int ...$problemTypes): array
    {
        $resultArray = [];
        $hasProblem = false;
        foreach ($entities as $key => $entity) {
            foreach ($problemTypes as $problemType) {
                if ($entity->hasMutedProblem($problemType)) {
                    $hasProblem = true;
                }
            }
            if ($entity->hasMutedProblem(StubProblemType::STUB_IS_MISSED) ||
                $additionalFilter !== null && $additionalFilter($entity) === true) {
                $hasProblem = true;
            }
            if ($hasProblem) {
                $hasProblem = false;
            } else {
                $resultArray[$key] = $entity;
            }
        }

        return $resultArray;
    }

    /**
     * @return PHPFunction[]
     */
    public static function getFilteredStubsFunctions(bool $shouldSuitCurrentPhpVersion = true): array
    {
        $allFunctions = ReflectionStubsSingleton::getReflectionStubs()->getFunctions();
        /** @var PHPFunction[] $resultArray */
        $resultArray = [];
        $allFunctions = array_filter(
            $allFunctions,
            fn ($function) => !$shouldSuitCurrentPhpVersion || ParserUtils::entitySuitsCurrentPhpVersion($function)
        );
        foreach (self::getFiltered($allFunctions, null, StubProblemType::HAS_DUPLICATION, StubProblemType::FUNCTION_PARAMETER_MISMATCH) as $function) {
            $resultArray[] = $function;
        }
        return $resultArray;
    }

    /**
     * @return PHPFunction[]
     * @throws RuntimeException
     */
    public static function getFilteredReflectionFunctions(): array
    {
        $allFunctions = ReflectionStubsSingleton::getReflectionStubs()->getFunctions();
        /** @var PHPFunction[] $resultArray */
        $resultArray = [];
        foreach (self::getFiltered(
            $allFunctions,
            null,
            StubProblemType::HAS_DUPLICATION
        ) as $function) {
            $resultArray[] = $function;
        }
        return $resultArray;
    }

    public static function getFilteredReflectionMethods(PHPInterface|PHPClass $class): array
    {
        $allMethods = $class->methods;
        $resultArray = [];
        foreach (self::getFiltered(
            $allMethods,
            null,
            StubProblemType::HAS_DUPLICATION,
            StubProblemType::FUNCTION_PARAMETER_MISMATCH
        ) as $function) {
            $resultArray[] = $function;
        }
        return $resultArray;
    }

    /**
     * @return PHPFunction[]
     * @throws RuntimeException
     */
    public static function getFilteredStubsMethods(PHPInterface|PHPClass $class, bool $shouldSuitCurrentPhpVersion = true): array
    {
        $allMethods = $class->methods;
        /** @var PHPFunction[] $resultArray */
        $resultArray = [];
        $allMethods = array_filter(
            $allMethods,
            fn (PHPMethod $method) => !$shouldSuitCurrentPhpVersion || ParserUtils::entitySuitsCurrentPhpVersion($method)
        );
        foreach (self::getFiltered(
            $allMethods,
            fn (PHPMethod $method) => $method->parentId === '\___PHPSTORM_HELPERS\object',
            StubProblemType::HAS_DUPLICATION,
            StubProblemType::FUNCTION_PARAMETER_MISMATCH
        ) as $function) {
            $resultArray[] = $function;
        }
        return $resultArray;
    }

    public static function getFilteredParameters(PHPFunction $function, ?callable $additionalFilter = null, int ...$problemType): array
    {
        /** @var PHPParameter[] $resultArray */
        $resultArray = [];
        foreach (self::getFiltered(
            $function->parameters,
            $additionalFilter,
            StubProblemType::FUNCTION_PARAMETER_MISMATCH,
            ...$problemType
        ) as $parameter) {
            $resultArray[] = $parameter;
        }
        return $resultArray;
    }

    public static function getFilterFunctionForAllowedTypeHintsInLanguageLevel(string $classType, float $languageVersion): callable
    {
        return match ($classType) {
            PHPClass::class => function (PHPClass $stubClass, PHPMethod $stubMethod, ?float $firstSinceVersion) use ($languageVersion) {
                $reflectionClass = ReflectionStubsSingleton::getReflectionStubs()->getClass($stubClass->id, fromReflection: true);
                $reflectionMethod = null;
                if ($reflectionClass !== null) {
                    $reflectionMethods = array_filter(
                        $reflectionClass->methods,
                        fn (PHPMethod $method) => $stubMethod->name === $method->name
                    );
                    $reflectionMethod = array_pop($reflectionMethods);
                }
                return $reflectionMethod !== null && ($stubMethod->isFinal || $stubClass->isFinal || $firstSinceVersion !== null &&
                        $firstSinceVersion > $languageVersion);
            },
            PHPInterface::class => function (PHPInterface $stubClass, PHPMethod $stubMethod, ?float $firstSinceVersion) use ($languageVersion) {
                $reflectionClass = ReflectionStubsSingleton::getReflectionStubs()->getInterface($stubClass->id, fromReflection: true);
                $reflectionMethod = null;
                if ($reflectionClass !== null) {
                    $reflectionMethods = array_filter(
                        $reflectionClass->methods,
                        fn (PHPMethod $method) => $stubMethod->name === $method->name
                    );
                    $reflectionMethod = array_pop($reflectionMethods);
                }
                return $reflectionMethod !== null && ($stubMethod->isFinal || $stubClass->isFinal || $firstSinceVersion !== null &&
                        $firstSinceVersion > $languageVersion);
            },
            PHPEnum::class => function (PHPEnum $stubClass, PHPMethod $stubMethod, ?float $firstSinceVersion) use ($languageVersion) {
                $reflectionClass = ReflectionStubsSingleton::getReflectionStubs()->getEnum($stubClass->id, fromReflection: true);
                $reflectionMethod = null;
                if ($reflectionClass !== null) {
                    $reflectionMethods = array_filter(
                        $reflectionClass->methods,
                        fn (PHPMethod $method) => $stubMethod->name === $method->name
                    );
                    $reflectionMethod = array_pop($reflectionMethods);
                }
                return $reflectionMethod !== null && ($stubMethod->isFinal || $stubClass->isFinal || $firstSinceVersion !== null &&
                        $firstSinceVersion > $languageVersion);
            },
            default => throw new Exception("Unknown class type"),
        };
    }
}
