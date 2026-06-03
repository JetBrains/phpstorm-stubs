<?php

namespace StubTests\Unit\Validator\Meta;

use StubTests\Framework\Validator\Meta\ConstantsReferenceExistsCheck;
use StubTests\Framework\Validator\Services\EntityLookupService;
use StubTests\Unit\Validator\CheckTestCase;

class ConstantsReferenceExistsCheckTest extends CheckTestCase
{
    public function testClassConstantFound(): void
    {
        $constant = $this->makeClassConstant('ATTR_DRIVER_NAME');
        $class = $this->makeClass('\\PDO', constants: [$constant]);

        $entityLookup = new EntityLookupService();
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$class]);
        $stubs->method('getInterfaces')->willReturn([]);
        $stubs->method('getEnums')->willReturn([]);

        $check = new ConstantsReferenceExistsCheck($entityLookup);
        $result = $check->run($stubs, 'class_const|\\PDO::ATTR_DRIVER_NAME', '8.0');
        $this->assertFalse($result->hasFailures());
    }

    public function testClassConstantNotFound(): void
    {
        $class = $this->makeClass('\\PDO', constants: []);

        $entityLookup = new EntityLookupService();
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$class]);
        $stubs->method('getInterfaces')->willReturn([]);
        $stubs->method('getEnums')->willReturn([]);

        $check = new ConstantsReferenceExistsCheck($entityLookup);
        $result = $check->run($stubs, 'class_const|\\PDO::NONEXISTENT', '8.0');
        $this->assertTrue($result->hasFailures());
    }

    public function testClassNotFound(): void
    {
        $entityLookup = new EntityLookupService();
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([]);
        $stubs->method('getInterfaces')->willReturn([]);
        $stubs->method('getEnums')->willReturn([]);

        $check = new ConstantsReferenceExistsCheck($entityLookup);
        $result = $check->run($stubs, 'class_const|\\Unknown::FOO', '8.0');
        $this->assertTrue($result->hasFailures());
    }

    public function testGlobalConstantFound(): void
    {
        $constant = $this->makeGlobalConstant('\\PHP_INT_MAX', 9223372036854775807);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn([$constant]);

        $check = new ConstantsReferenceExistsCheck();
        $result = $check->run($stubs, 'global_const|\\PHP_INT_MAX', '8.0');
        $this->assertFalse($result->hasFailures());
    }

    public function testGlobalConstantNotFound(): void
    {
        $stubs = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn([]);

        $check = new ConstantsReferenceExistsCheck();
        $result = $check->run($stubs, 'global_const|\\NONEXISTENT', '8.0');
        $this->assertTrue($result->hasFailures());
    }

    public function testSupportsAllVersions(): void
    {
        $check = new ConstantsReferenceExistsCheck();
        $this->assertTrue($check->supports('5.6'));
        $this->assertTrue($check->supports('8.4'));
    }
}
