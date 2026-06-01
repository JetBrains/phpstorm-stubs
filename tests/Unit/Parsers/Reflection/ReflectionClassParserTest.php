<?php

namespace StubTests\Unit\Parsers\Reflection;

use PHPUnit\Framework\TestCase as BaseTestCase;
use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPClassConstant;
use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Parsers\Reflection\ReflectionClassParser;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClass;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClassConstant;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionMethod;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionProperty;

class ReflectionClassParserTest extends BaseTestCase
{
    public function testItCanParseInternalClass()
    {
        $stubReflectionClass = $this->getMockBuilder(AdaptedReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $stubReflectionClass->method('isInternal')->willReturn(true);
        self::assertTrue(new ReflectionClassParser()->canParse($stubReflectionClass));
    }

    public function testItCanNotParseUsersClasses()
    {
        $stubReflectionClass = $this->getMockBuilder(AdaptedReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $stubReflectionClass->method('isInternal')->willReturn(false);
        self::assertFalse(new ReflectionClassParser()->canParse($stubReflectionClass));
    }

    public function testItCanNotParseInternalInterface()
    {
        $stubReflectionClass = $this->getMockBuilder(AdaptedReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $stubReflectionClass->method('isInternal')->willReturn(true);
        $stubReflectionClass->method('isInterface')->willReturn(true);
        self::assertFalse(new ReflectionClassParser()->canParse($stubReflectionClass));
    }

    public function testItCanNotParseUsersInterface()
    {
        $stubReflectionClass = $this->getMockBuilder(AdaptedReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $stubReflectionClass->method('isInternal')->willReturn(false);
        $stubReflectionClass->method('isInterface')->willReturn(true);
        self::assertFalse(new ReflectionClassParser()->canParse($stubReflectionClass));
    }

    public function testItCanNotParseInternalEnums()
    {
        $stubReflectionClass = $this->getMockBuilder(AdaptedReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $stubReflectionClass->method('isInternal')->willReturn(true);
        $stubReflectionClass->method('isEnum')->willReturn(true);
        self::assertFalse(new ReflectionClassParser()->canParse($stubReflectionClass));
    }

    public function testItCanNotParseUsersEnums()
    {
        $stubReflectionClass = $this->getMockBuilder(AdaptedReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $stubReflectionClass->method('isInternal')->willReturn(false);
        $stubReflectionClass->method('isEnum')->willReturn(true);
        self::assertFalse(new ReflectionClassParser()->canParse($stubReflectionClass));
    }

    public function testItReturnsCorrectInstance()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $basePHPElement = new ReflectionClassParser()->parse($reflectionMock);
        self::assertTrue($basePHPElement instanceof PHPClass);
    }

    public function testItSetsNullToNameIfNameNotAvailable()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $basePHPElement = new ReflectionClassParser()->parse($reflectionMock);
        self::assertNull($basePHPElement->getName());
    }

    public function testItCanParseName()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMock->method('getShortName')->willReturn('Foo');
        $basePHPElement = new ReflectionClassParser()->parse($reflectionMock);
        self::assertEquals('Foo', $basePHPElement->getName());
    }

    public function testItSetsRootNamespaceIfNoNamespaceAvailable()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $basePHPElement = new ReflectionClassParser()->parse($reflectionMock);
        self::assertEquals('\\', $basePHPElement->getNamespace());
    }

    public function testItCanParseNamespace()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMock->method('getNamespaceName')->willReturn('MyNameSpace\SubNameSpace');
        $basePHPElement = new ReflectionClassParser()->parse($reflectionMock);
        self::assertEquals('\MyNameSpace\SubNameSpace', $basePHPElement->getNamespace());
    }

    public function testItCanParseRootNamespace()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMock->method('getNamespaceName')->willReturn('');
        $basePHPElement = new ReflectionClassParser()->parse($reflectionMock);
        self::assertEquals('\\', $basePHPElement->getNamespace());
    }

    public function testItSetsNullAsDefaultId()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $basePHPElement = new ReflectionClassParser()->parse($reflectionMock);
        self::assertNull($basePHPElement->getId());
    }

    public function testItCanParseId()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMock->method('getShortName')->willReturn('SomeFooClass');
        $reflectionMock->method('getName')->willReturn('SomeNamespace\SubNamespace\SomeFooClass');
        $reflectionMock->method('getNamespaceName')->willReturn('SomeNamespace\SubNamespace');
        $basePHPElement = new ReflectionClassParser()->parse($reflectionMock);
        self::assertEquals('\SomeNamespace\SubNamespace\SomeFooClass', $basePHPElement->getId());
    }

    public function testItCanParseIdWithRootNamespace()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMock->method('getShortName')->willReturn('SomeFooClass');
        $reflectionMock->method('getName')->willReturn('SomeFooClass');
        $reflectionMock->method('getNamespaceName')->willReturn('');
        $basePHPElement = new ReflectionClassParser()->parse($reflectionMock);
        self::assertEquals('\SomeFooClass', $basePHPElement->getId());
    }

    public function testItSetFinalAsFalseByDefault()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $basePHPElement = new ReflectionClassParser()->parse($reflectionMock);
        self::assertFalse($basePHPElement->isFinal());
    }

    public function testItCanParseFinalClass()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMock->method('isFinal')->willReturn(true);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionMock);
        self::assertTrue($basePHPElement->isFinal());
    }

    public function testItCanParseNonFinalClass()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMock->method('isFinal')->willReturn(false);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionMock);
        self::assertFalse($basePHPElement->isFinal());
    }

    public function testItSetsFalseIfNoReadonlyAvailable()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
        $basePHPElement = new ReflectionClassParser()->parse($reflectionMock);
        self::assertFalse($basePHPElement->isReadonly());
    }

    public function testItCanParseReadonlyClass()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMock->method('isReadOnly')->willReturn(true);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionMock);
        self::assertTrue($basePHPElement->isReadonly());
    }

    public function testItCanParseNonReadonlyClass()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMock->method('isReadOnly')->willReturn(false);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionMock);
        self::assertFalse($basePHPElement->isReadonly());
    }

    public function testItSetsEmptyArrayIfMethodsCanNotBeReadInClass()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $basePHPElement = new ReflectionClassParser()->parse($reflectionMock);
        self::assertTrue(is_array($basePHPElement->getMethods()));
        self::assertNotNull($basePHPElement->getMethods());
        self::assertEmpty($basePHPElement->getMethods());
    }

    public function testItSetsEmptyArrayIfNoMethodsInClass()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMock->method('getMethods')->willReturn([]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionMock);
        self::assertTrue(is_array($basePHPElement->getMethods()));
        self::assertNotNull($basePHPElement->getMethods());
        self::assertEmpty($basePHPElement->getMethods());
    }

    public function testItCanParseClassWithMethods()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionMethodMock->method('getName')->willReturn('foo');
        $reflectionClassMock->method('getMethods')->willReturn([$reflectionMethodMock]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getMethods());
        self::assertNotEmpty($basePHPElement->getMethods());
    }

    public function testItReturnsCorrectInstanceForMethod()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionMethodMock->method('getName')->willReturn('foo');
        $reflectionClassMock->method('getMethods')->willReturn([$reflectionMethodMock]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getMethods());
        self::assertNotEmpty($basePHPElement->getMethods());
        self::assertInstanceOf(PHPMethod::class, $basePHPElement->getMethods()[0]);
    }

    public function testItReturnsCorrectInstancesForAllMethods()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMethodMock1 = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionMethodMock2 = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionMethodMock3 = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionMethodMock1->method('getName')->willReturn('foo');
        $reflectionMethodMock2->method('getName')->willReturn('foo1');
        $reflectionMethodMock3->method('getName')->willReturn('foo3');
        $reflectionClassMock->method('getMethods')->willReturn([$reflectionMethodMock1, $reflectionMethodMock2, $reflectionMethodMock3]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getMethods());
        self::assertNotEmpty($basePHPElement->getMethods());
        self::assertInstanceOf(PHPMethod::class, $basePHPElement->getMethods()[0]);
        self::assertInstanceOf(PHPMethod::class, $basePHPElement->getMethods()[1]);
        self::assertInstanceOf(PHPMethod::class, $basePHPElement->getMethods()[2]);
    }

    public function testItReturnsActuallyParsedMethods()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMethodMock1 = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionMethodMock2 = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionMethodMock3 = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionMethodMock1->method('getName')->willReturn('foo');
        $reflectionMethodMock2->method('getName')->willReturn('foo1');
        $reflectionMethodMock3->method('getName')->willReturn('foo3');
        $reflectionClassMock->method('getMethods')->willReturn([$reflectionMethodMock1, $reflectionMethodMock2, $reflectionMethodMock3]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        $methods = $basePHPElement->getMethods();
        self::assertEquals("foo", $methods[0]->getName());
        self::assertEquals("foo1", $methods[1]->getName());
        self::assertEquals("foo3", $methods[2]->getName());
    }

    public function testItCanParseClassWithOneMethod()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionMethodMock->method('getName')->willReturn('foo');
        $reflectionClassMock->method('getMethods')->willReturn([$reflectionMethodMock]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getMethods());
        self::assertNotEmpty($basePHPElement->getMethods());
        self::assertEquals(1, sizeof($basePHPElement->getMethods()));
    }

    public function testItCanParseClassWithSomeMethods()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMethodMock1 = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionMethodMock2 = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionMethodMock3 = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionMethodMock1->method('getName')->willReturn('foo');
        $reflectionMethodMock2->method('getName')->willReturn('foo1');
        $reflectionMethodMock3->method('getName')->willReturn('foo3');
        $reflectionClassMock->method('getMethods')->willReturn([$reflectionMethodMock1, $reflectionMethodMock2, $reflectionMethodMock3]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getMethods());
        self::assertNotEmpty($basePHPElement->getMethods());
        self::assertEquals(3, sizeof($basePHPElement->getMethods()));
    }

    public function testItSetsEmptyArrayIfPropertiesCanNotBeReadInClass() {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertIsArray($basePHPElement->getProperties());

        self::assertEmpty($basePHPElement->getProperties());
    }

    public function testItSetsEmptyArrayIfNoPropertiesInClass()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionClassMock->method('getProperties')->willReturn([]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertIsArray($basePHPElement->getProperties());
        self::assertNotNull($basePHPElement->getProperties());
        self::assertEmpty($basePHPElement->getProperties());
    }

    public function testItCanParseProperties()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionPropertyMock = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionPropertyMock->method('getName')->willReturn('prop');
        $reflectionClassMock->method('getProperties')->willReturn([$reflectionPropertyMock]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getProperties());
        self::assertNotEmpty($basePHPElement->getProperties());
    }

    public function testItReturnsCorrectInstanceForProperty()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionPropertyMock = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionPropertyMock->method('getName')->willReturn('prop');
        $reflectionClassMock->method('getProperties')->willReturn([$reflectionPropertyMock]);
        $class = new ReflectionClassParser()->parse($reflectionClassMock);
        $property = $class->getProperties()[0];
        self::assertNotNull($property);
        self::assertInstanceOf(PHPProperty::class, $property);
    }

    public function testItReturnsCorrectInstancesForAllProperties() {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionPropertyMock1 = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionPropertyMock2 = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionPropertyMock3 = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionPropertyMock1->method('getName')->willReturn('prop');
        $reflectionPropertyMock2->method('getName')->willReturn('prop1');
        $reflectionPropertyMock3->method('getName')->willReturn('prop3');
        $reflectionClassMock->method('getProperties')->willReturn([$reflectionPropertyMock1, $reflectionPropertyMock2, $reflectionPropertyMock3]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getProperties());
        self::assertNotEmpty($basePHPElement->getProperties());
        self::assertInstanceOf(PHPProperty::class, $basePHPElement->getProperties()[0]);
        self::assertInstanceOf(PHPProperty::class, $basePHPElement->getProperties()[1]);
        self::assertInstanceOf(PHPProperty::class, $basePHPElement->getProperties()[2]);
    }

    public function testItReturnsActuallyParsedProperties()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionPropertyMock1 = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionPropertyMock2 = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionPropertyMock3 = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionPropertyMock1->method('getName')->willReturn('prop');
        $reflectionPropertyMock2->method('getName')->willReturn('prop1');
        $reflectionPropertyMock3->method('getName')->willReturn('prop3');
        $reflectionClassMock->method('getProperties')->willReturn([$reflectionPropertyMock1, $reflectionPropertyMock2, $reflectionPropertyMock3]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        $properties = $basePHPElement->getProperties();
        self::assertEquals("prop", $properties[0]->getName());
        self::assertEquals("prop1", $properties[1]->getName());
        self::assertEquals("prop3", $properties[2]->getName());
    }

    public function testItCanParseOneProperty()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionPropertyMock = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionPropertyMock->method('getName')->willReturn('prop');
        $reflectionClassMock->method('getProperties')->willReturn([$reflectionPropertyMock]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertEquals(1, sizeof($basePHPElement->getProperties()));
    }

    public function testItCanParseSomeProperties() {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionPropertyMock1 = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionPropertyMock2 = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionPropertyMock3 = $this->getMockBuilder(AdaptedReflectionProperty::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionPropertyMock1->method('getName')->willReturn('prop');
        $reflectionPropertyMock2->method('getName')->willReturn('prop1');
        $reflectionPropertyMock3->method('getName')->willReturn('prop3');
        $reflectionClassMock->method('getProperties')->willReturn([$reflectionPropertyMock1, $reflectionPropertyMock2, $reflectionPropertyMock3]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertEquals(3, sizeof($basePHPElement->getProperties()));
    }

    public function testItSetsEmptyArrayIfConstantsCanNotBeReadInClass() {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getConstants());
        self::assertIsArray($basePHPElement->getConstants());
        self::assertEmpty($basePHPElement->getConstants());
    }

    public function testItSetsEmptyArrayIfNoConstantsInClassPhp56()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionClassMock->method('hasReflectionConstants')->willReturn(false);
        $reflectionClassMock->method('getConstants')->willReturn([]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getConstants());
        self::assertIsArray($basePHPElement->getConstants());
        self::assertEmpty($basePHPElement->getConstants());
    }

    public function testItSetsEmptyArrayIfNoConstantsInClassPhp71()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionClassMock->method('hasReflectionConstants')->willReturn(true);
        $reflectionClassMock->method('getReflectionConstants')->willReturn([]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getConstants());
        self::assertIsArray($basePHPElement->getConstants());
        self::assertEmpty($basePHPElement->getConstants());
    }

    public function testItCanParseClassConstantsPhp56()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionClassMock->method('hasReflectionConstants')->willReturn(false);
        $reflectionClassMock->method('getConstants')->willReturn(['FOO' => 'BAR']);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getConstants());
        self::assertIsArray($basePHPElement->getConstants());
        self::assertNotEmpty($basePHPElement->getConstants());
    }

    public function testItCanParseSeveralConstantsPhp56()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionClassMock->method('hasReflectionConstants')->willReturn(false);
        $reflectionClassMock->method('getConstants')->willReturn(['FOO' => 'BAR', 'BAR' => 'FOO']);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getConstants());
        self::assertIsArray($basePHPElement->getConstants());
        self::assertNotEmpty($basePHPElement->getConstants());
        self::assertEquals(2, sizeof($basePHPElement->getConstants()));
    }

    public function testItCanParseClassConstantsPhp71()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionClassConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getValue'])
            ->getMock();
        $reflectionClassConstantMock->method('getName')->willReturn('FOO');
        $reflectionClassConstantMock->method('getValue')->willReturn('BAR');
        $reflectionClassMock->method('hasReflectionConstants')->willReturn(true);
        $reflectionClassMock->method('getReflectionConstants')->willReturn([$reflectionClassConstantMock]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getConstants());
        self::assertIsArray($basePHPElement->getConstants());
        self::assertNotEmpty($basePHPElement->getConstants());
    }

    public function testItCanParseSeveralConstantsPhp71() {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionClassConstantMock1 = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getValue'])
            ->getMock();
        $reflectionClassConstantMock2 = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getValue'])
            ->getMock();
        $reflectionClassConstantMock3 = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getValue'])
            ->getMock();
        $reflectionClassConstantMock1->method('getName')->willReturn('FOO');
        $reflectionClassConstantMock1->method('getValue')->willReturn('BAR');
        $reflectionClassConstantMock2->method('getName')->willReturn('BAR');
        $reflectionClassConstantMock2->method('getValue')->willReturn('FOO');
        $reflectionClassConstantMock3->method('getName')->willReturn('FAA');
        $reflectionClassConstantMock3->method('getValue')->willReturn('BOO');
        $reflectionClassMock->method('hasReflectionConstants')->willReturn(true);
        $reflectionClassMock->method('getReflectionConstants')->willReturn([$reflectionClassConstantMock1, $reflectionClassConstantMock2, $reflectionClassConstantMock3]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getConstants());
        self::assertIsArray($basePHPElement->getConstants());
        self::assertNotEmpty($basePHPElement->getConstants());
        self::assertEquals(3, sizeof($basePHPElement->getConstants()));
    }

    public function testItReturnsCorrectInstanceForConstantPhp71()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionClassConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getValue'])
            ->getMock();
        $reflectionClassConstantMock->method('getName')->willReturn('FOO');
        $reflectionClassConstantMock->method('getValue')->willReturn('BAR');
        $reflectionClassMock->method('hasReflectionConstants')->willReturn(true);
        $reflectionClassMock->method('getReflectionConstants')->willReturn([$reflectionClassConstantMock]);
        $class = new ReflectionClassParser()->parse($reflectionClassMock);
        $constant = $class->getConstants()[0];
        self::assertInstanceOf(PHPClassConstant::class, $constant);
    }

    public function testItReturnsCorrectInstancesForAllConstantsPhp56()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionClassMock->method('hasReflectionConstants')->willReturn(false);
        $reflectionClassMock->method('getConstants')->willReturn(['FOO' => 'BAR', 'BAR' => 'FOO']);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        $constants = $basePHPElement->getConstants();
        $constant1 = $constants[0];
        $constant2 = $constants[1];
        self::assertInstanceOf(PHPClassConstant::class, $constant1);
        self::assertInstanceOf(PHPClassConstant::class, $constant2);
    }

    public function testItReturnsActuallyParsedConstantsPhp56()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionClassMock->method('hasReflectionConstants')->willReturn(false);
        $reflectionClassMock->method('getConstants')->willReturn(['FOO' => 'BAR', 'BAR' => 'FOO']);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        $constants = $basePHPElement->getConstants();
        self::assertEquals("FOO", $constants[0]->getName());
        self::assertEquals("FOO", $constants[1]->getValue());
    }

    public function testItReturnsActuallyParsedConstantsPhp71()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionClassConstantMock1 = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getValue'])
            ->getMock();
        $reflectionClassConstantMock2 = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getValue'])
            ->getMock();
        $reflectionClassConstantMock3 = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getValue'])
            ->getMock();
        $reflectionClassConstantMock1->method('getName')->willReturn('FOO');
        $reflectionClassConstantMock1->method('getValue')->willReturn('BAR');
        $reflectionClassConstantMock2->method('getName')->willReturn('BAR');
        $reflectionClassConstantMock2->method('getValue')->willReturn('FOO');
        $reflectionClassConstantMock3->method('getName')->willReturn('FAA');
        $reflectionClassConstantMock3->method('getValue')->willReturn('BOO');
        $reflectionClassMock->method('hasReflectionConstants')->willReturn(true);
        $reflectionClassMock->method('getReflectionConstants')->willReturn([$reflectionClassConstantMock1, $reflectionClassConstantMock2, $reflectionClassConstantMock3]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        $constants = $basePHPElement->getConstants();
        self::assertEquals("FOO", $constants[0]->getName());
        self::assertEquals("BAR", $constants[0]->getValue());
        self::assertEquals("BAR", $constants[1]->getName());
        self::assertEquals("FOO", $constants[1]->getValue());
        self::assertEquals("FAA", $constants[2]->getName());
        self::assertEquals("BOO", $constants[2]->getValue());
    }

    public function testItSetsNullAsDefaultParentClass()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertNull($basePHPElement->getParentClass());
    }

    public function testItCanParseParentClass()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $parentClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionClassMock->method('getParentClass')->willReturn($parentClassMock);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getParentClass());
    }

    public function testItReturnsCorrectInstanceForParentClass()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $parentClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionClassMock->method('getParentClass')->willReturn($parentClassMock);
        $class = new ReflectionClassParser()->parse($reflectionClassMock);
        $parentClass = $class->getParentClass();
        self::assertInstanceOf(PHPClass::class, $parentClass);
    }

    public function testItReturnsActuallyParsedParentClass()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $parentClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $parentClassMock->method('getName')->willReturn('ParentClass');
        $reflectionClassMock->method('getParentClass')->willReturn($parentClassMock);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertEquals("ParentClass", $basePHPElement->getParentClass()->getName());
    }

    public function testItSetsEmptyArraysForImplementedInterfacesIfTheyCanNotBeRead()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getImplementedInterfaces());
        self::assertIsArray($basePHPElement->getImplementedInterfaces());
        self::assertEmpty($basePHPElement->getImplementedInterfaces());
    }

    public function testItSetsEmptyArraysForImplementedInterfacesIfNoAny()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        $reflectionClassMock->method('getInterfaces')->willReturn([]);
        self::assertNotNull($basePHPElement->getImplementedInterfaces());
        self::assertIsArray($basePHPElement->getImplementedInterfaces());
        self::assertEmpty($basePHPElement->getImplementedInterfaces());
    }

    public function testItCanParseImplementedInterfaces()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionInterfaceMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionClassMock->method('getInterfaces')->willReturn([$reflectionInterfaceMock]);;
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getImplementedInterfaces());
        self::assertNotEmpty($basePHPElement->getImplementedInterfaces());
    }

    public function testItReturnsCorrectInstanceForImplementedInterface()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionInterfaceMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionClassMock->method('getInterfaces')->willReturn([$reflectionInterfaceMock]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertInstanceOf(PHPInterface::class, $basePHPElement->getImplementedInterfaces()[0]);
    }

    public function testItReturnsImplementedInterfacesWithCorrectName() {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionInterfaceMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        // ReflectionClass::getName() returns the name without a leading backslash
        $reflectionInterfaceMock->method('getName')->willReturn('Interface');
        $reflectionClassMock->method('getInterfaces')->willReturn([$reflectionInterfaceMock]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertEquals("Interface", $basePHPElement->getImplementedInterfaces()[0]->getName());
    }

    public function testItReturnsImplementedInterfacesWithCorrectNamespace()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionInterfaceMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        // getName() returns full unqualified name; getNamespaceName() returns the namespace portion
        $reflectionInterfaceMock->method('getName')->willReturn('My\Namespace\Interface');
        $reflectionInterfaceMock->method('getNamespaceName')->willReturn('\My\Namespace');
        $reflectionClassMock->method('getInterfaces')->willReturn([$reflectionInterfaceMock]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertEquals("\My\Namespace\Interface", $basePHPElement->getImplementedInterfaces()[0]->getId());
        self::assertEquals("\My\Namespace", $basePHPElement->getImplementedInterfaces()[0]->getNamespace());
    }

    public function testItReturnsAllActuallyParsedImplementedInterfaces()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionInterfaceMock1 = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionInterfaceMock2 = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionInterfaceMock3 = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        // getName() returns the name without a leading backslash (matching ReflectionClass::getName())
        $reflectionInterfaceMock1->method('getName')->willReturn('Interface1');
        $reflectionInterfaceMock2->method('getName')->willReturn('Interface2');
        $reflectionInterfaceMock3->method('getName')->willReturn('Interface3');
        $reflectionClassMock->method('getInterfaces')->willReturn([$reflectionInterfaceMock1, $reflectionInterfaceMock2, $reflectionInterfaceMock3]);
        $basePHPElement = new ReflectionClassParser()->parse($reflectionClassMock);
        self::assertEquals(3, sizeof($basePHPElement->getImplementedInterfaces()));
        self::assertEquals("Interface1", $basePHPElement->getImplementedInterfaces()[0]->getName());
        self::assertEquals("Interface2", $basePHPElement->getImplementedInterfaces()[1]->getName());
        self::assertEquals("Interface3", $basePHPElement->getImplementedInterfaces()[2]->getName());
        self::assertEquals("\Interface1", $basePHPElement->getImplementedInterfaces()[0]->getId());
        self::assertEquals("\Interface2", $basePHPElement->getImplementedInterfaces()[1]->getId());
        self::assertEquals("\Interface3", $basePHPElement->getImplementedInterfaces()[2]->getId());
    }

//    public function testItCanNotParsePhpDoc()
//    {
//        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
//        $basePHPElement = new ReflectionObjectClassParser()->parse($reflectionClassMock);
//        self::assertNull($basePHPElement->getAdditionalManager(AdditionalManagerType::PhpDocManager));
//    }
//
//    public function testItCanNotParseStubsSpecificProperties()
//    {
//        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
//        $basePHPElement = new ReflectionObjectClassParser()->parse($reflectionClassMock);
//        self::assertNull($basePHPElement->getAdditionalManager(AdditionalManagerType::StubsSpecificPropertiesManager));
//    }

    /*public function testItCanAddParsedClassToContainer()
    {
        $containerManagerCollection = new ContainerManagersCollection();
        $containerManagerCollection->setManager(EntityContainerManagerType::ClassesManager, new ReflectionEntitiesContainerManager());
        $container = new StubsContainer($containerManagerCollection);;
        new ReflectionObjectClassParser()->parseAndAddToContainer(stdClass::class, $container);
        self::assertNotEmpty($container->getClasses());
    }*/
}
