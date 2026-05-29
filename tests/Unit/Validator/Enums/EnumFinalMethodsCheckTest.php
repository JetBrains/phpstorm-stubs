<?php

namespace StubTests\Unit\Validator\Enums;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassFinalMethodsCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Unit\Validator\CheckTestCase;

class EnumFinalMethodsCheckTest extends CheckTestCase
{
    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllPhpVersions(): void
    {
        $check = new ClassFinalMethodsCheck(entityTypeConfig: EntityTypeConfig::forEnum());
        $this->assertTrue($check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── Matching final flag ───────────────────────────────────────────────────

    public function testNonFinalMethodMatchPasses(): void
    {
        $enumId   = '\RoundingMode';
        $reflEnum = $this->makeEnum($enumId, [$this->makeMethod('cases')]);
        $stubEnum = $this->makeEnum($enumId, [$this->makeMethod('cases')]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassFinalMethodsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    // ── Mismatch ──────────────────────────────────────────────────────────────

    public function testFinalMethodMismatchFails(): void
    {
        $enumId   = '\RoundingMode';
        $reflEnum = $this->makeEnum($enumId, [$this->makeMethod('cases', isFinal: true)]);
        $stubEnum = $this->makeEnum($enumId, [$this->makeMethod('cases')]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassFinalMethodsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($enumId . '::cases', $failures);
        $this->assertStringContainsString('final', $failures[$enumId . '::cases']);
    }
}
