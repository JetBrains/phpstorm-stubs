<?php

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use StubTests\Model\PHPParameter;
use StubTests\TestData\Providers\PhpStormStubsSingleton;
use StubTests\TestData\Providers\Reflection\ReflectionConstantsProvider;
use StubTests\TestData\Providers\Reflection\ReflectionMethodsProvider;
use StubTests\TestData\Providers\Reflection\ReflectionParametersProvider;
use StubTests\TestData\Providers\Reflection\ReflectionPropertiesProvider;
use StubTests\TestData\Providers\ReflectionStubsSingleton;

class StubsPhp81Tests extends AbstractBaseStubsTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        PhpStormStubsSingleton::getPhpStormStubs();
        ReflectionStubsSingleton::getReflectionStubs();
    }

    #[DataProviderExternal(ReflectionPropertiesProvider::class, 'classReadonlyPropertiesProvider')]
    public function testPropertyReadonly(?string $classId, ?string $propertyName)
    {
        if (!$classId && !$propertyName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionProperty = ReflectionStubsSingleton::getReflectionStubs()->getClass($classId, fromReflection: true)->getProperty($propertyName, fromReflection: true);
        $stubProperty = PhpStormStubsSingleton::getPhpStormStubs()->getClass($classId)->getProperty($propertyName);
        static::assertEquals(
            $reflectionProperty->isReadonly,
            $stubProperty->isReadonly,
            "Property $classId::$propertyName readonly modifier is incorrect"
        );
    }

    #[DataProviderExternal(ReflectionMethodsProvider::class, 'classMethodsWithTentitiveReturnTypeProvider')]
    public function testClassMethodTentativeReturnTypeHints(?string $classId, ?string $methodName)
    {
        if (!$classId && !$methodName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionMethod = ReflectionStubsSingleton::getReflectionStubs()->getClass($classId, fromReflection: true)->getMethod($methodName, fromReflection: true);
        $stubsMethod = PhpStormStubsSingleton::getPhpStormStubs()->getClass($classId)->getMethod($methodName);
        $unifiedStubsReturnTypes = [];
        $unifiedStubsAttributesReturnTypes = [];
        $unifiedReflectionReturnTypes = [];
        self::convertNullableTypesToUnion($reflectionMethod->returnTypesFromSignature, $unifiedReflectionReturnTypes);
        if (!empty($stubsMethod->returnTypesFromSignature)) {
            self::convertNullableTypesToUnion($stubsMethod->returnTypesFromSignature, $unifiedStubsReturnTypes);
        } else {
            foreach ($stubsMethod->returnTypesFromAttribute as $languageVersion => $listOfTypes) {
                $unifiedStubsAttributesReturnTypes[$languageVersion] = [];
                self::convertNullableTypesToUnion($listOfTypes, $unifiedStubsAttributesReturnTypes[$languageVersion]);
            }
        }
        $conditionToCompareWithSignature = AbstractBaseStubsTestCase::isReflectionTypesMatchSignature(
            $unifiedReflectionReturnTypes,
            $unifiedStubsReturnTypes
        );
        $typesFromAttribute = [];
        if (!empty($unifiedStubsAttributesReturnTypes)) {
            $typesFromAttribute = !empty($unifiedStubsAttributesReturnTypes[getenv('PHP_VERSION')]) ?
                $unifiedStubsAttributesReturnTypes[getenv('PHP_VERSION')] :
                $unifiedStubsAttributesReturnTypes['default'];
        }
        $conditionToCompareWithAttribute = AbstractBaseStubsTestCase::isReflectionTypesExistInAttributes($unifiedReflectionReturnTypes, $typesFromAttribute);
        $testCondition = $conditionToCompareWithSignature || $conditionToCompareWithAttribute;
        self::assertTrue(
            $testCondition,
            "Method $classId::$methodName has invalid return type. Reflection method has return type " .
            implode('|', $reflectionMethod->returnTypesFromSignature) .
            ' but stubs has return type ' . implode('|', $stubsMethod->returnTypesFromSignature) .
            ' in signature and attribute has types ' . implode('|', $typesFromAttribute)
        );
        self::assertTrue($stubsMethod->isReturnTypeTentative, "Reflection method $classId::$methodName has " .
            "tentative return type but stub's method isn't declared as tentative");
    }

    #[DataProviderExternal(ReflectionMethodsProvider::class, 'interfaceMethodsWithTentitiveReturnTypeProvider')]
    public function testInterfaceMethodTentativeReturnTypeHints(?string $classId, ?string $methodName)
    {
        if (!$classId && !$methodName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionMethod = ReflectionStubsSingleton::getReflectionStubs()->getInterface($classId, fromReflection: true)->getMethod($methodName, fromReflection: true);
        $stubsMethod = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($classId)->getMethod($methodName);
        $unifiedStubsReturnTypes = [];
        $unifiedStubsAttributesReturnTypes = [];
        $unifiedReflectionReturnTypes = [];
        self::convertNullableTypesToUnion($reflectionMethod->returnTypesFromSignature, $unifiedReflectionReturnTypes);
        if (!empty($stubsMethod->returnTypesFromSignature)) {
            self::convertNullableTypesToUnion($stubsMethod->returnTypesFromSignature, $unifiedStubsReturnTypes);
        } else {
            foreach ($stubsMethod->returnTypesFromAttribute as $languageVersion => $listOfTypes) {
                $unifiedStubsAttributesReturnTypes[$languageVersion] = [];
                self::convertNullableTypesToUnion($listOfTypes, $unifiedStubsAttributesReturnTypes[$languageVersion]);
            }
        }
        $conditionToCompareWithSignature = AbstractBaseStubsTestCase::isReflectionTypesMatchSignature(
            $unifiedReflectionReturnTypes,
            $unifiedStubsReturnTypes
        );
        $typesFromAttribute = [];
        if (!empty($unifiedStubsAttributesReturnTypes)) {
            $typesFromAttribute = !empty($unifiedStubsAttributesReturnTypes[getenv('PHP_VERSION')]) ?
                $unifiedStubsAttributesReturnTypes[getenv('PHP_VERSION')] :
                $unifiedStubsAttributesReturnTypes['default'];
        }
        $conditionToCompareWithAttribute = AbstractBaseStubsTestCase::isReflectionTypesExistInAttributes($unifiedReflectionReturnTypes, $typesFromAttribute);
        $testCondition = $conditionToCompareWithSignature || $conditionToCompareWithAttribute;
        self::assertTrue(
            $testCondition,
            "Method $classId::$methodName has invalid return type. Reflection method has return type " .
            implode('|', $reflectionMethod->returnTypesFromSignature) .
            ' but stubs has return type ' . implode('|', $stubsMethod->returnTypesFromSignature) .
            ' in signature and attribute has types ' . implode('|', $typesFromAttribute)
        );
        self::assertTrue($stubsMethod->isReturnTypeTentative, "Reflection method $classId::$methodName has " .
            "tentative return type but stub's method isn't declared as tentative");
    }

    #[DataProviderExternal(ReflectionMethodsProvider::class, 'enumMethodsWithTentitiveReturnTypeProvider')]
    public function testEnumMethodTentativeReturnTypeHints(?string $classId, ?string $methodName)
    {
        if (!$classId && !$methodName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionMethod = ReflectionStubsSingleton::getReflectionStubs()->getEnum($classId, fromReflection: true)->getMethod($methodName, fromReflection: true);
        $stubsMethod = PhpStormStubsSingleton::getPhpStormStubs()->getEnum($classId)->getMethod($methodName);
        $unifiedStubsReturnTypes = [];
        $unifiedStubsAttributesReturnTypes = [];
        $unifiedReflectionReturnTypes = [];
        self::convertNullableTypesToUnion($reflectionMethod->returnTypesFromSignature, $unifiedReflectionReturnTypes);
        if (!empty($stubsMethod->returnTypesFromSignature)) {
            self::convertNullableTypesToUnion($stubsMethod->returnTypesFromSignature, $unifiedStubsReturnTypes);
        } else {
            foreach ($stubsMethod->returnTypesFromAttribute as $languageVersion => $listOfTypes) {
                $unifiedStubsAttributesReturnTypes[$languageVersion] = [];
                self::convertNullableTypesToUnion($listOfTypes, $unifiedStubsAttributesReturnTypes[$languageVersion]);
            }
        }
        $conditionToCompareWithSignature = AbstractBaseStubsTestCase::isReflectionTypesMatchSignature(
            $unifiedReflectionReturnTypes,
            $unifiedStubsReturnTypes
        );
        $typesFromAttribute = [];
        if (!empty($unifiedStubsAttributesReturnTypes)) {
            $typesFromAttribute = !empty($unifiedStubsAttributesReturnTypes[getenv('PHP_VERSION')]) ?
                $unifiedStubsAttributesReturnTypes[getenv('PHP_VERSION')] :
                $unifiedStubsAttributesReturnTypes['default'];
        }
        $conditionToCompareWithAttribute = AbstractBaseStubsTestCase::isReflectionTypesExistInAttributes($unifiedReflectionReturnTypes, $typesFromAttribute);
        $testCondition = $conditionToCompareWithSignature || $conditionToCompareWithAttribute;
        self::assertTrue(
            $testCondition,
            "Method $classId::$methodName has invalid return type. Reflection method has return type " .
            implode('|', $reflectionMethod->returnTypesFromSignature) .
            ' but stubs has return type ' . implode('|', $stubsMethod->returnTypesFromSignature) .
            ' in signature and attribute has types ' . implode('|', $typesFromAttribute)
        );
        self::assertTrue($stubsMethod->isReturnTypeTentative, "Reflection method $classId::$methodName has " .
            "tentative return type but stub's method isn't declared as tentative");
    }

    #[DataProviderExternal(ReflectionConstantsProvider::class, 'enumConstantProvider')]
    public function testEnumConstants(?string $classId, ?string $constantName): void
    {
        if (!$classId && !$constantName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionConstant = ReflectionStubsSingleton::getReflectionStubs()->getEnum($classId, fromReflection: true)->getConstant($constantName, fromReflection: true);
        $constantValue = $reflectionConstant->value;
        $stubsEnum = PhpStormStubsSingleton::getPhpStormStubs()->getEnum($classId);
        $stubConstant = $stubsEnum->getConstant($constantName);
        static::assertNotEmpty(
            $stubConstant,
            "Missing constant: $classId::$constantName = $constantValue\n"
        );
    }

    #[DataProviderExternal(ReflectionConstantsProvider::class, 'enumCaseProvider')]
    public function testEnumCases(?string $classId, ?string $caseName): void
    {
        if (!$classId && !$caseName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionConstant = ReflectionStubsSingleton::getReflectionStubs()->getEnum($classId, fromReflection: true)->getCase($caseName, fromReflection: true);
        $enumCaseName = $reflectionConstant->value->name;
        $enumCaseValue = $reflectionConstant->value->value;
        $stubsEnum = PhpStormStubsSingleton::getPhpStormStubs()->getEnum($classId);
        $stubConstant = $stubsEnum->getCase($caseName);
        static::assertNotEmpty(
            $stubConstant,
            "Missing enum case: $classId::$caseName\n"
        );
    }

    #[DataProviderExternal(ReflectionParametersProvider::class, 'enumMethodOptionalParametersWithDefaultValueProvider')]
    public function testEnumMethodsDefaultParametersValue(?string $classId, ?string $methodName, ?string $parameterName)
    {
        if (!$classId && !$methodName && !$parameterName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionParameter = ReflectionStubsSingleton::getReflectionStubs()->getEnum($classId, fromReflection: true)->getMethod($methodName, fromReflection: true)->getParameter($parameterName);
        $stubClass = PhpStormStubsSingleton::getPhpStormStubs()->getEnum($classId);
        $phpstormFunction = $stubClass->getMethod($methodName);
        $stubParameters = array_filter($phpstormFunction->parameters, fn (PHPParameter $stubParameter) => $stubParameter->indexInSignature === $reflectionParameter->indexInSignature);
        $stubOptionalParameter = array_pop($stubParameters);
        $reflectionValue = AbstractBaseStubsTestCase::getStringRepresentationOfDefaultParameterValue($reflectionParameter->defaultValue);
        $stubValue = AbstractBaseStubsTestCase::getStringRepresentationOfDefaultParameterValue($stubOptionalParameter->defaultValue, $stubClass);
        self::assertEquals(
            $reflectionValue,
            $stubValue,
            sprintf(
                'Reflection method %s::%s has optional parameter %s with default value %s but stub parameter has value %s',
                $classId,
                $methodName,
                $parameterName,
                $reflectionValue,
                $stubValue
            )
        );
    }

    #[DataProviderExternal(ReflectionParametersProvider::class, 'enumMethodOptionalParametersWithoutDefaultValueProvider')]
    public function testEnumMethodsWithoutOptionalDefaultParametersValue(?string $classId, ?string $methodName, ?string $parameterName)
    {
        if (!$classId && !$methodName && !$parameterName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionParameter = ReflectionStubsSingleton::getReflectionStubs()->getInterface($classId, fromReflection: true)->getMethod($methodName, fromReflection: true)->getParameter($parameterName);
        $stubClass = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($classId);
        $phpstormFunction = $stubClass->getMethod($methodName);
        $stubParameters = array_filter($phpstormFunction->parameters, fn (PHPParameter $stubParameter) => $stubParameter->indexInSignature === $reflectionParameter->indexInSignature);
        $stubOptionalParameter = array_pop($stubParameters);

        self::assertEmpty(
            $stubOptionalParameter->defaultValue,
            sprintf(
                'Stub method %s::%s has a parameter "%s" which expected to have no default value but it has',
                $classId,
                $methodName,
                $stubOptionalParameter->name
            )
        );
        self::assertTrue(
            $stubOptionalParameter->markedOptionalInPhpDoc,
            sprintf(
                'Stub method %s::%s has a parameter "%s" which expected to be marked as [optional] at PHPDoc but it is not',
                $classId,
                $methodName,
                $stubOptionalParameter->name
            )
        );
    }
}
