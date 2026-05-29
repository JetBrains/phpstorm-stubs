<?php

namespace StubTests\Unit\Validator\Enums;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Constants\ClassConstantsValueCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Unit\Validator\CheckTestCase;

class EnumConstantsValueCheckTest extends CheckTestCase
{
    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllVersions(): void
    {
        $check = new ClassConstantsValueCheck(entityTypeConfig: EntityTypeConfig::forEnum());
        $this->assertTrue($check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── Entity not found ──────────────────────────────────────────────────────

    public function testEnumNotFoundInReflectionFails(): void
    {
        $enumId   = '\\RoundingMode';
        $stubEnum = $this->makeEnum($enumId);

        $provider = $this->createMockReflectionProviderWithEnums([]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassConstantsValueCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$enumId]);
        $this->assertStringContainsString('Enum', $result->getFailures()[$enumId]);
        $this->assertStringNotContainsString('Class', $result->getFailures()[$enumId]);
    }

    public function testEnumNotFoundInStubsFails(): void
    {
        $enumId   = '\\RoundingMode';
        $reflEnum = $this->makeEnum($enumId);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([]);

        $result = (new ClassConstantsValueCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', $result->getFailures()[$enumId]);
    }

    // ── Matching values ───────────────────────────────────────────────────────

    public function testMatchingValuesPasses(): void
    {
        $enumId   = '\\RoundingMode';
        $reflEnum = $this->makeEnum($enumId, constants: [$this->makeClassConstant('DefaultValue', 0)]);
        $stubEnum = $this->makeEnum($enumId, constants: [$this->makeClassConstant('DefaultValue', 0)]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassConstantsValueCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Value mismatch ────────────────────────────────────────────────────────

    public function testValueMismatchFailsOnLatestPhp(): void
    {
        $enumId   = '\\RoundingMode';
        $reflEnum = $this->makeEnum($enumId, constants: [$this->makeClassConstant('DefaultValue', 0)]);
        $stubEnum = $this->makeEnum($enumId, constants: [$this->makeClassConstant('DefaultValue', 99)]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassConstantsValueCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($enumId . '::DefaultValue', $failures);
        $this->assertStringContainsString('value mismatch', $failures[$enumId . '::DefaultValue']);
        $this->assertStringNotContainsString('Class', $failures[$enumId . '::DefaultValue']);
    }

    public function testValueMismatchSkippedOnNonLatestPhp(): void
    {
        $enumId   = '\\RoundingMode';
        $reflEnum = $this->makeEnum($enumId, constants: [$this->makeClassConstant('DefaultValue', 0)]);
        $stubEnum = $this->makeEnum($enumId, constants: [$this->makeClassConstant('DefaultValue', 99)]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassConstantsValueCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, PhpVersions::PHP_8_1->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Constant not in reflection is skipped ─────────────────────────────────

    public function testConstantNotInReflectionIsSkipped(): void
    {
        $enumId   = '\\RoundingMode';
        $reflEnum = $this->makeEnum($enumId); // no constants in reflection
        $stubEnum = $this->makeEnum($enumId, constants: [$this->makeClassConstant('DefaultValue', 99)]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassConstantsValueCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }
}
