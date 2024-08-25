<?php
declare(strict_types=1);

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use StubTests\Model\PHPParameter;
use StubTests\TestData\Providers\PhpStormStubsSingleton;
use StubTests\TestData\Providers\Reflection\ReflectionConstantsProvider;
use StubTests\TestData\Providers\Reflection\ReflectionParametersProvider;
use StubTests\TestData\Providers\ReflectionStubsSingleton;

class StubsConstantsAndParametersValuesTest extends AbstractBaseStubsTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        PhpStormStubsSingleton::getPhpStormStubs();
        ReflectionStubsSingleton::getReflectionStubs();
    }

    /*#[DataProviderExternal(ReflectionConstantsProvider::class, 'constantValuesProvider')]
    public function testConstantsValues($constant): void
    {
        if (!$constant) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $constantName = $constant->name;
        $constantValue = $constant->value;
        $stubConstant = PhpStormStubsSingleton::getPhpStormStubs()->getConstant($constantName);
        self::assertEquals(
            strval($constantValue),
            strval($stubConstant->value),
            "Constant value mismatch: const $constantName \n
            Expected value: $constantValue but was $stubConstant->value"
        );
    }*/

    #[DataProviderExternal(ReflectionParametersProvider::class, 'functionOptionalParametersWithDefaultValueProvider')]
    public function testFunctionsDefaultParametersValue(?string $functionId, ?string $parameterName)
    {
        if (!$functionId && !$parameterName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionParameter = ReflectionStubsSingleton::getReflectionStubs()->getFunction($functionId, fromReflection: true)->getParameter($parameterName);
        $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getFunction($functionId);
        $stubParameters = array_filter($phpstormFunction->parameters, fn (PHPParameter $stubParameter) => $stubParameter->indexInSignature === $reflectionParameter->indexInSignature);
        /** @var PHPParameter $stubOptionalParameter */
        $stubOptionalParameter = array_pop($stubParameters);
        $reflectionValue = AbstractBaseStubsTestCase::getStringRepresentationOfDefaultParameterValue($reflectionParameter->defaultValue);
        $stubValue = AbstractBaseStubsTestCase::getStringRepresentationOfDefaultParameterValue($stubOptionalParameter->defaultValue);
        self::assertEquals(
            $reflectionValue,
            $stubValue,
            sprintf(
                'Reflection function %s has optional parameter %s with default value "%s" but stub parameter has value "%s"',
                $functionId,
                $reflectionParameter->name,
                $reflectionValue,
                $stubValue
            )
        );
    }

    #[DataProviderExternal(ReflectionParametersProvider::class, 'functionOptionalParametersWithoutDefaultValueProvider')]
    public function testFunctionsWithoutOptionalDefaultParametersValue(?string $functionId, ?string $parameterName)
    {
        if (!$functionId && !$parameterName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionParameter = ReflectionStubsSingleton::getReflectionStubs()->getFunction($functionId, fromReflection: true)->getParameter($parameterName);
        $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getFunction($functionId);
        $stubParameters = array_filter($phpstormFunction->parameters, fn (PHPParameter $stubParameter) => $stubParameter->indexInSignature === $reflectionParameter->indexInSignature);
        /** @var PHPParameter $stubOptionalParameter */
        $stubOptionalParameter = array_pop($stubParameters);

        self::assertEmpty(
            $stubOptionalParameter->defaultValue,
            sprintf(
                'Stub function "%s" has a parameter "%s" which expected to have no default value but it has',
                $functionId,
                $stubOptionalParameter->name
            )
        );
        self::assertTrue(
            $stubOptionalParameter->markedOptionalInPhpDoc,
            sprintf(
                'Stub function "%s" has a parameter "%s" which expected to be marked as [optional] at PHPDoc but it is not',
                $functionId,
                $stubOptionalParameter->name
            )
        );
    }

    #[DataProviderExternal(ReflectionParametersProvider::class, 'classMethodOptionalParametersWithDefaultValueProvider')]
    public function testClassMethodsDefaultParametersValue(?string $classId, ?string $methodName, ?string $parameterName)
    {
        if (!$classId && !$methodName && !$parameterName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionParameter = ReflectionStubsSingleton::getReflectionStubs()->getClass($classId, fromReflection: true)->getMethod($methodName, fromReflection: true)->getParameter($parameterName);
        $stubClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($classId);
        $phpstormFunction = $stubClass->getMethod($methodName);
        $stubParameters = array_filter($phpstormFunction->parameters, fn (PHPParameter $stubParameter) => $stubParameter->indexInSignature === $reflectionParameter->indexInSignature);
        /** @var PHPParameter $stubOptionalParameter */
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

    #[DataProviderExternal(ReflectionParametersProvider::class, 'interfaceMethodOptionalParametersWithDefaultValueProvider')]
    public function testInterfaceMethodsDefaultParametersValue(?string $classId, ?string $methodName, ?string $parameterName)
    {
        if (!$classId && !$methodName && !$parameterName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionParameter = ReflectionStubsSingleton::getReflectionStubs()->getInterface($classId, fromReflection: true)->getMethod($methodName, fromReflection: true)->getParameter($parameterName);
        $stubClass = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($classId);
        $phpstormFunction = $stubClass->getMethod($methodName);
        $stubParameters = array_filter($phpstormFunction->parameters, fn (PHPParameter $stubParameter) => $stubParameter->indexInSignature === $reflectionParameter->indexInSignature);
        /** @var PHPParameter $stubOptionalParameter */
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

    #[DataProviderExternal(ReflectionParametersProvider::class, 'classMethodOptionalParametersWithoutDefaultValueProvider')]
    public function testClassMethodsWithoutOptionalDefaultParametersValue(?string $classId, ?string $methodName, ?string $parameterName)
    {
        if (!$classId && !$methodName && !$parameterName) {
            self::markTestSkipped($this->emptyDataSetMessage);
        }
        $reflectionParameter = ReflectionStubsSingleton::getReflectionStubs()->getClass($classId, fromReflection: true)->getMethod($methodName, fromReflection: true)->getParameter($parameterName);
        $stubClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($classId);
        $phpstormFunction = $stubClass->getMethod($methodName);
        $stubParameters = array_filter($phpstormFunction->parameters, fn (PHPParameter $stubParameter) => $stubParameter->indexInSignature === $reflectionParameter->indexInSignature);
        /** @var PHPParameter $stubOptionalParameter */
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

    #[DataProviderExternal(ReflectionParametersProvider::class, 'interfaceMethodOptionalParametersWithoutDefaultValueProvider')]
    public function testInterfaceMethodsWithoutOptionalDefaultParametersValue(?string $classId, ?string $methodName, ?string $parameterName)
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
