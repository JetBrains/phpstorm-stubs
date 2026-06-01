<?php

namespace StubTests\Unit\Validator\Enums;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Constants\ClassConstantsVisibilityCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Unit\Validator\CheckTestCase;

class EnumConstantsVisibilityCheckTest extends CheckTestCase
{
    // ── Entity not found ──────────────────────────────────────────────────────

    public function testEnumNotFoundInReflectionFails(): void
    {
        $enumId = '\\Status';
        $stubEnum = $this->makeEnum($enumId);

        $provider = $this->createMockReflectionProviderWithEnums([]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassConstantsVisibilityCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, PhpVersions::PHP_8_1->value);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$enumId]);
        $this->assertStringContainsString('Enum', $result->getFailures()[$enumId]);
    }

    public function testEnumNotFoundInStubsFails(): void
    {
        $enumId = '\\Status';
        $reflEnum = $this->makeEnum($enumId);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([]);

        $result = (new ClassConstantsVisibilityCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, PhpVersions::PHP_8_1->value);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', $result->getFailures()[$enumId]);
    }

    // ── Matching visibility ───────────────────────────────────────────────────

    public function testMatchingVisibilityPasses(): void
    {
        $enumId = '\\Status';
        $reflEnum = $this->makeEnum($enumId, constants: [$this->makeClassConstant('DEFAULT', visibility: AccessModifier::PUBLIC)]);
        $stubEnum = $this->makeEnum($enumId, constants: [$this->makeClassConstant('DEFAULT', visibility: AccessModifier::PUBLIC)]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassConstantsVisibilityCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, PhpVersions::PHP_8_1->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Visibility mismatch ───────────────────────────────────────────────────

    public function testVisibilityMismatchFails(): void
    {
        $enumId = '\\Status';
        $reflEnum = $this->makeEnum($enumId, constants: [$this->makeClassConstant('DEFAULT', visibility: AccessModifier::PUBLIC)]);
        $stubEnum = $this->makeEnum($enumId, constants: [$this->makeClassConstant('DEFAULT', visibility: AccessModifier::PROTECTED)]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassConstantsVisibilityCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, PhpVersions::PHP_8_1->value);

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($enumId . '::DEFAULT', $failures);
        $this->assertStringContainsString("'public'", $failures[$enumId . '::DEFAULT']);
        $this->assertStringContainsString("'protected'", $failures[$enumId . '::DEFAULT']);
    }

    // ── Constant not in reflection is skipped ─────────────────────────────────

    public function testConstantNotInReflectionIsSkipped(): void
    {
        $enumId = '\\Status';
        $reflEnum = $this->makeEnum($enumId); // no constants in reflection
        $stubEnum = $this->makeEnum($enumId, constants: [$this->makeClassConstant('EXTRA', visibility: AccessModifier::PROTECTED)]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassConstantsVisibilityCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, PhpVersions::PHP_8_1->value);

        $this->assertFalse($result->hasFailures());
    }
}
