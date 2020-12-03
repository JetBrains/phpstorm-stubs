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
        $classesAndInterfaces = PhpStormStubsSingleton::getPhpStormStubs()->getClasses() +
            PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces();
        foreach ($classesAndInterfaces as $class) {
            foreach ($class->constants as $constant) {
                yield "constant {$class->name}::{$constant->name}" => [$class->name, $constant];
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
        $classesAndInterfaces = PhpStormStubsSingleton::getPhpStormStubs()->getClasses() +
            PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces();
        foreach ($classesAndInterfaces as $className => $class) {
            foreach ($class->methods as $methodName => $method) {
                yield "method {$className}::{$methodName}" => [$methodName, $method];
            }
        }
    }

    public static function stubMethodParametersWithoutScalarTypeHintsProvider(): ?Generator
    {
        foreach (EntitiesFilter::getFiltered(PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses()) as $className => $class) {
            foreach (EntitiesFilter::getFilteredFunctions($class) as $methodName => $method) {
                $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                if ($class !== null && !$method->isFinal && !$class->isFinal && $firstSinceVersion !== -1 && $firstSinceVersion < 7) {
                    foreach (EntitiesFilter::getFilteredParameters($method, StubProblemType::PARAMETER_HAS_SCALAR_TYPEHINT) as $parameter) {
                        yield "method {$className}::{$methodName}($parameter->name)" => [$method, $parameter];
                    }
                }
            }
        }

        foreach (EntitiesFilter::getFiltered(PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces()) as $interfaceName => $interface) {
            foreach (EntitiesFilter::getFilteredFunctions($interface) as $methodName => $method) {
                $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                if ($firstSinceVersion !== -1 && $firstSinceVersion < 7) {
                    foreach (EntitiesFilter::getFilteredParameters($method, StubProblemType::PARAMETER_HAS_SCALAR_TYPEHINT) as $parameter) {
                        yield "method {$interface->name}::{$methodName}($parameter->name)" => [$method, $parameter];
                    }
                }
            }
        }
    }

    public static function stubMethodParametersWithoutNullableTypeHintsProvider(): ?Generator
    {
        foreach (EntitiesFilter::getFiltered(PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses()) as $className => $class) {
            foreach (EntitiesFilter::getFilteredFunctions($class) as $methodName => $method) {
                $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                if ($class !== null && !$method->isFinal && !$class->isFinal && $firstSinceVersion !== -1 && $firstSinceVersion < 7.1) {
                    foreach (EntitiesFilter::getFilteredParameters($method, StubProblemType::HAS_NULLABLE_TYPEHINT) as $parameter) {
                        yield "method {$className}::{$methodName}($parameter->name)" => [$method, $parameter];
                    }
                }
            }
        }

        foreach (EntitiesFilter::getFiltered(PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces()) as $interfaceName => $interface) {
            foreach (EntitiesFilter::getFilteredFunctions($interface) as $methodName => $method) {
                $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                if ($firstSinceVersion !== -1 && $firstSinceVersion < 7.1) {
                    foreach (EntitiesFilter::getFilteredParameters($method, StubProblemType::HAS_NULLABLE_TYPEHINT) as $parameter) {
                        yield "method {$interface->name}::{$methodName}($parameter->name)" => [$method, $parameter];
                    }
                }
            }
        }
    }

    public static function stubMethodParametersWithoutUnionTypeHintsProvider(): ?Generator
    {
        foreach (EntitiesFilter::getFiltered(PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses()) as $className => $class) {
            foreach (EntitiesFilter::getFilteredFunctions($class) as $methodName => $method) {
                $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                if ($class !== null && !$method->isFinal && !$class->isFinal && $firstSinceVersion !== -1 && $firstSinceVersion < 8) {
                    foreach (EntitiesFilter::getFilteredParameters($method, StubProblemType::HAS_UNION_TYPEHINT) as $parameter) {
                        yield "method {$className}::{$methodName}($parameter->name)" => [$method, $parameter];
                    }
                }
            }
        }

        foreach (EntitiesFilter::getFiltered(PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces()) as $interfaceName => $interface) {
            foreach (EntitiesFilter::getFilteredFunctions($interface) as $methodName => $method) {
                $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                if ($firstSinceVersion !== -1 && $firstSinceVersion < 8) {
                    foreach (EntitiesFilter::getFilteredParameters($method, StubProblemType::HAS_UNION_TYPEHINT) as $parameter) {
                        yield "method {$interface->name}::{$methodName}($parameter->name)" => [$method, $parameter];
                    }
                }
            }
        }
    }

    public static function stubMethodWithoutReturnTypeHintsProvider(): ?Generator
    {
        foreach (EntitiesFilter::getFiltered(PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses()) as $className => $class) {
            foreach (EntitiesFilter::getFiltered($class->methods, StubProblemType::FUNCTION_HAS_RETURN_TYPEHINT) as $methodName => $method) {
                $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                if ($class !== null && !$method->isFinal && !$class->isFinal && $firstSinceVersion !== -1 && $firstSinceVersion < 7) {
                    yield "method {$className}::{$methodName}" => [$method];
                }
            }
        }

        foreach (EntitiesFilter::getFiltered(PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces()) as $interfaceName => $interface) {
            foreach (EntitiesFilter::getFiltered($interface->methods, StubProblemType::FUNCTION_HAS_RETURN_TYPEHINT) as $methodName => $method) {
                $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                if ($firstSinceVersion !== -1 && $firstSinceVersion < 7) {
                    yield "method {$interface->name}::{$methodName}" => [$method];
                }
            }
        }
    }

    public static function stubMethodWithoutNullableReturnTypeHintsProvider(): ?Generator
    {
        foreach (EntitiesFilter::getFiltered(PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses()) as $className => $class) {
            foreach (EntitiesFilter::getFiltered($class->methods, StubProblemType::HAS_NULLABLE_TYPEHINT) as $methodName => $method) {
                $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                if ($class !== null && !$method->isFinal && !$class->isFinal && $firstSinceVersion !== -1 && $firstSinceVersion < 7.1) {
                    yield "method {$className}::{$methodName}" => [$method];
                }
            }
        }

        foreach (EntitiesFilter::getFiltered(PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces()) as $interfaceName => $interface) {
            foreach (EntitiesFilter::getFiltered($interface->methods, StubProblemType::HAS_NULLABLE_TYPEHINT) as $methodName => $method) {
                $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                if ($firstSinceVersion !== -1 && $firstSinceVersion < 7.1) {
                    yield "method {$interface->name}::{$methodName}" => [$method];
                }
            }
        }
    }

    public static function stubMethodWithoutUnionReturnTypeHintsProvider(): ?Generator
    {
        foreach (EntitiesFilter::getFiltered(PhpStormStubsSingleton::getPhpStormStubs()->getCoreClasses()) as $className => $class) {
            foreach (EntitiesFilter::getFiltered($class->methods, StubProblemType::HAS_UNION_TYPEHINT) as $methodName => $method) {
                $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                if ($class !== null && !$method->isFinal && !$class->isFinal && $firstSinceVersion !== -1 && $firstSinceVersion < 8) {
                    yield "method {$className}::{$methodName}" => [$method];
                }
            }
        }

        foreach (EntitiesFilter::getFiltered(PhpStormStubsSingleton::getPhpStormStubs()->getCoreInterfaces()) as $interfaceName => $interface) {
            foreach (EntitiesFilter::getFiltered($interface->methods, StubProblemType::HAS_UNION_TYPEHINT) as $methodName => $method) {
                $firstSinceVersion = StubsTypeHintsTest::getFirstSinceVersion($method);
                if ($firstSinceVersion !== -1 && $firstSinceVersion < 8) {
                    yield "method {$interface->name}::{$methodName}" => [$method];
                }
            }
        }
    }
}
