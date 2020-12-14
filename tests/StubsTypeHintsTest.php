<?php
declare(strict_types=1);

namespace StubTests;

use phpDocumentor\Reflection\DocBlock\Tags\Since;
use PHPUnit\Framework\TestCase;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Model\PHPParameter;
use StubTests\Model\StubProblemType;
use StubTests\TestData\Providers\PhpStormStubsSingleton;

class StubsTypeHintsTest extends TestCase
{
    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionParametersProvider::functionParametersProvider
     */
    public function testFunctionsTypeHints(PHPFunction $function, PHPParameter $parameter)
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
        self::assertEquals($function->returnType, preg_replace('/\w+\[]/', 'array', $phpstormFunction->returnType),
            "Function $functionName has invalid return type");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionParametersProvider::methodParametersProvider
     */
    public function testMethodsTypeHints(PHPClass|PHPInterface $reflectionClass, PHPMethod $reflectionMethod, PHPParameter $reflectionParameter)
    {
        $className = $reflectionClass->name;
        $methodName = $reflectionMethod->name;
        if ($reflectionClass instanceof PHPClass) {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getClasses()[$className]->methods[$methodName];
        } else {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces()[$className]->methods[$methodName];
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
    public function testMethodDoesNotHaveScalarTypeHintsInParameters(PHPMethod $stubMethod, PHPParameter $parameter)
    {
        $sinceVersion = StubsTypeHintsTest::getFirstSinceVersion($stubMethod);
        self::assertFalse($parameter->type === 'int' || $parameter->type === 'float' ||
            $parameter->type === 'string' || $parameter->type === 'bool',
            "Method '{$stubMethod->parentName}::{$stubMethod->name}' with @since '$sinceVersion'  
                has parameter '{$parameter->name}' with typehint '{$parameter->type}' but typehints available only since php 7");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsParametersProvider::parametersFoNullableTypeHintTestsProvider
     */
    public function testMethodDoesNotHaveNullableTypeHintsInParameters(PHPMethod $stubMethod, PHPParameter $parameter)
    {
        $sinceVersion = StubsTypeHintsTest::getFirstSinceVersion($stubMethod);
        self::assertFalse(
            str_starts_with($parameter->type, '?') ||
            str_contains($parameter->type, 'null') ||
            str_contains($parameter->type, 'NULL'),
            "Method '{$stubMethod->parentName}::{$stubMethod->name}' with @since '$sinceVersion'  
                has nullable parameter '{$parameter->name}' with typehint '{$parameter->type}' 
                but nullable typehints available only since php 7.1");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsParametersProvider::parametersForUnionTypeHintTestsProvider
     */
    public function testMethodDoesNotHaveUnionTypeHintsInParameters(PHPMethod $stubMethod, PHPParameter $parameter)
    {
        $sinceVersion = StubsTypeHintsTest::getFirstSinceVersion($stubMethod);
        self::assertFalse(str_contains($parameter->type, '|'),
            "Method '{$stubMethod->parentName}::{$stubMethod->name}' with @since '$sinceVersion'  
                has parameter '{$parameter->name}' with union typehint '{$parameter->type}' 
                but union typehints available only since php 8.0");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubMethodsProvider::methodsForReturnTypeHintTestsProvider
     * @param PHPMethod $stubMethod
     */
    public function testMethodDoesNotHaveReturnTypeHint(PHPMethod $stubMethod)
    {
        $sinceVersion = StubsTypeHintsTest::getFirstSinceVersion($stubMethod);
        self::assertEmpty($stubMethod->returnType, "Method '{$stubMethod->parentName}::{$stubMethod->name}' has since version '$sinceVersion'
            but has return typehint '$stubMethod->returnType' that supported only since PHP 7. Please declare return type via PhpDoc");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubMethodsProvider::methodsForNullableReturnTypeHintTestsProvider
     * @param PHPMethod $stubMethod
     */
    public function testMethodDoesNotHaveNullableReturnTypeHint(PHPMethod $stubMethod)
    {
        $sinceVersion = StubsTypeHintsTest::getFirstSinceVersion($stubMethod);
        $returnType = $stubMethod->returnType;
        self::assertFalse(
            str_starts_with($returnType, '?') ||
            str_contains($returnType, 'null') ||
            str_contains($returnType, 'NULL'),
            "Method '{$stubMethod->parentName}::{$stubMethod->name}' has since version '$sinceVersion'
            but has nullable return typehint '$returnType' that supported only since PHP 7.1. 
            Please declare return type via PhpDoc");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubMethodsProvider::methodsForUnionReturnTypeHintTestsProvider
     * @param PHPMethod $stubMethod
     */
    public function testMethodDoesNotHaveUnionReturnTypeHint(PHPMethod $stubMethod)
    {
        $sinceVersion = StubsTypeHintsTest::getFirstSinceVersion($stubMethod);
        self::assertFalse(str_contains($stubMethod->returnType, '|'),
            "Method '{$stubMethod->parentName}::{$stubMethod->name}' has since version '$sinceVersion'
            but has union return typehint '$stubMethod->returnType' that supported only since PHP 8.0. 
            Please declare return type via PhpDoc");
    }

    private static function compareTypeHintsWithReflection(PHPParameter $parameter, PHPParameter $stubParameter, ?string $functionName): void
    {
        $unifiedReflectionParameter = $parameter->type;
        $unifiedStubsParameter = $stubParameter->type;
        if (!str_contains($parameter->type, '|')) {
            $unifiedReflectionParameter = preg_replace('/\?/', 'null|', $parameter->type);
            $unifiedStubsParameter = preg_replace('/\?/', 'null|', $stubParameter->type);
        }
        $unifiedStubsParameter = preg_replace('/\w+\[]/', 'array', $unifiedStubsParameter);
        $reflectionParameterTypes = explode('|', $unifiedReflectionParameter);
        $stubsParameterTypes = explode('|', $unifiedStubsParameter);
        if (!is_array($reflectionParameterTypes)) {
            $reflectionParameterTypes = [$reflectionParameterTypes];
        }
        if (!is_array($stubsParameterTypes)) {
            $stubsParameterTypes = [$stubsParameterTypes];
        }
        $absentInStubsTypes = array_diff($reflectionParameterTypes, $stubsParameterTypes);
        $extraInStubsTypes = array_diff($stubsParameterTypes, $reflectionParameterTypes);
        $diff = $absentInStubsTypes + $extraInStubsTypes;
        self::assertEmpty($diff, "Type mismatch $functionName: \$$parameter->name \n
        Reflection parameter has type '$parameter->type' but stub parameter has type '$stubParameter->type'");
    }

    public static function getFirstSinceVersion(PHPFunction|PHPMethod $stubFunction): int
    {
        $firstSinceVersion = 5;
        $parentClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($stubFunction->parentName);
        if (!empty($stubFunction->sinceTags)) {
            $sinceVersions = array_map(fn(Since $tag) => (int)$tag->getVersion(), $stubFunction->sinceTags);
            sort($sinceVersions, SORT_DESC);
            $firstSinceVersion = array_pop($sinceVersions);
        } elseif ($stubFunction->hasInheritDocTag) {
            $firstSinceVersion = -1;
        } elseif ($stubFunction->parentName === '___PHPSTORM_HELPERS\object') {
            $firstSinceVersion = -1;
        } elseif (!empty($parentClass->sinceTags)) {
            $sinceVersions = array_map(fn(Since $tag) => (int)$tag->getVersion(), $parentClass->sinceTags);
            sort($sinceVersions, SORT_DESC);
            $firstSinceVersion = array_pop($sinceVersions);

        }
        return $firstSinceVersion;
    }
}
