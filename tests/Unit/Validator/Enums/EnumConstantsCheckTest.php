<?php

namespace StubTests\Unit\Validator\Enums;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Constants\ClassConstantsCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Unit\Validator\CheckTestCase;

class EnumConstantsCheckTest extends CheckTestCase
{
    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllVersions(): void
    {
        $check = new ClassConstantsCheck(entityTypeConfig: EntityTypeConfig::forEnum());
        $this->assertTrue($check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── Matching constants ────────────────────────────────────────────────────

    public function testMatchingConstantPasses(): void
    {
        $enumId = '\\RoundingMode';
        $reflEnum = $this->makeEnum($enumId, constants: [$this->makeClassConstant('DefaultValue', 0)]);
        $stubEnum = $this->makeEnum($enumId, constants: [$this->makeClassConstant('DefaultValue', 0)]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassConstantsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    public function testNoConstantsPasses(): void
    {
        $enumId = '\\RoundingMode';
        $reflEnum = $this->makeEnum($enumId);
        $stubEnum = $this->makeEnum($enumId);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassConstantsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    // ── Spurious constant in stubs ────────────────────────────────────────────

    public function testSpuriousConstantInStubsFails(): void
    {
        $enumId = '\\RoundingMode';
        $reflEnum = $this->makeEnum($enumId); // no constants in reflection
        $stubEnum = $this->makeEnum($enumId, constants: [$this->makeClassConstant('Ghost', 0)]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassConstantsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($enumId . '::Ghost', $failures);
        $this->assertStringContainsString('not found in reflection', $failures[$enumId . '::Ghost']);
        $this->assertStringNotContainsString('Class', $failures[$enumId . '::Ghost']);
    }

    public function testConstantInReflectionOnlyPasses(): void
    {
        // Constant only in reflection (not stub) is fine — might be inherited in stubs
        $enumId = '\\RoundingMode';
        $reflEnum = $this->makeEnum($enumId, constants: [$this->makeClassConstant('DefaultValue', 0)]);
        $stubEnum = $this->makeEnum($enumId);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassConstantsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    // ── Visibility is not checked here ───────────────────────────────────────

    public function testVisibilityMismatchNotCheckedByThisCheck(): void
    {
        // Visibility is validated by EnumConstantsVisibilityCheck, not here.
        $enumId = '\\RoundingMode';
        $reflEnum = $this->makeEnum($enumId, constants: [$this->makeClassConstant('DefaultValue', null, AccessModifier::PUBLIC)]);
        $stubEnum = $this->makeEnum($enumId, constants: [$this->makeClassConstant('DefaultValue', null, AccessModifier::PROTECTED)]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassConstantsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    // ── Value is not checked here ─────────────────────────────────────────────

    public function testValueMismatchNotCheckedByThisCheck(): void
    {
        // Value comparison is handled by EnumConstantsValueCheck, not here.
        $enumId = '\\RoundingMode';
        $reflEnum = $this->makeEnum($enumId, constants: [$this->makeClassConstant('DefaultValue', 0)]);
        $stubEnum = $this->makeEnum($enumId, constants: [$this->makeClassConstant('DefaultValue', 99)]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassConstantsCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }
}
