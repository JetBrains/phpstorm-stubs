<?php

namespace StubTests\Unit\Validator\Classes\Methods;

use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ReflectionMethodSpecialTypeHintsCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class ReflectionMethodSpecialTypeHintsCheckTest extends CheckTestCase
{
    private ReflectionMethodSpecialTypeHintsCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new ReflectionMethodSpecialTypeHintsCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllVersions(): void
    {
        $this->assertTrue($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_7_1->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    // ── Non-Reflection class → silent success ─────────────────────────────────

    public function testNonReflectionClassSucceedsSilently(): void
    {
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([]);

        $result = $this->check->run($stubs, '\SomeRandomClass', '8.1');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── Reflection class absent from stubs → silent success ───────────────────

    public function testReflectionClassAbsentFromStubsSucceedsSilently(): void
    {
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([]);

        $result = $this->check->run($stubs, '\\ReflectionFunctionAbstract', '8.1');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── getReturnType with all correct hints → passes ─────────────────────────

    public function testGetReturnTypeWithCorrectHintsPasses(): void
    {
        $method = $this->makeMethodWithLanguageLevelTypes('getReturnType', [
            '7.1' => 'ReflectionNamedType|null',
            '8.0' => 'ReflectionNamedType|ReflectionUnionType|null',
            '8.1' => 'ReflectionNamedType|ReflectionUnionType|ReflectionIntersectionType|null',
        ]);

        $stubClass = $this->createMockClassWithProperties(
            '\\ReflectionFunctionAbstract', null, null, null, [$method]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, '\\ReflectionFunctionAbstract', '8.1');

        $this->assertFalse($result->hasFailures());
    }

    // ── getReturnType with null LanguageLevelTypes → fails ────────────────────

    public function testGetReturnTypeMissingLanguageLevelTypeAwareFails(): void
    {
        $method = $this->makeMethodWithLanguageLevelTypes('getReturnType', null);

        $stubClass = $this->createMockClassWithProperties(
            '\\ReflectionFunctionAbstract', null, null, null, [$method]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, '\\ReflectionFunctionAbstract', '8.1');

        $this->assertTrue($result->hasFailures());
        $key = '\\ReflectionFunctionAbstract::getReturnType';
        $this->assertArrayHasKey($key, $result->getFailures());
        $this->assertStringContainsString('missing', $result->getFailures()[$key]);
    }

    // ── getReturnType missing a required version entry → fails ────────────────

    public function testGetReturnTypeMissingVersionEntryFails(): void
    {
        $method = $this->makeMethodWithLanguageLevelTypes('getReturnType', [
            '7.1' => 'ReflectionNamedType|null',
            // '8.0' entry intentionally omitted
            '8.1' => 'ReflectionNamedType|ReflectionUnionType|ReflectionIntersectionType|null',
        ]);

        $stubClass = $this->createMockClassWithProperties(
            '\\ReflectionFunctionAbstract', null, null, null, [$method]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, '\\ReflectionFunctionAbstract', '8.1');

        $this->assertTrue($result->hasFailures());
        $key = '\\ReflectionFunctionAbstract::getReturnType@8.0';
        $this->assertArrayHasKey($key, $result->getFailures());
        $this->assertStringContainsString('8.0', $result->getFailures()[$key]);
    }

    // ── getReturnType wrong type for a version → fails ────────────────────────

    public function testGetReturnTypeWrongTypeFails(): void
    {
        $method = $this->makeMethodWithLanguageLevelTypes('getReturnType', [
            '7.1' => 'ReflectionType|null',  // wrong — should be ReflectionNamedType|null
            '8.0' => 'ReflectionNamedType|ReflectionUnionType|null',
            '8.1' => 'ReflectionNamedType|ReflectionUnionType|ReflectionIntersectionType|null',
        ]);

        $stubClass = $this->createMockClassWithProperties(
            '\\ReflectionFunctionAbstract', null, null, null, [$method]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, '\\ReflectionFunctionAbstract', '8.1');

        $this->assertTrue($result->hasFailures());
        $key = '\\ReflectionFunctionAbstract::getReturnType@7.1';
        $this->assertArrayHasKey($key, $result->getFailures());
        $this->assertStringContainsString("expected 'ReflectionNamedType|null'", $result->getFailures()[$key]);
        $this->assertStringContainsString("found 'ReflectionType|null'", $result->getFailures()[$key]);
    }

    // ── Type component order does not matter (normalised comparison) ──────────

    public function testTypeOrderIsNormalised(): void
    {
        $method = $this->makeMethodWithLanguageLevelTypes('getReturnType', [
            '7.1' => 'null|ReflectionNamedType',   // reversed order
            '8.0' => 'null|ReflectionUnionType|ReflectionNamedType',
            '8.1' => 'null|ReflectionIntersectionType|ReflectionUnionType|ReflectionNamedType',
        ]);

        $stubClass = $this->createMockClassWithProperties(
            '\\ReflectionFunctionAbstract', null, null, null, [$method]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, '\\ReflectionFunctionAbstract', '8.1');

        $this->assertFalse($result->hasFailures());
    }

    // ── ReflectionParameter::getType → same spec as getReturnType ─────────────

    public function testReflectionParameterGetTypeWithCorrectHintsPasses(): void
    {
        $method = $this->makeMethodWithLanguageLevelTypes('getType', [
            '7.1' => 'ReflectionNamedType|null',
            '8.0' => 'ReflectionNamedType|ReflectionUnionType|null',
            '8.1' => 'ReflectionNamedType|ReflectionUnionType|ReflectionIntersectionType|null',
        ]);

        $stubClass = $this->createMockClassWithProperties(
            '\\ReflectionParameter', null, null, null, [$method]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, '\\ReflectionParameter', '8.1');

        $this->assertFalse($result->hasFailures());
    }

    // ── ReflectionProperty::getType → only 8.0+ entries required ─────────────

    public function testReflectionPropertyGetTypeWithCorrectHintsPasses(): void
    {
        $method = $this->makeMethodWithLanguageLevelTypes('getType', [
            '8.0' => 'ReflectionNamedType|ReflectionUnionType|null',
            '8.1' => 'ReflectionNamedType|ReflectionUnionType|ReflectionIntersectionType|null',
        ]);

        $stubClass = $this->createMockClassWithProperties(
            '\\ReflectionProperty', null, null, null, [$method]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, '\\ReflectionProperty', '8.1');

        $this->assertFalse($result->hasFailures());
    }

    // ── ReflectionEnum::getBackingType → only 8.2 entry required ─────────────

    public function testReflectionEnumGetBackingTypeWithCorrectHintsPasses(): void
    {
        $method = $this->makeMethodWithLanguageLevelTypes('getBackingType', [
            '8.2' => 'ReflectionNamedType|null',
        ]);

        $stubClass = $this->createMockClassWithProperties(
            '\\ReflectionEnum', null, null, null, [$method]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, '\\ReflectionEnum', '8.2');

        $this->assertFalse($result->hasFailures());
    }

    // ── ReflectionEnum::getBackingType wrong version-map value → fails ─────────

    public function testReflectionEnumGetBackingTypeWrongTypeFails(): void
    {
        $method = $this->makeMethodWithLanguageLevelTypes('getBackingType', [
            '8.2' => 'ReflectionType|null',  // wrong — should contain ReflectionNamedType
        ]);

        $stubClass = $this->createMockClassWithProperties(
            '\\ReflectionEnum', null, null, null, [$method]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, '\\ReflectionEnum', '8.2');

        $this->assertTrue($result->hasFailures());
        $key = '\\ReflectionEnum::getBackingType@8.2';
        $this->assertArrayHasKey($key, $result->getFailures());
        $this->assertStringContainsString("expected 'ReflectionNamedType|null'", $result->getFailures()[$key]);
    }

    // ── Method absent from the class → silently skip ─────────────────────────

    public function testMethodAbsentFromClassIsSkipped(): void
    {
        // No methods provided — getReturnType is absent from the class
        $stubClass = $this->createMockClassWithProperties(
            '\\ReflectionFunctionAbstract', null, null, null, []
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, '\\ReflectionFunctionAbstract', '8.1');

        $this->assertFalse($result->hasFailures());
    }

    // ── Class-level known problem suppresses all checks ───────────────────────

    public function testClassLevelKnownProblemSuppresses(): void
    {
        $method = $this->makeMethodWithLanguageLevelTypes('getReturnType', null);  // would fail

        $stubClass = $this->createMockClassWithProperties(
            '\\ReflectionFunctionAbstract', null, null, null, [$method]
        );

        $entityId = '\\ReflectionFunctionAbstract';

        $knownProblemsProvider = $this->createMock(KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: $entityId,
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::REFLECTION_SPECIAL_TYPE_HINTS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Test suppression'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ReflectionMethodSpecialTypeHintsCheck(null, $registry))->run($stubs, $entityId, '8.1');

        $this->assertFalse($result->hasFailures());
        $skipped = array_filter($result->getSuccesses(), fn($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skipped);
        $this->assertStringContainsString('Test suppression', array_values($skipped)[0]);
    }

    // ── Method-level known problem suppresses that method ─────────────────────

    public function testMethodLevelKnownProblemSuppressesMethod(): void
    {
        $method = $this->makeMethodWithLanguageLevelTypes('getReturnType', null);  // would fail

        $stubClass = $this->createMockClassWithProperties(
            '\\ReflectionFunctionAbstract', null, null, null, [$method]
        );

        $classId    = '\\ReflectionFunctionAbstract';
        $methodId   = $classId . '::getReturnType';

        $knownProblemsProvider = $this->createMock(KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: $methodId,
                type: ProblemType::RUNTIME_VALUE,
                affectedChecks: [CheckType::REFLECTION_SPECIAL_TYPE_HINTS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Method-level suppression'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ReflectionMethodSpecialTypeHintsCheck(null, $registry))->run($stubs, $classId, '8.1');

        $this->assertFalse($result->hasFailures());
        $skipped = array_filter($result->getSuccesses(), fn($s) => str_contains($s, 'skipped'));
        $this->assertNotEmpty($skipped);
        $this->assertStringContainsString('Method-level suppression', array_values($skipped)[0]);
    }

    // ── Multiple failures reported independently ──────────────────────────────

    public function testMultipleVersionFailuresReportedSeparately(): void
    {
        $method = $this->makeMethodWithLanguageLevelTypes('getReturnType', [
            '7.1' => 'ReflectionType|null',   // wrong
            '8.0' => 'ReflectionType|null',   // wrong
            '8.1' => 'ReflectionNamedType|ReflectionUnionType|ReflectionIntersectionType|null',
        ]);

        $stubClass = $this->createMockClassWithProperties(
            '\\ReflectionFunctionAbstract', null, null, null, [$method]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, '\\ReflectionFunctionAbstract', '8.1');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey('\\ReflectionFunctionAbstract::getReturnType@7.1', $result->getFailures());
        $this->assertArrayHasKey('\\ReflectionFunctionAbstract::getReturnType@8.0', $result->getFailures());
        $this->assertArrayNotHasKey('\\ReflectionFunctionAbstract::getReturnType@8.1', $result->getFailures());
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    /**
     * Create a PHPMethod mock with a configurable getLanguageLevelTypes() return value.
     *
     * @param string     $name               Method name
     * @param array|null $languageLevelTypes  Version map or null (no LanguageLevelTypeAware attribute)
     */
    private function makeMethodWithLanguageLevelTypes(string $name, ?array $languageLevelTypes): PHPMethod
    {
        $method = new PHPMethod();
        $method->setName($name);
        $method->initStubsMetadata()->setLanguageLevelTypes($languageLevelTypes);

        return $method;
    }
}
