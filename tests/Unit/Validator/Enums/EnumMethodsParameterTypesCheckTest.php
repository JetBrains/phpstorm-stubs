<?php

namespace StubTests\Unit\Validator\Enums;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterTypesCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Unit\Validator\CheckTestCase;

class EnumMethodsParameterTypesCheckTest extends CheckTestCase
{
    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsPhp70AndAbove(): void
    {
        $check = new ClassMethodsParameterTypesCheck(entityTypeConfig: EntityTypeConfig::forEnum());
        $this->assertTrue($check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    public function testDoesNotSupportPhpBefore70(): void
    {
        $check = new ClassMethodsParameterTypesCheck(entityTypeConfig: EntityTypeConfig::forEnum());
        $this->assertFalse($check->supports(PhpVersions::PHP_5_6->value));
    }

    // ── Matching parameter types ──────────────────────────────────────────────

    public function testMatchingParameterTypePasses(): void
    {
        $enumId   = '\Dom\AdjacentPosition';
        $reflEnum = $this->makeEnum($enumId, [
            $this->makeMethod('from', parameters: [$this->makeParam('value', $this->createType('int'))]),
        ]);
        $stubEnum = $this->makeEnum($enumId, [
            $this->makeMethod('from', parameters: [$this->makeParam('value', $this->createType('int'))]),
        ]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsParameterTypesCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    public function testParameterTypeMismatchFails(): void
    {
        $enumId   = '\Dom\AdjacentPosition';
        $reflEnum = $this->makeEnum($enumId, [
            $this->makeMethod('from', parameters: [$this->makeParam('value', $this->createType('int'))]),
        ]);
        $stubEnum = $this->makeEnum($enumId, [
            $this->makeMethod('from', parameters: [$this->makeParam('value', $this->createType('string'))]),
        ]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsParameterTypesCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($enumId . '::from', $failures);
        $this->assertStringContainsString('type', $failures[$enumId . '::from']);
        $this->assertStringNotContainsString('Class', $failures[$enumId . '::from']);
    }
}
