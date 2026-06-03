<?php

namespace StubTests\Unit\Parsers\Reflection\Wrappers;

use PHPUnit\Framework\TestCase;
use ReflectionFunction;
use ReflectionParameter;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionFunction;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionParameter;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionType;

class AdaptedReflectionFunctionTest extends TestCase
{
    public function testItExtractsFunctionName()
    {
        $functionMock = $this->getMockBuilder(ReflectionFunction::class)
            ->disableOriginalConstructor()
            ->getMock();
        $functionMock->method('getName')->willReturn('testFunction');

        $adapted = new AdaptedReflectionFunction($functionMock);

        self::assertEquals('testFunction', $adapted->getName());
    }

    public function testItExtractsIsInternal()
    {
        $functionMock = $this->getMockBuilder(ReflectionFunction::class)
            ->disableOriginalConstructor()
            ->getMock();
        $functionMock->method('isInternal')->willReturn(true);

        $adapted = new AdaptedReflectionFunction($functionMock);

        self::assertTrue($adapted->isInternal());
    }

    public function testItExtractsIsVariadic()
    {
        $functionMock = $this->getMockBuilder(ReflectionFunction::class)
            ->disableOriginalConstructor()
            ->getMock();
        $functionMock->method('isVariadic')->willReturn(false);

        $adapted = new AdaptedReflectionFunction($functionMock);

        self::assertFalse($adapted->isVariadic());
    }

    public function testItExtractsReturnsReference()
    {
        $functionMock = $this->getMockBuilder(ReflectionFunction::class)
            ->disableOriginalConstructor()
            ->getMock();
        $functionMock->method('returnsReference')->willReturn(true);

        $adapted = new AdaptedReflectionFunction($functionMock);

        self::assertTrue($adapted->returnsReference());
    }

    public function testItExtractsNumberOfParameters()
    {
        $functionMock = $this->getMockBuilder(ReflectionFunction::class)
            ->disableOriginalConstructor()
            ->getMock();
        $functionMock->method('getNumberOfParameters')->willReturn(2);

        $adapted = new AdaptedReflectionFunction($functionMock);

        self::assertEquals(2, $adapted->getNumberOfParameters());
    }

    public function testItExtractsNumberOfRequiredParameters()
    {
        $functionMock = $this->getMockBuilder(ReflectionFunction::class)
            ->disableOriginalConstructor()
            ->getMock();
        $functionMock->method('getNumberOfRequiredParameters')->willReturn(1);

        $adapted = new AdaptedReflectionFunction($functionMock);

        self::assertEquals(1, $adapted->getNumberOfRequiredParameters());
    }

    public function testItWrapsParametersAsAdaptedReflectionParameter()
    {
        $paramMock = $this->getMockBuilder(ReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paramMock->method('getName')->willReturn('param1');

        $functionMock = $this->getMockBuilder(ReflectionFunction::class)
            ->disableOriginalConstructor()
            ->getMock();
        $functionMock->method('getParameters')->willReturn([$paramMock]);

        $adapted = new AdaptedReflectionFunction($functionMock);
        $parameters = $adapted->getParameters();

        self::assertIsArray($parameters);
        self::assertCount(1, $parameters);
        self::assertInstanceOf(AdaptedReflectionParameter::class, $parameters[0]);
    }

    public function testItWrapsReturnTypeAsAdaptedReflectionType()
    {
        $returnTypeMock = $this->getMockBuilder(\ReflectionType::class)
            ->disableOriginalConstructor()
            ->getMock();

        $functionMock = $this->getMockBuilder(ReflectionFunction::class)
            ->disableOriginalConstructor()
            ->getMock();
        $functionMock->method('hasReturnType')->willReturn(true);
        $functionMock->method('getReturnType')->willReturn($returnTypeMock);

        $adapted = new AdaptedReflectionFunction($functionMock);

        self::assertInstanceOf(AdaptedReflectionType::class, $adapted->getReturnType());
    }

    public function testItHandlesFunctionWithoutReturnType()
    {
        $functionMock = $this->getMockBuilder(ReflectionFunction::class)
            ->disableOriginalConstructor()
            ->getMock();
        $functionMock->method('hasReturnType')->willReturn(false);

        $adapted = new AdaptedReflectionFunction($functionMock);

        self::assertNull($adapted->getReturnType());
    }

    public function testHasReturnTypeReturnsTrueWhenTypePresent()
    {
        $returnTypeMock = $this->getMockBuilder(\ReflectionType::class)
            ->disableOriginalConstructor()
            ->getMock();

        $functionMock = $this->getMockBuilder(ReflectionFunction::class)
            ->disableOriginalConstructor()
            ->getMock();
        $functionMock->method('hasReturnType')->willReturn(true);
        $functionMock->method('getReturnType')->willReturn($returnTypeMock);

        $adapted = new AdaptedReflectionFunction($functionMock);

        self::assertTrue($adapted->hasReturnType());
    }

    public function testItExtractsDocComment()
    {
        $functionMock = $this->getMockBuilder(ReflectionFunction::class)
            ->disableOriginalConstructor()
            ->getMock();
        $functionMock->method('getDocComment')->willReturn('/** Function doc */');

        $adapted = new AdaptedReflectionFunction($functionMock);

        self::assertEquals('/** Function doc */', $adapted->getDocComment());
    }

    public function testItHandlesFunctionWithoutDocComment()
    {
        $functionMock = $this->getMockBuilder(ReflectionFunction::class)
            ->disableOriginalConstructor()
            ->getMock();
        $functionMock->method('getDocComment')->willReturn(false);

        $adapted = new AdaptedReflectionFunction($functionMock);

        self::assertFalse($adapted->getDocComment());
    }
}
