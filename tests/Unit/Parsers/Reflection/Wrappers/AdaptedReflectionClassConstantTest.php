<?php

namespace StubTests\Unit\Parsers\Reflection\Wrappers;

use PHPUnit\Framework\TestCase;
use ReflectionClassConstant;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClassConstant;

class AdaptedReflectionClassConstantTest extends TestCase
{
    public function testItExtractsConstantName()
    {
        $constantMock = $this->getMockBuilder(ReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->getMock();
        $constantMock->method('getName')->willReturn('TEST_CONSTANT');

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $constantMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionClassConstant($constantMock);

        self::assertEquals('TEST_CONSTANT', $adapted->getName());
    }

    public function testItExtractsConstantValue()
    {
        $constantMock = $this->getMockBuilder(ReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->getMock();
        $constantMock->method('getValue')->willReturn(42);

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $constantMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionClassConstant($constantMock);

        self::assertEquals(42, $adapted->getValue());
    }

    public function testItExtractsIsPublic()
    {
        $constantMock = $this->getMockBuilder(ReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->getMock();
        $constantMock->method('isPublic')->willReturn(true);

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $constantMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionClassConstant($constantMock);

        self::assertTrue($adapted->isPublic());
    }

    public function testItExtractsIsPrivate()
    {
        $constantMock = $this->getMockBuilder(ReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->getMock();
        $constantMock->method('isPrivate')->willReturn(false);

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $constantMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionClassConstant($constantMock);

        self::assertFalse($adapted->isPrivate());
    }

    public function testItExtractsIsProtected()
    {
        $constantMock = $this->getMockBuilder(ReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->getMock();
        $constantMock->method('isProtected')->willReturn(true);

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $constantMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionClassConstant($constantMock);

        self::assertTrue($adapted->isProtected());
    }

    public function testItStoresDeclaringClassName()
    {
        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('DeclaringClass');

        $constantMock = $this->getMockBuilder(ReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->getMock();
        $constantMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionClassConstant($constantMock);

        self::assertEquals('DeclaringClass', $adapted->getExtractedData()['declaringClassName']);
    }

    public function testItExtractsDocComment()
    {
        $constantMock = $this->getMockBuilder(ReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->getMock();
        $constantMock->method('getDocComment')->willReturn('/** Constant doc */');

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $constantMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionClassConstant($constantMock);

        self::assertEquals('/** Constant doc */', $adapted->getDocComment());
    }

    public function testItHandlesConstantWithoutDocComment()
    {
        $constantMock = $this->getMockBuilder(ReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->getMock();
        $constantMock->method('getDocComment')->willReturn(false);

        $declaringClassMock = $this->getMockBuilder(\ReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $constantMock->method('getDeclaringClass')->willReturn($declaringClassMock);

        $adapted = new AdaptedReflectionClassConstant($constantMock);

        self::assertFalse($adapted->getDocComment());
    }
}
