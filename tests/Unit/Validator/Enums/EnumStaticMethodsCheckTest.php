<?php

namespace StubTests\Unit\Validator\Enums;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassStaticMethodsCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Unit\Validator\CheckTestCase;

class EnumStaticMethodsCheckTest extends CheckTestCase
{
    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllPhpVersions(): void
    {
        $check = new ClassStaticMethodsCheck(entityTypeConfig: EntityTypeConfig::forEnum());
        $this->assertTrue($check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── Matching static flag ──────────────────────────────────────────────────

    public function testStaticMethodMatchPasses(): void
    {
        $enumId   = '\RoundingMode';
        $reflEnum = $this->makeEnum($enumId, [$this->makeMethod('cases', isStatic: true)]);
        $stubEnum = $this->makeEnum($enumId, [$this->makeMethod('cases', isStatic: true)]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassStaticMethodsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    // ── Mismatch ──────────────────────────────────────────────────────────────

    public function testStaticMethodMismatchFails(): void
    {
        $enumId   = '\RoundingMode';
        // Reflection says static, stub says non-static
        $reflEnum = $this->makeEnum($enumId, [$this->makeMethod('cases', isStatic: true)]);
        $stubEnum = $this->makeEnum($enumId, [$this->makeMethod('cases')]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassStaticMethodsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($enumId . '::cases', $failures);
        $this->assertStringContainsString('static', $failures[$enumId . '::cases']);
    }

    public function testErrorMessageContainsEnumNotClass(): void
    {
        $enumId   = '\RoundingMode';
        $reflEnum = $this->makeEnum($enumId, [$this->makeMethod('cases', isStatic: true)]);
        $stubEnum = $this->makeEnum($enumId, [$this->makeMethod('cases')]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassStaticMethodsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $failures = $result->getFailures();
        $message  = $failures[$enumId . '::cases'];
        $this->assertStringNotContainsString('Class', $message);
    }
}
