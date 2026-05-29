<?php

namespace StubTests\Unit\Validator\Classes;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\EntityExistsCheck;
use StubTests\Unit\Validator\CheckTestCase;

class ClassExistsCheckTest extends CheckTestCase
{
    private EntityExistsCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        $this->check = new EntityExistsCheck(entityTypeConfig: EntityTypeConfig::forClass());
    }

    public function testSupportsAllPhpVersions(): void
    {
        $this->assertTrue($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    public function testClassExistsInStubs(): void
    {
        // Arrange
        $className = 'DateTime';

        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('hasClass')->with($className)->willReturn(true);

        // Act
        $result = $this->check->run($stubsManager, $className, '8.0');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
        $this->assertCount(1, $result->getSuccesses());
    }

    public function testClassNotFoundInStubs(): void
    {
        // Arrange
        $className = 'MissingClass';

        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('hasClass')->with($className)->willReturn(false);

        // Act
        $result = $this->check->run($stubsManager, $className, '8.0');

        // Assert
        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());
        $this->assertEquals(0, $result->getSuccessCount());

        $failures = $result->getFailures();
        $this->assertArrayHasKey($className, $failures);
        $this->assertStringContainsString('exists in PHP 8.0 but not in stubs', $failures[$className]);
    }

    public function testNamespacedClassExistsInStubs(): void
    {
        // Arrange
        $className = '\\Namespace\\MyClass';

        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('hasClass')->with($className)->willReturn(true);

        // Act
        $result = $this->check->run($stubsManager, $className, '8.0');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testDifferentPhpVersionsInErrorMessage(): void
    {
        // Arrange
        $className = 'MissingClass';

        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('hasClass')->willReturn(false);

        // Act
        $result56 = $this->check->run($stubsManager, $className, '5.6');
        $result80 = $this->check->run($stubsManager, $className, '8.0');

        // Assert
        $failures56 = $result56->getFailures();
        $failures80 = $result80->getFailures();

        $this->assertStringContainsString('PHP 5.6', $failures56[$className]);
        $this->assertStringContainsString('PHP 8.0', $failures80[$className]);
    }
}
