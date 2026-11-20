<?php

namespace StubTests\Unit\Validator;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\KnownProblemNecessity;
use StubTests\Framework\Validator\KnownProblems\KnownProblemNecessityAnalyzer;
use StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblems\RecordingKnownProblemsRegistry;
use StubTests\Framework\Validator\KnownProblems\ValidatorSuiteCase;
use StubTests\Framework\Validator\KnownProblemsRegistry;

class KnownProblemNecessityAnalyzerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    // ── Verdicts ──────────────────────────────────────────────────────────────

    public function testEntryIsNeededWhenACasePassesOnlyWithIt(): void
    {
        $analyzer = $this->analyzer(
            [self::problem(EntityType::FUNCTION, '\\foo', CheckType::PARAMETER_NAMES, PhpVersions::PHP_8_0, PhpVersions::LATEST)],
            [
                self::suiteCase(CheckType::PARAMETER_NAMES, '\\foo', '8.0'),
                self::suiteCase(CheckType::PARAMETER_NAMES, '\\foo', '8.1'),
            ],
            self::runner([[CheckType::PARAMETER_NAMES, EntityType::FUNCTION, '\\foo', '8.1']])
        );

        $verdict = $analyzer->analyze(0);

        $this->assertSame(KnownProblemNecessity::NEEDED, $verdict->necessity);
        $this->assertSame(['FakeValidatorTest ParameterNamesCheck \\foo PHP 8.1'], $verdict->failingWithout);
    }

    public function testEntryIsStaleWhenEveryCasePassesWithoutIt(): void
    {
        $analyzer = $this->analyzer(
            [self::problem(EntityType::FUNCTION, '\\foo', CheckType::PARAMETER_NAMES, PhpVersions::PHP_8_0, PhpVersions::LATEST)],
            [
                self::suiteCase(CheckType::PARAMETER_NAMES, '\\foo', '8.0'),
                self::suiteCase(CheckType::PARAMETER_NAMES, '\\foo', '8.1'),
            ],
            self::runner([])
        );

        $verdict = $analyzer->analyze(0);

        $this->assertSame(KnownProblemNecessity::STALE, $verdict->necessity);
        $this->assertSame([], $verdict->failingWithout);
    }

    public function testEntryWithoutAnyCaseIsUntestedNotStale(): void
    {
        $analyzer = $this->analyzer(
            [self::problem(EntityType::FUNCTION, '\\foo', CheckType::PARAMETER_NAMES, PhpVersions::EARLIEST, PhpVersions::LATEST)],
            [self::suiteCase(CheckType::PARAMETER_NAMES, '\\bar', '8.0')],
            self::runner([])
        );

        $this->assertSame(KnownProblemNecessity::UNTESTED, $analyzer->analyze(0)->necessity);
    }

    /**
     * An entity can have cases for other checks only, as a function no reflection cache has
     * still gets the PhpDoc cases, which are built from the stubs. Those pass with and without
     * the entry, but say nothing about it.
     */
    public function testCasesRunningOtherChecksDoNotCount(): void
    {
        $analyzer = $this->analyzer(
            [self::problem(EntityType::FUNCTION, '\\foo', CheckType::PARAMETER_NAMES, PhpVersions::EARLIEST, PhpVersions::LATEST)],
            [self::suiteCase(CheckType::PHPDOC_TAGS, '\\foo', '8.6')],
            self::runner([])
        );

        $this->assertSame(KnownProblemNecessity::UNTESTED, $analyzer->analyze(0)->necessity);
    }

    /**
     * A case that fails with every entry in place cannot show the entry is not needed: without
     * it, the case would fail just the same.
     */
    public function testEntryIsUntestedWhenSomeOfItsCasesAlreadyFail(): void
    {
        $analyzer = $this->analyzer(
            [self::problem(EntityType::FUNCTION, '\\foo', CheckType::PARAMETER_NAMES, PhpVersions::PHP_8_0, PhpVersions::LATEST)],
            [
                self::suiteCase(CheckType::PARAMETER_NAMES, '\\foo', '8.0'),
                self::suiteCase(CheckType::PARAMETER_NAMES, '\\foo', '8.1'),
            ],
            self::runner([], broken: ['FakeValidatorTest ParameterNamesCheck \\foo PHP 8.1'])
        );

        $this->assertSame(KnownProblemNecessity::UNTESTED, $analyzer->analyze(0)->necessity);
    }

    public function testCaseThatFailsOnlyWithoutTheEntryOutweighsCasesThatAlreadyFail(): void
    {
        $analyzer = $this->analyzer(
            [self::problem(EntityType::FUNCTION, '\\foo', CheckType::PARAMETER_NAMES, PhpVersions::PHP_8_0, PhpVersions::LATEST)],
            [
                self::suiteCase(CheckType::PARAMETER_NAMES, '\\foo', '8.0'),
                self::suiteCase(CheckType::PARAMETER_NAMES, '\\foo', '8.1'),
            ],
            self::runner(
                [[CheckType::PARAMETER_NAMES, EntityType::FUNCTION, '\\foo', '8.0']],
                broken: ['FakeValidatorTest ParameterNamesCheck \\foo PHP 8.1']
            )
        );

        $this->assertSame(KnownProblemNecessity::NEEDED, $analyzer->analyze(0)->necessity);
    }

    // ── Which cases are run ───────────────────────────────────────────────────

    public function testCasesOutsideTheVersionRangeAreNotRun(): void
    {
        $analyzer = $this->analyzer(
            [self::problem(EntityType::FUNCTION, '\\foo', CheckType::PARAMETER_NAMES, PhpVersions::PHP_8_0, PhpVersions::PHP_8_0)],
            [
                self::suiteCase(CheckType::PARAMETER_NAMES, '\\foo', '7.4'),
                self::suiteCase(CheckType::PARAMETER_NAMES, '\\foo', '8.0'),
            ],
            self::runner([[CheckType::PARAMETER_NAMES, EntityType::FUNCTION, '\\foo', '7.4']])
        );

        $this->assertSame(KnownProblemNecessity::STALE, $analyzer->analyze(0)->necessity);
    }

    public function testMemberEntryIsJudgedByTheCasesOfItsOwner(): void
    {
        $analyzer = $this->analyzer(
            [self::problem(EntityType::METHOD, '\\Foo::bar', CheckType::CLASS_FINAL_METHODS, PhpVersions::EARLIEST, PhpVersions::LATEST)],
            [self::suiteCase(CheckType::CLASS_FINAL_METHODS, '\\Foo', '8.0')],
            self::runner([[CheckType::CLASS_FINAL_METHODS, EntityType::METHOD, '\\Foo::bar', '8.0']], entityType: EntityType::CLASS_TYPE)
        );

        $this->assertSame(KnownProblemNecessity::NEEDED, $analyzer->analyze(0)->necessity);
    }

    public function testEntityIdsAreJudgedTogether(): void
    {
        $analyzer = $this->analyzer(
            [self::problem(EntityType::GLOBAL_CONSTANT, 'LIB_VERSIONS', CheckType::CONSTANT_VALUE, PhpVersions::LATEST, PhpVersions::LATEST, ['\\A_VERSION', '\\B_VERSION'])],
            [
                self::suiteCase(CheckType::CONSTANT_VALUE, '\\A_VERSION', '8.6'),
                self::suiteCase(CheckType::CONSTANT_VALUE, '\\B_VERSION', '8.6'),
            ],
            self::runner([[CheckType::CONSTANT_VALUE, EntityType::GLOBAL_CONSTANT, '\\B_VERSION', '8.6']], entityType: EntityType::GLOBAL_CONSTANT)
        );

        $this->assertSame(KnownProblemNecessity::NEEDED, $analyzer->analyze(0)->necessity);
    }

    /**
     * Each entry is judged with only itself removed, so of two entries that suppress the same
     * failure, each is reported stale: either one is enough.
     */
    public function testDuplicateEntryIsStale(): void
    {
        $problem = self::problem(EntityType::FUNCTION, '\\foo', CheckType::PARAMETER_NAMES, PhpVersions::EARLIEST, PhpVersions::LATEST);
        $analyzer = $this->analyzer(
            [$problem, $problem],
            [self::suiteCase(CheckType::PARAMETER_NAMES, '\\foo', '8.0')],
            self::runner([[CheckType::PARAMETER_NAMES, EntityType::FUNCTION, '\\foo', '8.0']])
        );

        $this->assertSame(KnownProblemNecessity::STALE, $analyzer->analyze(0)->necessity);
        $this->assertSame(KnownProblemNecessity::STALE, $analyzer->analyze(1)->necessity);
    }

    public function testOtherEntriesStayInPlaceWhileOneIsJudged(): void
    {
        $analyzer = $this->analyzer(
            [
                self::problem(EntityType::FUNCTION, '\\foo', CheckType::PARAMETER_NAMES, PhpVersions::EARLIEST, PhpVersions::LATEST),
                self::problem(EntityType::FUNCTION, '\\foo', CheckType::PARAMETER_TYPES, PhpVersions::EARLIEST, PhpVersions::LATEST),
            ],
            [
                self::suiteCase(CheckType::PARAMETER_NAMES, '\\foo', '8.0'),
                self::suiteCase(CheckType::PARAMETER_TYPES, '\\foo', '8.0'),
            ],
            self::runner([
                [CheckType::PARAMETER_NAMES, EntityType::FUNCTION, '\\foo', '8.0'],
                [CheckType::PARAMETER_TYPES, EntityType::FUNCTION, '\\foo', '8.0'],
            ])
        );

        $this->assertSame(['FakeValidatorTest ParameterNamesCheck \\foo PHP 8.0'], $analyzer->analyze(0)->failingWithout);
        $this->assertSame(['FakeValidatorTest ParameterTypesCheck \\foo PHP 8.0'], $analyzer->analyze(1)->failingWithout);
    }

    // ── Registry ──────────────────────────────────────────────────────────────

    public function testDefaultRegistryIsBackAfterAnalysis(): void
    {
        $analyzer = $this->analyzer(
            [self::problem(EntityType::FUNCTION, '\\foo', CheckType::PARAMETER_NAMES, PhpVersions::EARLIEST, PhpVersions::LATEST)],
            [self::suiteCase(CheckType::PARAMETER_NAMES, '\\foo', '8.0')],
            self::runner([])
        );

        $analyzer->analyze(0);

        $this->assertNotInstanceOf(RecordingKnownProblemsRegistry::class, KnownProblemsRegistry::getInstance());
    }

    public function testGetInstanceOnTheSubclassInstallsIt(): void
    {
        $this->assertInstanceOf(RecordingKnownProblemsRegistry::class, RecordingKnownProblemsRegistry::getInstance());
        $this->assertInstanceOf(RecordingKnownProblemsRegistry::class, KnownProblemsRegistry::getInstance());
    }

    public function testRecordingRegistryReportsEachCheckThatAskedOnce(): void
    {
        $registry = new RecordingKnownProblemsRegistry($this->provider([]));

        $registry->shouldSkipValidation('functions', '\\foo', CheckType::PARAMETER_NAMES, '8.0');
        $registry->shouldSkipValidation('functions', '\\bar', CheckType::PARAMETER_NAMES, '8.0');
        $registry->hasProblem('functions', '\\foo', CheckType::PARAMETER_TYPES, '8.0');

        $this->assertSame([CheckType::PARAMETER_NAMES, CheckType::PARAMETER_TYPES], $registry->takeAskedChecks());
        $this->assertSame([], $registry->takeAskedChecks());
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    /**
     * @param ProblemDefinition[] $problems
     * @param ValidatorSuiteCase[] $cases
     */
    private function analyzer(array $problems, array $cases, \Closure $runner): KnownProblemNecessityAnalyzer
    {
        return new KnownProblemNecessityAnalyzer($this->provider($problems), $cases, $runner);
    }

    /**
     * @param ProblemDefinition[] $problems
     */
    private function provider(array $problems): KnownProblemsProvider
    {
        $provider = $this->createStub(KnownProblemsProvider::class);
        $provider->method('getProblems')->willReturn($problems);

        return $provider;
    }

    /**
     * @param string[] $entityIds
     */
    private static function problem(
        EntityType $entityType,
        string $entityId,
        CheckType $check,
        PhpVersions $from,
        PhpVersions $to,
        array $entityIds = []
    ): ProblemDefinition {
        return new ProblemDefinition(
            entityType: $entityType,
            entityId: $entityId,
            type: ProblemType::OVERLOADED_SIGNATURE,
            affectedChecks: [$check],
            versionRange: new PhpVersionRange($from, $to),
            reason: 'Test problem',
            entityIds: $entityIds,
        );
    }

    /**
     * A case whose check name is the CheckType value of the check it runs, for runner().
     */
    private static function suiteCase(CheckType $check, string $entityId, string $phpVersion): ValidatorSuiteCase
    {
        return new ValidatorSuiteCase('FakeValidatorTest', 'testEntity', $check->value, $entityId, $phpVersion);
    }

    /**
     * Stands in for the validator checks. A case runs the check its name gives: like a real
     * check, it asks the registry about its entity, then about each mismatch of that entity or
     * its members, and fails on a mismatch that no known problem suppresses.
     *
     * @param list<array{CheckType, EntityType, string, string}> $mismatches Check, entity type, entity id and PHP version of each mismatch
     * @param string[] $broken Names of cases that fail whatever the registry says
     * @param EntityType $entityType Entity type the cases' entities are asked about under
     */
    private static function runner(array $mismatches, array $broken = [], EntityType $entityType = EntityType::FUNCTION): \Closure
    {
        return static function (ValidatorSuiteCase $case) use ($mismatches, $broken, $entityType): bool {
            $registry = KnownProblemsRegistry::getInstance();
            $check = CheckType::from($case->checkName);
            $passed = !in_array($case->getName(), $broken, true);

            if ($registry->shouldSkipValidation($entityType->value, $case->entityId, $check, $case->phpVersion)) {
                return $passed;
            }

            foreach ($mismatches as [$mismatchCheck, $mismatchType, $mismatchId, $mismatchVersion]) {
                $ofThisCase = $mismatchCheck === $check
                    && $mismatchVersion === $case->phpVersion
                    && ($mismatchId === $case->entityId || str_starts_with($mismatchId, $case->entityId . '::'));

                if ($ofThisCase && !$registry->shouldSkipValidation($mismatchType->value, $mismatchId, $check, $mismatchVersion)) {
                    $passed = false;
                }
            }

            return $passed;
        };
    }
}
