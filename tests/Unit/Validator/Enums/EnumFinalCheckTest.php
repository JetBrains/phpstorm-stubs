<?php

namespace StubTests\Unit\Validator\Enums;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\ClassFinalCheck;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Unit\Validator\CheckTestCase;

class EnumFinalCheckTest extends CheckTestCase
{
    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllPhpVersions(): void
    {
        $check = new ClassFinalCheck(entityTypeConfig: EntityTypeConfig::forEnum());
        $this->assertTrue($check->supports(PhpVersions::PHP_8_1->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── Matching final flag ───────────────────────────────────────────────────

    public function testFinalMatchPasses(): void
    {
        $enumId  = '\RoundingMode';
        $provider = $this->createMockReflectionProviderWithEnums([$this->makeEnum($enumId, isFinal: true)]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$this->makeEnum($enumId, isFinal: true)]);

        $result = (new ClassFinalCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testNonFinalMatchPasses(): void
    {
        $enumId  = '\RoundingMode';
        $provider = $this->createMockReflectionProviderWithEnums([$this->makeEnum($enumId)]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$this->makeEnum($enumId)]);

        $result = (new ClassFinalCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    public function testAbsentFinalPropertyTreatedAsFalse(): void
    {
        $enumId  = '\RoundingMode';
        $provider = $this->createMockReflectionProviderWithEnums([$this->makeEnum($enumId)]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$this->makeEnum($enumId)]); // isFinal not set

        $result = (new ClassFinalCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertFalse($result->hasFailures());
    }

    // ── Mismatch ──────────────────────────────────────────────────────────────

    public function testFinalInReflectionButNotStubsFails(): void
    {
        $enumId  = '\RoundingMode';
        $provider = $this->createMockReflectionProviderWithEnums([$this->makeEnum($enumId, isFinal: true)]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$this->makeEnum($enumId)]);

        $result = (new ClassFinalCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($enumId, $failures);
        $this->assertStringContainsString('final', $failures[$enumId]);
        $this->assertStringContainsString('non-final', $failures[$enumId]);
    }

    public function testNonFinalInReflectionButFinalInStubsFails(): void
    {
        $enumId  = '\RoundingMode';
        $provider = $this->createMockReflectionProviderWithEnums([$this->makeEnum($enumId)]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$this->makeEnum($enumId, isFinal: true)]);

        $result = (new ClassFinalCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($enumId, $failures);
        $this->assertStringContainsString('Enum', $failures[$enumId]);
    }

    // ── Missing entity ────────────────────────────────────────────────────────

    public function testEnumNotFoundInReflectionFails(): void
    {
        $enumId  = '\MissingEnum';
        $provider = $this->createMockReflectionProviderWithEnums([]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([$this->makeEnum($enumId, isFinal: true)]);

        $result = (new ClassFinalCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($enumId, $failures);
        $this->assertStringContainsString('not found in reflection', $failures[$enumId]);
    }

    public function testEnumNotFoundInStubsFails(): void
    {
        $enumId  = '\MissingEnum';
        $provider = $this->createMockReflectionProviderWithEnums([$this->makeEnum($enumId, isFinal: true)]);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getEnums')->willReturn([]);

        $result = (new ClassFinalCheck(reflectionProvider: $provider, entityTypeConfig: EntityTypeConfig::forEnum()))->run($stubs, $enumId, '8.1');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($enumId, $failures);
        $this->assertStringContainsString('not found in stubs', $failures[$enumId]);
    }
}
