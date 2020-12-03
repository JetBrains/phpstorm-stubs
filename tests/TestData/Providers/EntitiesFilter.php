<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers;

use StubTests\Model\BasePHPElement;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\StubProblemType;

class EntitiesFilter
{
    /**
     * @param BasePHPElement[] $entities
     * @param int ...$problemTypes
     * @return array
     */
    public static function getFiltered(array $entities, int ...$problemTypes): array
    {
        $resultArray = [];
        $hasProblem = false;
        foreach ($entities as $entity) {
            if (!empty($problemTypes)) {
                foreach ($problemTypes as $problemType) {
                    if ($entity->hasMutedProblem($problemType)) {
                        $hasProblem = true;
                    }
                }
            }
            if ($entity->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                $hasProblem = true;
            }
            if ($hasProblem === false) {
                $resultArray[] = $entity;
            } else {
                $hasProblem = false;
            }
        }

        return $resultArray;
    }

    public static function getFilteredFunctions(PHPClass|PHPInterface $class = null): array
    {
        if ($class === null) {
            $allFunctions = ReflectionStubsSingleton::getReflectionStubs()->getFunctions();
        } else {
            $allFunctions = $class->methods;
        }
        $resultArray = [];
        foreach (self::getFiltered($allFunctions, StubProblemType::FUNCTION_PARAMETER_MISMATCH) as $function) {
            $resultArray[] = $function;
        }
        return $resultArray;
    }

    public static function getFilteredConstants(PHPClass|PHPInterface $class = null): array
    {
        if ($class === null) {
            $allConstants = ReflectionStubsSingleton::getReflectionStubs()->getConstants();
        } else {
            $allConstants = $class->constants;
        }
        $resultArray = [];
        foreach (self::getFiltered($allConstants, StubProblemType::WRONG_CONSTANT_VALUE) as $constant) {
            $resultArray[] = $constant;
        }
        return $resultArray;
    }

    public static function getFilteredParameters(PHPFunction $function, int ...$problemType): array
    {
        $resultArray = [];
        foreach (self::getFiltered($function->parameters, StubProblemType::PARAMETER_NAME_MISMATCH, ...$problemType) as $parameter) {
            $resultArray[] = $parameter;
        }
        return $resultArray;
    }
}
