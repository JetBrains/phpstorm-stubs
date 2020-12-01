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
     * @dataProvider \StubTests\TestData\Providers\ReflectionTestDataProviders::functionParametersProvider
     */
    public function testFunctionsTypeHints(PHPFunction $function, PHPParameter $parameter)
    {
        $functionName = $function->name;
        $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getFunctions()[$functionName];
        $stubParameter = current(array_filter($phpstormFunction->parameters, fn(PHPParameter $stubParameter) => $stubParameter->name === $parameter->name));
        self::assertNotFalse($stubParameter, "Parameter $$parameter->name not found at $phpstormFunction->name(" .
            StubsParameterNamesTest::printParameters($phpstormFunction->parameters).')');
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
     * @dataProvider \StubTests\TestData\Providers\ReflectionTestDataProviders::methodParametersProvider
     */
    public function testMethodsTypeHints(PHPClass|PHPInterface $reflectionClass, PHPMethod $reflectionMethod, PHPParameter $reflectionParameter)
    {
        $className = $reflectionClass->name;
        $methodName = $reflectionMethod->name;
        $stubMethod = null;
        if ($reflectionClass instanceof PHPClass) {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getClasses()[$className]->methods[$methodName];
        } else {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces()[$className]->methods[$methodName];
        }
        $stubParameter = current(array_filter($stubMethod->parameters,
            fn(PHPParameter $stubParameter) => $stubParameter->name === $reflectionParameter->name));
        self::assertNotFalse($stubParameter, "Parameter $$reflectionParameter->name not found at 
        $reflectionClass->name::$stubMethod->name(" .
            StubsParameterNamesTest::printParameters($stubMethod->parameters).')');
        if (!$reflectionParameter->hasMutedProblem(StubProblemType::PARAMETER_REFERENCE)) {
            self::assertEquals($reflectionParameter->is_passed_by_ref, $stubParameter->is_passed_by_ref,
                "Invalid pass by ref $className::$methodName: \$$reflectionParameter->name ");
        }
        self::assertEquals($reflectionParameter->is_vararg, $stubParameter->is_vararg,
            "Invalid pass by ref $className::$methodName: \$$reflectionParameter->name ");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::stubMethodParametersProvider
     */
    public function testCoreMethodParametersForInvalidTypeHints(PHPMethod $stubMethod, PHPParameter $stubParameter): void
    {
        $firstSinceVersion = self::getFirstSinceVersion($stubMethod);
        self::checkMethodDoesNotHaveScalarTypeHints($firstSinceVersion, $stubMethod, $stubParameter);
        self::checkMethodDoesNotHaveReturnTypeHints($firstSinceVersion, $stubMethod);
        self::checkMethodDoesNotHaveNullableTypeHints($firstSinceVersion, $stubMethod, $stubParameter);
        self::checkMethodDoesNotHaveUnionTypeHints($firstSinceVersion, $stubMethod, $stubParameter);
    }

    private static function compareTypeHintsWithReflection(PHPParameter $parameter, PHPParameter $stubParameter, ?string $functionName): void
    {
        $unifiedReflectionParameter = preg_replace('/\?/', 'null|', $parameter->type);
        $unifiedStubsParameter = preg_replace('/\?/', 'null|', $stubParameter->type);
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

    private static function checkUnionTypehintsInParameter(PHPMethod $function, int $sinceVersion, PHPParameter $parameter): void
    {
        if (!$parameter->hasMutedProblem(StubProblemType::HAS_UNION_TYPEHINT)) {
            self::assertFalse(str_contains($parameter->type, '|'),
                "Method '{$function->parentName}::{$function->name}' with @since '$sinceVersion'  
                has parameter '{$parameter->name}' with union typehint '{$parameter->type}' 
                but union typehints available only since php 8.0");
        } else {
            self::markTestSkipped('Parameter ignored');
        }
    }

    private static function checkUnionTypeHintsInReturnType(PHPMethod $function, int $sinceVersion, string $returnTypeHint): void
    {
        if (!$function->hasMutedProblem(StubProblemType::HAS_UNION_TYPEHINT)) {
            self::assertFalse(str_contains($returnTypeHint, '|'),
                "Method '{$function->parentName}::{$function->name}' has since version '$sinceVersion'
            but has union return typehint '$returnTypeHint' that supported only since PHP 8.0. 
            Please declare return type via PhpDoc");
        } else {
            self::markTestSkipped('Method ignored');
        }
    }

    private static function checkNullableTypehintsInParameter(PHPMethod $function, int $sinceVersion, PHPParameter $parameter): void
    {
        if (!$parameter->hasMutedProblem(StubProblemType::HAS_NULLABLE_TYPEHINT)) {
            self::assertFalse(
                str_starts_with($parameter->type, '?') ||
                str_contains($parameter->type, 'null') ||
                str_contains($parameter->type, 'NULL'),
                "Method '{$function->parentName}::{$function->name}' with @since '$sinceVersion'  
                has nullable parameter '{$parameter->name}' with typehint '{$parameter->type}' 
                but nullable typehints available only since php 7.1");
        } else {
            self::markTestSkipped('Parameter ignored');
        }
    }

    private static function checkNullableTypeHintsInReturnType(PHPMethod $function, int $sinceVersion, string $returnTypeHint): void
    {
        if (!$function->hasMutedProblem(StubProblemType::HAS_NULLABLE_TYPEHINT)) {
            self::assertFalse(
                str_starts_with($returnTypeHint, '?') ||
                str_contains($returnTypeHint, 'null') ||
                str_contains($returnTypeHint, 'NULL'),
                "Method '{$function->parentName}::{$function->name}' has since version '$sinceVersion'
            but has nullable return typehint '$returnTypeHint' that supported only since PHP 7.1. 
            Please declare return type via PhpDoc");
        } else {
            self::markTestSkipped('Function ignored');
        }
    }

    private static function checkMethodDoesNotHaveUnionTypeHints(int $sinceVersion, PHPMethod $stubMethod, PHPParameter $parameter): void
    {
        $returnTypeHint = $stubMethod->returnType;
        if ($sinceVersion < 8.0) {
            self::checkUnionTypehintsInParameter($stubMethod, $sinceVersion, $parameter);
            self::checkUnionTypeHintsInReturnType($stubMethod, $sinceVersion, $returnTypeHint);
        } else {
            self::markTestSkipped("Method '{$stubMethod->parentName}::{$stubMethod->name}' has since version >= 8.0");
        }
    }

    private static function checkMethodDoesNotHaveNullableTypeHints(int $sinceVersion, PHPMethod $stubMethod, PHPParameter $parameter): void
    {
        $returnTypeHint = $stubMethod->returnType;
        if ($sinceVersion < 7.1) {
            self::checkNullableTypehintsInParameter($stubMethod, $sinceVersion, $parameter);
            self::checkNullableTypeHintsInReturnType($stubMethod, $sinceVersion, $returnTypeHint);
        } else {
            self::markTestSkipped("Method '{$stubMethod->parentName}::{$stubMethod->name}' has since version > 7.1");
        }
    }

    private static function checkMethodDoesNotHaveReturnTypeHints(int $sinceVersion, PHPMethod $stubMethod)
    {
        $returnTypeHint = $stubMethod->returnType;
        if ($sinceVersion < 7) {
            if (!$stubMethod->hasMutedProblem(StubProblemType::FUNCTION_HAS_RETURN_TYPEHINT)) {
                self::assertEmpty($returnTypeHint, "Method '{$stubMethod->parentName}::{$stubMethod->name}' has since version '$sinceVersion'
            but has return typehint '$returnTypeHint' that supported only since PHP 7. Please declare return type via PhpDoc");
            } else {
                self::markTestSkipped('Method ignored');
            }
        } else {
            self::markTestSkipped("Function '{$stubMethod->name}' has since version > 7");
        }
    }

    private static function checkMethodDoesNotHaveScalarTypeHints(int $sinceVersion, PHPMethod $stubMethod, PHPParameter $parameter)
    {
        if ($sinceVersion < 7) {
            if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_HAS_SCALAR_TYPEHINT)) {
                self::assertFalse($parameter->type === 'int' || $parameter->type === 'float' ||
                    $parameter->type === 'string' || $parameter->type === 'bool',
                    "Method '{$stubMethod->parentName}::{$stubMethod->name}' with @since '$sinceVersion'  
                has parameter '{$parameter->name}' with typehint '{$parameter->type}' but typehints available only since php 7");
            } else {
                self::markTestSkipped('Parameter ignored');
            }
        } else {
            self::markTestSkipped("Function '{$stubMethod->name}' has since version > 7");
        }
    }

    public static function getFirstSinceVersion(PHPMethod $stubFunction): int
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
