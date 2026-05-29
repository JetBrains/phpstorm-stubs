<?php

namespace StubTests\Unit\Validator\Classes;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\EntityNamespaceCheck;
use StubTests\Unit\Validator\CheckTestCase;

class ClassNamespaceCheckTest extends CheckTestCase
{
    private EntityNamespaceCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        $this->check = new EntityNamespaceCheck(entityTypeConfig: EntityTypeConfig::forClass());
    }

    public function testSupportsAllPhpVersions(): void
    {
        $this->assertTrue($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    public function testClassWithCorrectNamespace(): void
    {
        // Arrange
        $className = 'Foo\\Bar\\MyClass';
        $expectedNamespace = 'Foo\\Bar';

        $stubClass = $this->createMockClassWithProperties($className, $expectedNamespace);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        // Act
        $result = $this->check->run($stubsManager, $className, '8.0');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testClassWithoutNamespace(): void
    {
        // Arrange
        $className = 'DateTime';
        $expectedNamespace = null;

        $stubClass = $this->createMockClassWithProperties($className, $expectedNamespace);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        // Act
        $result = $this->check->run($stubsManager, $className, '8.0');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testNamespaceMismatch(): void
    {
        // Arrange
        $className = 'Foo\\Bar\\MyClass';
        $wrongNamespace = 'Baz\\Qux'; // Should be 'Foo\Bar'

        $stubClass = $this->createMockClassWithProperties($className, $wrongNamespace);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        // Act
        $result = $this->check->run($stubsManager, $className, '8.0');

        // Assert
        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());

        $failures = $result->getFailures();
        $this->assertArrayHasKey($className, $failures);
        $this->assertStringContainsString('Namespace mismatch', $failures[$className]);
        $this->assertStringContainsString('Foo\\Bar', $failures[$className]);
        $this->assertStringContainsString('Baz\\Qux', $failures[$className]);
    }

    public function testClassNotFoundInStubs(): void
    {
        // Arrange
        $className = 'MissingClass';

        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([]);

        // Act
        $result = $this->check->run($stubsManager, $className, '8.0');

        // Assert
        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());

        $failures = $result->getFailures();
        $this->assertArrayHasKey($className, $failures);
        $this->assertStringContainsString('not found in stubs', $failures[$className]);
    }

    public function testNestedNamespace(): void
    {
        // Arrange
        $className = 'Foo\\Bar\\Baz\\Qux\\MyClass';
        $expectedNamespace = 'Foo\\Bar\\Baz\\Qux';

        $stubClass = $this->createMockClassWithProperties($className, $expectedNamespace);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        // Act
        $result = $this->check->run($stubsManager, $className, '8.0');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testClassWithNullNamespaceShouldMatchGlobalNamespace(): void
    {
        // Arrange
        $className = 'SimpleClass'; // No namespace in ID
        $classNamespace = null; // No namespace set in class

        $stubClass = $this->createMockClassWithProperties($className, $classNamespace);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        // Act
        $result = $this->check->run($stubsManager, $className, '7.4');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testRootNamespaceClass(): void
    {
        // Arrange
        // Classes in root namespace have IDs like '\stdClass' (leading backslash)
        // and namespace set to '\' (backslash) according to framework convention
        $className = '\\stdClass';
        $expectedNamespace = '\\';

        $stubClass = $this->createMockClassWithProperties($className, $expectedNamespace);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        // Act
        $result = $this->check->run($stubsManager, $className, '8.0');

        // Assert
        $this->assertFalse($result->hasFailures(), 'Root namespace class should pass validation');
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testRootNamespaceClassWithWrongNamespace(): void
    {
        // Arrange
        $className = '\\Exception';
        $wrongNamespace = ''; // Wrong: should be '\' for root namespace

        $stubClass = $this->createMockClassWithProperties($className, $wrongNamespace);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        // Act
        $result = $this->check->run($stubsManager, $className, '8.0');

        // Assert
        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());

        $failures = $result->getFailures();
        $this->assertArrayHasKey($className, $failures);
        $this->assertStringContainsString('Namespace mismatch', $failures[$className]);
    }
}
