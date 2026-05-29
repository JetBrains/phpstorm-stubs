<?php

namespace StubTests\Unit\Validator\Enums;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsVisibilityCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Unit\Validator\CheckTestCase;

class EnumMethodsVisibilityCheckTest extends CheckTestCase
{
    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllPhpVersions(): void
    {
        $check = new ClassMethodsVisibilityCheck(entityTypeConfig: EntityTypeConfig::forEnum());
        $this->assertTrue($check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── Matching visibility ───────────────────────────────────────────────────

    public function testPublicMethodMatchPasses(): void
    {
        $enumId   = '\RoundingMode';
        $reflEnum = $this->makeEnum($enumId, [$this->makeMethod('cases')]);
        $stubEnum = $this->makeEnum($enumId, [$this->makeMethod('cases')]);

        $provider = $this->createMockReflectionProviderWithEnums([$reflEnum]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$stubEnum]);

        $result = (new ClassMethodsVisibilityCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }
}
