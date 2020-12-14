<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers\Reflection;

use Generator;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPParameter;
use StubTests\Model\StubProblemType;
use StubTests\TestData\Providers\EntitiesFilter;
use StubTests\TestData\Providers\ReflectionStubsSingleton;

class ReflectionParametersProvider
{
    public static function functionParametersProvider(): ?Generator
    {
        foreach (ReflectionTestDataProviders::getFilteredFunctions() as $function) {
            foreach (self::getFilteredParameters($function) as $parameter) {
                yield "$function->name($parameter->name)" => [$function, $parameter];
            }
        }
    }

    public static function methodParametersProvider(): ?Generator
    {
        $classesAndInterfaces = ReflectionStubsSingleton::getReflectionStubs()->getClasses() +
            ReflectionStubsSingleton::getReflectionStubs()->getInterfaces();
        foreach (EntitiesFilter::getFiltered($classesAndInterfaces) as $class) {
            //exclude classes from PHPReflectionParser
            if (strncmp($class->name, 'PHP', 3) !== 0) {
                foreach (ReflectionTestDataProviders::getFilteredFunctions($class) as $method) {
                    foreach (self::getFilteredParameters($method) as $parameter) {
                        yield "$class->name::$method->name($parameter->name)" => [$class, $method, $parameter];
                    }
                }
            }
        }
    }

    public static function getFilteredParameters(PHPFunction $function, int ...$problemType): array
    {
        /** @var PHPParameter[] $resultArray */
        $resultArray = [];
        foreach (EntitiesFilter::getFiltered($function->parameters, StubProblemType::PARAMETER_NAME_MISMATCH, ...$problemType) as $parameter) {
            $resultArray[] = $parameter;
        }
        return $resultArray;
    }
}
