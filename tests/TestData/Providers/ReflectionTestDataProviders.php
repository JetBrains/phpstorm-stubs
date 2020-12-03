<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers;

use Generator;

class ReflectionTestDataProviders
{

    public static function constantProvider(): ?Generator
    {
        foreach (EntitiesFilter::getFiltered(ReflectionStubsSingleton::getReflectionStubs()->getConstants()) as $constant) {
            yield "constant {$constant->name}" => [$constant];
        }
    }

    public static function constantValuesProvider(): ?Generator
    {
        foreach (EntitiesFilter::getFilteredConstants() as $constant) {
            yield "constant {$constant->name}" => [$constant];
        }
    }

    public static function classConstantProvider(): ?Generator
    {
        $classesAndInterfaces = ReflectionStubsSingleton::getReflectionStubs()->getClasses() +
            ReflectionStubsSingleton::getReflectionStubs()->getInterfaces();
        foreach (EntitiesFilter::getFiltered($classesAndInterfaces) as $class) {
            foreach (EntitiesFilter::getFiltered($class->constants) as $constant) {
                yield "constant {$class->name}::{$constant->name}" => [$class, $constant];
            }
        }
    }

    public static function classConstantValuesProvider(): ?Generator
    {
        $classesAndInterfaces = ReflectionStubsSingleton::getReflectionStubs()->getClasses() +
            ReflectionStubsSingleton::getReflectionStubs()->getInterfaces();
        foreach (EntitiesFilter::getFiltered($classesAndInterfaces) as $class) {
            foreach (EntitiesFilter::getFilteredConstants($class) as $constant) {
                yield "constant {$class->name}::{$constant->name}" => [$class, $constant];
            }
        }
    }

    public static function functionProvider(): ?Generator
    {
        foreach (EntitiesFilter::getFiltered(ReflectionStubsSingleton::getReflectionStubs()->getFunctions()) as $function) {
            yield "function {$function->name}" => [$function];
        }
    }

    public static function classProvider(): ?Generator
    {
        foreach (EntitiesFilter::getFiltered(ReflectionStubsSingleton::getReflectionStubs()->getClasses()) as $class) {
            //exclude classes from PHPReflectionParser
            if (strncmp($class->name, 'PHP', 3) !== 0) {
                yield "class {$class->name}" => [$class];
            }
        }
    }

    public static function functionParametersProvider(): ?Generator
    {
        foreach (EntitiesFilter::getFilteredFunctions() as $function) {
            foreach (EntitiesFilter::getFilteredParameters($function) as $parameter) {
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
                    foreach (EntitiesFilter::getFilteredParameters($method) as $parameter) {
                        yield "$class->name::$method->name($parameter->name)" => [$class, $method, $parameter];
                    }
                }
            }
        }
    }

    public static function interfaceProvider(): ?Generator
    {
        foreach (EntitiesFilter::getFiltered(ReflectionStubsSingleton::getReflectionStubs()->getInterfaces()) as $interface) {
            yield "interface {$interface->name}" => [$interface];
        }
    }
}
