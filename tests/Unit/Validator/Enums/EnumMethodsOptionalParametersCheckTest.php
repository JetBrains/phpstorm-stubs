<?php

namespace StubTests\Unit\Validator\Enums;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsOptionalParametersCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Unit\Validator\CheckTestCase;

class EnumMethodsOptionalParametersCheckTest extends CheckTestCase
{
    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllPhpVersions(): void
    {
        $check = new ClassMethodsOptionalParametersCheck(entityTypeConfig: EntityTypeConfig::forEnum());
        $this->assertTrue($check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── Optional parameter matching ───────────────────────────────────────────

    public function testRequiredParamOnBothSidesPasses(): void
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

        $result = (new ClassMethodsOptionalParametersCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    public function testOptionalInReflectionButRequiredInStubFails(): void
    {
        $enumId   = '\MyEnum';
        // Reflection says optional, stub says required
        $reflEnum = $this->makeEnum($enumId, [
            $this->makeMethod('doSomething', parameters: [$this->makeParam('value', optional: true)]),
        ]);
        $stubEnum = $this->makeEnum($enumId, [
            $this->makeMethod('doSomething', parameters: [$this->makeParam('value')]),
        ]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsOptionalParametersCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertStringContainsString('optional', array_values($failures)[0]);
        $this->assertStringNotContainsString('Class', array_values($failures)[0]);
    }
}
