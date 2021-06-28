<?php
declare(strict_types=1);

namespace StubTests;

use PHPUnit\Framework\Exception;
use RuntimeException;
use StubTests\Model\PHPClass;
use StubTests\Model\PHPInterface;
use StubTests\Model\PHPMethod;
use StubTests\Model\PHPProperty;
use StubTests\Model\PhpVersions;
use StubTests\TestData\Providers\PhpStormStubsSingleton;

class BaseClassesTest extends BaseStubsTest
{
    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionClassesTestDataProviders::classWithParentProvider
     * @param PHPClass|PHPInterface $class
     * @throws Exception|RuntimeException
     */
    public function testClassesParent(PHPClass|PHPInterface $class)
    {
        $className = $class->name;
        if ($class instanceof PHPClass) {
            $stubClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($className);
            static::assertEquals(
                $class->parentClass,
                $stubClass->parentClass,
                empty($class->parentClass) ? "Class $className should not extend $stubClass->parentClass" :
                    "Class $className should extend $class->parentClass"
            );
        } else {
            $stubClass = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($className);
            foreach ($class->parentInterfaces as $parentInterface) {
                static::assertContains(
                    $parentInterface,
                    $stubClass->parentInterfaces,
                    "Interface $className should extend $parentInterface"
                );
            }
        }
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionMethodsProvider::classMethodsProvider
     * @param PHPClass|PHPInterface $class
     * @param PHPMethod $method
     * @throws Exception|RuntimeException
     */
    public function testClassesMethodsExist(PHPClass|PHPInterface $class, PHPMethod $method)
    {
        $className = $class->name;
        if ($class instanceof PHPClass) {
            $stubClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($className);
        } else {
            $stubClass = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($className);
        }
        static::assertArrayHasKey(
            $method->name,
            $stubClass->methods,
            "Missing method $className::$method->name"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionMethodsProvider::classFinalMethodsProvider
     * @param PHPClass|PHPInterface $class
     * @param PHPMethod $method
     * @throws RuntimeException
     */
    public function testClassesFinalMethods(PHPClass|PHPInterface $class, PHPMethod $method)
    {
        $className = $class->name;
        if ($class instanceof PHPClass) {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getClass($className)->methods[$method->name];
        } else {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($className)->methods[$method->name];
        }
        static::assertEquals(
            $method->isFinal,
            $stubMethod->isFinal,
            "Method $className::$method->name final modifier is incorrect"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionMethodsProvider::classStaticMethodsProvider
     * @param PHPClass|PHPInterface $class
     * @param PHPMethod $method
     * @throws RuntimeException
     */
    public function testClassesStaticMethods(PHPClass|PHPInterface $class, PHPMethod $method)
    {
        $className = $class->name;
        if ($class instanceof PHPClass) {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getClass($className)->methods[$method->name];
        } else {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($className)->methods[$method->name];
        }
        static::assertEquals(
            $method->isStatic,
            $stubMethod->isStatic,
            "Method $className::$method->name static modifier is incorrect"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionMethodsProvider::classMethodsWithAccessProvider
     * @param PHPClass|PHPInterface $class
     * @param PHPMethod $method
     * @throws RuntimeException
     */
    public function testClassesMethodsVisibility(PHPClass|PHPInterface $class, PHPMethod $method)
    {
        $className = $class->name;
        if ($class instanceof PHPClass) {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getClass($className)->methods[$method->name];
        } else {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($className)->methods[$method->name];
        }
        static::assertEquals(
            $method->access,
            $stubMethod->access,
            "Method $className::$method->name access modifier is incorrect"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionMethodsProvider::classMethodsWithParametersProvider
     * @param PHPClass|PHPInterface $class
     * @param PHPMethod $method
     * @throws Exception|RuntimeException
     */
    public function testClassMethodsParametersCount(PHPClass|PHPInterface $class, PHPMethod $method)
    {
        $className = $class->name;
        if ($class instanceof PHPClass) {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getClass($className)->methods[$method->name];
        } else {
            $stubMethod = PhpStormStubsSingleton::getPhpStormStubs()->getInterface($className)->methods[$method->name];
        }
        $filteredStubParameters = array_filter(
            $stubMethod->parameters,
            function ($parameter) {
                if (!empty($parameter->availableVersionsRangeFromAttribute)) {
                    return $parameter->availableVersionsRangeFromAttribute['from'] <= (doubleval(getenv('PHP_VERSION') ?? PhpVersions::getFirst()))
                        && $parameter->availableVersionsRangeFromAttribute['to'] >= (doubleval(getenv('PHP_VERSION')) ?? PhpVersions::getLatest());
                } else {
                    return true;
                }
            }
        );
        static::assertSameSize(
            $method->parameters,
            $filteredStubParameters,
            "Parameter number mismatch for method $className::$method->name. 
                         Expected: " . self::getParameterRepresentation($method)
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionClassesTestDataProviders::classesWithInterfacesProvider
     * @param PHPClass $class
     * @throws Exception|RuntimeException
     */
    public function testClassInterfaces(PHPClass $class)
    {
        $className = $class->name;
        $stubClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name);
        foreach ($class->interfaces as $interface) {
            static::assertContains(
                $interface,
                $stubClass->interfaces,
                "Class $className doesn't implement interface $interface"
            );
        }
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionPropertiesProvider::classPropertiesProvider
     * @param PHPClass $class
     * @param PHPProperty $property
     * @throws Exception|RuntimeException
     */
    public function testClassProperties(PHPClass $class, PHPProperty $property)
    {
        $className = $class->name;
        $stubClass = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name);
        static::assertArrayHasKey(
            $property->name,
            $stubClass->properties,
            "Missing property $property->access $property->type $className::$$property->name"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionPropertiesProvider::classStaticPropertiesProvider
     * @param PHPClass $class
     * @param PHPProperty $property
     * @throws RuntimeException
     */
    public function testClassStaticProperties(PHPClass $class, PHPProperty $property)
    {
        $className = $class->name;
        $stubProperty = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name)->properties[$property->name];
        static::assertEquals(
            $property->is_static,
            $stubProperty->is_static,
            "Property $className::$property->name static modifier is incorrect"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionPropertiesProvider::classPropertiesWithAccessProvider
     * @param PHPClass $class
     * @param PHPProperty $property
     * @throws RuntimeException
     */
    public function testClassPropertiesVisibility(PHPClass $class, PHPProperty $property)
    {
        $className = $class->name;
        $stubProperty = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name)->properties[$property->name];
        static::assertEquals(
            $property->access,
            $stubProperty->access,
            "Property $className::$property->name access modifier is incorrect"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionPropertiesProvider::classPropertiesWithTypeProvider
     * @param PHPClass $class
     * @param PHPProperty $property
     * @throws RuntimeException
     */
    public function testClassPropertiesType(PHPClass $class, PHPProperty $property)
    {
        $className = $class->name;
        $stubProperty = PhpStormStubsSingleton::getPhpStormStubs()->getClass($class->name)->properties[$property->name];
        static::assertEquals(
            $property->type,
            $stubProperty->type,
            "Property type doesn't match for property $className::$property->name"
        );
    }

    /**
     * @dataProvider \StubTests\TestData\Providers\Reflection\ReflectionClassesTestDataProviders::allClassesProvider
     * @throws Exception
     */
    public function testClassesExist(PHPClass|PHPInterface $class): void
    {
        $className = $class->name;
        if ($class instanceof PHPClass) {
            $stubClasses = PhpStormStubsSingleton::getPhpStormStubs()->getClasses();
        } else {
            $stubClasses = PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces();
        }
        static::assertArrayHasKey($className, $stubClasses, "Missing class $className: class $className {}");
    }
}
