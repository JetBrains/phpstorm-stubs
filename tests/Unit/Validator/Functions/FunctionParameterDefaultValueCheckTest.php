<?php

namespace StubTests\Unit\Validator\Functions;

use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Functions\FunctionParameterDefaultValueCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class FunctionParameterDefaultValueCheckTest extends CheckTestCase
{
    private FunctionParameterDefaultValueCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new FunctionParameterDefaultValueCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsOnlyLatestPhpVersion(): void
    {
        $this->assertFalse($this->check->supports(PhpVersions::PHP_8_0->value));
        $this->assertFalse($this->check->supports(PhpVersions::PHP_8_3->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    // ── Function not found ────────────────────────────────────────────────────

    public function testFunctionNotFoundInReflectionIsFailure(): void
    {
        $fnId       = '\\missingFunc';
        $stubFunc   = $this->createMockFunction($fnId);

        $provider = $this->createMockReflectionProvider([], []);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$stubFunc]);

        $result = (new FunctionParameterDefaultValueCheck($provider))->run($stubs, $fnId, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$fnId]);
    }

    public function testFunctionNotFoundInStubsSucceeds(): void
    {
        // FunctionExistsCheck handles missing stubs; we succeed silently
        $fnId      = '\\missingFunc';
        $reflFunc  = $this->createMockFunction($fnId);

        $provider = $this->createMockReflectionProvider([$reflFunc], []);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([]);

        $result = (new FunctionParameterDefaultValueCheck($provider))->run($stubs, $fnId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Matching defaults ─────────────────────────────────────────────────────

    public function testMatchingIntegerDefaultSucceeds(): void
    {
        $fnId       = '\\sort';
        $reflParams = [$this->makeParam('flags', hasDefaultValue: true, defaultValue: 0, optional: true)];
        $stubParams = [$this->makeParam('flags', hasDefaultValue: true, defaultValue: 0, optional: true)];

        $reflFunc = $this->createMockFunction($fnId, $reflParams);
        $stubFunc = $this->createMockFunction($fnId, $stubParams);

        $provider = $this->createMockReflectionProvider([$reflFunc], []);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$stubFunc]);

        $result = (new FunctionParameterDefaultValueCheck($provider))->run($stubs, $fnId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    public function testMatchingStringDefaultSucceeds(): void
    {
        $fnId       = '\\implode';
        $reflParams = [$this->makeParam('separator', hasDefaultValue: true, defaultValue: '', optional: true)];
        $stubParams = [$this->makeParam('separator', hasDefaultValue: true, defaultValue: '', optional: true)];

        $reflFunc = $this->createMockFunction($fnId, $reflParams);
        $stubFunc = $this->createMockFunction($fnId, $stubParams);

        $provider = $this->createMockReflectionProvider([$reflFunc], []);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$stubFunc]);

        $result = (new FunctionParameterDefaultValueCheck($provider))->run($stubs, $fnId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Mismatch detection ────────────────────────────────────────────────────

    public function testMismatchedDefaultIsFailure(): void
    {
        $fnId       = '\\sort';
        $reflParams = [$this->makeParam('flags', hasDefaultValue: true, defaultValue: 0, optional: true)];  // reflection: 0
        $stubParams = [$this->makeParam('flags', hasDefaultValue: true, defaultValue: 4, optional: true)];  // stub: 4 — wrong

        $reflFunc = $this->createMockFunction($fnId, $reflParams);
        $stubFunc = $this->createMockFunction($fnId, $stubParams);

        $provider = $this->createMockReflectionProvider([$reflFunc], []);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$stubFunc]);

        $result = (new FunctionParameterDefaultValueCheck($provider))->run($stubs, $fnId, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($fnId, $result->getFailures());
        $message = $result->getFailures()[$fnId];
        $this->assertStringContainsString('$flags', $message);
        $this->assertStringContainsString("reflection '0'", $message);
        $this->assertStringContainsString("stubs '4'", $message);
    }

    public function testMultipleMismatchesReportedTogether(): void
    {
        $fnId       = '\\func';
        $reflParams = [
            $this->makeParam('a', hasDefaultValue: true, defaultValue: 1, optional: true),
            $this->makeParam('b', hasDefaultValue: true, defaultValue: 'x', optional: true),
        ];
        $stubParams = [
            $this->makeParam('a', hasDefaultValue: true, defaultValue: 2, optional: true),    // wrong
            $this->makeParam('b', hasDefaultValue: true, defaultValue: 'y', optional: true),  // wrong
        ];

        $reflFunc = $this->createMockFunction($fnId, $reflParams);
        $stubFunc = $this->createMockFunction($fnId, $stubParams);

        $provider = $this->createMockReflectionProvider([$reflFunc], []);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$stubFunc]);

        $result = (new FunctionParameterDefaultValueCheck($provider))->run($stubs, $fnId, PhpVersions::LATEST->value);

        $this->assertTrue($result->hasFailures());
        $message = $result->getFailures()[$fnId];
        $this->assertStringContainsString('$a', $message);
        $this->assertStringContainsString('$b', $message);
    }

    // ── Null-skip behaviour ───────────────────────────────────────────────────

    public function testNullReflectionDefaultIsSkipped(): void
    {
        $fnId       = '\\func';
        $reflParams = [$this->makeParam('x', hasDefaultValue: true, defaultValue: null, optional: true)]; // null reflection default
        $stubParams = [$this->makeParam('x', hasDefaultValue: true, defaultValue: 42, optional: true)];   // stub has 42

        $reflFunc = $this->createMockFunction($fnId, $reflParams);
        $stubFunc = $this->createMockFunction($fnId, $stubParams);

        $provider = $this->createMockReflectionProvider([$reflFunc], []);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$stubFunc]);

        $result = (new FunctionParameterDefaultValueCheck($provider))->run($stubs, $fnId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    public function testNullStubDefaultIsSkipped(): void
    {
        $fnId       = '\\func';
        $reflParams = [$this->makeParam('x', hasDefaultValue: true, defaultValue: 42, optional: true)];   // reflection: 42
        $stubParams = [$this->makeParam('x', hasDefaultValue: true, defaultValue: null, optional: true)]; // stub: null (unevaluable or actual null)

        $reflFunc = $this->createMockFunction($fnId, $reflParams);
        $stubFunc = $this->createMockFunction($fnId, $stubParams);

        $provider = $this->createMockReflectionProvider([$reflFunc], []);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$stubFunc]);

        $result = (new FunctionParameterDefaultValueCheck($provider))->run($stubs, $fnId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── No default in reflection ──────────────────────────────────────────────

    public function testNoReflectionDefaultIsSkipped(): void
    {
        $fnId       = '\\func';
        $reflParams = [$this->makeParam('x')];    // no default in reflection
        $stubParams = [$this->makeParam('x', hasDefaultValue: true, defaultValue: 42, optional: true)]; // stub has one

        $reflFunc = $this->createMockFunction($fnId, $reflParams);
        $stubFunc = $this->createMockFunction($fnId, $stubParams);

        $provider = $this->createMockReflectionProvider([$reflFunc], []);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$stubFunc]);

        $result = (new FunctionParameterDefaultValueCheck($provider))->run($stubs, $fnId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Known problem ─────────────────────────────────────────────────────────

    public function testKnownProblemSkipsFunction(): void
    {
        $fnId       = '\\problematic';
        $reflParams = [$this->makeParam('flags', hasDefaultValue: true, defaultValue: 0, optional: true)];
        $stubParams = [$this->makeParam('flags', hasDefaultValue: true, defaultValue: 99, optional: true)]; // mismatch

        $reflFunc = $this->createMockFunction($fnId, $reflParams);
        $stubFunc = $this->createMockFunction($fnId, $stubParams);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::FUNCTION,
                entityId: $fnId,
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::PARAMETER_DEFAULT_VALUE],
                versionRange: new PhpVersionRange(PhpVersions::LATEST, PhpVersions::LATEST),
                reason: 'Platform-specific default value'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $provider = $this->createMockReflectionProvider([$reflFunc], []);
        $stubs    = $this->createMockStorageManager();
        $stubs->method('getFunctions')->willReturn([$stubFunc]);

        $result = (new FunctionParameterDefaultValueCheck($provider, $registry))->run($stubs, $fnId, PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures());
        $skipped = array_filter($result->getSuccesses(), fn($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skipped);
        $this->assertStringContainsString('Platform-specific default value', array_values($skipped)[0]);
    }
}
