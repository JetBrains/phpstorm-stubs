<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers\Reflection;

use Generator;
use StubTests\Model\PHPParameter;
use StubTests\Model\StubProblemType;
use StubTests\TestData\Providers\EntitiesFilter;
use StubTests\TestData\Providers\ReflectionStubsSingleton;

class ReflectionParametersProvider
{
    public static function functionParametersProvider(): ?Generator
    {
        foreach (EntitiesFilter::getFilteredFunctions() as $function) {
            foreach (EntitiesFilter::getFilteredParameters($function, null,
                StubProblemType::PARAMETER_TYPE_MISMATCH) as $parameter) {
                yield "$function->name($parameter->name)" => [$function, $parameter];
            }
        }
    }

    public static function functionOptionalParametersProvider(): ?Generator
    {
        foreach (EntitiesFilter::getFilteredFunctions() as $function) {
            foreach (EntitiesFilter::getFilteredParameters($function, fn(PHPParameter $parameter) => !$parameter->isOptional,
                StubProblemType::PARAMETER_TYPE_MISMATCH) as $parameter) {
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
                foreach (EntitiesFilter::getFilteredFunctions($class) as $method) {
                    foreach (EntitiesFilter::getFilteredParameters($method, null) as $parameter) {
                        yield "$class->name::$method->name($parameter->name)" => [$class, $method, $parameter];
                    }
                }
            }
        }
    }
}
