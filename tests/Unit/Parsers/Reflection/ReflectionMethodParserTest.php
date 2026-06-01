<?php

namespace StubTests\Unit\Parsers\Reflection;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\Types\NoType;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Reflection\ReflectionMethodParser;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClass;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionMethod;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionType;

class ReflectionMethodParserTest extends TestCase
{
    public function testItCanParseMethod()
    {
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertNotNull($basePHPElement);
    }

    public function testItReturnsCorrectInstanceOfMethods()
    {
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertTrue($basePHPElement instanceof PHPMethod);
    }

    public function testItCanParseName()
    {
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionMethodMock->method('getName')->willReturn('foo');
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertEquals('foo', $basePHPElement->getName());
    }

    public function testItCanParseId()
    {
        $parentClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getNamespaceName', 'getName', 'getShortName'])
            ->getMock();
        $parentClassMock->method('getName')->willReturn('SomeNamespace\SubNamespace\SomeFooClass');
        $parentClassMock->method('getNamespaceName')->willReturn('SomeNamespace\SubNamespace');
        $parentClassMock->method('getShortName')->willReturn('SomeFooClass');
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getDeclaringClass'])
            ->getMock();
        $reflectionMethodMock->method('getName')->willReturn('foo');
        $reflectionMethodMock->method('getDeclaringClass')->willReturn($parentClassMock);
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertEquals('\SomeNamespace\SubNamespace\SomeFooClass::foo', $basePHPElement->getId());
    }

    public function testItCanParseIdIfNoNamespaceIsPresent()
    {
        $parentClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getNamespaceName'])
            ->getMock();
        $parentClassMock->method('getName')->willReturn('SomeFooClass');
        $parentClassMock->method('getNamespaceName')->willReturn('');
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getDeclaringClass'])
            ->getMock();
        $reflectionMethodMock->method('getName')->willReturn('foo');
        $reflectionMethodMock->method('getDeclaringClass')->willReturn($parentClassMock);
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertEquals('\SomeFooClass::foo', $basePHPElement->getId());
    }

    public function testItCanParseVisibility() {
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isPublic'])
            ->getMock();
        $reflectionMethodMock->method('isPublic')->willReturn(true);
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertEquals('public', $basePHPElement->getAccess()->value);
    }

    public function testItCanParseVisibilityIfNoVisibilityIsPresent() {
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isPublic'])
            ->getMock();
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertEquals('public', $basePHPElement->getAccess()->value);
    }

    public function testItCanParseVisibilityIfVisibilityIsPrivate() {
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isPublic', 'isProtected', 'isPrivate'])
            ->getMock();
        $reflectionMethodMock->method('isPublic')->willReturn(false);
        $reflectionMethodMock->method('isProtected')->willReturn(false);
        $reflectionMethodMock->method('isPrivate')->willReturn(true);
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertEquals('private', $basePHPElement->getAccess()->value);
    }

    public function testItCanParseVisibilityIfVisibilityIsProtected() {
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isPublic', 'isProtected', 'isPrivate'])
            ->getMock();
        $reflectionMethodMock->method('isPublic')->willReturn(false);
        $reflectionMethodMock->method('isProtected')->willReturn(true);
        $reflectionMethodMock->method('isPrivate')->willReturn(false);
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertEquals('protected', $basePHPElement->getAccess()->value);
    }

    public function testItCanParseStaticAttribute()
    {
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isStatic'])
            ->getMock();
        $reflectionMethodMock->method('isStatic')->willReturn(true);
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertTrue($basePHPElement->isStatic());
    }

    public function testItParsesByDefaultNonStaticAttribute()
    {
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertFalse($basePHPElement->isStatic());
    }

    public function testItParsesNonStaticAttribute()
    {
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isStatic'])
            ->getMock();
        $reflectionMethodMock->method('isStatic')->willReturn(false);
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertFalse($basePHPElement->isStatic());
    }

    public function testItCanParseFinalAttributeIfNoFinalAttributeIsPresent()
    {
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertFalse($basePHPElement->isFinal());
    }

    public function testItCanParseFinalAttribute() {
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isFinal'])
            ->getMock();
        $reflectionMethodMock->method('isFinal')->willReturn(true);
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertTrue($basePHPElement->isFinal());
    }

    public function testItCanParseNonFinalAttribute()
    {
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isFinal'])
            ->getMock();
        $reflectionMethodMock->method('isFinal')->willReturn(false);
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertFalse($basePHPElement->isFinal());
    }

    public function testItCanParseAbstractAttribute() {
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isAbstract'])
            ->getMock();
        $reflectionMethodMock->method('isAbstract')->willReturn(true);
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertTrue($basePHPElement->isAbstract());
    }

    public function testItCanParseAbstractAttributeIfNoAbstractAttributeIsPresent() {
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertFalse($basePHPElement->isAbstract());
    }

    public function testItCanParseNonAbstractAttribute()
    {
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isAbstract'])
            ->getMock();
        $reflectionMethodMock->method('isAbstract')->willReturn(false);
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertFalse($basePHPElement->isAbstract());
    }

    public function testItCanParseDeprecatedAttribute() {
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['isDeprecated'])
            ->getMock();
        $reflectionMethodMock->method('isDeprecated')->willReturn(true);
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertTrue($basePHPElement->isDeprecated());
    }

    public function testItCanParseDeprecatedAttributeIfNoDeprecatedAttributeIsPresent() {
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertFalse($basePHPElement->isDeprecated());
    }

    public function testItReturnsNoTypeAsDefaultReturnType()
    {
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertInstanceOf(NoType::class, $basePHPElement->getReturnTypeFromSignature());
    }

    public function testItCanParseSimpleReturnType() {
        $declaringClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)->disableOriginalConstructor()->getMock();
        $reflectionMethodMock->method('getDeclaringClass')->willReturn($declaringClassMock);
        $reflectionMethodMock->method('getName')->willReturn('testMethod');
        $reflectionMethodMock->method('getParameters')->willReturn([]);
        $reflectionMethodMock->method('isProtected')->willReturn(false);
        $reflectionMethodMock->method('isPrivate')->willReturn(false);
        $reflectionMethodMock->method('isStatic')->willReturn(false);
        $reflectionMethodMock->method('isFinal')->willReturn(false);
        $reflectionMethodMock->method('isAbstract')->willReturn(false);
        $reflectionMethodMock->method('isDeprecated')->willReturn(false);
        $reflectionMethodMock->method('hasTentativeReturnType')->willReturn(false);
        $returnTypeMock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'allowsNull', 'isUnionType', 'isIntersectionType'])
            ->getMock();
        $returnTypeMock->method('getName')->willReturn('string');
        $returnTypeMock->method('allowsNull')->willReturn(false);
        $returnTypeMock->method('isUnionType')->willReturn(false);
        $returnTypeMock->method('isIntersectionType')->willReturn(false);
        $reflectionMethodMock->method('hasReturnType')->willReturn(true);
        $reflectionMethodMock->method('getReturnType')->willReturn($returnTypeMock);
        $basePhpElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertEquals('string', $basePhpElement->getReturnTypeFromSignature()->toString());
    }

    public function testItCanParseTentativeReturnType() {
        $declaringClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)->disableOriginalConstructor()->getMock();
        $reflectionMethodMock->method('getDeclaringClass')->willReturn($declaringClassMock);
        $reflectionMethodMock->method('getName')->willReturn('testMethod');
        $reflectionMethodMock->method('getParameters')->willReturn([]);
        $reflectionMethodMock->method('isProtected')->willReturn(false);
        $reflectionMethodMock->method('isPrivate')->willReturn(false);
        $reflectionMethodMock->method('isStatic')->willReturn(false);
        $reflectionMethodMock->method('isFinal')->willReturn(false);
        $reflectionMethodMock->method('isAbstract')->willReturn(false);
        $reflectionMethodMock->method('isDeprecated')->willReturn(false);
        $reflectionTypeMock = $this->getMockBuilder(AdaptedReflectionType::class)->disableOriginalConstructor()->getMock();
        $reflectionTypeMock->method('getName')->willReturn('string');
        $reflectionMethodMock->method('hasTentativeReturnType')->willReturn(true);
        $reflectionMethodMock->method('getTentativeReturnType')->willReturn($reflectionTypeMock);
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertTrue($basePHPElement->hasTentativeReturnType());
    }

    public function testItCanParseNoTentativeReturnType() {
        $declaringClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)->disableOriginalConstructor()->getMock();
        $reflectionMethodMock->method('getDeclaringClass')->willReturn($declaringClassMock);
        $reflectionMethodMock->method('getName')->willReturn('testMethod');
        $reflectionMethodMock->method('getParameters')->willReturn([]);
        $reflectionMethodMock->method('isProtected')->willReturn(false);
        $reflectionMethodMock->method('isPrivate')->willReturn(false);
        $reflectionMethodMock->method('isStatic')->willReturn(false);
        $reflectionMethodMock->method('isFinal')->willReturn(false);
        $reflectionMethodMock->method('isAbstract')->willReturn(false);
        $reflectionMethodMock->method('isDeprecated')->willReturn(false);
        $reflectionMethodMock->method('hasTentativeReturnType')->willReturn(false);
        $reflectionTypeMock = $this->getMockBuilder(AdaptedReflectionType::class)->disableOriginalConstructor()->getMock();

        $reflectionTypeMock->method('getName')->willReturn('string');
        $reflectionMethodMock->method('getReturnType')->willReturn($reflectionTypeMock);
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertFalse($basePHPElement->hasTentativeReturnType());
    }

    public function testItCanParseReturnTypesOfTentativeReturnType() {
        $declaringClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)->disableOriginalConstructor()->getMock();
        $returnTypeMock = $this->getMockBuilder(AdaptedReflectionType::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'allowsNull', 'isUnionType', 'isIntersectionType'])
            ->getMock();
        $returnTypeMock->method('getName')->willReturn('string');
        $returnTypeMock->method('allowsNull')->willReturn(false);
        $returnTypeMock->method('isUnionType')->willReturn(false);
        $returnTypeMock->method('isIntersectionType')->willReturn(false);
        $declaringClassMock->method('getName')->willReturn('TestClass');
        $reflectionMethodMock->method('getDeclaringClass')->willReturn($declaringClassMock);
        $reflectionMethodMock->method('getName')->willReturn('testMethod');
        $reflectionMethodMock->method('getParameters')->willReturn([]);
        $reflectionMethodMock->method('isProtected')->willReturn(false);
        $reflectionMethodMock->method('isPrivate')->willReturn(false);
        $reflectionMethodMock->method('isStatic')->willReturn(false);
        $reflectionMethodMock->method('isFinal')->willReturn(false);
        $reflectionMethodMock->method('isAbstract')->willReturn(false);
        $reflectionMethodMock->method('isDeprecated')->willReturn(false);
        $reflectionMethodMock->method('hasReturnType')->willReturn(false);
        $reflectionMethodMock->method('hasTentativeReturnType')->willReturn(true);
        $reflectionMethodMock->method('getTentativeReturnType')->willReturn($returnTypeMock);
        $basePHPElement = new ReflectionMethodParser()->parse($reflectionMethodMock);
        self::assertEquals('string', $basePHPElement->getReturnTypeFromSignature()->toString());
    }
}
