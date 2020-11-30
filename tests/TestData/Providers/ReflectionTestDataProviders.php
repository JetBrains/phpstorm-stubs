<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers;

use Generator;
use StubTests\Model\StubProblemType;

class ReflectionTestDataProviders
{

    public static function constantProvider(): ?Generator
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->getConstants() as $constant) {
            yield "constant {$constant->name}" => [$constant];
        }
    }

    public static function functionProvider(): ?Generator
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->getFunctions() as $function) {
            yield "function {$function->name}" => [$function];
        }
    }

    public static function classProvider(): ?Generator
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->getClasses() as $class) {
            //exclude classes from PHPReflectionParser
            if (strncmp($class->name, 'PHP', 3) !== 0) {
                yield "class {$class->name}" => [$class];
            }
        }
    }

    public static function functionParametersForNameCheckingProvider(): ?Generator
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->getFunctions() as $function) {
            if (!$function->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                !$function->hasMutedProblem(StubProblemType::FUNCTION_PARAMETER_MISMATCH)) {
                foreach ($function->parameters as $parameter) {
                    if (!$parameter->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                        yield "$function->name($parameter->name)" => [$function, $parameter];
                    }
                }
            }
        }
    }

    public static function functionParametersForTypeCheckingProvider(): ?Generator
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->getFunctions() as $function) {
            if (!$function->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                !$function->hasMutedProblem(StubProblemType::FUNCTION_PARAMETER_MISMATCH)) {
                foreach ($function->parameters as $parameter) {
                    if (!$parameter->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                        !$parameter->hasMutedProblem(StubProblemType::PARAMETER_NAME_MISMATCH)) {
                        yield "$function->name($parameter->name)" => [$function, $parameter];
                    }
                }
            }
        }
    }

    public static function methodParametersForNamesCheckingProvider(): ?Generator
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->getClasses() as $class) {
            //exclude classes from PHPReflectionParser
            if (strncmp($class->name, 'PHP', 3) !== 0 && !$class->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                foreach ($class->methods as $method) {
                    if (!$method->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                        !$method->hasMutedProblem(StubProblemType::FUNCTION_PARAMETER_MISMATCH)) {
                        foreach ($method->parameters as $parameter) {
                            if (!$parameter->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                                yield "$class->name::$method->name($parameter->name)" => [$class, $method, $parameter];
                            }
                        }
                    }
                }
            }
        }
    }

    public static function methodParametersForTypesCheckingProvider(): ?Generator
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->getClasses() as $class) {
            //exclude classes from PHPReflectionParser
            if (strncmp($class->name, 'PHP', 3) !== 0 && !$class->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                foreach ($class->methods as $method) {
                    if (!$method->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                        !$method->hasMutedProblem(StubProblemType::FUNCTION_PARAMETER_MISMATCH)) {
                        foreach ($method->parameters as $parameter) {
                            if (!$parameter->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                                !$parameter->hasMutedProblem(StubProblemType::PARAMETER_NAME_MISMATCH)) {
                                yield "$class->name::$method->name($parameter->name)" => [$class, $method, $parameter];
                            }
                        }
                    }
                }
            }
        }
    }

    public static function interfaceProvider(): ?Generator
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->getInterfaces() as $interface) {
            yield "interface {$interface->name}" => [$interface];
        }
    }
}
