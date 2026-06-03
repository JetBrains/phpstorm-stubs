<?php

namespace StubTests\Unit\Validator\Enums;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\EntityExistsCheck;
use StubTests\Unit\Validator\CheckTestCase;

class EnumExistsCheckTest extends CheckTestCase
{
    private EntityExistsCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        $this->check = new EntityExistsCheck(entityTypeConfig: EntityTypeConfig::forEnum());
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllPhpVersions(): void
    {
        $this->assertTrue($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    // ── Enum found ────────────────────────────────────────────────────────────

    public function testEnumExistsInStubs(): void
    {
        $enumId = '\RoundingMode';

        $stubs = $this->createMockStorageManager();
        $stubs->method('hasEnum')->with($enumId)->willReturn(true);

        $result = $this->check->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testNamespacedEnumExistsInStubs(): void
    {
        $enumId = '\Dom\AdjacentPosition';

        $stubs = $this->createMockStorageManager();
        $stubs->method('hasEnum')->with($enumId)->willReturn(true);

        $result = $this->check->run($stubs, $enumId, '8.4');

        $this->assertFalse($result->hasFailures());
    }

    // ── Enum not found ────────────────────────────────────────────────────────

    public function testEnumNotFoundInStubsIsFailure(): void
    {
        $enumId = '\MissingEnum';

        $stubs = $this->createMockStorageManager();
        $stubs->method('hasEnum')->willReturn(false);

        $result = $this->check->run($stubs, $enumId, '8.1');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($enumId, $failures);
        $this->assertStringContainsString('Enum', $failures[$enumId]);
        $this->assertStringContainsString('exists in PHP 8.1 but not in stubs', $failures[$enumId]);
    }

    public function testErrorMessageContainsEnumNotClass(): void
    {
        $enumId = '\RoundingMode';

        $stubs = $this->createMockStorageManager();
        $stubs->method('hasEnum')->willReturn(false);

        $result = $this->check->run($stubs, $enumId, '8.1');

        $failures = $result->getFailures();
        $this->assertStringContainsString('Enum', $failures[$enumId]);
        $this->assertStringNotContainsString('Class', $failures[$enumId]);
        $this->assertStringNotContainsString('Interface', $failures[$enumId]);
    }

    public function testDifferentPhpVersionsInErrorMessage(): void
    {
        $enumId = '\MissingEnum';

        $stubs = $this->createMockStorageManager();
        $stubs->method('hasEnum')->willReturn(false);

        $result81 = $this->check->run($stubs, $enumId, '8.1');
        $result84 = $this->check->run($stubs, $enumId, '8.4');

        $this->assertStringContainsString('PHP 8.1', $result81->getFailures()[$enumId]);
        $this->assertStringContainsString('PHP 8.4', $result84->getFailures()[$enumId]);
    }
}
