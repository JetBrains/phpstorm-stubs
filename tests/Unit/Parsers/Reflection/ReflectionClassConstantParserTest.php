<?php

namespace StubTests\Unit\Parsers\Reflection;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\PHPClassConstant;
use StubTests\Framework\Parsers\Reflection\ReflectionClassConstantParser;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClassConstant;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClassReference;
use function PHPUnit\Framework\assertEquals;

class ReflectionClassConstantParserTest extends TestCase
{
    public function testItCanParseClassConstants()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertNotNull($parsedConstant);
    }

    public function testItReturnsCorrectInstanceOfClassConstants()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertTrue($parsedConstant instanceof PHPClassConstant);
    }

    public function testItSetsDevautNameNullForClassConstants()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertNull($parsedConstant->getName());
    }

    public function testItCanParseClassConstantName()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $classConstantMock->method('getName')->willReturn('foo');
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertEquals('foo', $parsedConstant->getName());
    }

    public function testItSetsDevautValueNullForClassConstants()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertNull($parsedConstant->getValue());
    }

    public function testItCanParseClassConstantValue()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getValue'])
            ->getMock();
        $classConstantMock->method('getValue')->willReturn('foo');
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertEquals('foo', $parsedConstant->getValue());
    }

    public function testParsedConstantDoesnNotHaveId()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $classConstantMock->method('getName')->willReturn('foo');
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertNull($parsedConstant->getId());
    }

    public function testItSetsNullAsParentClassIfNoParentClass()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertNull($parsedConstant->getParentId());
    }

    public function testItCanParseParentClassIdRootNamespace()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getDeclaringClass'])
            ->getMock();
        $declaringClassMock = new AdaptedReflectionClassReference('ParentClass');
        $classConstantMock->method('getDeclaringClass')->willReturn($declaringClassMock);
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        assertEquals('\ParentClass', $parsedConstant->getParentId());
    }

    public function testItCanParseParentClassIdCustomNamespace()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getDeclaringClass'])
            ->getMock();
        $declaringClassMock = new AdaptedReflectionClassReference('DummyNamespace\ParentClass');
        $classConstantMock->method('getDeclaringClass')->willReturn($declaringClassMock);
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        assertEquals('\DummyNamespace\ParentClass', $parsedConstant->getParentId());
    }

    public function testItCanParseConstantPrivateVisibility()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isPrivate'])
            ->getMock();
        $classConstantMock->method('isPrivate')->willReturn(true);
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertSame(AccessModifier::PRIVATE, $parsedConstant->getAccess());
    }

    public function testItCanParseConstantProtectedVisibility()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isProtected'])
            ->getMock();
        $classConstantMock->method('isProtected')->willReturn(true);
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertSame(AccessModifier::PROTECTED, $parsedConstant->getAccess());
    }

    public function testItCanParseConstantPublicVisibility()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isPublic'])
            ->getMock();
        $classConstantMock->method('isPublic')->willReturn(true);
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertSame(AccessModifier::PUBLIC, $parsedConstant->getAccess());
    }

    public function testItParseVisibilityPublicIfNoVisibilityIsPresent()
    {
        $classConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isPublic', 'isProtected', 'isPrivate'])
            ->getMock();
        $classConstantMock->method('isPublic')->willReturn(false);
        $classConstantMock->method('isProtected')->willReturn(false);
        $classConstantMock->method('isPrivate')->willReturn(false);
        $parsedConstant = new ReflectionClassConstantParser()->parse($classConstantMock);
        self::assertSame(AccessModifier::PUBLIC, $parsedConstant->getAccess());
    }
}
