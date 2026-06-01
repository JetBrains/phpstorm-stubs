<?php

namespace StubTests\Unit\Validator\Interfaces;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Constants\ClassConstantsValueCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Unit\Validator\CheckTestCase;

class InterfaceConstantsValueCheckTest extends CheckTestCase
{
    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllVersions(): void
    {
        $check = new ClassConstantsValueCheck(entityTypeConfig: EntityTypeConfig::forInterface());
        $this->assertTrue($check->supports(PhpVersions::PHP_5_6->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── Entity not found ──────────────────────────────────────────────────────

    public function testInterfaceNotFoundInReflectionFails(): void
    {
        $ifaceId = '\\Countable';
        $stubIface = $this->makeInterface($ifaceId);

        $provider = $this->createMockReflectionProviderWithInterfaces([]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassConstantsValueCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $ifaceId, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$ifaceId]);
        $this->assertStringContainsString('Interface', $result->getFailures()[$ifaceId]);
        $this->assertStringNotContainsString('Class', $result->getFailures()[$ifaceId]);
    }

    public function testInterfaceNotFoundInStubsFails(): void
    {
        $ifaceId = '\\Countable';
        $reflIface = $this->makeInterface($ifaceId);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([]);

        $result = (new ClassConstantsValueCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $ifaceId, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', $result->getFailures()[$ifaceId]);
    }

    // ── Matching values ───────────────────────────────────────────────────────

    public function testMatchingValuesPasses(): void
    {
        $ifaceId = '\\MyInterface';
        $reflIface = $this->makeInterface($ifaceId, constants: [$this->makeClassConstant('VERSION', 1)]);
        $stubIface = $this->makeInterface($ifaceId, constants: [$this->makeClassConstant('VERSION', 1)]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassConstantsValueCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $ifaceId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Value mismatch ────────────────────────────────────────────────────────

    public function testValueMismatchFailsOnLatestPhp(): void
    {
        $ifaceId = '\\MyInterface';
        $reflIface = $this->makeInterface($ifaceId, constants: [$this->makeClassConstant('VERSION', 1)]);
        $stubIface = $this->makeInterface($ifaceId, constants: [$this->makeClassConstant('VERSION', 99)]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassConstantsValueCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $ifaceId, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($ifaceId . '::VERSION', $failures);
        $this->assertStringContainsString('value mismatch', $failures[$ifaceId . '::VERSION']);
        $this->assertStringNotContainsString('Class', $failures[$ifaceId . '::VERSION']);
    }

    public function testValueMismatchSkippedOnNonLatestPhp(): void
    {
        $ifaceId = '\\MyInterface';
        $reflIface = $this->makeInterface($ifaceId, constants: [$this->makeClassConstant('VERSION', 1)]);
        $stubIface = $this->makeInterface($ifaceId, constants: [$this->makeClassConstant('VERSION', 99)]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassConstantsValueCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $ifaceId, PhpVersions::PHP_8_0->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Constant not in reflection is skipped ─────────────────────────────────

    public function testConstantNotInReflectionIsSkipped(): void
    {
        $ifaceId = '\\MyInterface';
        $reflIface = $this->makeInterface($ifaceId); // no constants in reflection
        $stubIface = $this->makeInterface($ifaceId, constants: [$this->makeClassConstant('VERSION', 99)]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassConstantsValueCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $ifaceId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }
}
