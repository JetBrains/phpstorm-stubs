<?php
declare(strict_types=1);

namespace StubTests;

use phpDocumentor\Reflection\DocBlock\Tags\Template;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use stdClass;
use StubTests\Model\CommonUtils;
use StubTests\Model\PHPParameter;
use StubTests\Model\StubProblemType;
use StubTests\TestData\Providers\PhpStormStubsSingleton;
use StubTests\TestData\Providers\Reflection\ReflectionFunctionsProvider;
use StubTests\TestData\Providers\Reflection\ReflectionMethodsProvider;
use StubTests\TestData\Providers\Reflection\ReflectionParametersProvider;
use StubTests\TestData\Providers\ReflectionStubsSingleton;
use StubTests\TestData\Providers\Stubs\StubMethodsProvider;
use StubTests\TestData\Providers\Stubs\StubsParametersProvider;

class StubsTypeHintsTest extends AbstractBaseStubsTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        PhpStormStubsSingleton::getPhpStormStubs();
        ReflectionStubsSingleton::getReflectionStubs();
    }

    #[DataProviderExternal(ReflectionFunctionsProvider::class, 'functionsForReturnTypeHintsTestProvider')]
    public function testFunctionsReturnTypeHints(?string $functionId)
    {
        if (!$functionId) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $function = ReflectionStubsSingleton::getReflectionStubs()->getFunction($functionId, fromReflection: true);
        $stubFunction = PhpStormStubsSingleton::getPhpStormStubs()->getFunction($functionId);
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
        $conditionToCompareWithSignature = AbstractBaseStubsTestCase::isReflectionTypesMatchSignature(
            $unifiedReflectionReturnTypes,
            $unifiedStubsReturnTypes
        ) || empty($unifiedReflectionReturnTypes);
        $typesFromAttribute = [];
        if (!empty($unifiedStubsAttributesReturnTypes)) {
            $typesFromAttribute = !empty($unifiedStubsAttributesReturnTypes[getenv('PHP_VERSION')]) ?
                $unifiedStubsAttributesReturnTypes[getenv('PHP_VERSION')] :
                $unifiedStubsAttributesReturnTypes['default'];
        }
        $conditionToCompareWithAttribute = AbstractBaseStubsTestCase::isReflectionTypesExistInAttributes($unifiedReflectionReturnTypes, $typesFromAttribute);
        $testCondition = $conditionToCompareWithSignature || $conditionToCompareWithAttribute;
        self::assertTrue($testCondition, "Function $functionId has invalid return type.
        Reflection function has return type " . implode('|', $function->returnTypesFromSignature) . ' but stubs has return type ' .
            implode('|', $stubFunction->returnTypesFromSignature) . ' in signature and attribute has types ' .
            implode('|', $typesFromAttribute));
    }

    #[DataProviderExternal(ReflectionParametersProvider::class, 'functionParametersWithTypeProvider')]
    public function testFunctionsParametersTypeHints(?string $functionId, ?string $parameterName)
    {
        if (!$functionId && !$parameterName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionParameter = ReflectionStubsSingleton::getReflectionStubs()->getFunction($functionId, fromReflection: true)->getParameter($parameterName);
        $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getFunction($functionId);
        /** @var PHPParameter $stubParameter */
        $stubParameter = current(array_filter($phpstormFunction->parameters, fn (PHPParameter $stubParameter) => $stubParameter->indexInSignature === $reflectionParameter->indexInSignature));
        $testCondition = self::typeHintsMatchReflection($reflectionParameter, $stubParameter, $functionId);
        self::assertTrue($testCondition->result || empty($reflectionParameter->typesFromSignature), $testCondition->message);
        if (!$reflectionParameter->hasMutedProblem(StubProblemType::PARAMETER_REFERENCE)) {
            self::assertEquals(
                $reflectionParameter->is_passed_by_ref,
                $stubParameter->is_passed_by_ref,
                "Invalid pass by ref $functionId: \$$reflectionParameter->name "
            );
        }
        self::assertEquals(
            $reflectionParameter->is_vararg,
            $stubParameter->is_vararg,
            "Invalid vararg $functionId: \$$reflectionParameter->name "
        );
    }

    #[DataProviderExternal(ReflectionMethodsProvider::class, 'classMethodsWithoutTentitiveReturnTypeProvider')]
    public function testClassMethodsReturnTypeHints(?string $classId, ?string $methodName)
    {
        if (!$classId && !$methodName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionMethod = ReflectionStubsSingleton::getReflectionStubs()->getClass($classId, fromReflection: true)->getMethod($methodName, fromReflection: true);
        $class = PhpStormStubsSingleton::getPhpStormStubs()->getClass($classId);
        $stubMethod = $class->getMethod($methodName);
        $unifiedStubsReturnTypes = [];
        $unifiedStubsAttributesReturnTypes = [];
        $unifiedReflectionReturnTypes = [];
        self::convertNullableTypesToUnion($reflectionMethod->returnTypesFromSignature, $unifiedReflectionReturnTypes);
        if (!empty($stubMethod->returnTypesFromSignature)) {
            self::convertNullableTypesToUnion($stubMethod->returnTypesFromSignature, $unifiedStubsReturnTypes);
        } else {
            foreach ($stubMethod->returnTypesFromAttribute as $languageVersion => $listOfTypes) {
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
        self::assertTrue($testCondition, "Method $classId::$methodName has invalid return type.
        Reflection method has return type " . implode('|', $reflectionMethod->returnTypesFromSignature) . ' but stubs has return type ' .
            implode('|', $stubMethod->returnTypesFromSignature) . ' in signature and attribute has types ' .
            implode('|', $typesFromAttribute));
    }

    #[DataProviderExternal(ReflectionMethodsProvider::class, 'interfaceMethodsWithoutTentitiveReturnTypeProvider')]
    public function testInterfaceMethodsReturnTypeHints(?string $classId, ?string $methodName)
    {
        if (!$classId && !$methodName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionMethod = ReflectionStubsSingleton::getReflectionStubs()->getInterface($classId, fromReflection: true)->getMethod($methodName, fromReflection: true);
        $class = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($classId);
        $stubMethod = $class->getMethod($methodName);
        $unifiedStubsReturnTypes = [];
        $unifiedStubsAttributesReturnTypes = [];
        $unifiedReflectionReturnTypes = [];
        self::convertNullableTypesToUnion($reflectionMethod->returnTypesFromSignature, $unifiedReflectionReturnTypes);
        if (!empty($stubMethod->returnTypesFromSignature)) {
            self::convertNullableTypesToUnion($stubMethod->returnTypesFromSignature, $unifiedStubsReturnTypes);
        } else {
            foreach ($stubMethod->returnTypesFromAttribute as $languageVersion => $listOfTypes) {
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
        self::assertTrue($testCondition, "Method $classId::$methodName has invalid return type.
        Reflection method has return type " . implode('|', $reflectionMethod->returnTypesFromSignature) . ' but stubs has return type ' .
            implode('|', $stubMethod->returnTypesFromSignature) . ' in signature and attribute has types ' .
            implode('|', $typesFromAttribute));
    }

    #[DataProviderExternal(ReflectionMethodsProvider::class, 'enumMethodsWithoutTentitiveReturnTypeProvider')]
    public function testEnumMethodsReturnTypeHints(?string $classId, ?string $methodName)
    {
        if (!$classId && !$methodName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionMethod = ReflectionStubsSingleton::getReflectionStubs()->getEnum($classId, fromReflection: true)->getMethod($methodName, fromReflection: true);
        $class = PhpStormStubsSingleton::getPhpStormStubs()->getEnum($classId);
        $stubMethod = $class->getMethod($methodName);
        $unifiedStubsReturnTypes = [];
        $unifiedStubsAttributesReturnTypes = [];
        $unifiedReflectionReturnTypes = [];
        self::convertNullableTypesToUnion($reflectionMethod->returnTypesFromSignature, $unifiedReflectionReturnTypes);
        if (!empty($stubMethod->returnTypesFromSignature)) {
            self::convertNullableTypesToUnion($stubMethod->returnTypesFromSignature, $unifiedStubsReturnTypes);
        } else {
            foreach ($stubMethod->returnTypesFromAttribute as $languageVersion => $listOfTypes) {
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
        self::assertTrue($testCondition, "Method $classId::$methodName has invalid return type.
        Reflection method has return type " . implode('|', $reflectionMethod->returnTypesFromSignature) . ' but stubs has return type ' .
            implode('|', $stubMethod->returnTypesFromSignature) . ' in signature and attribute has types ' .
            implode('|', $typesFromAttribute));
    }

    #[DataProviderExternal(ReflectionParametersProvider::class, 'classMethodParametersWithTypeHintProvider')]
    public function testClassMethodsParametersTypeHints(?string $classId, ?string $methodName, ?string $parameterName)
    {
        if (!$classId && !$methodName && !$parameterName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionParameter = ReflectionStubsSingleton::getReflectionStubs()->getClass($classId, fromReflection: true)->getMethod($methodName, fromReflection: true)->getParameter($parameterName);
        $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getClass($classId)->getMethod($methodName);
        /** @var PHPParameter $stubParameter */
        $stubParameter = current(array_filter(
            $stubMethod->parameters,
            fn (PHPParameter $stubParameter) => $stubParameter->name === $reflectionParameter->name
        ));
        self::assertNotFalse($stubParameter, "Parameter $$reflectionParameter->name not found at 
        $classId::$stubMethod->name(" .
            StubsParameterNamesTest::printParameters($stubMethod->parameters) . ')');
        $testCondition = self::typeHintsMatchReflection($reflectionParameter, $stubParameter, $methodName);
        self::assertTrue($testCondition->result, $testCondition->message);
        if (!$reflectionParameter->hasMutedProblem(StubProblemType::PARAMETER_REFERENCE)) {
            self::assertEquals(
                $reflectionParameter->is_passed_by_ref,
                $stubParameter->is_passed_by_ref,
                "Invalid pass by ref $classId::$methodName: \$$reflectionParameter->name "
            );
        }
        self::assertEquals(
            $reflectionParameter->is_vararg,
            $stubParameter->is_vararg,
            "Invalid pass by ref $classId::$methodName: \$$reflectionParameter->name "
        );
    }

    #[DataProviderExternal(ReflectionParametersProvider::class, 'interfaceMethodParametersWithTypeHintProvider')]
    public function testInterfaceMethodsParametersTypeHints(?string $classId, ?string $methodName, ?string $parameterName)
    {
        if (!$classId && !$methodName && !$parameterName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionParameter = ReflectionStubsSingleton::getReflectionStubs()->getInterface($classId, fromReflection: true)->getMethod($methodName, fromReflection: true)->getParameter($parameterName);
        $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($classId)->getMethod($methodName);
        /** @var PHPParameter $stubParameter */
        $stubParameter = current(array_filter(
            $stubMethod->parameters,
            fn (PHPParameter $stubParameter) => $stubParameter->name === $reflectionParameter->name
        ));
        self::assertNotFalse($stubParameter, "Parameter $$reflectionParameter->name not found at 
        $classId::$stubMethod->name(" .
            StubsParameterNamesTest::printParameters($stubMethod->parameters) . ')');
        $testCondition = self::typeHintsMatchReflection($reflectionParameter, $stubParameter, $methodName);
        self::assertTrue($testCondition->result, $testCondition->message);
        if (!$reflectionParameter->hasMutedProblem(StubProblemType::PARAMETER_REFERENCE)) {
            self::assertEquals(
                $reflectionParameter->is_passed_by_ref,
                $stubParameter->is_passed_by_ref,
                "Invalid pass by ref $classId::$methodName: \$$reflectionParameter->name "
            );
        }
        self::assertEquals(
            $reflectionParameter->is_vararg,
            $stubParameter->is_vararg,
            "Invalid pass by ref $classId::$methodName: \$$reflectionParameter->name "
        );
    }

    #[DataProviderExternal(ReflectionParametersProvider::class, 'enumMethodParametersWithTypeHintProvider')]
    public function testEnumMethodsParametersTypeHints(?string $classId, ?string $methodName, ?string $parameterName)
    {
        if (!$classId && !$methodName && !$parameterName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionParameter = ReflectionStubsSingleton::getReflectionStubs()->getEnum($classId, fromReflection: true)->getMethod($methodName, fromReflection: true)->getParameter($parameterName);
        $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getEnum($classId)->getMethod($methodName);
        /** @var PHPParameter $stubParameter */
        $stubParameter = current(array_filter(
            $stubMethod->parameters,
            fn (PHPParameter $stubParameter) => $stubParameter->name === $reflectionParameter->name
        ));
        self::assertNotFalse($stubParameter, "Parameter $$reflectionParameter->name not found at 
        $classId::$stubMethod->name(" .
            StubsParameterNamesTest::printParameters($stubMethod->parameters) . ')');
        $testCondition = self::typeHintsMatchReflection($reflectionParameter, $stubParameter, $methodName);
        self::assertTrue($testCondition->result, $testCondition->message);
        if (!$reflectionParameter->hasMutedProblem(StubProblemType::PARAMETER_REFERENCE)) {
            self::assertEquals(
                $reflectionParameter->is_passed_by_ref,
                $stubParameter->is_passed_by_ref,
                "Invalid pass by ref $classId::$methodName: \$$reflectionParameter->name "
            );
        }
        self::assertEquals(
            $reflectionParameter->is_vararg,
            $stubParameter->is_vararg,
            "Invalid pass by ref $classId::$methodName: \$$reflectionParameter->name "
        );
    }

    #[DataProviderExternal(StubsParametersProvider::class, 'classMethodsParametersForAllowedScalarTypeHintTestsProvider')]
    public function testClassMethodScalarTypeHintsInParametersMatchReflection(?string $classHash, ?string $methodHash, ?string $parameterName)
    {
        if (!$classHash && !$methodHash && !$parameterName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $stubsClass = PhpStormStubsSingleton::getPhpStormStubs()->getClassByHash($classHash);
        $stubsMethod = $stubsClass->getMethodByHash($methodHash);
        $stubParameter = $stubsMethod->getParameter($parameterName);
        $reflectionMethod = ReflectionStubsSingleton::getReflectionStubs()->getClass($stubsClass->id, fromReflection: true)->getMethod($stubsMethod->name, fromReflection: true);
        $reflectionParameters = array_filter($reflectionMethod->parameters, fn (PHPParameter $parameter) => $parameter->name === $stubParameter->name);
        $reflectionParameter = array_pop($reflectionParameters);
        if (!$reflectionParameter) {
            self::fail("Parameter with name $parameterName not found in reflection");
        } else {
            $testCondition = self::typeHintsMatchReflection($reflectionParameter, $stubParameter, $stubsMethod->name);
            self::assertTrue($testCondition->result, $testCondition->message);
        }
    }

    #[DataProviderExternal(StubsParametersProvider::class, 'interfaceMethodsParametersForAllowedScalarTypeHintTestsProvider')]
    public function testInterfaceMethodScalarTypeHintsInParametersMatchReflection(?string $classHash, ?string $methodHash, ?string $parameterName)
    {
        if (!$classHash && !$methodHash && !$parameterName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $stubsInterface = PhpStormStubsSingleton::getPhpStormStubs()->getInterfaceByHash($classHash);
        $stubsMethod = $stubsInterface->getMethodByHash($methodHash);
        $stubParameter = $stubsMethod->getParameter($parameterName);
        $reflectionMethod = ReflectionStubsSingleton::getReflectionStubs()->getInterface($stubsInterface->id, fromReflection: true)->getMethod($stubsMethod->name, fromReflection: true);
        $reflectionParameters = array_filter($reflectionMethod->parameters, fn (PHPParameter $parameter) => $parameter->name === $stubParameter->name);
        $reflectionParameter = array_pop($reflectionParameters);
        $testCondition = self::typeHintsMatchReflection($reflectionParameter, $stubParameter, $stubsMethod->name);
        self::assertTrue($testCondition->result, $testCondition->message);
    }

    #[DataProviderExternal(StubsParametersProvider::class, 'enumMethodsParametersForAllowedScalarTypeHintTestsProvider')]
    public function testEnumMethodScalarTypeHintsInParametersMatchReflection(?string $classHash, ?string $methodHash, ?string $parameterName)
    {
        if (!$classHash && !$methodHash && !$parameterName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $stubsEnum = PhpStormStubsSingleton::getPhpStormStubs()->getEnumByHash($classHash);
        $stubsMethod = $stubsEnum->getMethodByHash($methodHash);
        $stubParameter = $stubsMethod->getParameter($parameterName);
        $reflectionMethod = ReflectionStubsSingleton::getReflectionStubs()->getEnum($stubsEnum->id, fromReflection: true)->getMethod($stubsMethod->name, fromReflection: true);
        $reflectionParameters = array_filter($reflectionMethod->parameters, fn (PHPParameter $parameter) => $parameter->name === $stubParameter->name);
        $reflectionParameter = array_pop($reflectionParameters);
        $testCondition = self::typeHintsMatchReflection($reflectionParameter, $stubParameter, $stubsMethod->name);
        self::assertTrue($testCondition->result, $testCondition->message);
    }

    #[DataProviderExternal(StubsParametersProvider::class, 'classMethodsParametersForAllowedNullableTypeHintTestsProvider')]
    public function testClassMethodNullableTypeHintsInParametersMatchReflection(?string $classHash, ?string $methodHash, ?string $parameterName)
    {
        if (!$classHash && !$methodHash && !$parameterName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $stubsClass = PhpStormStubsSingleton::getPhpStormStubs()->getClassByHash($classHash);
        $stubsMethod = $stubsClass->getMethodByHash($methodHash);
        $stubParameter = $stubsMethod->getParameter($parameterName);
        $reflectionClass = ReflectionStubsSingleton::getReflectionStubs()->getClass($stubsClass->id, fromReflection: true);
        $reflectionMethod = $reflectionClass->getMethod($stubsMethod->name);
        $reflectionParameters = array_filter($reflectionMethod->parameters, fn (PHPParameter $parameter) => $parameter->name === $stubParameter->name);
        $reflectionParameter = array_pop($reflectionParameters);
        $testCondition = self::typeHintsMatchReflection($reflectionParameter, $stubParameter, $stubsMethod->name);
        self::assertTrue($testCondition->result, $testCondition->message);
    }

    #[DataProviderExternal(StubsParametersProvider::class, 'interfaceMethodsParametersForAllowedNullableTypeHintTestsProvider')]
    public function testInterfaceMethodNullableTypeHintsInParametersMatchReflection(?string $classHash, ?string $methodHash, ?string $parameterName)
    {
        if (!$classHash && !$methodHash && !$parameterName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $stubsInterface = PhpStormStubsSingleton::getPhpStormStubs()->getInterfaceByHash($classHash);
        $stubsMethod = $stubsInterface->getMethodByHash($methodHash);
        $stubParameter = $stubsMethod->getParameter($parameterName);
        $reflectionMethod = ReflectionStubsSingleton::getReflectionStubs()->getInterface($stubsInterface->id, fromReflection: true)->getMethod($stubsMethod->name, fromReflection: true);
        $reflectionParameters = array_filter($reflectionMethod->parameters, fn (PHPParameter $parameter) => $parameter->name === $stubParameter->name);
        $reflectionParameter = array_pop($reflectionParameters);
        $testCondition = self::typeHintsMatchReflection($reflectionParameter, $stubParameter, $stubsMethod->name);
        self::assertTrue($testCondition->result, $testCondition->message);
    }

    #[DataProviderExternal(StubsParametersProvider::class, 'enumMethodsParametersForAllowedNullableTypeHintTestsProvider')]
    public function testEnumMethodNullableTypeHintsInParametersMatchReflection(?string $classHash, ?string $methodHash, ?string $parameterName)
    {
        if (!$classHash && !$methodHash && !$parameterName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $stubsEnum = PhpStormStubsSingleton::getPhpStormStubs()->getEnumByHash($classHash);
        $stubsMethod = $stubsEnum->getMethodByHash($methodHash);
        $stubParameter = $stubsMethod->getParameter($parameterName);
        $reflectionMethod = ReflectionStubsSingleton::getReflectionStubs()->getEnum($stubsEnum->id, fromReflection: true)->getMethod($stubsMethod->name, fromReflection: true);
        $reflectionParameters = array_filter($reflectionMethod->parameters, fn (PHPParameter $parameter) => $parameter->name === $stubParameter->name);
        $reflectionParameter = array_pop($reflectionParameters);
        $testCondition = self::typeHintsMatchReflection($reflectionParameter, $stubParameter, $stubsMethod->name);
        self::assertTrue($testCondition->result, $testCondition->message);
    }

    #[DataProviderExternal(StubsParametersProvider::class, 'classMethodsParametersForAllowedUnionTypeHintTestsProvider')]
    public function testClassMethodUnionTypeHintsInParametersMatchReflection(?string $classHash, ?string $methodHash, ?string $parameterName)
    {
        if (!$classHash && !$methodHash && !$parameterName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $stubsClass = PhpStormStubsSingleton::getPhpStormStubs()->getClassByHash($classHash);
        $stubsMethod = $stubsClass->getMethodByHash($methodHash);
        $stubParameter = $stubsMethod->getParameter($parameterName);
        $reflectionMethod = ReflectionStubsSingleton::getReflectionStubs()->getClass($stubsClass->id, fromReflection: true)->getMethod($stubsMethod->name, fromReflection: true);
        $reflectionParameters = array_filter($reflectionMethod->parameters, fn (PHPParameter $parameter) => $parameter->name === $stubParameter->name);
        $reflectionParameter = array_pop($reflectionParameters);
        $testCondition = self::typeHintsMatchReflection($reflectionParameter, $stubParameter, $stubsMethod->name);
        self::assertTrue($testCondition->result, $testCondition->message);
    }

    #[DataProviderExternal(StubsParametersProvider::class, 'interfaceMethodsParametersForAllowedUnionTypeHintTestsProvider')]
    public function testInterfaceMethodUnionTypeHintsInParametersMatchReflection(?string $classHash, ?string $methodHash, ?string $parameterName)
    {
        if (!$classHash && !$methodHash && !$parameterName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $stubsInterface = PhpStormStubsSingleton::getPhpStormStubs()->getInterfaceByHash($classHash);
        $stubsMethod = $stubsInterface->getMethodByHash($methodHash);
        $stubParameter = $stubsMethod->getParameter($parameterName);
        $reflectionMethod = ReflectionStubsSingleton::getReflectionStubs()->getInterface($stubsInterface->id, fromReflection: true)->getMethod($stubsMethod->name, fromReflection: true);
        $reflectionParameters = array_filter($reflectionMethod->parameters, fn (PHPParameter $parameter) => $parameter->name === $stubParameter->name);
        $reflectionParameter = array_pop($reflectionParameters);
        $testCondition = self::typeHintsMatchReflection($reflectionParameter, $stubParameter, $stubsMethod->name);
        self::assertTrue($testCondition->result, $testCondition->message);
    }

    #[DataProviderExternal(StubsParametersProvider::class, 'enumMethodsParametersForAllowedUnionTypeHintTestsProvider')]
    public function testEnumMethodUnionTypeHintsInParametersMatchReflection(?string $classHash, ?string $methodHash, ?string $parameterName)
    {
        if (!$classHash && !$methodHash && !$parameterName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $stubsEnum = PhpStormStubsSingleton::getPhpStormStubs()->getEnumByHash($classHash);
        $stubsMethod = $stubsEnum->getMethodByHash($methodHash);
        $stubParameter = $stubsMethod->getParameter($parameterName);
        $reflectionMethod = ReflectionStubsSingleton::getReflectionStubs()->getEnum($stubsEnum->id, fromReflection: true)->getMethod($stubsMethod->name, fromReflection: true);
        $reflectionParameters = array_filter($reflectionMethod->parameters, fn (PHPParameter $parameter) => $parameter->name === $stubParameter->name);
        $reflectionParameter = array_pop($reflectionParameters);
        $testCondition = self::typeHintsMatchReflection($reflectionParameter, $stubParameter, $stubsMethod->name);
        self::assertTrue($testCondition->result, $testCondition->message);
    }

    #[DataProviderExternal(StubMethodsProvider::class, 'allFunctionWithReturnTypeHintsProvider')]
    public static function testSignatureTypeHintsConformPhpDocInFunctions(string $functionId)
    {
        $function = PhpStormStubsSingleton::getPhpStormStubs()->getFunction($functionId, shouldSuitCurrentPhpVersion: false);
        $unifiedPhpDocTypes = CommonUtils::array_flat_map(
            array_map(
                self::getTypePossibleNamespace(...),
                $function->returnTypesFromPhpDoc,
            ),
            fn (string $type) => self::handleTemplateTypes($type, $function->templateTypes),
        );
        $unifiedSignatureTypes = array_map(self::getTypePossibleNamespace(...), $function->returnTypesFromSignature);
        if (count($unifiedSignatureTypes) === 1) {
            $type = array_pop($unifiedSignatureTypes);
            if (str_contains($type, '?')) {
                $unifiedSignatureTypes[] = 'null';
            }
            $typeParts = explode('\\', ltrim($type, '?'));
            $typeName = end($typeParts);
            $unifiedSignatureTypes[] = $typeName;
        }
        $typesIntersection = array_intersect($unifiedSignatureTypes, $unifiedPhpDocTypes);
        self::assertSameSize(
            $unifiedSignatureTypes,
            $typesIntersection,
            'Function ' . "$functionId has mismatch in phpdoc return type and signature return type. 
            Signature has " . implode('|', $unifiedSignatureTypes) . " but phpdoc has " . implode('|', $unifiedPhpDocTypes)
        );
    }

    #[DataProviderExternal(StubMethodsProvider::class, 'allClassesMethodsWithReturnTypeHintsProvider')]
    public static function testClassesMethodsSignatureTypeHintsConformPhpDocInMethods(string $classId, string $functionId)
    {
        $stubsClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($classId, shouldSuitCurrentPhpVersion: false);
        $classTemplateTypes = $stubsClass->templateTypes;
        $function = $stubsClass->getMethod($functionId, false);
        $unifiedPhpDocTypes = array_map(
            fn (string $type) => ltrim($type, '\\'),
            CommonUtils::array_flat_map(
                CommonUtils::array_flat_map(
                    array_map(
                        self::getTypePossibleNamespace(...),
                        $function->returnTypesFromPhpDoc,
                    ),
                    fn (string $type) => self::handleTemplateTypes($type, $function->templateTypes),
                ),
                fn (string $type) => self::handleTemplateTypes($type, $classTemplateTypes),
            )
        );
        $unifiedSignatureTypes = array_map(self::getTypePossibleNamespace(...), $function->returnTypesFromSignature);
        if (count($unifiedSignatureTypes) === 1) {
            $type = array_pop($unifiedSignatureTypes);
            if (str_contains($type, '?')) {
                $unifiedSignatureTypes[] = 'null';
            }
            $typeParts = explode('\\', ltrim($type, '?'));
            $typeName = end($typeParts);
            $unifiedSignatureTypes[] = $typeName;
        }
        $typesIntersection = array_intersect($unifiedSignatureTypes, $unifiedPhpDocTypes);
        self::assertSameSize(
            $unifiedSignatureTypes,
            $typesIntersection,
            "Method $classId::$functionId has mismatch in phpdoc return type and signature return type. 
            Signature has " . implode('|', $unifiedSignatureTypes) . " but phpdoc has " . implode('|', $unifiedPhpDocTypes)
        );
    }

    #[DataProviderExternal(StubMethodsProvider::class, 'allInterfacesMethodsWithReturnTypeHintsProvider')]
    public static function testInterfacesMethodsSignatureTypeHintsConformPhpDocInMethods(string $classId, string $functionId)
    {
        $function = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($classId, shouldSuitCurrentPhpVersion: false)->getMethod($functionId, false);
        $unifiedPhpDocTypes = CommonUtils::array_flat_map(
            array_map(
                self::getTypePossibleNamespace(...),
                $function->returnTypesFromPhpDoc,
            ),
            fn (string $type) => self::handleTemplateTypes($type, $function->templateTypes),
        );
        $unifiedSignatureTypes = array_map(self::getTypePossibleNamespace(...), $function->returnTypesFromSignature);
        if (count($unifiedSignatureTypes) === 1) {
            $type = array_pop($unifiedSignatureTypes);
            if (str_contains($type, '?')) {
                $unifiedSignatureTypes[] = 'null';
            }
            $typeParts = explode('\\', ltrim($type, '?'));
            $typeName = end($typeParts);
            $unifiedSignatureTypes[] = $typeName;
        }
        $typesIntersection = array_intersect($unifiedSignatureTypes, $unifiedPhpDocTypes);
        self::assertSameSize(
            $unifiedSignatureTypes,
            $typesIntersection,
            "Method $classId::$functionId has mismatch in phpdoc return type and signature return type. 
            Signature has " . implode('|', $unifiedSignatureTypes) . " but phpdoc has " . implode('|', $unifiedPhpDocTypes)
        );
    }

    #[DataProviderExternal(StubMethodsProvider::class, 'allEnumsMethodsWithReturnTypeHintsProvider')]
    public function testEnumsMethodsSignatureTypeHintsConformPhpDocInMethods(?string $classId, ?string $functionId)
    {
        if (!$classId && !$functionId) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $function = PhpStormStubsSingleton::getPhpStormStubs()->getEnum($classId)->getMethod($functionId);
        $unifiedPhpDocTypes = CommonUtils::array_flat_map(
            array_map(
                self::getTypePossibleNamespace(...),
                $function->returnTypesFromPhpDoc,
            ),
            fn (string $type) => self::handleTemplateTypes($type, $function->templateTypes),
        );
        $unifiedSignatureTypes = array_map(self::getTypePossibleNamespace(...), $function->returnTypesFromSignature);
        if (count($unifiedSignatureTypes) === 1) {
            $type = array_pop($unifiedSignatureTypes);
            if (str_contains($type, '?')) {
                $unifiedSignatureTypes[] = 'null';
            }
            $typeParts = explode('\\', ltrim($type, '?'));
            $typeName = end($typeParts);
            $unifiedSignatureTypes[] = $typeName;
        }
        $typesIntersection = array_intersect($unifiedSignatureTypes, $unifiedPhpDocTypes);
        self::assertSameSize(
            $unifiedSignatureTypes,
            $typesIntersection,
            "Method $classId::$functionId has mismatch in phpdoc return type and signature return type. 
            Signature has " . implode('|', $unifiedSignatureTypes) . " but phpdoc has " . implode('|', $unifiedPhpDocTypes)
        );
    }

    /**
     * @return object{result:bool, message:string}
     */
    private static function typeHintsMatchReflection(?PHPParameter $parameter, ?PHPParameter $stubParameter, string $functionName): stdClass
    {
        if (!$parameter || !$stubParameter) {
            $return = new stdClass();
            $return->result = false;
            $return->message = match (null) {
                $parameter => "Parameter not found in reflection function '$functionName'",
                $stubParameter => "Parameter not found in stub function '$functionName'"
            };
            return $return;
        }
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
        $testCondition = AbstractBaseStubsTestCase::isReflectionTypesMatchSignature($unifiedReflectionParameterTypes, $unifiedStubsParameterTypes);
        if (!$testCondition) {
            if (!empty($unifiedStubsAttributesParameterTypes)) {
                $typesFromAttribute = !empty($unifiedStubsAttributesParameterTypes[getenv('PHP_VERSION')]) ?
                    $unifiedStubsAttributesParameterTypes[getenv('PHP_VERSION')] :
                    $unifiedStubsAttributesParameterTypes['default'];
                $testCondition = AbstractBaseStubsTestCase::isReflectionTypesExistInAttributes($unifiedReflectionParameterTypes, $typesFromAttribute);
            }
        }
        $return = new stdClass();
        $return->result = $testCondition;
        $return->message = "Type mismatch $functionName: \$$parameter->name \n
        Reflection parameter $parameter->name with index $parameter->indexInSignature has type '" . implode('|', $unifiedReflectionParameterTypes) .
            "' but stub parameter $stubParameter->name with index $stubParameter->indexInSignature has type '" . implode('|', $unifiedStubsParameterTypes) . "' in signature and " .
            implode('|', $typesFromAttribute) . ' in attribute';
        return $return;
    }

    private static function getTypePossibleNamespace(string $type): string
    {
        $typeParts = explode('\\', $type);
        return end($typeParts);
    }

    private static function replaceArrayNotations(string $type): string
    {
        /* Assume T[] or array shape array{0: T1, 1: T2} */
        if (str_contains($type, '[') || str_contains($type, '{')) {
            return 'array';
        }
        if (str_starts_with($type, 'list')) {
            return 'array';
        }
        /* Assume template type T1<T2> where we don't care about the "inner" type */
        if (str_contains($type, '<')) {
            $pos = strpos($type, '<');
            return substr($type, 0, $pos);
        }
        return $type;
    }

    /***
     * @param list<Template> $templates
     * @return list<string>
     */
    private static function handleTemplateTypes(string $typeName, array $templates): array
    {
        foreach ($templates as $templateType) {
            if ($typeName === $templateType->getTemplateName()) {
                if ($templateType->getBound()) {
                    $typeName = $templateType->getBound()?->__toString();
                    /* A bounded type might be a union type */
                    if (str_contains($typeName, '|')) {
                        return array_map(
                            self::replaceArrayNotations(...),
                            explode('|', $typeName)
                        );
                    }
                } else {
                    $typeName = ['object'];
                }
            }
        }

        return [self::replaceArrayNotations($typeName)];
    }
}
