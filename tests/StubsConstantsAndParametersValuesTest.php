<?php
declare(strict_types=1);

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use RuntimeException;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPConst;
use StubTests\Model\PHPEnum;
use StubTests\Model\PHPFunction;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Model\PHPParameter;
use StubTests\TestData\Providers\PhpStormStubsSingleton;
use StubTests\TestData\Providers\Reflection\ReflectionConstantsProvider;
use StubTests\TestData\Providers\Reflection\ReflectionParametersProvider;

class StubsConstantsAndParametersValuesTest extends AbstractBaseStubsTestCase
{
    /*#[DataProviderExternal(ReflectionConstantsProvider::class, 'constantValuesProvider')]
    public function testConstantsValues(PHPConst $constant): void
    {
        $constantName = $constant->name;
        $constantValue = $constant->value;
        $stubConstant = PhpStormStubsSingleton::getPhpStormStubs()->getConstant($constantName);
        self::assertEquals(
            $constantValue,
            $stubConstant->value,
            "Constant value mismatch: const $constantName \n
            Expected value: $constantValue but was $stubConstant->value"
        );
    }*/

    /**
     * @throws RuntimeException
     */
    #[DataProviderExternal(ReflectionParametersProvider::class, 'functionOptionalParametersWithDefaultValueProvider')]
    public function testFunctionsDefaultParametersValue(PHPFunction $function, PHPParameter $parameter)
    {
        $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getFunction($function->name);
        $stubParameters = array_filter($phpstormFunction->parameters, fn (PHPParameter $stubParameter) => $stubParameter->indexInSignature === $parameter->indexInSignature);
        /** @var PHPParameter $stubOptionalParameter */
        $stubOptionalParameter = array_pop($stubParameters);
        $reflectionValue = AbstractBaseStubsTestCase::getStringRepresentationOfDefaultParameterValue($parameter->defaultValue);
        $stubValue = AbstractBaseStubsTestCase::getStringRepresentationOfDefaultParameterValue($stubOptionalParameter->defaultValue);
        self::assertEquals(
            $reflectionValue,
            $stubValue,
            sprintf(
                'Reflection function %s has optional parameter %s with default value "%s" but stub parameter has value "%s"',
                $function->name,
                $parameter->name,
                $reflectionValue,
                $stubValue
            )
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionParametersProvider::functionOptionalParametersWithoutDefaultValueProvider
     * @throws Exception|RuntimeException
     */
    public function testFunctionsWithoutOptionalDefaultParametersValue(PHPFunction $function, PHPParameter $parameter)
    {
        $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getFunction($function->name);
        $stubParameters = array_filter($phpstormFunction->parameters, fn (PHPParameter $stubParameter) => $stubParameter->indexInSignature === $parameter->indexInSignature);
        /** @var PHPParameter $stubOptionalParameter */
        $stubOptionalParameter = array_pop($stubParameters);

        self::assertTrue(
            empty($stubOptionalParameter->defaultValue),
            sprintf(
                'Stub function "%s" has a parameter "%s" which expected to have no default value but it has',
                $function->name,
                $stubOptionalParameter->name
            )
        );
        self::assertTrue(
            $stubOptionalParameter->markedOptionalInPhpDoc,
            sprintf(
                'Stub function "%s" has a parameter "%s" which expected to be marked as [optional] at PHPDoc but it is not',
                $function->name,
                $stubOptionalParameter->name
            )
        );
    }

    /**
     * @throws RuntimeException
     */
    #[DataProviderExternal(ReflectionParametersProvider::class, 'methodOptionalParametersWithDefaultValueProvider')]
    public function testMethodsDefaultParametersValue(PHPClass|PHPInterface $class, PHPMethod $method, PHPParameter $parameter)
    {
        if ($class instanceof PHPEnum) {
            $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getEnum($class->name)->getMethod($method->name);
        } elseif ($class instanceof PHPClass) {
            $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name)->getMethod($method->name);
        } else {
            $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($class->name)->getMethod($method->name);
        }
        $stubParameters = array_filter($phpstormFunction->parameters, fn (PHPParameter $stubParameter) => $stubParameter->indexInSignature === $parameter->indexInSignature);
        /** @var PHPParameter $stubOptionalParameter */
        $stubOptionalParameter = array_pop($stubParameters);
        $reflectionValue = AbstractBaseStubsTestCase::getStringRepresentationOfDefaultParameterValue($parameter->defaultValue);
        $stubValue = AbstractBaseStubsTestCase::getStringRepresentationOfDefaultParameterValue($stubOptionalParameter->defaultValue, $class);
        self::assertEquals(
            $reflectionValue,
            $stubValue,
            sprintf(
                'Reflection method %s::%s has optional parameter %s with default value %s but stub parameter has value %s',
                $class->name,
                $method->name,
                $parameter->name,
                $reflectionValue,
                $stubValue
            )
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionParametersProvider::methodOptionalParametersWithoutDefaultValueProvider
     * @throws Exception|RuntimeException
     */
    public function testMethodsWithoutOptionalDefaultParametersValue(PHPClass|PHPInterface $class, PHPMethod $method, PHPParameter $parameter)
    {
        if ($class instanceof PHPEnum) {
            $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getEnum($class->name)->getMethod($method->name);
        } elseif ($class instanceof PHPClass) {
            $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name)->getMethod($method->name);
        } else {
            $phpstormFunction = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($class->name)->getMethod($method->name);
        }
        $stubParameters = array_filter($phpstormFunction->parameters, fn (PHPParameter $stubParameter) => $stubParameter->indexInSignature === $parameter->indexInSignature);
        /** @var PHPParameter $stubOptionalParameter */
        $stubOptionalParameter = array_pop($stubParameters);

        self::assertTrue(
            empty($stubOptionalParameter->defaultValue),
            sprintf(
                'Stub method %s::%s has a parameter "%s" which expected to have no default value but it has',
                $class->name,
                $method->name,
                $stubOptionalParameter->name
            )
        );
        self::assertTrue(
            $stubOptionalParameter->markedOptionalInPhpDoc,
            sprintf(
                'Stub method %s::%s has a parameter "%s" which expected to be marked as [optional] at PHPDoc but it is not',
                $class->name,
                $method->name,
                $stubOptionalParameter->name
            )
        );
    }
}
