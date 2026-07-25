<?php

namespace StubTests\Unit\Validator\Functions;

use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\EntityExistsCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

/**
 * Exercises the function variant of EntityExistsCheck (driven by EntityTypeConfig::forFunction()).
 * The dedicated FunctionExistsCheck class was merged into EntityExistsCheck.
 */
class FunctionExistsCheckTest extends CheckTestCase
{
    private EntityExistsCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new EntityExistsCheck(entityTypeConfig: EntityTypeConfig::forFunction());
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    public function testSupportsAllPhpVersions(): void
    {
        $this->assertTrue($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    public function testFunctionExistsInStubs(): void
    {
        // Arrange
        $functionName = 'array_map';
        $mockFunction = $this->createMockFunction($functionName);

        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$mockFunction]);

        // Act
        $result = $this->check->run($stubsManager, $functionName, '8.0');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
        $this->assertCount(1, $result->getSuccesses());
    }

    public function testFunctionNotFoundInStubs(): void
    {
        // Arrange
        $functionName = 'missing_function';
        $mockFunction = $this->createMockFunction('array_map');

        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$mockFunction]);

        // Act
        $result = $this->check->run($stubsManager, $functionName, '8.0');

        // Assert
        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());
        $this->assertEquals(0, $result->getSuccessCount());

        $failures = $result->getFailures();
        $this->assertArrayHasKey($functionName, $failures);
        $this->assertStringContainsString('exists in PHP 8.0 but not in stubs', $failures[$functionName]);
    }

    public function testFunctionExistsAmongMultipleFunctions(): void
    {
        // Arrange
        $functionName = 'array_filter';
        $mockFunctions = [
            $this->createMockFunction('array_map'),
            $this->createMockFunction('array_filter'),
            $this->createMockFunction('array_reduce'),
        ];

        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn($mockFunctions);

        // Act
        $result = $this->check->run($stubsManager, $functionName, '8.0');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testEmptyFunctionsArray(): void
    {
        // Arrange
        $functionName = 'any_function';

        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([]);

        // Act
        $result = $this->check->run($stubsManager, $functionName, '8.0');

        // Assert
        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());
    }

    public function testFunctionFoundByGetIdMethod(): void
    {
        // Arrange
        $functionName = 'test_function';

        // Create a mock that has getId but not getName
        $mockFunction = $this->createMock(\StubTests\Framework\Parsers\Model\PHPFunction::class);
        $mockFunction->method('getId')->willReturn($functionName);

        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$mockFunction]);

        // Act
        $result = $this->check->run($stubsManager, $functionName, '8.0');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testFunctionNotFoundWhenIdMismatches(): void
    {
        // Arrange — getId() does not match the searched entityId
        $mockFunction = $this->createMock(\StubTests\Framework\Parsers\Model\PHPFunction::class);
        $mockFunction->method('getId')->willReturn('different_id');
        $mockFunction->method('getName')->willReturn('test_function');

        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([$mockFunction]);

        // Act — lookup is by getId(), not getName()
        $result = $this->check->run($stubsManager, 'test_function', '8.0');

        // Assert — should fail because no function with getId() === 'test_function'
        $this->assertTrue($result->hasFailures());
    }

    public function testKnownProblemSkipsFunctionExistenceCheck(): void
    {
        // A missing function is suppressed by a known problem keyed on (FUNCTION, EntityExistsCheck).
        $functionName = '\\deliberately_absent';

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: $functionName,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::ENTITY_EXISTS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Function is provided at C level without a stub'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);
        $check = new EntityExistsCheck(entityTypeConfig: EntityTypeConfig::forFunction(), knownProblemsRegistry: $registry);

        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getFunctions')->willReturn([]);

        $result = $check->run($stubsManager, $functionName, '8.0');

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        $this->assertStringContainsString('skipped', $successes[0]);
        $this->assertStringContainsString('C level', $successes[0]);
    }
}
