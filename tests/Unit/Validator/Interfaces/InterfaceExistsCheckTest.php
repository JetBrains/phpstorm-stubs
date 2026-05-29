<?php

namespace StubTests\Unit\Validator\Interfaces;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\EntityExistsCheck;
use StubTests\Unit\Validator\CheckTestCase;

class InterfaceExistsCheckTest extends CheckTestCase
{
    private EntityExistsCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        $this->check = new EntityExistsCheck(entityTypeConfig: EntityTypeConfig::forInterface());
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllPhpVersions(): void
    {
        $this->assertTrue($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    // ── Interface found ───────────────────────────────────────────────────────

    public function testInterfaceExistsInStubs(): void
    {
        $interfaceId = '\Iterator';

        $stubs = $this->createMockStorageManager();
        $stubs->method('hasInterface')->with($interfaceId)->willReturn(true);

        $result = $this->check->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testNamespacedInterfaceExistsInStubs(): void
    {
        $interfaceId = '\Random\Engine';

        $stubs = $this->createMockStorageManager();
        $stubs->method('hasInterface')->with($interfaceId)->willReturn(true);

        $result = $this->check->run($stubs, $interfaceId, '8.2');

        $this->assertFalse($result->hasFailures());
    }

    // ── Interface not found ───────────────────────────────────────────────────

    public function testInterfaceNotFoundInStubsIsFailure(): void
    {
        $interfaceId = '\MissingInterface';

        $stubs = $this->createMockStorageManager();
        $stubs->method('hasInterface')->willReturn(false);

        $result = $this->check->run($stubs, $interfaceId, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($interfaceId, $failures);
        $this->assertStringContainsString('Interface', $failures[$interfaceId]);
        $this->assertStringContainsString('exists in PHP 8.0 but not in stubs', $failures[$interfaceId]);
    }

    public function testErrorMessageContainsInterfaceNotClass(): void
    {
        $interfaceId = '\Countable';

        $stubs = $this->createMockStorageManager();
        $stubs->method('hasInterface')->willReturn(false);

        $result = $this->check->run($stubs, $interfaceId, '8.0');

        $failures = $result->getFailures();
        $this->assertStringContainsString('Interface', $failures[$interfaceId]);
        $this->assertStringNotContainsString('Class', $failures[$interfaceId]);
    }

    public function testDifferentPhpVersionsInErrorMessage(): void
    {
        $interfaceId = '\MissingInterface';

        $stubs = $this->createMockStorageManager();
        $stubs->method('hasInterface')->willReturn(false);

        $result56 = $this->check->run($stubs, $interfaceId, '5.6');
        $result80 = $this->check->run($stubs, $interfaceId, '8.0');

        $this->assertStringContainsString('PHP 5.6', $result56->getFailures()[$interfaceId]);
        $this->assertStringContainsString('PHP 8.0', $result80->getFailures()[$interfaceId]);
    }
}
