<?php

namespace StubTests\Unit\Validator\Enums;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParametersCountCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Unit\Validator\CheckTestCase;

class EnumMethodsParametersCountCheckTest extends CheckTestCase
{
    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllPhpVersions(): void
    {
        $check = new ClassMethodsParametersCountCheck(entityTypeConfig: EntityTypeConfig::forEnum());
        $this->assertTrue($check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── Parameter count matching ──────────────────────────────────────────────

    public function testMatchingParameterCountPasses(): void
    {
        $enumId   = '\Dom\AdjacentPosition';
        $reflEnum = $this->makeEnum($enumId, [
            $this->makeMethod('from', parameters: [$this->makeParam('value')]),
        ]);
        $stubEnum = $this->makeEnum($enumId, [
            $this->makeMethod('from', parameters: [$this->makeParam('value')]),
        ]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsParametersCountCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    public function testParameterCountMismatchFails(): void
    {
        $enumId   = '\Dom\AdjacentPosition';
        // Reflection has 1 param, stub has 0
        $reflEnum = $this->makeEnum($enumId, [
            $this->makeMethod('from', parameters: [$this->makeParam('value')]),
        ]);
        $stubEnum = $this->makeEnum($enumId, [
            $this->makeMethod('from'),
        ]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsParametersCountCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($enumId . '::from', $failures);
        $this->assertStringContainsString('parameter', $failures[$enumId . '::from']);
        $this->assertStringNotContainsString('Class', $failures[$enumId . '::from']);
    }

    public function testNoParamMethodPasses(): void
    {
        $enumId   = '\RoundingMode';
        $reflEnum = $this->makeEnum($enumId, [$this->makeMethod('cases')]);
        $stubEnum = $this->makeEnum($enumId, [$this->makeMethod('cases')]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsParametersCountCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }
}
