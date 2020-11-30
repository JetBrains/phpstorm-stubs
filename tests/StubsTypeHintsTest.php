<?php
declare(strict_types=1);

namespace StubTests;

use JetBrains\PhpStorm\Pure;
use phpDocumentor\Reflection\DocBlock\Tags\Since;
use PHPUnit\Framework\TestCase;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPMethod;
use StubTests\Model\PHPParameter;
use StubTests\Model\StubProblemType;
use StubTests\TestData\Providers\PhpStormStubsSingleton;

class StubsTypeHintsTest extends TestCase
{
    /**
     * @dataProvider \StubTests\TestData\Providers\ReflectionTestDataProviders::functionProvider
     */
    public function testCoreFunctionsTypeHints(PHPFunction $function)
    {
        $functionName = $function->name;
        $stubFunctions = PhpStormStubsSingleton::getPhpStormStubs()->getFunctions();
        $phpstormFunction = $stubFunctions[$functionName];
        if ($phpstormFunction->stubBelongsToCore && !$function->hasMutedProblem(StubProblemType::FUNCTION_PARAMETER_MISMATCH)) {
            if (empty($function->parameters)) {
                self::markTestSkipped('Parameters list is empty');
            } else {
                foreach ($function->parameters as $parameter) {
                    if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_NAME_MISMATCH)) {
                        self::assertNotEmpty(array_filter($phpstormFunction->parameters,
                            fn(PHPParameter $stubParameter) => $stubParameter->name === $parameter->name),
                            "Function ${functionName} has signature $functionName(" . self::printParameters($function->parameters) . ')' .
                            " but stub function has signature $functionName(" . self::printParameters($phpstormFunction->parameters) . ')');
                        $stubParameter = current(array_filter($phpstormFunction->parameters, fn(PHPParameter $stubParameter) => $stubParameter->name === $parameter->name));
                        self::compareTypeHintsWithReflection($parameter, $stubParameter, $functionName);
                        if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_REFERENCE)) {
                            self::assertEquals($parameter->is_passed_by_ref, $stubParameter->is_passed_by_ref, "Invalid pass by ref $functionName: \$$parameter->name ");
                        }
                        self::assertEquals($parameter->is_vararg, $stubParameter->is_vararg, "Invalid vararg $functionName: \$$parameter->name ");
                    }
                    self::assertEquals($function->returnType, preg_replace('/\w+\[]/', 'array', $phpstormFunction->returnType), "Function $functionName has invalid return type");
                }
            }
        } else {
            self::markTestSkipped('Function ignored');
        }
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\StubsTestDataProviders::coreStubMethodProvider
     */
    public function testCoreMethodsForInvalidTypeHints(string $methodName, PHPMethod $stubFunction): void
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

    private static function checkUnionTypehintsInParameters(PHPFunction $function, PHPClass $parentClass, int $sinceVersion): void
    {
        if (empty($function->parameters)) {
            self::markTestSkipped('Parameters list empty');
        } else {
            foreach ($function->parameters as $parameter) {
                if (!$parameter->hasMutedProblem(StubProblemType::HAS_UNION_TYPEHINT)) {
                    self::assertFalse(str_contains($parameter->type, '|'),
                        "Method '{$parentClass->name}::{$function->name}' with @since '$sinceVersion'  
                has parameter '{$parameter->name}' with union typehint '{$parameter->type}' 
                but union typehints available only since php 8.0");
                } else {
                    self::markTestSkipped('Parameter ignored');
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
            self::markTestSkipped('Method ignored');
        }
    }

    private static function checkNullableTypehintsInParameters(PHPFunction $function, PHPClass $parentClass, int $sinceVersion): void
    {
        if (empty($function->parameters)) {
            self::markTestSkipped('Parameters list empty');
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
                    self::markTestSkipped('Parameter ignored');
                }
            }
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
            self::markTestSkipped('Function ignored');
        }
    }

    private static function checkMethodDoesNotHaveUnionTypeHints(int $sinceVersion, PHPClass $parentClass, PHPFunction $function): void
    {
        $returnTypeHint = $function->returnType;
        if ($sinceVersion < 8.0) {
            self::checkUnionTypehintsInParameters($function, $parentClass, $sinceVersion);
            self::checkUnionTypeHintsInReturnType($function, $parentClass, $sinceVersion, $returnTypeHint);
        } else {
            self::markTestSkipped("Method '{$parentClass->name}::{$function->name}' has since version >= 8.0");
        }
    }

    private static function checkMethodDoesNotHaveNullableTypeHints(int $sinceVersion, PHPClass $parentClass, PHPFunction $function): void
    {
        $returnTypeHint = $function->returnType;
        if ($sinceVersion < 7.1) {
            self::checkNullableTypehintsInParameters($function, $parentClass, $sinceVersion);
            self::checkNullableTypeHintsInReturnType($function, $parentClass, $sinceVersion, $returnTypeHint);
        } else {
            self::markTestSkipped("Method '{$parentClass->name}::{$function->name}' has since version > 7.1");
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
                self::markTestSkipped('Method ignored');
            }
        } else {
            self::markTestSkipped("Function '{$function->name}' has since version > 7");
        }
    }

    private static function checkMethodDoesNotHaveScalarTypeHints(int $sinceVersion, PHPClass $parentClass, PHPFunction $function)
    {
        if ($sinceVersion < 7) {
            if (empty($function->parameters)) {
                self::markTestSkipped('Parameters list empty');
            } else {
                foreach ($function->parameters as $parameter) {
                    if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_HAS_SCALAR_TYPEHINT)) {
                        self::assertFalse($parameter->type === 'int' || $parameter->type === 'float' ||
                            $parameter->type === 'string' || $parameter->type === 'bool',
                            "Method '{$parentClass->name}::{$function->name}' with @since '$sinceVersion'  
                has parameter '{$parameter->name}' with typehint '{$parameter->type}' but typehints available only since php 7");
                    } else {
                        self::markTestSkipped('Parameter ignored');
                    }
                }
            }
        } else {
            self::markTestSkipped("Function '{$function->name}' has since version > 7");
        }
    }

    #[Pure]
    public static function printParameters(array $params): string
    {
        $signature = '';
        foreach ($params as $param) {
            $signature .= '$' . $param->name . ', ';
        }
        return trim($signature, ', ');
    }

}
