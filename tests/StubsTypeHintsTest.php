<?php
declare(strict_types=1);

namespace StubTests;

use PHPUnit\Framework\TestCase;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Model\PHPParameter;
use StubTests\Model\PhpVersions;
use StubTests\Model\StubProblemType;
use StubTests\Parsers\Utils;
use StubTests\TestData\Providers\EntitiesFilter;
use StubTests\TestData\Providers\PhpStormStubsSingleton;
use StubTests\TestData\Providers\ReflectionStubsSingleton;

class StubsTypeHintsTest extends TestCase
{
    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionFunctionsProvider::allFunctionsProvider
     */
    public function testFunctionsReturnTypeHints(PHPFunction $function)
    {
        $functionName = $function->name;
        $allEqualStubFunctions = EntitiesFilter::getFiltered(PhpStormStubsSingleton::getPhpStormStubs()->getFunctions(),
            fn(PHPFunction $stubFunction) => $stubFunction->name !== $functionName ||
                !in_array(PhpVersions::getLatest(), Utils::getAvailableInVersions($stubFunction)));
        $stubFunction = array_pop($allEqualStubFunctions);
        self::assertEquals($function->returnTypesFromSignature, $stubFunction->returnTypesFromSignature,
            "Function $functionName has invalid return type");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionParametersProvider::functionParametersProvider
     */
    public function testFunctionsParametersTypeHints(PHPFunction $function, PHPParameter $parameter)
    {
        $functionName = $function->name;
        $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getFunctions()[$functionName];
        $stubParameter = current(array_filter($phpstormFunction->parameters, fn(PHPParameter $stubParameter) => $stubParameter->name === $parameter->name));
        self::assertNotFalse($stubParameter, "Parameter $$parameter->name not found at $phpstormFunction->name(" .
            StubsParameterNamesTest::printParameters($phpstormFunction->parameters) . ')');
        self::compareTypeHintsWithReflection($parameter, $stubParameter, $functionName);
        if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_REFERENCE)) {
            self::assertEquals($parameter->is_passed_by_ref, $stubParameter->is_passed_by_ref,
                "Invalid pass by ref $functionName: \$$parameter->name ");
        }
        self::assertEquals($parameter->is_vararg, $stubParameter->is_vararg,
            "Invalid vararg $functionName: \$$parameter->name ");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionMethodsProvider::classMethodsProvider
     */
    public function testMethodsReturnTypeHints(PHPClass|PHPInterface $class, PHPMethod $method)
    {
        $functionName = $method->name;
        if ($class instanceof PHPClass) {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name)->methods[$functionName];
        } else {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($class->name)->methods[$functionName];
        }
        self::assertEquals($method->returnTypesFromSignature, $stubMethod->returnTypesFromSignature,
            "Method $class->name::$functionName has invalid return type");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionParametersProvider::methodParametersProvider
     */
    public function testMethodsParametersTypeHints(PHPClass|PHPInterface $reflectionClass, PHPMethod $reflectionMethod, PHPParameter $reflectionParameter)
    {
        $className = $reflectionClass->name;
        $methodName = $reflectionMethod->name;
        if ($reflectionClass instanceof PHPClass) {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getClass($className)->methods[$methodName];
        } else {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($className)->methods[$methodName];
        }
        $stubParameter = current(array_filter($stubMethod->parameters,
            fn(PHPParameter $stubParameter) => $stubParameter->name === $reflectionParameter->name));
        self::assertNotFalse($stubParameter, "Parameter $$reflectionParameter->name not found at 
        $reflectionClass->name::$stubMethod->name(" .
            StubsParameterNamesTest::printParameters($stubMethod->parameters) . ')');
        if (!$reflectionParameter->hasMutedProblem(StubProblemType::PARAMETER_REFERENCE)) {
            self::assertEquals($reflectionParameter->is_passed_by_ref, $stubParameter->is_passed_by_ref,
                "Invalid pass by ref $className::$methodName: \$$reflectionParameter->name ");
        }
        self::assertEquals($reflectionParameter->is_vararg, $stubParameter->is_vararg,
            "Invalid pass by ref $className::$methodName: \$$reflectionParameter->name ");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsParametersProvider::parametersForScalarTypeHintTestsProvider
     */
    public function testMethodDoesNotHaveScalarTypeHintsInParameters(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $parameter)
    {
        $sinceVersion = Utils::getDeclaredSinceVersion($stubMethod);
        self::assertEmpty(array_intersect(['int', 'float', 'string', 'bool'], $parameter->types),
            "Method '{$class->name}::{$stubMethod->name}' with @since '$sinceVersion'  
                has parameter '{$parameter->name}' with typehint '" . implode('|', $parameter->types) .
            "' but typehints available only since php 7");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsParametersProvider::parametersForNullableTypeHintTestsProvider
     */
    public function testMethodDoesNotHaveNullableTypeHintsInParameters(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $parameter)
    {
        $sinceVersion = Utils::getDeclaredSinceVersion($stubMethod);
        self::assertEmpty(array_filter($parameter->types, fn(string $type) => str_contains($type, '?')),
            "Method '{$class->name}::{$stubMethod->name}' with @since '$sinceVersion'  
                has nullable parameter '{$parameter->name}' with typehint '" . implode('|', $parameter->types) . "' 
                but nullable typehints available only since php 7.1");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsParametersProvider::parametersForUnionTypeHintTestsProvider
     */
    public function testMethodDoesNotHaveUnionTypeHintsInParameters(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $parameter)
    {
        $sinceVersion = Utils::getDeclaredSinceVersion($stubMethod);
        self::assertLessThan(2, count($parameter->types),
            "Method '{$class->name}::{$stubMethod->name}' with @since '$sinceVersion'  
                has parameter '{$parameter->name}' with union typehint '" . implode('|', $parameter->types) . "' 
                but union typehints available only since php 8.0");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubMethodsProvider::methodsForReturnTypeHintTestsProvider
     * @param PHPMethod $stubMethod
     */
    public function testMethodDoesNotHaveReturnTypeHint(PHPMethod $stubMethod)
    {
        $sinceVersion = Utils::getDeclaredSinceVersion($stubMethod);
        self::assertEmpty($stubMethod->returnTypesFromSignature, "Method '{$stubMethod->parentName}::{$stubMethod->name}' has since version '$sinceVersion'
            but has return typehint '" . implode('|', $stubMethod->returnTypesFromSignature) . "' that supported only since PHP 7. Please declare return type via PhpDoc");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubMethodsProvider::methodsForNullableReturnTypeHintTestsProvider
     * @param PHPMethod $stubMethod
     */
    public function testMethodDoesNotHaveNullableReturnTypeHint(PHPMethod $stubMethod)
    {
        $sinceVersion = Utils::getDeclaredSinceVersion($stubMethod);
        $returnTypes = $stubMethod->returnTypesFromSignature;
        self::assertEmpty(array_filter($returnTypes, fn(string $type) => str_contains($type, '?')),
            "Method '{$stubMethod->parentName}::{$stubMethod->name}' has since version '$sinceVersion'
            but has nullable return typehint '" . implode('|', $returnTypes) . "' that supported only since PHP 7.1. 
            Please declare return type via PhpDoc");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubMethodsProvider::methodsForUnionReturnTypeHintTestsProvider
     * @param PHPMethod $stubMethod
     */
    public function testMethodDoesNotHaveUnionReturnTypeHint(PHPMethod $stubMethod)
    {
        $sinceVersion = Utils::getDeclaredSinceVersion($stubMethod);
        self::assertLessThan(2, count($stubMethod->returnTypesFromSignature),
            "Method '{$stubMethod->parentName}::{$stubMethod->name}' has since version '$sinceVersion'
            but has union return typehint '" . implode('|', $stubMethod->returnTypesFromSignature) . "' that supported only since PHP 8.0. 
            Please declare return type via PhpDoc");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsParametersProvider::parametersForAllowedScalarTypeHintTestsProvider
     */
    public function testMethodScalarTypeHintsInParametersMatchReflection(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $stubParameter)
    {
        $reflectionMethods = array_filter(ReflectionStubsSingleton::getReflectionStubs()->getClass($class->name)->methods,
            fn(PHPMethod $method) => $method->name === $stubMethod->name);
        /** @var PHPMethod $reflectionMethod */
        $reflectionMethod = array_pop($reflectionMethods);
        $reflectionParameters = array_filter($reflectionMethod->parameters, fn(PHPParameter $parameter) => $parameter->name === $stubParameter->name);
        $reflectionParameter = array_pop($reflectionParameters);
        self::compareTypeHintsWithReflection($reflectionParameter, $stubParameter, $stubMethod->name);
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsParametersProvider::parametersForAllowedNullableTypeHintTestsProvider
     */
    public function testMethodNullableTypeHintsInParametersMatchReflection(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $stubParameter)
    {
        $reflectionMethods = array_filter(ReflectionStubsSingleton::getReflectionStubs()->getClass($class->name)->methods,
            fn(PHPMethod $method) => $method->name === $stubMethod->name);
        /** @var PHPMethod $reflectionMethod */
        $reflectionMethod = array_pop($reflectionMethods);
        $reflectionParameters = array_filter($reflectionMethod->parameters, fn(PHPParameter $parameter) => $parameter->name === $stubParameter->name);
        $reflectionParameter = array_pop($reflectionParameters);
        self::compareTypeHintsWithReflection($reflectionParameter, $stubParameter, $stubMethod->name);
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsParametersProvider::parametersForAllowedUnionTypeHintTestsProvider
     */
    public function testMethodUnionTypeHintsInParametersMatchReflection(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $stubParameter)
    {
        $reflectionMethods = array_filter(ReflectionStubsSingleton::getReflectionStubs()->getClass($class->name)->methods,
            fn(PHPMethod $method) => $method->name === $stubMethod->name);
        /** @var PHPMethod $reflectionMethod */
        $reflectionMethod = array_pop($reflectionMethods);
        $reflectionParameters = array_filter($reflectionMethod->parameters, fn(PHPParameter $parameter) => $parameter->name === $stubParameter->name);
        $reflectionParameter = array_pop($reflectionParameters);
        self::compareTypeHintsWithReflection($reflectionParameter, $stubParameter, $stubMethod->name);
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubMethodsProvider::allFunctionAndMethodsWithReturnTypeHintsProvider
     * @param PHPFunction|PHPMethod $method
     */
    public function testSignatureTypeHintsComplainPhpDocInMethods(PHPFunction|PHPMethod $method)
    {
        $functionName = $method->name;
        $unifiedPhpDocTypes = array_map(function (string $type) {
            $typeParts = explode('\\', $type);
            $typeName = end($typeParts);
            return preg_replace('/\w+\[]/', 'array', $typeName);
        }, $method->returnTypesFromPhpDoc);
        $unifiedSignatureTypes = $method->returnTypesFromSignature;
        if (count($unifiedSignatureTypes) === 1) {
            $type = array_pop($method->returnTypesFromSignature);
            if (str_contains($type, '?')) {
                $unifiedSignatureTypes = [ltrim($type, '?'), 'null'];
            }
        }
        $typesIntersection = array_intersect($unifiedSignatureTypes, $unifiedPhpDocTypes);
        self::assertEquals(count($unifiedSignatureTypes), count($typesIntersection),
            $method instanceof PHPMethod ? "Method $method->parentName::" : 'Function ' .
                "$functionName has mismatch in phpdoc return type and signature return type\n
                signature has " . implode('|', $method->returnTypesFromSignature) . "\n
                but phpdoc has " . implode('|', $unifiedPhpDocTypes));
    }

    private static function compareTypeHintsWithReflection(PHPParameter $parameter, PHPParameter $stubParameter, ?string $functionName): void
    {
        $unifiedStubsParameterTypes = [];
        $unifiedReflectionParameterTypes = [];
        self::convertNullableTypesToUnion($parameter->types, $unifiedReflectionParameterTypes);
        self::convertNullableTypesToUnion($stubParameter->types, $unifiedStubsParameterTypes);
        $absentInStubsTypes = array_diff($unifiedReflectionParameterTypes, $unifiedStubsParameterTypes);
        $extraInStubsTypes = array_diff($unifiedStubsParameterTypes, $unifiedReflectionParameterTypes);
        $diff = $absentInStubsTypes + $extraInStubsTypes;
        self::assertEmpty($diff, "Type mismatch $functionName: \$$parameter->name \n
        Reflection parameter has type '" . implode('|', $unifiedReflectionParameterTypes) .
            "' but stub parameter has type '" . implode('|', $unifiedStubsParameterTypes) . "'");
    }

    private static function convertNullableTypesToUnion($typesToProcess, array &$resultArray)
    {
        array_walk($typesToProcess, function (string $type) use (&$resultArray) {
            if (str_contains($type, '?')) {
                array_push($resultArray, 'null', ltrim($type, '?'));
            } else {
                array_push($resultArray, $type);
            }
        });
    }
}
