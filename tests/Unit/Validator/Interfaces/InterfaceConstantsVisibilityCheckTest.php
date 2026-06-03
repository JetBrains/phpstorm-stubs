<?php

namespace StubTests\Unit\Validator\Interfaces;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;
use StubTests\Framework\Validator\Classes\Constants\ClassConstantsVisibilityCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Unit\Validator\CheckTestCase;

class InterfaceConstantsVisibilityCheckTest extends CheckTestCase
{
    // ── Entity not found ──────────────────────────────────────────────────────

    public function testInterfaceNotFoundInReflectionFails(): void
    {
        $ifaceId = '\\Countable';
        $stubIface = $this->makeInterface($ifaceId);

        $provider = $this->createMockReflectionProviderWithInterfaces([]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassConstantsVisibilityCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $ifaceId, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$ifaceId]);
        $this->assertStringContainsString('Interface', $result->getFailures()[$ifaceId]);
    }

    public function testInterfaceNotFoundInStubsFails(): void
    {
        $ifaceId = '\\Countable';
        $reflIface = $this->makeInterface($ifaceId);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([]);

        $result = (new ClassConstantsVisibilityCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $ifaceId, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', $result->getFailures()[$ifaceId]);
    }

    // ── Matching visibility ───────────────────────────────────────────────────

    public function testMatchingPublicVisibilityPasses(): void
    {
        $ifaceId = '\\MyInterface';
        $reflIface = $this->makeInterface($ifaceId, constants: [$this->makeClassConstant('VERSION', visibility: AccessModifier::PUBLIC)]);
        $stubIface = $this->makeInterface($ifaceId, constants: [$this->makeClassConstant('VERSION', visibility: AccessModifier::PUBLIC)]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassConstantsVisibilityCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $ifaceId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testNoConstantsPasses(): void
    {
        $ifaceId = '\\EmptyInterface';
        $reflIface = $this->makeInterface($ifaceId);
        $stubIface = $this->makeInterface($ifaceId);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassConstantsVisibilityCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $ifaceId, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Visibility mismatch ───────────────────────────────────────────────────

    public function testVisibilityMismatchFails(): void
    {
        // Interface constants are normally always public in PHP; a stub error could annotate
        // a constant as protected — the check should catch it.
        $ifaceId = '\\MyInterface';
        $reflIface = $this->makeInterface($ifaceId, constants: [$this->makeClassConstant('VERSION', visibility: AccessModifier::PUBLIC)]);
        $stubIface = $this->makeInterface($ifaceId, constants: [$this->makeClassConstant('VERSION', visibility: AccessModifier::PROTECTED)]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassConstantsVisibilityCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $ifaceId, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($ifaceId . '::VERSION', $failures);
        $this->assertStringContainsString("'public'", $failures[$ifaceId . '::VERSION']);
        $this->assertStringContainsString("'protected'", $failures[$ifaceId . '::VERSION']);
    }

    // ── Constant not in reflection is skipped ─────────────────────────────────

    public function testConstantNotInReflectionIsSkipped(): void
    {
        $ifaceId = '\\MyInterface';
        $reflIface = $this->makeInterface($ifaceId); // no constants in reflection
        $stubIface = $this->makeInterface($ifaceId, constants: [$this->makeClassConstant('EXTRA', visibility: AccessModifier::PROTECTED)]);

        $provider = $this->createMockReflectionProviderWithInterfaces([$reflIface]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$stubIface]);

        $result = (new ClassConstantsVisibilityCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forInterface()))->run($stubs, $ifaceId, '8.0');

        $this->assertFalse($result->hasFailures());
    }
}
