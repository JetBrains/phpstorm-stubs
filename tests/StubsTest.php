<?php

namespace StubTests;

use phpDocumentor\Reflection\DocBlock\Tags\Since;
use PHPUnit\Framework\TestCase;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPConst;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Model\PHPParameter;
use StubTests\Model\StubProblemType;
use StubTests\TestData\Providers\PhpStormStubsSingleton;
use function array_filter;

class StubsTest extends TestCase
{
    /**
     * @dataProvider \StubTests\TestData\Providers\ReflectionTestDataProviders::constantProvider
     */
    public function testConstants(PHPConst $constant): void
    {
        $constantName = $constant->name;
        $constantValue = $constant->value;
        $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getConstants();
        if ($constant->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
            static::markTestSkipped('constant is excluded');
        }
        static::assertArrayHasKey(
            $constantName,
            $stubConstants,
            "Missing constant: const $constantName = $constantValue\n"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\ReflectionTestDataProviders::constantProvider
     */
    public function testConstantsValues(PHPConst $constant): void
    {
        $constantName = $constant->name;
        $constantValue = $constant->value;
        $stubConstants = PhpStormStubsSingleton::getPhpStormStubs()->getConstants();
        if ($constant->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
            static::markTestSkipped('constant is excluded');
        }
        if ($constant->hasMutedProblem(StubProblemType::WRONG_CONSTANT_VALUE)) {
            static::markTestSkipped('constant is excluded');
        }

        static::assertEquals(
            $constantValue,
            $stubConstants[$constantName]->value,
            "Constant value mismatch: const $constantName \n
            Expected value: $constantValue but was {$stubConstants[$constantName]->value}"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\ReflectionTestDataProviders::functionProvider
     */
    public function testFunctions(PHPFunction $function): void
    {
        $functionName = $function->name;
        $stubFunctions = PhpStormStubsSingleton::getPhpStormStubs()->getFunctions();
        $params = self::getParameterRepresentation($function);
        if ($function->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
            static::markTestSkipped('function is excluded');
        }
        static::assertArrayHasKey($functionName, $stubFunctions, "Missing function: function $functionName($params){}");
        $phpstormFunction = $stubFunctions[$functionName];
        if (!$function->hasMutedProblem(StubProblemType::FUNCTION_IS_DEPRECATED)) {
            static::assertFalse(
                $function->is_deprecated && $phpstormFunction->is_deprecated !== true,
                "Function $functionName is not deprecated in stubs"
            );
        }
        if (!$function->hasMutedProblem(StubProblemType::FUNCTION_PARAMETER_MISMATCH)) {
            static::assertSameSize(
                $function->parameters,
                $phpstormFunction->parameters,
                "Parameter number mismatch for function $functionName. 
                Expected: " . self::getParameterRepresentation($function)
            );
        }
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\ReflectionTestDataProviders::classProvider
     */
    public function testClasses(PHPClass $class): void
    {
        $className = $class->name;
        $stubClasses = PhpStormStubsSingleton::getPhpStormStubs()->getClasses();
        if ($class->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
            static::markTestSkipped('class is skipped');
        }
        static::assertArrayHasKey($className, $stubClasses, "Missing class $className: class $className {}");
        $stubClass = $stubClasses[$className];
        if (!$class->hasMutedProblem(StubProblemType::WRONG_PARENT)) {
            static::assertEquals(
                $class->parentClass,
                $stubClass->parentClass,
                "Class $className should extend {$class->parentClass}"
            );
        }
        foreach ($class->constants as $constant) {
            if (!$constant->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                static::assertArrayHasKey(
                    $constant->name,
                    $stubClass->constants,
                    "Missing constant $className::{$constant->name}"
                );
            }
        }
        foreach ($class->methods as $method) {
            $params = self::getParameterRepresentation($method);
            $methodName = $method->name;
            if (!$method->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                static::assertArrayHasKey(
                    $methodName,
                    $stubClass->methods,
                    "Missing method $className::$methodName($params){}"
                );
                $stubMethod = $stubClass->methods[$methodName];
                if (!$method->hasMutedProblem(StubProblemType::FUNCTION_IS_FINAL)) {
                    static::assertEquals(
                        $method->isFinal,
                        $stubMethod->isFinal,
                        "Method $className::$methodName final modifier is incorrect"
                    );
                }
                if (!$method->hasMutedProblem(StubProblemType::FUNCTION_IS_STATIC)) {
                    static::assertEquals(
                        $method->isStatic,
                        $stubMethod->isStatic,
                        "Method $className::$methodName static modifier is incorrect"
                    );
                }
                if (!$method->hasMutedProblem(StubProblemType::FUNCTION_ACCESS)) {
                    static::assertEquals(
                        $method->access,
                        $stubMethod->access,
                        "Method $className::$methodName access modifier is incorrect"
                    );
                }
                if (!$method->hasMutedProblem(StubProblemType::FUNCTION_PARAMETER_MISMATCH)) {
                    static::assertSameSize(
                        $method->parameters,
                        $stubMethod->parameters,
                        "Parameter number mismatch for method $className::$methodName. 
                        Expected: " . self::getParameterRepresentation($method)
                    );
                    foreach ($method->parameters as $parameter) {
                        self::assertNotEmpty(array_filter($stubMethod->parameters,
                            fn(PHPParameter $stubParameter) => $stubParameter->name === $parameter->name),
                            "Function $className::$methodName has signature $methodName(" . StubsTypeHintsTest::printParameters($method->parameters) . ')' .
                            " but stub function has signature $methodName(" . StubsTypeHintsTest::printParameters($stubMethod->parameters) . ")");
                        $stubParameter = current(array_filter($stubMethod->parameters, fn(PHPParameter $stubParameter) => $stubParameter->name === $parameter->name));
                        if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_REFERENCE)) {
                            self::assertEquals($parameter->is_passed_by_ref, $stubParameter->is_passed_by_ref, "Invalid pass by ref $className::$methodName: \$$parameter->name ");
                        }
                        self::assertEquals($parameter->is_vararg, $stubParameter->is_vararg, "Invalid pass by ref $className::$methodName: \$$parameter->name ");
                    }
                }
            }
        }
        foreach ($class->interfaces as $interface) {
            if (!$class->hasMutedProblem(StubProblemType::WRONG_INTERFACE)) {
                static::assertContains(
                    $interface,
                    $stubClass->interfaces,
                    "Class $className doesn't implement interface $interface"
                );
            }
        }
        foreach ($class->properties as $property) {
            $propertyName = $property->name;
            if ($property->access === "private") {
                continue;
            }
            if (!$property->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                static::assertArrayHasKey(
                    $propertyName,
                    $stubClass->properties,
                    "Missing property $className::$property->access $property->type $$propertyName"
                );
                $stubProperty = $stubClass->properties[$propertyName];
                if (!$property->hasMutedProblem(StubProblemType::PROPERTY_IS_STATIC)) {
                    static::assertEquals(
                        $property->is_static,
                        $stubProperty->is_static,
                        "Property $className::$propertyName static modifier is incorrect"
                    );
                }
                if (!$property->hasMutedProblem(StubProblemType::PROPERTY_ACCESS)) {
                    static::assertEquals(
                        $property->access,
                        $stubProperty->access,
                        "Property $className::$propertyName access modifier is incorrect"
                    );
                }
                if (!$property->hasMutedProblem(StubProblemType::PROPERTY_TYPE)
                    && !empty($property->type)) {
                    static::assertEquals(
                        $property->type,
                        $stubProperty->type,
                        "Property type doesn't match for property $className::$propertyName"
                    );
                }
            }
        }
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\ReflectionTestDataProviders::interfaceProvider
     */
    public function testInterfaces(PHPInterface $interface): void
    {
        $interfaceName = $interface->name;
        $stubInterfaces = PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces();
        if ($interface->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
            static::markTestSkipped('interface is skipped');
        }
        static::assertArrayHasKey(
            $interfaceName,
            $stubInterfaces,
            "Missing interface $interfaceName: interface $interfaceName {}"
        );
        $stubInterface = $stubInterfaces[$interfaceName];
        if (!$interface->hasMutedProblem(StubProblemType::WRONG_PARENT)) {
            foreach ($interface->parentInterfaces as $parentInterface) {
                static::assertContains(
                    $parentInterface,
                    $stubInterface->parentInterfaces,
                    "Missing parent interface $parentInterface"
                );
            }
        }
        foreach ($interface->constants as $constant) {
            if (!$constant->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                static::assertArrayHasKey(
                    $constant->name,
                    $stubInterface->constants,
                    "Missing constant $interfaceName::{$constant->name}"
                );
            }
        }
        foreach ($interface->methods as $method) {
            $params = self::getParameterRepresentation($method);
            $methodName = $method->name;
            if (!$method->hasMutedProblem(StubProblemType::STUB_IS_MISSED)) {
                static::assertArrayHasKey(
                    $methodName,
                    $stubInterface->methods,
                    "Missing method $interfaceName::$methodName($params){}"
                );
                $stubMethod = $stubInterface->methods[$methodName];
                if (!$method->hasMutedProblem(StubProblemType::FUNCTION_IS_FINAL)) {
                    static::assertEquals(
                        $method->isFinal,
                        $stubMethod->isFinal,
                        "Method $interfaceName::$methodName final modifier is incorrect"
                    );
                }
                if (!$method->hasMutedProblem(StubProblemType::FUNCTION_IS_STATIC)) {
                    static::assertEquals(
                        $method->isStatic,
                        $stubMethod->isStatic,
                        "Method $interfaceName::$methodName static modifier is incorrect"
                    );
                }
                if (!$method->hasMutedProblem(StubProblemType::FUNCTION_ACCESS)) {
                    static::assertEquals(
                        $method->access,
                        $stubMethod->access,
                        "Method $interfaceName::$methodName access modifier is incorrect"
                    );
                }
                if (!$method->hasMutedProblem(StubProblemType::FUNCTION_PARAMETER_MISMATCH)) {
                    static::assertSameSize(
                        $method->parameters,
                        $stubMethod->parameters,
                        "Parameter number mismatch for method $interfaceName::$methodName. 
                        Expected: " . self::getParameterRepresentation($method)
                    );
                }
            }
        }
    }

    private static function getParameterRepresentation(PHPFunction $function): string
    {
        $result = '';
        foreach ($function->parameters as $parameter) {
            if (!empty($parameter->type)) {
                $result .= $parameter->type . ' ';
            }
            if ($parameter->is_passed_by_ref) {
                $result .= '&';
            }
            if ($parameter->is_vararg) {
                $result .= '...';
            }
            $result .= '$' . $parameter->name . ', ';
        }
        $result = rtrim($result, ', ');

        return $result;
    }
}
