<?php

namespace StubTests\Unit\Validator\Enums;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsReturnTypesCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Unit\Validator\CheckTestCase;

class EnumMethodsReturnTypesCheckTest extends CheckTestCase
{
    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsPhp70AndAbove(): void
    {
        $check = new ClassMethodsReturnTypesCheck(entityTypeConfig: EntityTypeConfig::forEnum());
        $this->assertTrue($check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    public function testDoesNotSupportPhpBefore70(): void
    {
        $check = new ClassMethodsReturnTypesCheck(entityTypeConfig: EntityTypeConfig::forEnum());
        $this->assertFalse($check->supports(PhpVersions::PHP_5_6->value));
    }

    // ── Return type matching ──────────────────────────────────────────────────

    public function testMatchingReturnTypePasses(): void
    {
        $enumId   = '\RoundingMode';
        $reflEnum = $this->makeEnum($enumId, [$this->makeMethod('cases', $this->createType('array'))]);
        $stubEnum = $this->makeEnum($enumId, [$this->makeMethod('cases', $this->createType('array'))]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsReturnTypesCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    public function testReturnTypeMismatchFails(): void
    {
        $enumId   = '\RoundingMode';
        // Reflection says 'array', stub says 'int'
        $reflEnum = $this->makeEnum($enumId, [$this->makeMethod('cases', $this->createType('array'))]);
        $stubEnum = $this->makeEnum($enumId, [$this->makeMethod('cases', $this->createType('int'))]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsReturnTypesCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($enumId . '::cases', $failures);
        $this->assertStringContainsString('Return type mismatch', $failures[$enumId . '::cases']);
        $this->assertStringNotContainsString('Class', $failures[$enumId . '::cases']);
    }

    public function testNoReturnTypeInReflectionPasses(): void
    {
        $enumId   = '\RoundingMode';
        // Reflection has no return type → check passes regardless of stub
        $reflEnum = $this->makeEnum($enumId, [$this->makeMethod('cases')]);
        $stubEnum = $this->makeEnum($enumId, [$this->makeMethod('cases', $this->createType('array'))]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsReturnTypesCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }
}
