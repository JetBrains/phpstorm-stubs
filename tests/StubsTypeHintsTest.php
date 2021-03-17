<?php
declare(strict_types=1);

namespace StubTests;

use RuntimeException;
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

class StubsTypeHintsTest extends BaseStubsTest
{
    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionFunctionsProvider::allFunctionsProvider
     * @param PHPFunction $function
     * @throws RuntimeException
     */
    public function testFunctionsReturnTypeHints(PHPFunction $function)
    {
        $functionName = $function->name;
        $allEqualStubFunctions = EntitiesFilter::getFiltered(PhpStormStubsSingleton::getPhpStormStubs()->getFunctions(),
            fn (PHPFunction $stubFunction) => $stubFunction->name !== $functionName ||
                !in_array(PhpVersions::getLatest(), Utils::getAvailableInVersions($stubFunction)));
        /** @var PHPFunction $stubFunction */
        $stubFunction = array_pop($allEqualStubFunctions);
        $conditionToCompareWithSignature = self::ifReflectionTypesExistInSignature($function->returnTypesFromSignature, $stubFunction->returnTypesFromSignature);
        $conditionToCompareWithAttribute = self::ifReflectionTypesExistInAttributes($function->returnTypesFromSignature, $stubFunction->returnTypesFromAttribute);
        $testCondition = $conditionToCompareWithSignature || $conditionToCompareWithAttribute;
        self::assertTrue($testCondition, "Function $functionName has invalid return type.
        Reflection function has return type " . implode('|', $function->returnTypesFromSignature) . ' but stubs has return type ' .
            implode('|', $stubFunction->returnTypesFromSignature) . ' in signature and attribute has types ' .
            self::getStringRepresentationOfTypeHintsFromAttributes($stubFunction->returnTypesFromAttribute));
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionParametersProvider::functionParametersProvider
     * @param PHPFunction $function
     * @param PHPParameter $parameter
     * @throws RuntimeException
     */
    public function testFunctionsParametersTypeHints(PHPFunction $function, PHPParameter $parameter)
    {
        $functionName = $function->name;
        $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getFunction($functionName);
        $stubParameter = current(array_filter($phpstormFunction->parameters, fn (PHPParameter $stubParameter) => $stubParameter->name === $parameter->name));
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
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionMethodsProvider::classMethodsWithReturnTypeHintProvider
     * @param PHPClass|PHPInterface $class
     * @param PHPMethod $method
     * @throws RuntimeException
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
     * @param PHPClass|PHPInterface $reflectionClass
     * @param PHPMethod $reflectionMethod
     * @param PHPParameter $reflectionParameter
     * @throws RuntimeException
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
            fn (PHPParameter $stubParameter) => $stubParameter->name === $reflectionParameter->name));
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
     * @param PHPClass|PHPInterface $class
     * @param PHPMethod $stubMethod
     * @param PHPParameter $parameter
     * @throws RuntimeException
     */
    public static function testMethodDoesNotHaveScalarTypeHintsInParameters(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $parameter)
    {
        $sinceVersion = Utils::getDeclaredSinceVersion($stubMethod);
        self::assertEmpty(array_intersect(['int', 'float', 'string', 'bool'], $parameter->typesFromSignature),
            "Method '$class->name::$stubMethod->name' with @since '$sinceVersion'  
                has parameter '$parameter->name' with typehint '" . implode('|', $parameter->typesFromSignature) .
            "' but typehints available only since php 7");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsParametersProvider::parametersForNullableTypeHintTestsProvider
     * @param PHPClass|PHPInterface $class
     * @param PHPMethod $stubMethod
     * @param PHPParameter $parameter
     * @throws RuntimeException
     */
    public static function testMethodDoesNotHaveNullableTypeHintsInParameters(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $parameter)
    {
        $sinceVersion = Utils::getDeclaredSinceVersion($stubMethod);
        self::assertEmpty(array_filter($parameter->typesFromSignature, fn (string $type) => str_contains($type, '?')),
            "Method '$class->name::$stubMethod->name' with @since '$sinceVersion'  
                has nullable parameter '$parameter->name' with typehint '" . implode('|', $parameter->typesFromSignature) . "' 
                but nullable typehints available only since php 7.1");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsParametersProvider::parametersForUnionTypeHintTestsProvider
     * @param PHPClass|PHPInterface $class
     * @param PHPMethod $stubMethod
     * @param PHPParameter $parameter
     * @throws RuntimeException
     */
    public static function testMethodDoesNotHaveUnionTypeHintsInParameters(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $parameter)
    {
        $sinceVersion = Utils::getDeclaredSinceVersion($stubMethod);
        self::assertLessThan(2, count($parameter->typesFromSignature),
            "Method '$class->name::$stubMethod->name' with @since '$sinceVersion'  
                has parameter '$parameter->name' with union typehint '" . implode('|', $parameter->typesFromSignature) . "' 
                but union typehints available only since php 8.0");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubMethodsProvider::methodsForReturnTypeHintTestsProvider
     * @param PHPMethod $stubMethod
     * @throws RuntimeException
     */
    public static function testMethodDoesNotHaveReturnTypeHint(PHPMethod $stubMethod)
    {
        $sinceVersion = Utils::getDeclaredSinceVersion($stubMethod);
        self::assertEmpty($stubMethod->returnTypesFromSignature, "Method '$stubMethod->parentName::$stubMethod->name' has since version '$sinceVersion'
            but has return typehint '" . implode('|', $stubMethod->returnTypesFromSignature) . "' that supported only since PHP 7. Please declare return type via PhpDoc");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubMethodsProvider::methodsForNullableReturnTypeHintTestsProvider
     * @param PHPMethod $stubMethod
     * @throws RuntimeException
     */
    public static function testMethodDoesNotHaveNullableReturnTypeHint(PHPMethod $stubMethod)
    {
        $sinceVersion = Utils::getDeclaredSinceVersion($stubMethod);
        $returnTypes = $stubMethod->returnTypesFromSignature;
        self::assertEmpty(array_filter($returnTypes, fn (string $type) => str_contains($type, '?')),
            "Method '$stubMethod->parentName::$stubMethod->name' has since version '$sinceVersion'
            but has nullable return typehint '" . implode('|', $returnTypes) . "' that supported only since PHP 7.1. 
            Please declare return type via PhpDoc");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubMethodsProvider::methodsForUnionReturnTypeHintTestsProvider
     * @param PHPMethod $stubMethod
     * @throws RuntimeException
     */
    public static function testMethodDoesNotHaveUnionReturnTypeHint(PHPMethod $stubMethod)
    {
        $sinceVersion = Utils::getDeclaredSinceVersion($stubMethod);
        self::assertLessThan(2, count($stubMethod->returnTypesFromSignature),
            "Method '$stubMethod->parentName::$stubMethod->name' has since version '$sinceVersion'
            but has union return typehint '" . implode('|', $stubMethod->returnTypesFromSignature) . "' that supported only since PHP 8.0. 
            Please declare return type via PhpDoc");
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsParametersProvider::parametersForAllowedScalarTypeHintTestsProvider
     * @param PHPClass|PHPInterface $class
     * @param PHPMethod $stubMethod
     * @param PHPParameter $stubParameter
     * @throws RuntimeException
     */
    public function testMethodScalarTypeHintsInParametersMatchReflection(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $stubParameter)
    {
        $reflectionMethods = array_filter(ReflectionStubsSingleton::getReflectionStubs()->getClass($class->name)->methods,
            fn (PHPMethod $method) => $method->name === $stubMethod->name);
        /** @var PHPMethod $reflectionMethod */
        $reflectionMethod = array_pop($reflectionMethods);
        $reflectionParameters = array_filter($reflectionMethod->parameters, fn (PHPParameter $parameter) => $parameter->name === $stubParameter->name);
        $reflectionParameter = array_pop($reflectionParameters);
        self::compareTypeHintsWithReflection($reflectionParameter, $stubParameter, $stubMethod->name);
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsParametersProvider::parametersForAllowedNullableTypeHintTestsProvider
     * @param PHPClass|PHPInterface $class
     * @param PHPMethod $stubMethod
     * @param PHPParameter $stubParameter
     * @throws RuntimeException
     */
    public function testMethodNullableTypeHintsInParametersMatchReflection(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $stubParameter)
    {
        $reflectionMethods = array_filter(ReflectionStubsSingleton::getReflectionStubs()->getClass($class->name)->methods,
            fn (PHPMethod $method) => $method->name === $stubMethod->name);
        /** @var PHPMethod $reflectionMethod */
        $reflectionMethod = array_pop($reflectionMethods);
        $reflectionParameters = array_filter($reflectionMethod->parameters, fn (PHPParameter $parameter) => $parameter->name === $stubParameter->name);
        $reflectionParameter = array_pop($reflectionParameters);
        self::compareTypeHintsWithReflection($reflectionParameter, $stubParameter, $stubMethod->name);
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubsParametersProvider::parametersForAllowedUnionTypeHintTestsProvider
     * @param PHPClass|PHPInterface $class
     * @param PHPMethod $stubMethod
     * @param PHPParameter $stubParameter
     * @throws RuntimeException
     */
    public function testMethodUnionTypeHintsInParametersMatchReflection(PHPClass|PHPInterface $class, PHPMethod $stubMethod, PHPParameter $stubParameter)
    {
        $reflectionMethods = array_filter(ReflectionStubsSingleton::getReflectionStubs()->getClass($class->name)->methods,
            fn (PHPMethod $method) => $method->name === $stubMethod->name);
        /** @var PHPMethod $reflectionMethod */
        $reflectionMethod = array_pop($reflectionMethods);
        $reflectionParameters = array_filter($reflectionMethod->parameters, fn (PHPParameter $parameter) => $parameter->name === $stubParameter->name);
        $reflectionParameter = array_pop($reflectionParameters);
        self::compareTypeHintsWithReflection($reflectionParameter, $stubParameter, $stubMethod->name);
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Stubs\StubMethodsProvider::allFunctionAndMethodsWithReturnTypeHintsProvider
     * @param PHPFunction|PHPMethod $method
     */
    public static function testSignatureTypeHintsComplainPhpDocInMethods(PHPFunction|PHPMethod $method)
    {
        $functionName = $method->name;
        $unifiedPhpDocTypes = array_map(function (string $type) {
            $typeParts = explode('\\', $type);
            $typeName = end($typeParts);
            return preg_replace('/\w+\[]/', 'array', $typeName);
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
        self::assertEquals(count($unifiedSignatureTypes), count($typesIntersection),
            $method instanceof PHPMethod ? "Method $method->parentName::" : 'Function ' .
                "$functionName has mismatch in phpdoc return type and signature return type\n
                signature has " . implode('|', $unifiedSignatureTypes) . "\n
                but phpdoc has " . implode('|', $unifiedPhpDocTypes));
    }

    private static function compareTypeHintsWithReflection(PHPParameter $parameter, PHPParameter $stubParameter, ?string $functionName): void
    {
        $unifiedStubsParameterTypes = [];
        $unifiedStubsAttributesParameterTypes = [];
        $unifiedReflectionParameterTypes = [];
        self::convertNullableTypesToUnion($parameter->typesFromSignature, $unifiedReflectionParameterTypes);
        if (!empty($stubParameter->typesFromSignature)) {
            self::convertNullableTypesToUnion($stubParameter->typesFromSignature, $unifiedStubsParameterTypes);
        } else {
            foreach ($stubParameter->typesFromAttribute as $languageVersion => $listOfTypes) {
                $unifiedStubsAttributesParameterTypes[$languageVersion] = [];
                self::convertNullableTypesToUnion($listOfTypes, $unifiedStubsAttributesParameterTypes[$languageVersion]);
            }
        }
        $conditionToCompareWithSignature = self::ifReflectionTypesExistInSignature($unifiedReflectionParameterTypes, $unifiedStubsParameterTypes);
        $conditionToCompareWithAttribute = self::ifReflectionTypesExistInAttributes($unifiedReflectionParameterTypes, $unifiedStubsAttributesParameterTypes);
        $testCondition = $conditionToCompareWithSignature || $conditionToCompareWithAttribute;
        self::assertTrue($testCondition, "Type mismatch $functionName: \$$parameter->name \n
        Reflection parameter has type '" . implode('|', $unifiedReflectionParameterTypes) .
            "' but stub parameter has type '" . implode('|', $unifiedStubsParameterTypes) . "' in signature and " .
            self::getStringRepresentationOfTypeHintsFromAttributes($unifiedStubsAttributesParameterTypes) . ' in attribute');
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

    private static function getStringRepresentationOfTypeHintsFromAttributes(array $typesFromAttribute): string
    {
        $resultString = '';
        foreach ($typesFromAttribute as $types) {
            $resultString .= '[' . implode('|', $types) . ']';
        }
        return $resultString;
    }

    private static function ifReflectionTypesExistInAttributes(array $reflectionTypes, array $typesFromAttribute): bool
    {
        return !empty(array_filter($typesFromAttribute,
            fn (array $types) => count(array_intersect($reflectionTypes, $types)) == count($reflectionTypes)));
    }

    private static function ifReflectionTypesExistInSignature(array $reflectionTypes, array $typesFromSignature): bool
    {
        return count(array_intersect($reflectionTypes, $typesFromSignature)) === count($reflectionTypes);
    }
}
