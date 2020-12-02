<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers;

use Generator;
use StubTests\Model\StubProblemType;
use StubTests\StubsTypeHintsTest;

class StubsTestDataProviders
{
    public static function stubClassConstantProvider(): ?Generator
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getClasses() as $class) {
            foreach ($class->constants as $constant) {
                yield "constant {$class->name}::{$constant->name}" => [$class->name, $constant];
            }
        }

        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces() as $interfaceName => $interface) {
            foreach ($interface->constants as $constantName => $constant) {
                yield "constant {$interfaceName}::{$constantName}" => [$interfaceName, $constant];
            }
        }
    }

    public static function stubConstantProvider(): ?Generator
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getConstants() as $constantName => $constant) {
            yield "constant {$constantName}" => [$constant];
        }
    }

    public static function stubFunctionProvider(): ?Generator
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getFunctions() as $functionName => $function) {
            yield "function {$functionName}" => [$function];
        }
    }

    public static function stubClassProvider(): ?Generator
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getClasses() as $class) {
            yield "class {$class->name}" => [$class];
        }

        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces() as $interface) {
            yield "interface {$interface->name}" => [$interface];
        }
    }

    public static function stubMethodProvider(): ?Generator
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getClasses() as $className => $class) {
            foreach ($class->methods as $methodName => $method) {
                yield "method {$className}::{$methodName}" => [$methodName, $method];
            }
        }

        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces() as $interfaceName => $interface) {
            foreach ($interface->methods as $methodName => $method) {
                yield "method {$interfaceName}::{$methodName}" => [$methodName, $method];
            }
        }
    }

    public static function stubMethodParametersWithoutScalarTypeHintsProvider(): ?Generator
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses() as $className => $class) {
            if (!$class->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                foreach ($class->methods as $methodName => $method) {
                    $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                    if ($class !== null && !$method->isFinal && !$class->isFinal && $firstSinceVersion !== -1 && $firstSinceVersion < 7) {
                        if (!$method->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                            !$method->hasMutedProblem(StubProblemType::FUNCTION_PARAMETER_MISMATCH)) {
                            foreach ($method->parameters as $parameter) {
                                if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_NAME_MISMATCH) &&
                                    !$parameter->hasMutedProblem(StubProblemType::PARAMETER_HAS_SCALAR_TYPEHINT)) {
                                    yield "method {$className}::{$methodName}($parameter->name)" => [$method, $parameter];
                                }
                            }
                        }
                    }
                }
            }
        }

        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces() as $interfaceName => $interface) {
            if (!$interface->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                foreach ($interface->methods as $methodName => $method) {
                    $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                    if ($firstSinceVersion !== -1 && $firstSinceVersion < 7) {
                        if (!$method->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                            !$method->hasMutedProblem(StubProblemType::FUNCTION_PARAMETER_MISMATCH)) {
                            foreach ($method->parameters as $parameter) {
                                if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_NAME_MISMATCH) &&
                                    !$parameter->hasMutedProblem(StubProblemType::PARAMETER_HAS_SCALAR_TYPEHINT)) {
                                    yield "method {$interface->name}::{$methodName}($parameter->name)" => [$method, $parameter];
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public static function stubMethodParametersWithoutNullableTypeHintsProvider(): ?Generator
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses() as $className => $class) {
            if (!$class->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                foreach ($class->methods as $methodName => $method) {
                    $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                    if ($class !== null && !$method->isFinal && !$class->isFinal && $firstSinceVersion !== -1 && $firstSinceVersion < 7.1) {
                        if (!$method->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                            !$method->hasMutedProblem(StubProblemType::FUNCTION_PARAMETER_MISMATCH)) {
                            foreach ($method->parameters as $parameter) {
                                if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_NAME_MISMATCH) &&
                                    !$parameter->hasMutedProblem(StubProblemType::HAS_NULLABLE_TYPEHINT)) {
                                    yield "method {$className}::{$methodName}($parameter->name)" => [$method, $parameter];
                                }
                            }
                        }
                    }
                }
            }
        }

        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces() as $interfaceName => $interface) {
            if (!$interface->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                foreach ($interface->methods as $methodName => $method) {
                    $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                    if ($firstSinceVersion !== -1 && $firstSinceVersion < 7.1) {
                        if (!$method->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                            !$method->hasMutedProblem(StubProblemType::FUNCTION_PARAMETER_MISMATCH)) {
                            foreach ($method->parameters as $parameter) {
                                if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_NAME_MISMATCH) &&
                                    !$parameter->hasMutedProblem(StubProblemType::PARAMETER_HAS_SCALAR_TYPEHINT)) {
                                    yield "method {$interface->name}::{$methodName}($parameter->name)" => [$method, $parameter];
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public static function stubMethodParametersWithoutUnionTypeHintsProvider(): ?Generator
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses() as $className => $class) {
            if (!$class->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                foreach ($class->methods as $methodName => $method) {
                    $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                    if ($class !== null && !$method->isFinal && !$class->isFinal && $firstSinceVersion !== -1 && $firstSinceVersion < 8) {
                        if (!$method->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                            !$method->hasMutedProblem(StubProblemType::FUNCTION_PARAMETER_MISMATCH)) {
                            foreach ($method->parameters as $parameter) {
                                if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_NAME_MISMATCH) &&
                                    !$parameter->hasMutedProblem(StubProblemType::HAS_UNION_TYPEHINT)) {
                                    yield "method {$className}::{$methodName}($parameter->name)" => [$method, $parameter];
                                }
                            }
                        }
                    }
                }
            }
        }

        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces() as $interfaceName => $interface) {
            if (!$interface->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                foreach ($interface->methods as $methodName => $method) {
                    $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                    if ($firstSinceVersion !== -1 && $firstSinceVersion < 8) {
                        if (!$method->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                            !$method->hasMutedProblem(StubProblemType::FUNCTION_PARAMETER_MISMATCH)) {
                            foreach ($method->parameters as $parameter) {
                                if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_NAME_MISMATCH) &&
                                    !$parameter->hasMutedProblem(StubProblemType::HAS_UNION_TYPEHINT)) {
                                    yield "method {$interface->name}::{$methodName}($parameter->name)" => [$method, $parameter];
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public static function stubMethodWithoutReturnTypeHintsProvider(): ?Generator
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses() as $className => $class) {
            if (!$class->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                foreach ($class->methods as $methodName => $method) {
                    $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                    if ($class !== null && !$method->isFinal && !$class->isFinal && $firstSinceVersion !== -1 && $firstSinceVersion < 7) {
                        if (!$method->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                            !$method->hasMutedProblem(StubProblemType::FUNCTION_HAS_RETURN_TYPEHINT)) {
                            yield "method {$className}::{$methodName}" => [$method];
                        }
                    }
                }
            }
        }

        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces() as $interfaceName => $interface) {
            if (!$interface->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                foreach ($interface->methods as $methodName => $method) {
                    $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                    if ($firstSinceVersion !== -1 && $firstSinceVersion < 7) {
                        if (!$method->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                            !$method->hasMutedProblem(StubProblemType::FUNCTION_HAS_RETURN_TYPEHINT)) {
                            yield "method {$interface->name}::{$methodName}" => [$method];
                        }
                    }
                }
            }
        }
    }

    public static function stubMethodWithoutNullableReturnTypeHintsProvider(): ?Generator
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses() as $className => $class) {
            if (!$class->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                foreach ($class->methods as $methodName => $method) {
                    $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                    if ($class !== null && !$method->isFinal && !$class->isFinal && $firstSinceVersion !== -1 && $firstSinceVersion < 7.1) {
                        if (!$method->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                            !$method->hasMutedProblem(StubProblemType::HAS_NULLABLE_TYPEHINT)) {
                            yield "method {$className}::{$methodName}" => [$method];
                        }
                    }
                }
            }
        }

        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces() as $interfaceName => $interface) {
            if (!$interface->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                foreach ($interface->methods as $methodName => $method) {
                    $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                    if ($firstSinceVersion !== -1 && $firstSinceVersion < 7.1) {
                        if (!$method->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                            !$method->hasMutedProblem(StubProblemType::HAS_NULLABLE_TYPEHINT)) {
                            yield "method {$interface->name}::{$methodName}" => [$method];
                        }
                    }
                }
            }
        }
    }

    public static function stubMethodWithoutUnionReturnTypeHintsProvider(): ?Generator
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses() as $className => $class) {
            if (!$class->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                foreach ($class->methods as $methodName => $method) {
                    $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                    if ($class !== null && !$method->isFinal && !$class->isFinal && $firstSinceVersion !== -1 && $firstSinceVersion < 8) {
                        if (!$method->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                            !$method->hasMutedProblem(StubProblemType::HAS_UNION_TYPEHINT)) {
                            yield "method {$className}::{$methodName}" => [$method];
                        }
                    }
                }
            }
        }

        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces() as $interfaceName => $interface) {
            if (!$interface->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                foreach ($interface->methods as $methodName => $method) {
                    $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                    if ($firstSinceVersion !== -1 && $firstSinceVersion < 8) {
                        if (!$method->hasMutedProblem(StubProblemType::STUB_IS_MISSED) &&
                            !$method->hasMutedProblem(StubProblemType::HAS_UNION_TYPEHINT)) {
                            yield "method {$interface->name}::{$methodName}" => [$method];
                        }
                    }
                }
            }
        }
    }
}
