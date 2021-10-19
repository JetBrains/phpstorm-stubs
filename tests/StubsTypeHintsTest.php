<?php
declare(strict_types=1);

namespace StubTests;

use PHPUnit\Framework\Exception;
use RuntimeException;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Model\PHPParameter;
use StubTests\Model\StubProblemType;
use StubTests\Parsers\ParserUtils;
use StubTests\TestData\Providers\PhpStormStubsSingleton;
use StubTests\TestData\Providers\ReflectionStubsSingleton;

class StubsTypeHintsTest extends BaseStubsTest
{
    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionFunctionsProvider::allFunctionsProvider
     * @throws RuntimeException
     */
    public function testFunctionsReturnTypeHints(PHPFunction $function)
    {
        $functionName = $function->name;
        $stubFunction = PhpStormStubsSingleton::getPhpStormStubs()->getFunction($functionName);
        $unifiedStubsReturnTypes = [];
        $unifiedStubsAttributesReturnTypes = [];
        $unifiedReflectionReturnTypes = [];
        self::convertNullableTypesToUnion($function->returnTypesFromSignature, $unifiedReflectionReturnTypes);
        if (!empty($stubFunction->returnTypesFromSignature)) {
            self::convertNullableTypesToUnion($stubFunction->returnTypesFromSignature, $unifiedStubsReturnTypes);
        }
        foreach ($stubFunction->returnTypesFromAttribute as $languageVersion => $listOfTypes) {
            $unifiedStubsAttributesReturnTypes[$languageVersion] = [];
            self::convertNullableTypesToUnion($listOfTypes, $unifiedStubsAttributesReturnTypes[$languageVersion]);
        }
        $conditionToCompareWithSignature = BaseStubsTest::isReflectionTypesMatchSignature(
            $unifiedReflectionReturnTypes,
            $unifiedStubsReturnTypes
        );
        $typesFromAttribute = [];
        if (!empty($unifiedStubsAttributesReturnTypes)) {
            $typesFromAttribute = !empty($unifiedStubsAttributesReturnTypes[getenv('PHP_VERSION')]) ?
                $unifiedStubsAttributesReturnTypes[getenv('PHP_VERSION')] :
                $unifiedStubsAttributesReturnTypes['default'];
        }
        $conditionToCompareWithAttribute = BaseStubsTest::isReflectionTypesExistInAttributes($unifiedReflectionReturnTypes, $typesFromAttribute);
        $testCondition = $conditionToCompareWithSignature || $conditionToCompareWithAttribute;
        self::assertTrue($testCondition, "Function $functionName has invalid return type.
        Reflection function has return type " . implode('|', $function->returnTypesFromSignature) . ' but stubs has return type ' .
            implode('|', $stubFunction->returnTypesFromSignature) . ' in signature and attribute has types ' .
            implode('|', $typesFromAttribute));
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionParametersProvider::functionParametersWithTypeProvider
     * @throws RuntimeException
     */
    public function testFunctionsParametersTypeHints(PHPFunction $function, PHPParameter $parameter)
    {
        $functionName = $function->name;
        $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getFunction($functionName);
        /** @var PHPParameter $stubParameter */
        $stubParameter = current(array_filter($phpstormFunction->parameters, fn (PHPParameter $stubParameter) => $stubParameter->indexInSignature === $parameter->indexInSignature));
        self::compareTypeHintsWithReflection($parameter, $stubParameter, $functionName);
        if (!$parameter->hasMutedProblem(StubProblemType::PARAMETER_REFERENCE)) {
            self::assertEquals(
                $parameter->is_passed_by_ref,
                $stubParameter->is_passed_by_ref,
                "Invalid pass by ref $functionName: \$$parameter->name "
            );
        }
        self::assertEquals(
            $parameter->is_vararg,
            $stubParameter->is_vararg,
            "Invalid vararg $functionName: \$$parameter->name "
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionMethodsProvider::classMethodsWithoutTentitiveReturnTypeProvider
     * @throws RuntimeException
     */
    public function testMethodsReturnTypeHints(PHPClass|PHPInterface $class, PHPMethod $method)
    {
        $functionName = $method->name;
        if ($class instanceof PHPClass) {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name)->getMethod($functionName);
        } else {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($class->name)->getMethod($functionName);
        }
        $unifiedStubsReturnTypes = [];
        $unifiedStubsAttributesReturnTypes = [];
        $unifiedReflectionReturnTypes = [];
        self::convertNullableTypesToUnion($method->returnTypesFromSignature, $unifiedReflectionReturnTypes);
        if (!empty($stubMethod->returnTypesFromSignature)) {
            self::convertNullableTypesToUnion($stubMethod->returnTypesFromSignature, $unifiedStubsReturnTypes);
        } else {
            foreach ($stubMethod->returnTypesFromAttribute as $languageVersion => $listOfTypes) {
                $unifiedStubsAttributesReturnTypes[$languageVersion] = [];
                self::convertNullableTypesToUnion($listOfTypes, $unifiedStubsAttributesReturnTypes[$languageVersion]);
            }
        }
        $conditionToCompareWithSignature = BaseStubsTest::isReflectionTypesMatchSignature(
            $unifiedReflectionReturnTypes,
            $unifiedStubsReturnTypes
        );
        $typesFromAttribute = [];
        if (!empty($unifiedStubsAttributesReturnTypes)) {
            $typesFromAttribute = !empty($unifiedStubsAttributesReturnTypes[getenv('PHP_VERSION')]) ?
                $unifiedStubsAttributesReturnTypes[getenv('PHP_VERSION')] :
                $unifiedStubsAttributesReturnTypes['default'];
        }
        $conditionToCompareWithAttribute = BaseStubsTest::isReflectionTypesExistInAttributes($unifiedReflectionReturnTypes, $typesFromAttribute);
        $testCondition = $conditionToCompareWithSignature || $conditionToCompareWithAttribute;
        self::assertTrue($testCondition, "Method $class->name::$functionName has invalid return type.
        Reflection method has return type " . implode('|', $method->returnTypesFromSignature) . ' but stubs has return type ' .
            implode('|', $stubMethod->returnTypesFromSignature) . ' in signature and attribute has types ' .
            implode('|', $typesFromAttribute));
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionParametersProvider::methodParametersProvider
     * @throws RuntimeException
     */
    public function testMethodsParametersTypeHints(PHPClass|PHPInterface $reflectionClass, PHPMethod $reflectionMethod, PHPParameter $reflectionParameter)
    {
        $className = $reflectionClass->name;
        $methodName = $reflectionMethod->name;
        if ($reflectionClass instanceof PHPClass) {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getClass($className)->getMethod($methodName);
        } else {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($className)->getMethod($methodName);
        }
        /** @var PHPParameter $stubParameter */
        $stubParameter = current(array_filter(
            $stubMethod->parameters,
            fn (PHPParameter $stubParameter) => $stubParameter->name === $reflectionParameter->name
        ));
        self::assertNotFalse($stubParameter, "Parameter $$reflectionParameter->name not found at 
        $reflectionClass->name::$stubMethod->name(" .
            StubsParameterNamesTest::printParameters($stubMethod->parameters) . ')');
        self::compareTypeHintsWithReflection($reflectionParameter, $stubParameter, $methodName);
        if (!$reflectionParameter->hasMutedProblem(StubProblemType::PARAMETER_REFERENCE)) {
            self::assertEquals(
                $reflectionParameter->is_passed_by_ref,
                $stubParameter->is_passed_by_ref,
                "Invalid pass by ref $className::$methodName: \$$reflectionParameter->name "
            );
        }
        self::assertEquals(
            $reflectionParameter->is_vararg,
            $stubParameter->is_vararg,
            "Invalid pass by ref $className::$methodName: \$$reflectionParameter->name "
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsParametersProvider::parametersForScalarTypeHintTestsProvider
     * @throws RuntimeException
     */
    public static function testMethodDoesNotHaveScalarTypeHintsInParameters(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $parameter)
    {
        $sinceVersion = ParserUtils::getDeclaredSinceVersion($stubMethod);
        self::assertEmpty(
            array_intersect(['int', 'float', 'string', 'bool', 'mixed', 'object'], $parameter->typesFromSignature),
            "Method '$class->name::$stubMethod->name' with @since '$sinceVersion'  
                has parameter '$parameter->name' with typehint '" . implode('|', $parameter->typesFromSignature) .
            "' but typehints available only since php 7"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsParametersProvider::parametersForNullableTypeHintTestsProvider
     * @throws RuntimeException
     */
    public static function testMethodDoesNotHaveNullableTypeHintsInParameters(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $parameter)
    {
        $sinceVersion = ParserUtils::getDeclaredSinceVersion($stubMethod);
        self::assertEmpty(
            array_filter($parameter->typesFromSignature, fn (string $type) => str_contains($type, '?')),
            "Method '$class->name::$stubMethod->name' with @since '$sinceVersion'  
                has nullable parameter '$parameter->name' with typehint '" . implode('|', $parameter->typesFromSignature) . "' 
                but nullable typehints available only since php 7.1"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsParametersProvider::parametersForUnionTypeHintTestsProvider
     * @throws RuntimeException
     */
    public static function testMethodDoesNotHaveUnionTypeHintsInParameters(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $parameter)
    {
        $sinceVersion = ParserUtils::getDeclaredSinceVersion($stubMethod);
        self::assertLessThan(
            2,
            count($parameter->typesFromSignature),
            "Method '$class->name::$stubMethod->name' with @since '$sinceVersion'  
                has parameter '$parameter->name' with union typehint '" . implode('|', $parameter->typesFromSignature) . "' 
                but union typehints available only since php 8.0"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubMethodsProvider::methodsForReturnTypeHintTestsProvider
     * @throws RuntimeException
     */
    public static function testMethodDoesNotHaveReturnTypeHint(PHPMethod $stubMethod)
    {
        $sinceVersion = ParserUtils::getDeclaredSinceVersion($stubMethod);
        self::assertEmpty($stubMethod->returnTypesFromSignature, "Method '$stubMethod->parentName::$stubMethod->name' has since version '$sinceVersion'
            but has return typehint '" . implode('|', $stubMethod->returnTypesFromSignature) . "' that supported only since PHP 7. Please declare return type via PhpDoc");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubMethodsProvider::methodsForNullableReturnTypeHintTestsProvider
     * @throws RuntimeException
     */
    public static function testMethodDoesNotHaveNullableReturnTypeHint(PHPMethod $stubMethod)
    {
        $sinceVersion = ParserUtils::getDeclaredSinceVersion($stubMethod);
        $returnTypes = $stubMethod->returnTypesFromSignature;
        self::assertEmpty(
            array_filter($returnTypes, fn (string $type) => str_contains($type, '?')),
            "Method '$stubMethod->parentName::$stubMethod->name' has since version '$sinceVersion'
            but has nullable return typehint '" . implode('|', $returnTypes) . "' that supported only since PHP 7.1. 
            Please declare return type via PhpDoc"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubMethodsProvider::methodsForUnionReturnTypeHintTestsProvider
     * @throws RuntimeException
     */
    public static function testMethodDoesNotHaveUnionReturnTypeHint(PHPMethod $stubMethod)
    {
        $sinceVersion = ParserUtils::getDeclaredSinceVersion($stubMethod);
        self::assertLessThan(
            2,
            count($stubMethod->returnTypesFromSignature),
            "Method '$stubMethod->parentName::$stubMethod->name' has since version '$sinceVersion'
            but has union return typehint '" . implode('|', $stubMethod->returnTypesFromSignature) . "' that supported only since PHP 8.0. 
            Please declare return type via PhpDoc"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsParametersProvider::parametersForAllowedScalarTypeHintTestsProvider
     * @throws RuntimeException
     */
    public function testMethodScalarTypeHintsInParametersMatchReflection(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $stubParameter)
    {
        $reflectionMethod = ReflectionStubsSingleton::getReflectionStubs()->getClass($class->name)->getMethod($stubMethod->name);
        $reflectionParameters = array_filter($reflectionMethod->parameters, fn (PHPParameter $parameter) => $parameter->name === $stubParameter->name);
        $reflectionParameter = array_pop($reflectionParameters);
        self::compareTypeHintsWithReflection($reflectionParameter, $stubParameter, $stubMethod->name);
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsParametersProvider::parametersForAllowedNullableTypeHintTestsProvider
     * @throws RuntimeException
     */
    public function testMethodNullableTypeHintsInParametersMatchReflection(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $stubParameter)
    {
        $reflectionMethod = ReflectionStubsSingleton::getReflectionStubs()->getClass($class->name)->getMethod($stubMethod->name);
        $reflectionParameters = array_filter($reflectionMethod->parameters, fn (PHPParameter $parameter) => $parameter->name === $stubParameter->name);
        $reflectionParameter = array_pop($reflectionParameters);
        self::compareTypeHintsWithReflection($reflectionParameter, $stubParameter, $stubMethod->name);
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsParametersProvider::parametersForAllowedUnionTypeHintTestsProvider
     * @throws RuntimeException
     */
    public function testMethodUnionTypeHintsInParametersMatchReflection(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $stubParameter)
    {
        $reflectionMethod = ReflectionStubsSingleton::getReflectionStubs()->getClass($class->name)->getMethod($stubMethod->name);
        $reflectionParameters = array_filter($reflectionMethod->parameters, fn (PHPParameter $parameter) => $parameter->name === $stubParameter->name);
        $reflectionParameter = array_pop($reflectionParameters);
        self::compareTypeHintsWithReflection($reflectionParameter, $stubParameter, $stubMethod->name);
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubMethodsProvider::allFunctionAndMethodsWithReturnTypeHintsProvider
     * @throws Exception
     */
    public static function testSignatureTypeHintsComplainPhpDocInMethods(PHPFunction|PHPMethod $method)
    {
        $functionName = $method->name;
        $unifiedPhpDocTypes = array_map(function (string $type) {
            $typeParts = explode('\\', $type);
            $typeName = end($typeParts);

            // replace array notations like int[] or array<string,mixed> to match the array type
            return preg_replace(['/\w+\[]/', '/array<[a-z,\s]+>/'], 'array', $typeName);
        }, $method->returnTypesFromPhpDoc);
        $unifiedSignatureTypes = $method->returnTypesFromSignature;
        if (count($unifiedSignatureTypes) === 1) {
            $unifiedSignatureTypes = [];
            $type = array_pop($method->returnTypesFromSignature);
            if (str_contains($type, '?')) {
                array_push($unifiedSignatureTypes, 'null');
            }
            $typeParts = explode('\\', ltrim($type, '?'));
            $typeName = end($typeParts);
            array_push($unifiedSignatureTypes, $typeName);
        }
        $typesIntersection = array_intersect($unifiedSignatureTypes, $unifiedPhpDocTypes);
        self::assertSameSize(
            $unifiedSignatureTypes,
            $typesIntersection,
            $method instanceof PHPMethod ? "Method $method->parentName::" : 'Function ' .
                "$functionName has mismatch in phpdoc return type and signature return type\n
                signature has " . implode('|', $unifiedSignatureTypes) . "\n
                but phpdoc has " . implode('|', $unifiedPhpDocTypes)
        );
    }

    private static function compareTypeHintsWithReflection(PHPParameter $parameter, PHPParameter $stubParameter, ?string $functionName): void
    {
        $unifiedStubsParameterTypes = [];
        $unifiedStubsAttributesParameterTypes = [];
        $unifiedReflectionParameterTypes = [];
        self::convertNullableTypesToUnion($parameter->typesFromSignature, $unifiedReflectionParameterTypes);
        if (!empty($stubParameter->typesFromSignature)) {
            self::convertNullableTypesToUnion($stubParameter->typesFromSignature, $unifiedStubsParameterTypes);
        }
        foreach ($stubParameter->typesFromAttribute as $languageVersion => $listOfTypes) {
            $unifiedStubsAttributesParameterTypes[$languageVersion] = [];
            self::convertNullableTypesToUnion($listOfTypes, $unifiedStubsAttributesParameterTypes[$languageVersion]);
        }
        $typesFromAttribute = [];
        $testCondition = BaseStubsTest::isReflectionTypesMatchSignature($unifiedReflectionParameterTypes, $unifiedStubsParameterTypes);
        if (!$testCondition) {
            if (!empty($unifiedStubsAttributesParameterTypes)) {
                $typesFromAttribute = !empty($unifiedStubsAttributesParameterTypes[getenv('PHP_VERSION')]) ?
                    $unifiedStubsAttributesParameterTypes[getenv('PHP_VERSION')] :
                    $unifiedStubsAttributesParameterTypes['default'];
                $testCondition = BaseStubsTest::isReflectionTypesExistInAttributes($unifiedReflectionParameterTypes, $typesFromAttribute);
            }
        }
        self::assertTrue($testCondition, "Type mismatch $functionName: \$$parameter->name \n
        Reflection parameter $parameter->name with index $parameter->indexInSignature has type '" . implode('|', $unifiedReflectionParameterTypes) .
            "' but stub parameter $stubParameter->name with index $stubParameter->indexInSignature has type '" . implode('|', $unifiedStubsParameterTypes) . "' in signature and " .
            implode('|', $typesFromAttribute) . ' in attribute');
    }
}
