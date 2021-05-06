<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers;

use StubTests\Model\BasePHPElement;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Model\PHPParameter;
use StubTests\Model\StubProblemType;
use StubTests\Parsers\Utils;

class EntitiesFilter
{
    /**
     * @param BasePHPElement[] $entities
     * @param callable|null $additionalFilter
     * @param int ...$problemTypes
     * @return BasePHPElement[]
     */
    public static function getFiltered(array $entities, callable $additionalFilter = null, int ...$problemTypes): array
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
     * @param PHPClass|PHPInterface|null $class
     * @return PHPFunction[]
     */
    public static function getFilteredFunctions($class = null): array
    {
        if ($class === null) {
            $allFunctions = ReflectionStubsSingleton::getReflectionStubs()->getFunctions();
        } else {
            $allFunctions = $class->methods;
        }
        /** @var PHPFunction[] $resultArray */
        $resultArray = [];
        $allFunctions = array_filter($allFunctions, function ($function) {
           return in_array(doubleval(getenv('PHP_VERSION')), Utils::getAvailableInVersions($function));
        });
        foreach (EntitiesFilter::getFiltered($allFunctions, null, StubProblemType::HAS_DUPLICATION, StubProblemType::FUNCTION_PARAMETER_MISMATCH) as $function) {
            $resultArray[] = $function;
        }
        return $resultArray;
    }

    public static function getFilteredParameters(PHPFunction $function, callable $additionalFilter = null, int ...$problemType): array
    {
        /** @var PHPParameter[] $resultArray */
        $resultArray = [];
        foreach (EntitiesFilter::getFiltered(
            $function->parameters,
            $additionalFilter,
            StubProblemType::FUNCTION_PARAMETER_MISMATCH,
            ...$problemType
        ) as $parameter) {
            $resultArray[] = $parameter;
        }
        return $resultArray;
    }

    public static function getFilterFunctionForLanguageLevel(float $languageVersion): callable
    {
        return function ($class, PHPMethod $method, ?float $firstSinceVersion) use ($languageVersion) {
            return $class !== null && !$method->isFinal && !$class->isFinal && $firstSinceVersion !== null &&
                $firstSinceVersion < $languageVersion;
        };
    }

    public static function getFilterFunctionForAllowedTypeHintsInLanguageLevel(float $languageVersion): callable
    {
        return function ($stubClass, PHPMethod $stubMethod, ?float $firstSinceVersion) use ($languageVersion) {
            $reflectionClass = ReflectionStubsSingleton::getReflectionStubs()->getClass($stubClass->name);
            $reflectionMethod = null;
            if ($reflectionClass !== null) {
                $reflectionMethods = array_filter($reflectionClass->methods, function (PHPMethod $method) use ($stubMethod) {
                    return $stubMethod->name === $method->name;
                });
                $reflectionMethod = array_pop($reflectionMethods);
            }
            return $reflectionMethod !== null && ($stubMethod->isFinal || $stubClass->isFinal || $firstSinceVersion !== null &&
                    $firstSinceVersion > $languageVersion);
        };
    }
}
