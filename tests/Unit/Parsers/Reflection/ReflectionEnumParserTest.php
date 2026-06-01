<?php

namespace StubTests\Unit\Parsers\Reflection;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Model\PHPEnum;
use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Reflection\ReflectionEnumParser;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClass;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClassConstant;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionMethod;

class ReflectionEnumParserTest extends TestCase
{
    public function testItCanParseInternalEnums()
    {
        $stubReflectionClass = $this->getMockBuilder(AdaptedReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $stubReflectionClass->method('isInternal')->willReturn(true);
        $stubReflectionClass->method('isEnum')->willReturn(true);
        self::assertTrue(new ReflectionEnumParser()->canParse($stubReflectionClass));
    }

    public function testItCanNotParseUserEnums()
    {
        $stubReflectionClass = $this->getMockBuilder(AdaptedReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $stubReflectionClass->method('isInternal')->willReturn(false);
        $stubReflectionClass->method('isEnum')->willReturn(true);
        self::assertFalse(new ReflectionEnumParser()->canParse($stubReflectionClass));
    }

    public function testItCanNotParseInternalNonEnum()
    {
        $stubReflectionClass = $this->getMockBuilder(AdaptedReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $stubReflectionClass->method('isInternal')->willReturn(true);
        $stubReflectionClass->method('isEnum')->willReturn(false);
        self::assertFalse(new ReflectionEnumParser()->canParse($stubReflectionClass));
    }

    public function testItCanNotParseUsersNonEnum()
    {
        $stubReflectionClass = $this->getMockBuilder(AdaptedReflectionClass::class)
            ->disableOriginalConstructor()
            ->getMock();
        $stubReflectionClass->method('isInternal')->willReturn(false);
        $stubReflectionClass->method('isEnum')->willReturn(false);
        self::assertFalse(new ReflectionEnumParser()->canParse($stubReflectionClass));
    }

    public function testItReturnsCorrectInstanceOfEnum()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionMock);
        self::assertTrue($basePHPElement instanceof PHPEnum);
    }

    public function testItCanParseName()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMock->method('getShortName')->willReturn('Foo');
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionMock);
        self::assertEquals('Foo', $basePHPElement->getName());
    }

    public function testItCanParseNamespace()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMock->method('getNamespaceName')->willReturn('MyNameSpace\SubNameSpace');
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionMock);
        self::assertEquals('\MyNameSpace\SubNameSpace', $basePHPElement->getNamespace());
    }

    public function testItCanParseRootNamespace()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMock->method('getNamespaceName')->willReturn('');
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionMock);
        self::assertEquals('\\', $basePHPElement->getNamespace());
    }

    public function testItCanParseId()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMock->method('getShortName')->willReturn('SomeFooClass');
        $reflectionMock->method('getName')->willReturn('SomeNamespace\SubNamespace\SomeFooClass');
        $reflectionMock->method('getNamespaceName')->willReturn('SomeNamespace\SubNamespace');
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionMock);
        self::assertEquals('\SomeNamespace\SubNamespace\SomeFooClass', $basePHPElement->getId());
    }

    public function testItCanParseIdWithRootNamespace()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMock->method('getShortName')->willReturn('SomeFooClass');
        $reflectionMock->method('getName')->willReturn('SomeFooClass');
        $reflectionMock->method('getNamespaceName')->willReturn('');
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionMock);
        self::assertEquals('\SomeFooClass', $basePHPElement->getId());
    }

    public function testItCanParseFinalEnum()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMock->method('isFinal')->willReturn(true);
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionMock);
        self::assertTrue($basePHPElement->isFinal());
    }

    public function testItCanParseNonFinalEnum()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMock->method('isFinal')->willReturn(false);
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionMock);
        self::assertFalse($basePHPElement->isFinal());
    }

    public function testItCanParseReadonlyEnum()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMock->method('isReadOnly')->willReturn(true);
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionMock);
        self::assertTrue($basePHPElement->isReadonly());
    }

    public function testItCanParseNonReadonlyEnum()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMock->method('isReadOnly')->willReturn(false);
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionMock);
        self::assertFalse($basePHPElement->isReadonly());
    }

    public function testItReturnsEmptyArrayIfMethodsCanNotBeRead()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $basePhpElement = new ReflectionEnumParser()->parse($reflectionMock);
        self::assertIsArray($basePhpElement->getMethods());
        self::assertEmpty($basePhpElement->getMethods());
    }

    public function testItReturnsEmptyArrayIfThereAreNoMethods()
    {
        $reflectionMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $basePhpElement = new ReflectionEnumParser()->parse($reflectionMock);
        self::assertIsArray($basePhpElement->getMethods());
        self::assertEmpty($basePhpElement->getMethods());
    }

    public function testItCanParseMethods()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionMethodMock->method('getName')->willReturn('someMethod');
        $reflectionClassMock->method('getMethods')->willReturn([$reflectionMethodMock]);
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionClassMock);
        self::assertIsArray($basePHPElement->getMethods());
        self::assertNotNull($basePHPElement->getMethods());
        self::assertNotEmpty($basePHPElement->getMethods());
    }

    public function testItReturnsCorrectInstanceOfMethods()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionMethodMock = $this->getMockBuilder(AdaptedReflectionMethod::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $reflectionMethodMock->method('getName')->willReturn('someMethod');
        $reflectionClassMock->method('getMethods')->willReturn([$reflectionMethodMock]);
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionClassMock);
        self::assertInstanceOf(PHPMethod::class, $basePHPElement->getMethods()[0]);
    }

    public function testItReturnsActuallyParsedMethods()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getMethods'])
            ->getMock();
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
        $reflectionMethodMock1->method('getName')->willReturn('someMethod1');
        $reflectionMethodMock2->method('getName')->willReturn('someMethod2');
        $reflectionMethodMock3->method('getName')->willReturn('someMethod3');
        $reflectionClassMock->method('getMethods')->willReturn([$reflectionMethodMock1, $reflectionMethodMock2, $reflectionMethodMock3]);
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionClassMock);
        $firstMethod = $basePHPElement->getMethods()[0];
        $secondMethod = $basePHPElement->getMethods()[1];
        $thirdMethod = $basePHPElement->getMethods()[2];
        self::assertInstanceOf(PHPMethod::class, $firstMethod);
        self::assertInstanceOf(PHPMethod::class, $secondMethod);
        self::assertInstanceOf(PHPMethod::class, $thirdMethod);
        self::assertEquals('someMethod1', $firstMethod->getName());
        self::assertEquals('someMethod2', $secondMethod->getName());
        self::assertEquals('someMethod3', $thirdMethod->getName());
    }

    public function testItReturnsEmptyArrayIfConstantsCanNotBeRead()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $basePhpElement = new ReflectionEnumParser()->parse($reflectionClassMock);
        self::assertIsArray($basePhpElement->getConstants());
        self::assertEmpty($basePhpElement->getConstants());
    }

    public function testItReturnsEmptyArrayIfThereAreNoConstants()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionClassMock->method('getConstants')->willReturn([]);
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionClassMock);
        self::assertIsArray($basePHPElement->getConstants());
        self::assertEmpty($basePHPElement->getConstants());
    }

    public function testItCanParseEnumConstantsPhp56()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionClassMock->method('hasReflectionConstants')->willReturn(false);
        $reflectionClassMock->method('getConstants')->willReturn(['FOO' => 'BAR']);
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionClassMock);
        self::assertIsArray($basePHPElement->getConstants());
        self::assertNotNull($basePHPElement->getConstants());
        self::assertNotEmpty($basePHPElement->getConstants());
    }

    public function testItCanParseClassConstantsPhp71()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['hasReflectionConstants', 'getReflectionConstants'])
            ->getMock();
        $reflectionClassConstantMock = $this->getMockBuilder(AdaptedReflectionClassConstant::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName', 'getValue'])
            ->getMock();
        $reflectionClassConstantMock->method('getName')->willReturn('FOO');
        $reflectionClassConstantMock->method('getValue')->willReturn('BAR');
        $reflectionClassMock->method('hasReflectionConstants')->willReturn(true);
        $reflectionClassMock->method('getReflectionConstants')->willReturn([$reflectionClassConstantMock]);
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionClassMock);
        self::assertIsArray($basePHPElement->getConstants());
        self::assertNotNull($basePHPElement->getConstants());
        self::assertNotEmpty($basePHPElement->getConstants());
    }

    public function testItReturnsEmptyArrayIfImplementedInterfacesCanNotBeRead()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getImplementedInterfaces());
        self::assertIsArray($basePHPElement->getImplementedInterfaces());
        self::assertEmpty($basePHPElement->getImplementedInterfaces());
    }

    public function testItReturnsEmptyArrayIfThereAreNoImplementedInterfaces()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionClassMock->method('getInterfaces')->willReturn([]);
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getImplementedInterfaces());
        self::assertIsArray($basePHPElement->getImplementedInterfaces());
        self::assertEmpty($basePHPElement->getImplementedInterfaces());
    }

    public function testItCanParseImplementedInterfaces()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $implementedInterfaceMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $implementedInterfaceMock->method('getName')->willReturn('Foo');
        $reflectionClassMock->method('getInterfaces')->willReturn([$implementedInterfaceMock]);
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getImplementedInterfaces());
        self::assertNotEmpty($basePHPElement->getImplementedInterfaces());
    }

    public function testItReturnsCorrectInstanceOfImplementedInterfaces()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $implementedInterfaceMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $implementedInterfaceMock->method('getName')->willReturn('Foo');
        $reflectionClassMock->method('getInterfaces')->willReturn([$implementedInterfaceMock]);
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionClassMock);
        self::assertInstanceOf(PHPInterface::class, $basePHPElement->getImplementedInterfaces()[0]);
    }

    public function testItReturnsAllParsedImplementedInterfaces()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $implementedInterfaceMock1 = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $implementedInterfaceMock2 = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $implementedInterfaceMock3 = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $implementedInterfaceMock1->method('getName')->willReturn('Foo1');
        $implementedInterfaceMock2->method('getName')->willReturn('Foo2');
        $implementedInterfaceMock3->method('getName')->willReturn('Foo3');
        $reflectionClassMock->method('getInterfaces')->willReturn([$implementedInterfaceMock1, $implementedInterfaceMock2, $implementedInterfaceMock3]);
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionClassMock);
        self::assertCount(3, $basePHPElement->getImplementedInterfaces());
        self::assertContainsOnlyInstancesOf(PHPInterface::class, $basePHPElement->getImplementedInterfaces());
    }

    public function testItReturnsImplementedInterfacesWithCorrentName()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $implementedInterfaceMock1 = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $implementedInterfaceMock2 = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $implementedInterfaceMock1->method('getName')->willReturn('Foo1');
        $implementedInterfaceMock2->method('getName')->willReturn('Foo2');
        $reflectionClassMock->method('getInterfaces')->willReturn([$implementedInterfaceMock1, $implementedInterfaceMock2]);
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionClassMock);
        self::assertEquals('Foo1', $basePHPElement->getImplementedInterfaces()[0]->getName());
        self::assertEquals('Foo2', $basePHPElement->getImplementedInterfaces()[1]->getName());
    }

    public function testItReturnsImplementedInterfacesWithCorrentNamespace()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $implementedInterfaceMock1 = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $implementedInterfaceMock2 = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $implementedInterfaceMock1->method('getName')->willReturn('\Foo1');
        $implementedInterfaceMock1->method('getNamespaceName')->willReturn('\MyNameSpace');
        $implementedInterfaceMock2->method('getName')->willReturn('\Foo2');
        $implementedInterfaceMock2->method('getNamespaceName')->willReturn('\MyNameSpace');
        $reflectionClassMock->method('getInterfaces')->willReturn([$implementedInterfaceMock1, $implementedInterfaceMock2]);
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionClassMock);
        self::assertEquals('\MyNameSpace', $basePHPElement->getImplementedInterfaces()[0]->getNamespace());
        self::assertEquals('\MyNameSpace', $basePHPElement->getImplementedInterfaces()[1]->getNamespace());
    }

    /*public function testItDoesNotContainPhpDocManager()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $basePHPElement = new ReflectionEnumParser()->parse($reflectionClassMock);
        self::assertFalse($basePHPElement->canGetDataFromPhpDoc());
    }

    public function testItDoesNotContainStubsSpecificManager()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $basePHPElement = new ReflectionObjectEnumParser()->parse($reflectionClassMock);
        self::assertNull($basePHPElement->getAdditionalManager(AdditionalManagerType::StubsSpecificPropertiesManager));
    }

    public function testItDoesNotReturnNullIfNoCases()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionClassMock->method('getCases')->willReturn([]);
        $basePHPElement = new ReflectionObjectEnumParser()->parse($reflectionClassMock);
        self::assertNotNull($basePHPElement->getCases());
    }

    public function testItReturnsEmptyArrayIfNoCases()
    {
        $reflectionClassMock = $this->getMockBuilder(AdaptedReflectionClass::class)->disableOriginalConstructor()->getMock();
        $reflectionClassMock->method('getCases')->willReturn([]);
        $basePHPElement = new ReflectionObjectEnumParser()->parse($reflectionClassMock);
        self::assertTrue(is_array($basePHPElement->getCases()));;
        self::assertEmpty($basePHPElement->getCases());
    }

    public function testItCanParseEnumValues()
    {
        $parsedEnum = new ReflectionObjectEnumParser()->parse(new ReflectionEnum(PropertyHookType::class));
        self::assertEquals(2, sizeof($parsedEnum->getCases()));
    }

    public function testItCanAddParsedClassToContainer()
    {
        $containerManagerCollection = new ContainerManagersCollection();
        $containerManagerCollection->setManager(EntityContainerManagerType::EnumsManager, new ReflectionEntitiesContainerManager());
        $container = new StubsContainer($containerManagerCollection);;
        new ReflectionObjectEnumParser()->parseAndAddToContainer(PropertyHookType::class, $container);
        self::assertNotEmpty($container->getEnums());
    }*/
}
