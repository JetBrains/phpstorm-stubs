<?php

namespace StubTests\Unit\Validator\Interfaces;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Constants\ClassConstantsCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Unit\Validator\CheckTestCase;

class InterfaceConstantsCheckTest extends CheckTestCase
{
    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllVersions(): void
    {
        $check = new ClassConstantsCheck(entityTypeConfig: EntityTypeConfig::forInterface());
        $this->assertTrue($check->supports(PhpVersions::PHP_5_6->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── Matching constants ────────────────────────────────────────────────────

    public function testMatchingConstantPasses(): void
    {
        $ifaceId   = '\\Countable';
        $reflIface = $this->makeInterface($ifaceId, constants: [$this->makeClassConstant('MODE', 1)]);
        $stubIface = $this->makeInterface($ifaceId, constants: [$this->makeClassConstant('MODE', 1)]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassConstantsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $ifaceId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Spurious constant in stubs ────────────────────────────────────────────

    public function testSpuriousConstantInStubsFails(): void
    {
        $ifaceId   = '\\Countable';
        $reflIface = $this->makeInterface($ifaceId); // no constants in reflection
        $stubIface = $this->makeInterface($ifaceId, constants: [$this->makeClassConstant('GHOST', 1)]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassConstantsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $ifaceId, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($ifaceId . '::GHOST', $failures);
        $this->assertStringContainsString('not found in reflection', $failures[$ifaceId . '::GHOST']);
        $this->assertStringNotContainsString('Class', $failures[$ifaceId . '::GHOST']);
    }

    public function testConstantInReflectionOnlyPasses(): void
    {
        // Constant only in reflection (not stub) is fine — might be inherited in stubs
        $ifaceId   = '\\Countable';
        $reflIface = $this->makeInterface($ifaceId, constants: [$this->makeClassConstant('MODE', 1)]);
        $stubIface = $this->makeInterface($ifaceId);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassConstantsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $ifaceId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Value is not checked here ─────────────────────────────────────────────

    public function testValueMismatchNotCheckedByThisCheck(): void
    {
        // Value comparison is handled by InterfaceConstantsValueCheck, not here.
        $ifaceId   = '\\Countable';
        $reflIface = $this->makeInterface($ifaceId, constants: [$this->makeClassConstant('MODE', 1)]);
        $stubIface = $this->makeInterface($ifaceId, constants: [$this->makeClassConstant('MODE', 2)]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassConstantsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $ifaceId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }
}
