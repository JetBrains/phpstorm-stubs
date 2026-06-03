<?php

namespace StubTests\Unit\Parsers\Reflection\Wrappers;

use PHPUnit\Framework\TestCase;
use ReflectionParameter;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionParameter;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionType;

class AdaptedReflectionParameterTest extends TestCase
{
    // Basic extraction tests

    public function testItExtractsParameterName()
    {
        $paramMock = $this->getMockBuilder(ReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paramMock->method('getName')->willReturn('testParam');

        $adapted = new AdaptedReflectionParameter($paramMock);

        self::assertEquals('testParam', $adapted->getName());
    }

    public function testItExtractsParameterPosition()
    {
        $paramMock = $this->getMockBuilder(ReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paramMock->method('getPosition')->willReturn(2);

        $adapted = new AdaptedReflectionParameter($paramMock);

        self::assertEquals(2, $adapted->getPosition());
    }

    public function testItExtractsIsOptional()
    {
        $paramMock = $this->getMockBuilder(ReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paramMock->method('isOptional')->willReturn(true);

        $adapted = new AdaptedReflectionParameter($paramMock);

        self::assertTrue($adapted->isOptional());
    }

    public function testItExtractsIsVariadic()
    {
        $paramMock = $this->getMockBuilder(ReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paramMock->method('isVariadic')->willReturn(false);

        $adapted = new AdaptedReflectionParameter($paramMock);

        self::assertFalse($adapted->isVariadic());
    }

    public function testItExtractsIsPassedByReference()
    {
        $paramMock = $this->getMockBuilder(ReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paramMock->method('isPassedByReference')->willReturn(true);

        $adapted = new AdaptedReflectionParameter($paramMock);

        self::assertTrue($adapted->isPassedByReference());
    }

    public function testItExtractsAllowsNull()
    {
        $paramMock = $this->getMockBuilder(ReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paramMock->method('allowsNull')->willReturn(false);

        $adapted = new AdaptedReflectionParameter($paramMock);

        self::assertFalse($adapted->allowsNull());
    }

    public function testItExtractsCanBePassedByValue()
    {
        $paramMock = $this->getMockBuilder(ReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paramMock->method('canBePassedByValue')->willReturn(true);

        $adapted = new AdaptedReflectionParameter($paramMock);

        self::assertTrue($adapted->canBePassedByValue());
    }

    // Complex extraction tests (postExtract)

    public function testItWrapsTypeAsAdaptedReflectionType()
    {
        $typeMock = $this->getMockBuilder(\ReflectionType::class)
            ->disableOriginalConstructor()
            ->getMock();

        $paramMock = $this->getMockBuilder(ReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paramMock->method('hasType')->willReturn(true);
        $paramMock->method('getType')->willReturn($typeMock);

        $adapted = new AdaptedReflectionParameter($paramMock);

        self::assertInstanceOf(AdaptedReflectionType::class, $adapted->getType());
    }

    public function testItHandlesParameterWithoutType()
    {
        $paramMock = $this->getMockBuilder(ReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paramMock->method('hasType')->willReturn(false);

        $adapted = new AdaptedReflectionParameter($paramMock);

        self::assertNull($adapted->getType());
    }

    public function testItExtractsDefaultValueWhenAvailable()
    {
        $paramMock = $this->getMockBuilder(ReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paramMock->method('isDefaultValueAvailable')->willReturn(true);
        $paramMock->method('getDefaultValue')->willReturn('defaultValue');

        $adapted = new AdaptedReflectionParameter($paramMock);

        self::assertEquals('defaultValue', $adapted->getDefaultValue());
    }

    public function testItHandlesDefaultValueNotAvailable()
    {
        $paramMock = $this->getMockBuilder(ReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paramMock->method('isDefaultValueAvailable')->willReturn(false);

        $adapted = new AdaptedReflectionParameter($paramMock);

        self::assertNull($adapted->getDefaultValue());
    }

    public function testItHandlesExceptionWhenAccessingDefaultValue()
    {
        $paramMock = $this->getMockBuilder(ReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paramMock->method('isDefaultValueAvailable')->willReturn(true);
        $paramMock->method('getDefaultValue')->willThrowException(new \Exception('Cannot access default value'));

        $adapted = new AdaptedReflectionParameter($paramMock);

        self::assertNull($adapted->getDefaultValue());
    }

    // CRITICAL: Default value constant handling tests

    public function testItChecksIsDefaultValueAvailableBeforeIsDefaultValueConstant()
    {
        $paramMock = $this->getMockBuilder(ReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Simulate the critical case: not available
        $paramMock->method('isDefaultValueAvailable')->willReturn(false);

        $adapted = new AdaptedReflectionParameter($paramMock);

        // Should handle gracefully and return null when default value not available
        self::assertNull($adapted->getDefaultValueConstantName());
    }

    public function testItExtractsDefaultValueConstantNameWhenAvailableAndIsConstant()
    {
        $paramMock = $this->getMockBuilder(ReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paramMock->method('isDefaultValueAvailable')->willReturn(true);
        $paramMock->method('isDefaultValueConstant')->willReturn(true);
        $paramMock->method('getDefaultValueConstantName')->willReturn('PHP_INT_MAX');

        $adapted = new AdaptedReflectionParameter($paramMock);

        self::assertEquals('PHP_INT_MAX', $adapted->getDefaultValueConstantName());
    }

    public function testItReturnsNullWhenDefaultValueIsNotConstant()
    {
        $paramMock = $this->getMockBuilder(ReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paramMock->method('isDefaultValueAvailable')->willReturn(true);
        $paramMock->method('isDefaultValueConstant')->willReturn(false);

        $adapted = new AdaptedReflectionParameter($paramMock);

        self::assertNull($adapted->getDefaultValueConstantName());
    }

    public function testItHandlesInternalClassParametersWithoutThrowing()
    {
        $paramMock = $this->getMockBuilder(ReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paramMock->method('isDefaultValueAvailable')->willReturn(true);
        $paramMock->method('isDefaultValueConstant')->willThrowException(
            new \Exception('Internal error: Failed to retrieve the default value')
        );

        // Should not throw, should handle gracefully
        $adapted = new AdaptedReflectionParameter($paramMock);

        self::assertNull($adapted->getDefaultValueConstantName());
    }

    // Getter method tests

    public function testHasTypeReturnsTrueWhenTypePresent()
    {
        $typeMock = $this->getMockBuilder(\ReflectionType::class)
            ->disableOriginalConstructor()
            ->getMock();

        $paramMock = $this->getMockBuilder(ReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paramMock->method('hasType')->willReturn(true);
        $paramMock->method('getType')->willReturn($typeMock);

        $adapted = new AdaptedReflectionParameter($paramMock);

        self::assertTrue($adapted->hasType());
    }

    public function testHasTypeReturnsFalseWhenTypeAbsent()
    {
        $paramMock = $this->getMockBuilder(ReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paramMock->method('hasType')->willReturn(false);

        $adapted = new AdaptedReflectionParameter($paramMock);

        self::assertFalse($adapted->hasType());
    }
}
