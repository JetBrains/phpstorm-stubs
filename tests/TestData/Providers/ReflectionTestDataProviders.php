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
            if (!$constant->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                yield "constant {$constant->name}" => [$constant];
            }
        }
    }

    public static function constantValuesProvider(): ?Generator
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->getConstants() as $constant) {
            if (!$constant->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                !$constant->hasMutedProblem(StubProblemType::WRONG_CONSTANT_VALUE)) {
                yield "constant {$constant->name}" => [$constant];
            }
        }
    }

    public static function classConstantProvider(): ?Generator
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->getClasses() as $class) {
            if (!$class->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                foreach ($class->constants as $constant) {
                    if (!$constant->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                        yield "constant {$class->name}::{$constant->name}" => [$class, $constant];
                    }
                }
            }
        }

        foreach (ReflectionStubsSingleton::getReflectionStubs()->getInterfaces() as $interface) {
            if (!$interface->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                foreach ($interface->constants as $constant) {
                    if (!$constant->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                        yield "constant {$interface->name}::{$constant->name}" => [$interface, $constant];
                    }
                }
            }
        }
    }

    public static function classConstantValuesProvider(): ?Generator
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->getClasses() as $class) {
            if (!$class->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                foreach ($class->constants as $constant) {
                    if (!$constant->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                        !$constant->hasMutedProblem(StubProblemType::WRONG_CONSTANT_VALUE)) {
                        yield "constant {$class->name}::{$constant->name}" => [$class, $constant];
                    }
                }
            }
        }

        foreach (ReflectionStubsSingleton::getReflectionStubs()->getInterfaces() as $interface) {
            if (!$interface->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                foreach ($interface->constants as $constant) {
                    if (!$constant->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                        !$constant->hasMutedProblem(StubProblemType::WRONG_CONSTANT_VALUE)) {
                        yield "constant {$interface->name}::{$constant->name}" => [$interface, $constant];
                    }
                }
            }
        }
    }


    public static function functionProvider(): ?Generator
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->getFunctions() as $function) {
            if (!$function->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                yield "function {$function->name}" => [$function];
            }
        }
    }

    public static function classProvider(): ?Generator
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->getClasses() as $class) {
            //exclude classes from PHPReflectionParser
            if (strncmp($class->name, 'PHP', 3) !== 0 &&
                !$class->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                yield "class {$class->name}" => [$class];
            }
        }
    }

    public static function functionParametersProvider(): ?Generator
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->getFunctions() as $function) {
            if (!$function->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                !$function->hasMutedProblem(StubProblemType::FUNCTION_PARAMETER_MISMATCH)) {
                foreach ($function->parameters as $parameter) {
                    if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_NAME_MISMATCH) &&
                        !$parameter->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                        yield "$function->name($parameter->name)" => [$function, $parameter];
                    }
                }
            }
        }
    }

    public static function methodParametersProvider(): ?Generator
    {
        foreach (ReflectionStubsSingleton::getReflectionStubs()->getClasses() as $class) {
            //exclude classes from PHPReflectionParser
            if (strncmp($class->name, 'PHP', 3) !== 0 &&
                !$class->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                foreach ($class->methods as $method) {
                    if (!$method->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                        !$method->hasMutedProblem(StubProblemType::FUNCTION_PARAMETER_MISMATCH)) {
                        foreach ($method->parameters as $parameter) {
                            if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_NAME_MISMATCH) &&
                                !$parameter->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                                yield "$class->name::$method->name($parameter->name)" => [$class, $method, $parameter];
                            }
                        }
                    }
                }
            }
        }

        foreach (ReflectionStubsSingleton::getReflectionStubs()->getInterfaces() as $interface) {
            //exclude classes from PHPReflectionParser
            if (strncmp($interface->name, 'PHP', 3) !== 0 &&
                !$interface->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                foreach ($interface->methods as $method) {
                    if (!$method->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                        !$method->hasMutedProblem(StubProblemType::FUNCTION_PARAMETER_MISMATCH)) {
                        foreach ($method->parameters as $parameter) {
                            if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_NAME_MISMATCH) &&
                                !$parameter->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                                yield "$interface->name::$method->name($parameter->name)" => [$interface, $method, $parameter];
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
            if (!$interface->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                yield "interface {$interface->name}" => [$interface];
            }
        }
    }
}
