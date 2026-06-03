<?php

namespace StubTests\Unit\DataProviders;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\DataProvider\CurrentRuntimeReflectionRawDataProvider;

class CurrentRuntimeReflectionDataProviderTest extends TestCase
{
    public function testItReturnsArrayOfFunctions()
    {
        self::assertIsArray(new CurrentRuntimeReflectionRawDataProvider()->getReflectionFunctions());
    }

    public function testItReturnsNotEmptyArrayOfFunctions()
    {
        self::assertNotEmpty(new CurrentRuntimeReflectionRawDataProvider()->getReflectionFunctions());
    }

    public function testItDoesNotReturnUsersFunctions()
    {
        $fake = <<<PHP
function my_custom_function(string \$package, string \$version, string \$message, mixed ...\$args): void {}
PHP;
        eval($fake);
        self::assertTrue(function_exists('my_custom_function'));
        $reflectionFunctions = new CurrentRuntimeReflectionRawDataProvider()->getReflectionFunctions();
        self::assertFalse(array_key_exists('my_custom_function', $reflectionFunctions));
    }

    public function testItReturnsOnlyInternalFunctions()
    {
        $reflectionFunctions = new CurrentRuntimeReflectionRawDataProvider()->getReflectionFunctions();
        self::assertTrue(in_array('exit', $reflectionFunctions));
    }

    public function testItReturnsAllRuntimeInternalFunctions()
    {
        $reflectionFunctions = new CurrentRuntimeReflectionRawDataProvider()->getReflectionFunctions();
        self::assertGreaterThan(500, sizeof($reflectionFunctions));
    }

    public function testItReturnsArrayOfClasses()
    {
        self::assertIsArray(new CurrentRuntimeReflectionRawDataProvider()->getReflectionClasses());
    }

    public function testItReturnsNotEmptyArrayOfClasses()
    {
        self::assertNotEmpty(new CurrentRuntimeReflectionRawDataProvider()->getReflectionClasses());
    }

    public function testItReturnsArrayOfActualClasses()
    {
        self::assertFalse(in_array('PropertyHookType', new CurrentRuntimeReflectionRawDataProvider()->getReflectionClasses()));
        self::assertFalse(in_array('Traversable', new CurrentRuntimeReflectionRawDataProvider()->getReflectionClasses()));
        self::assertTrue(in_array('stdClass', new CurrentRuntimeReflectionRawDataProvider()->getReflectionClasses()));
    }

    public function testItDoesNotReturnUsersClasses()
    {
        $fake = <<<PHP
class MyFakeClass {}
PHP;
        eval($fake);
        self::assertTrue(class_exists('MyFakeClass'));
        self::assertFalse(in_array('MyFakeClass', new CurrentRuntimeReflectionRawDataProvider()->getReflectionClasses()));
    }

    public function testItReturnsAllInternalClasses()
    {
        $reflectionClasses = new CurrentRuntimeReflectionRawDataProvider()->getReflectionClasses();
        self::assertGreaterThan(200, sizeof($reflectionClasses));
    }

    public function testItReturnsArrayOfInterfaces()
    {
        self::assertIsArray(new CurrentRuntimeReflectionRawDataProvider()->getReflectionInterfaces());
    }

    public function testItReturnsNotEmptyArrayOfInterfaces()
    {
        self::assertNotEmpty(new CurrentRuntimeReflectionRawDataProvider()->getReflectionInterfaces());
    }

    public function testItReturnsActualInterfaces()
    {
        self::assertFalse(in_array('PropertyHookType', new CurrentRuntimeReflectionRawDataProvider()->getReflectionInterfaces()));
        self::assertFalse(in_array('stdClass', new CurrentRuntimeReflectionRawDataProvider()->getReflectionInterfaces()));
        self::assertTrue(in_array('Traversable', new CurrentRuntimeReflectionRawDataProvider()->getReflectionInterfaces()));
    }

    public function testItDoesNotReturnUsersInterfaces()
    {
        $fake = <<<PHP
interface MyFakeInterface {}
PHP;
        eval($fake);
        self::assertTrue(interface_exists('MyFakeInterface'));
        self::assertFalse(in_array('MyFakeInterface', new CurrentRuntimeReflectionRawDataProvider()->getReflectionInterfaces()));
    }

    public function testItReturnsAllInternalInterfaces()
    {
        $reflectionInterfaces = new CurrentRuntimeReflectionRawDataProvider()->getReflectionInterfaces();
        self::assertGreaterThan(25, sizeof($reflectionInterfaces));
    }

    public function testItReturnsArrayOfEnums()
    {
        self::assertIsArray(new CurrentRuntimeReflectionRawDataProvider()->getReflectionEnums());
    }

    public function testItReturnsNotEmptyArrayOfEnums()
    {
        self::assertNotEmpty(new CurrentRuntimeReflectionRawDataProvider()->getReflectionEnums());
    }

    public function testItReturnsActualEnums()
    {
        self::assertFalse(in_array('Traversable', new CurrentRuntimeReflectionRawDataProvider()->getReflectionEnums()));
        self::assertFalse(in_array('stdClass', new CurrentRuntimeReflectionRawDataProvider()->getReflectionEnums()));
        self::assertTrue(in_array('PropertyHookType', new CurrentRuntimeReflectionRawDataProvider()->getReflectionEnums()));
    }

    public function testItDoesNotReturnUsersEnums()
    {
        $fake = <<<PHP
enum FakeEnum {}
PHP;
        eval($fake);
        self::assertTrue(enum_exists('FakeEnum'));
        self::assertFalse(in_array('FakeEnum', new CurrentRuntimeReflectionRawDataProvider()->getReflectionEnums()));
    }

    public function testItReturnsAllInternalEnums()
    {
        $reflectionEnums = new CurrentRuntimeReflectionRawDataProvider()->getReflectionEnums();
        self::assertGreaterThanOrEqual(4, sizeof($reflectionEnums));
    }

    public function testItReturnsArrayOfConstants()
    {
        self::assertIsArray(new CurrentRuntimeReflectionRawDataProvider()->getReflectionConstants());
    }

    public function testItReturnsNotEmptyArrayOfConstants()
    {
        self::assertNotEmpty(new CurrentRuntimeReflectionRawDataProvider()->getReflectionConstants());
    }

    public function testItReturnsInternalConstants()
    {
        self::assertTrue(array_key_exists('PHP_VERSION', new CurrentRuntimeReflectionRawDataProvider()->getReflectionConstants()));
    }

    public function testItDoesNotReturnUsersConstants()
    {
        $fake = <<<PHP
define('STUB_TESTS_CONSTANT', 'MySomeRandomConstant');
PHP;
        eval($fake);
        self::assertTrue(defined('STUB_TESTS_CONSTANT'));
        $reflectionConstants = new CurrentRuntimeReflectionRawDataProvider()->getReflectionConstants();
        self::assertFalse(array_key_exists('STUB_TESTS_CONSTANT', $reflectionConstants));
    }

    public function testItContainsAllConstants()
    {
        $reflectionConstants = new CurrentRuntimeReflectionRawDataProvider()->getReflectionConstants();
        self::assertGreaterThan(500, sizeof($reflectionConstants));
    }

    public function testConstantsDoNotIncludeUserCategory()
    {
        // Define user constant
        $fake = <<<PHP
define('STUB_TESTS_USER_CONSTANT_2', 'TestValue');
PHP;
        eval($fake);
        self::assertTrue(defined('STUB_TESTS_USER_CONSTANT_2'));

        $reflectionConstants = new CurrentRuntimeReflectionRawDataProvider()->getReflectionConstants();

        // User constants should not be included
        self::assertArrayNotHasKey('STUB_TESTS_USER_CONSTANT_2', $reflectionConstants);

        // Verify internal constants are included
        self::assertArrayHasKey('PHP_VERSION', $reflectionConstants);
    }
}
