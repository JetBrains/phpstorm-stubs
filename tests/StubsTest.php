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
            if ($phpstormFunction->stubBelongsToCore) {
                foreach ($function->parameters as $parameter) {
                    if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_NAME_MISMATCH)) {
                        self::assertNotEmpty(array_filter($phpstormFunction->parameters,
                            fn(PHPParameter $stubParameter) => $stubParameter->name === $parameter->name),
                            "Function ${functionName} has signature $functionName(" . $this->printParameters($function->parameters) . ')' .
                            " but stub function has signature $functionName(" . $this->printParameters($phpstormFunction->parameters) . ")");
                        $stubParameter = current(array_filter($phpstormFunction->parameters, fn(PHPParameter $stubParameter) => $stubParameter->name === $parameter->name));
                        self::assertEquals($parameter->type, preg_replace('/\w+\[]/', 'array', $stubParameter->type), "Type mismatch $functionName: \$$parameter->name ");
                        if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_REFERENCE)) {
                            self::assertEquals($parameter->is_passed_by_ref, $stubParameter->is_passed_by_ref, "Invalid pass by ref $functionName: \$$parameter->name ");
                        }
                        self::assertEquals($parameter->is_vararg, $stubParameter->is_vararg, "Invalid pass by ref $functionName: \$$parameter->name ");
                    }
                }
            }
        }
        self::assertEquals($function->returnType, preg_replace('/\w+\[]/', 'array', $phpstormFunction->returnType), "Function $functionName has invalid return type");
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
                            "Function $className::$methodName has signature $methodName(" . $this->printParameters($method->parameters) . ')' .
                            " but stub function has signature $methodName(" . $this->printParameters($stubMethod->parameters) . ")");
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

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::coreStubMethodProvider
     */
    public function testCoreMethodsTypeHints(string $methodName, PHPMethod $stubFunction): void
    {
        $firstSinceVersion = 5;
        $parentClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($stubFunction->parentName);
        if (!empty($stubFunction->sinceTags)) {
            $sinceVersions = array_map(fn(Since $tag) => (int)$tag->getVersion(), $stubFunction->sinceTags);
            sort($sinceVersions, SORT_DESC);
            $firstSinceVersion = array_pop($sinceVersions);
        } elseif ($stubFunction->hasInheritDocTag) {
            self::markTestSkipped("Function '$methodName' contains inheritdoc.");
        } elseif ($stubFunction->parentName === '___PHPSTORM_HELPERS\object') {
            self::markTestSkipped("Function '$methodName' is declared in ___PHPSTORM_HELPERS\object.");
        } elseif (!empty($parentClass->sinceTags) || $stubFunction->name === '__construct') {
            $parentClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($stubFunction->parentName);
            if (!empty($parentClass->sinceTags)) {
                $sinceVersions = array_map(fn(Since $tag) => (int)$tag->getVersion(), $parentClass->sinceTags);
                sort($sinceVersions, SORT_DESC);
                $firstSinceVersion = array_pop($sinceVersions);
            }
        }
        if ($parentClass !== null && !$parentClass->isFinal && !$stubFunction->isFinal) {
            $parentClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($stubFunction->parentName);
            self::checkMethodDoesNotHaveScalarTypeHints($firstSinceVersion, $parentClass, $stubFunction);
            self::checkMethodDoesNotHaveReturnTypeHints($firstSinceVersion, $parentClass, $stubFunction);
            self::checkMethodDoesNotHaveNullableTypeHints($firstSinceVersion, $parentClass, $stubFunction);
            self::checkMethodDoesNotHaveUnionTypeHints($firstSinceVersion, $parentClass, $stubFunction);
        } else {
            self::markTestSkipped('Parent class or method is final');
        }
    }

    private function printParameters(array $params): string
    {
        $signature = '';
        foreach ($params as $param) {
            $signature .= '$' . $param->name . ', ';
        }
        return trim($signature, ", ");
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

    private static function checkMethodDoesNotHaveScalarTypeHints(int $sinceVersion, PHPClass $parentClass, PHPFunction $function)
    {
        if ($sinceVersion < 7) {
            if (empty($function->parameters)) {
                self::assertTrue(true, 'Parameters list empty');
            } else {
                foreach ($function->parameters as $parameter) {
                    if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_HAS_SCALAR_TYPEHINT)) {
                        self::assertFalse($parameter->type === 'int' || $parameter->type === 'float' ||
                            $parameter->type === 'string' || $parameter->type === 'bool',
                            "Method '{$parentClass->name}::{$function->name}' with @since '$sinceVersion'  
                has parameter '{$parameter->name}' with typehint '{$parameter->type}' but typehints available only since php 7");
                    } else {
                        self::markTestSkipped("Skipped");
                    }
                }
            }
        } else {
            self::assertTrue(true, "Function '{$function->name}' has since version > 7");
        }
    }

    private static function checkMethodDoesNotHaveReturnTypeHints(int $sinceVersion, PHPClass $parentClass, PHPFunction $function)
    {
        $returnTypeHint = $function->returnType;
        if ($sinceVersion < 7) {
            if (!$function->hasMutedProblem(StubProblemType::FUNCTION_HAS_RETURN_TYPEHINT)) {
                self::assertEmpty($returnTypeHint, "Method '{$parentClass->name}::{$function->name}' has since version '$sinceVersion'
            but has return typehint '$returnTypeHint' that supported only since PHP 7. Please declare return type via PhpDoc");
            } else {
                self::markTestSkipped("Skipped");
            }
        } else {
            self::assertTrue(true, "Function '{$function->name}' has since version > 7");
        }
    }

    private static function checkMethodDoesNotHaveNullableTypeHints(int $sinceVersion, PHPClass $parentClass, PHPFunction $function): void
    {
        $returnTypeHint = $function->returnType;
        if ($sinceVersion < 7.1) {
            self::checkNullableTypehintsInParameters($function, $parentClass, $sinceVersion);
            self::checkNullableTypeHintsInReturnType($function, $parentClass, $sinceVersion, $returnTypeHint);
        } else {
            self::assertTrue(true, "Method '{$parentClass->name}::{$function->name}' has since version > 7.1");
        }
    }

    private static function checkMethodDoesNotHaveUnionTypeHints(int $sinceVersion, PHPClass $parentClass, PHPFunction $function): void
    {
        $returnTypeHint = $function->returnType;
        if ($sinceVersion < 8.0) {
            self::checkUnionTypehintsInParameters($function, $parentClass, $sinceVersion);
            self::checkUnionTypeHintsInReturnType($function, $parentClass, $sinceVersion, $returnTypeHint);
        } else {
            self::assertTrue(true, "Method '{$parentClass->name}::{$function->name}' has since version >= 8.0");
        }
    }

    private static function checkNullableTypeHintsInReturnType(PHPFunction $function, PHPClass $parentClass, int $sinceVersion, string $returnTypeHint): void
    {
        if (!$function->hasMutedProblem(StubProblemType::HAS_NULLABLE_TYPEHINT)) {
            self::assertFalse(
                str_starts_with($returnTypeHint, '?') ||
                str_contains($returnTypeHint, 'null') ||
                str_contains($returnTypeHint, 'NULL'),
                "Method '{$parentClass->name}::{$function->name}' has since version '$sinceVersion'
            but has nullable return typehint '$returnTypeHint' that supported only since PHP 7.1. 
            Please declare return type via PhpDoc");
        } else {
            self::markTestSkipped('Skipped');
        }
    }

    private static function checkNullableTypehintsInParameters(PHPFunction $function, PHPClass $parentClass, int $sinceVersion): void
    {
        if (empty($function->parameters)) {
            self::assertTrue(true, 'Parameters list empty');
        } else {
            foreach ($function->parameters as $parameter) {
                if (!$parameter->hasMutedProblem(StubProblemType::HAS_NULLABLE_TYPEHINT)) {
                    self::assertFalse(
                        str_starts_with($parameter->type, '?') ||
                        str_contains($parameter->type, 'null') ||
                        str_contains($parameter->type, 'NULL'),
                        "Method '{$parentClass->name}::{$function->name}' with @since '$sinceVersion'  
                has nullable parameter '{$parameter->name}' with typehint '{$parameter->type}' 
                but nullable typehints available only since php 7.1");
                } else {
                    self::markTestSkipped('Skipped');
                }
            }
        }
    }

    private static function checkUnionTypeHintsInReturnType(PHPFunction $function, PHPClass $parentClass, int $sinceVersion, string $returnTypeHint): void
    {
        if (!$function->hasMutedProblem(StubProblemType::HAS_UNION_TYPEHINT)) {
            self::assertFalse(str_contains($returnTypeHint, '|'),
                "Method '{$parentClass->name}::{$function->name}' has since version '$sinceVersion'
            but has union return typehint '$returnTypeHint' that supported only since PHP 8.0. 
            Please declare return type via PhpDoc");
        } else {
            self::markTestSkipped('Skipped');
        }
    }

    private static function checkUnionTypehintsInParameters(PHPFunction $function, PHPClass $parentClass, int $sinceVersion): void
    {
        if (empty($function->parameters)) {
            self::assertTrue(true, 'Parameters list empty');
        } else {
            foreach ($function->parameters as $parameter) {
                if (!$parameter->hasMutedProblem(StubProblemType::HAS_UNION_TYPEHINT)) {
                    self::assertFalse(str_contains($parameter->type, '|'),
                        "Method '{$parentClass->name}::{$function->name}' with @since '$sinceVersion'  
                has parameter '{$parameter->name}' with union typehint '{$parameter->type}' 
                but union typehints available only since php 8.0");
                } else {
                    self::markTestSkipped('Skipped');
                }
            }
        }
    }
}
