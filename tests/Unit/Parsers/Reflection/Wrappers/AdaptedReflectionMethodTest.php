<?php

namespace StubTests\Unit\Parsers\Reflection\Wrappers;

use PHPUnit\Framework\TestCase;
use ReflectionMethod;
use ReflectionParameter;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionMethod;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionParameter;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionType;

class AdaptedReflectionMethodTest extends TestCase
{
    public function testItExtractsMethodName()
    {
        $methodMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $methodMock->method('getName')->willReturn('testMethod');

        $adapted = new AdaptedReflectionMethod($methodMock);

        self::assertEquals('testMethod', $adapted->getName());
    }

    public function testItExtractsIsAbstract()
    {
        $methodMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $methodMock->method('isAbstract')->willReturn(true);

        $adapted = new AdaptedReflectionMethod($methodMock);

        self::assertTrue($adapted->isAbstract());
    }

    public function testItExtractsIsFinal()
    {
        $methodMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $methodMock->method('isFinal')->willReturn(false);

        $adapted = new AdaptedReflectionMethod($methodMock);

        self::assertFalse($adapted->isFinal());
    }

    public function testItExtractsIsStatic()
    {
        $methodMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $methodMock->method('isStatic')->willReturn(true);

        $adapted = new AdaptedReflectionMethod($methodMock);

        self::assertTrue($adapted->isStatic());
    }

    public function testItExtractsIsPublic()
    {
        $methodMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $methodMock->method('isPublic')->willReturn(true);

        $adapted = new AdaptedReflectionMethod($methodMock);

        self::assertTrue($adapted->isPublic());
    }

    public function testItExtractsIsPrivate()
    {
        $methodMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $methodMock->method('isPrivate')->willReturn(false);

        $adapted = new AdaptedReflectionMethod($methodMock);

        self::assertFalse($adapted->isPrivate());
    }

    public function testItExtractsIsProtected()
    {
        $methodMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $methodMock->method('isProtected')->willReturn(true);

        $adapted = new AdaptedReflectionMethod($methodMock);

        self::assertTrue($adapted->isProtected());
    }

    public function testItExtractsIsConstructor()
    {
        $methodMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $methodMock->method('isConstructor')->willReturn(true);

        $adapted = new AdaptedReflectionMethod($methodMock);

        self::assertTrue($adapted->isConstructor());
    }

    public function testItExtractsIsDestructor()
    {
        $methodMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $methodMock->method('isDestructor')->willReturn(false);

        $adapted = new AdaptedReflectionMethod($methodMock);

        self::assertFalse($adapted->isDestructor());
    }

    public function testItExtractsNumberOfParameters()
    {
        $methodMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $methodMock->method('getNumberOfParameters')->willReturn(3);

        $adapted = new AdaptedReflectionMethod($methodMock);

        self::assertEquals(3, $adapted->getNumberOfParameters());
    }

    public function testItExtractsNumberOfRequiredParameters()
    {
        $methodMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $methodMock->method('getNumberOfRequiredParameters')->willReturn(1);

        $adapted = new AdaptedReflectionMethod($methodMock);

        self::assertEquals(1, $adapted->getNumberOfRequiredParameters());
    }

    public function testItExtractsReturnsReference()
    {
        $methodMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $methodMock->method('returnsReference')->willReturn(false);

        $adapted = new AdaptedReflectionMethod($methodMock);

        self::assertFalse($adapted->returnsReference());
    }

    public function testItStoresDeclaringClassName()
    {
        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');

        $methodMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $methodMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionMethod($methodMock);

        self::assertEquals('TestClass', $adapted->getExtractedData()['declaringClassName']);
    }

    public function testItWrapsParametersAsAdaptedReflectionParameter()
    {
        $paramMock = $this->getMockBuilder(ReflectionParameter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $paramMock->method('getName')->willReturn('param1');

        $methodMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $methodMock->method('getParameters')->willReturn([$paramMock]);

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $methodMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionMethod($methodMock);
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

        $methodMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $methodMock->method('hasReturnType')->willReturn(true);
        $methodMock->method('getReturnType')->willReturn($returnTypeMock);

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $methodMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionMethod($methodMock);

        self::assertInstanceOf(AdaptedReflectionType::class, $adapted->getReturnType());
    }

    public function testItHandlesMethodWithoutReturnType()
    {
        $methodMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $methodMock->method('hasReturnType')->willReturn(false);

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $methodMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionMethod($methodMock);

        self::assertNull($adapted->getReturnType());
    }

    public function testHasReturnTypeReturnsTrueWhenTypePresent()
    {
        $returnTypeMock = $this->getMockBuilder(\ReflectionType::class)
            ->disableOriginalConstructor()
            ->getMock();

        $methodMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $methodMock->method('hasReturnType')->willReturn(true);
        $methodMock->method('getReturnType')->willReturn($returnTypeMock);

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $methodMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionMethod($methodMock);

        self::assertTrue($adapted->hasReturnType());
    }

    public function testItExtractsDocComment()
    {
        $methodMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $methodMock->method('getDocComment')->willReturn('/** Test doc */');

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $methodMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionMethod($methodMock);

        self::assertEquals('/** Test doc */', $adapted->getDocComment());
    }

    public function testItHandlesMethodWithoutDocComment()
    {
        $methodMock = $this->getMockBuilder(ReflectionMethod::class)
            ->disableOriginalConstructor()
            ->getMock();
        $methodMock->method('getDocComment')->willReturn(false);

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $methodMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionMethod($methodMock);

        self::assertFalse($adapted->getDocComment());
    }
}
