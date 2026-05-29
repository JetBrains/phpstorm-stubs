<?php

namespace StubTests\Unit\Validator\Interfaces;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\EntityNamespaceCheck;
use StubTests\Unit\Validator\CheckTestCase;

class InterfaceNamespaceCheckTest extends CheckTestCase
{
    private EntityNamespaceCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        $this->check = new EntityNamespaceCheck(entityTypeConfig: EntityTypeConfig::forInterface());
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllPhpVersions(): void
    {
        $this->assertTrue($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    // ── Correct namespace ─────────────────────────────────────────────────────

    public function testRootNamespaceInterfaceWithBackslashId(): void
    {
        $iface = $this->makeInterface('\Iterator', namespace: '\\');

        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$iface]);

        $result = $this->check->run($stubs, '\Iterator', '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testNamespacedInterfaceWithCorrectNamespace(): void
    {
        $iface = $this->makeInterface('\Random\Engine', namespace: '\Random');

        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$iface]);

        $result = $this->check->run($stubs, '\Random\Engine', '8.2');

        $this->assertFalse($result->hasFailures());
    }

    public function testDeeplyNamespacedInterface(): void
    {
        $iface = $this->makeInterface('\Foo\Bar\Baz\MyInterface', namespace: '\Foo\Bar\Baz');

        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$iface]);

        $result = $this->check->run($stubs, '\Foo\Bar\Baz\MyInterface', '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Namespace mismatch ────────────────────────────────────────────────────

    public function testNamespaceMismatchIsFailure(): void
    {
        $iface = $this->makeInterface('\Random\Engine', namespace: '\WrongNamespace');

        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$iface]);

        $result = $this->check->run($stubs, '\Random\Engine', '8.2');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey('\Random\Engine', $failures);
        $this->assertStringContainsString('Namespace mismatch', $failures['\Random\Engine']);
        $this->assertStringContainsString('\Random', $failures['\Random\Engine']);
        $this->assertStringContainsString('\WrongNamespace', $failures['\Random\Engine']);
    }

    public function testRootNamespaceWithWrongNamespaceIsFailure(): void
    {
        $iface = $this->makeInterface('\Countable', namespace: 'SomeNamespace');

        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$iface]);

        $result = $this->check->run($stubs, '\Countable', '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('Namespace mismatch', $result->getFailures()['\Countable']);
    }

    // ── Interface not found ───────────────────────────────────────────────────

    public function testInterfaceNotFoundInStubsIsFailure(): void
    {
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([]);

        $result = $this->check->run($stubs, '\MissingInterface', '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey('\MissingInterface', $failures);
        $this->assertStringContainsString('not found in stubs', $failures['\MissingInterface']);
    }
}
