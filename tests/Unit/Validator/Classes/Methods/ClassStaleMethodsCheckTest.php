<?php

namespace StubTests\Unit\Validator\Classes\Methods;

use PHPUnit\Framework\Attributes\DataProvider;
use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPMethod;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassStaleMethodsCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

/**
 * Covers ClassStaleMethodsCheck — the only stubs → reflection check in the suite.
 *
 * It shipped in ea9b45cd with no unit coverage, leaving it the single concrete check without any.
 * Its value comes entirely from three narrowing rules (core/bundled only, methods only, magic and
 * PS_UNRESERVE_PREFIX_ excluded), and each of those is a silent-pass path: if one over-matches,
 * the check reports success and the stale method it exists to catch goes unreported. These tests
 * pin each rule in both directions.
 */
class ClassStaleMethodsCheckTest extends CheckTestCase
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

    /**
     * Build a stub class whose recorded source path decides whether it is judged at all.
     */
    private function makeStubClass(string $id, array $methods, string $sourcePath): PHPClass
    {
        $class = $this->makeClass($id, methods: $methods);
        $class->initStubsMetadata()->setSourcePath($sourcePath);

        return $class;
    }

    private function runCheck(PHPClass $stubClass, array $reflectionClasses, string $phpVersion = '8.0'): CheckResultSet
    {
        $provider = $this->createMockReflectionProviderWithClasses($reflectionClasses);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        return (new ClassStaleMethodsCheck($provider))->run($stubs, $stubClass->getId(), $phpVersion);
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsEveryVersion(): void
    {
        $check = new ClassStaleMethodsCheck();

        foreach (PhpVersions::cases() as $version) {
            self::assertTrue($check->supports($version->value), "must support {$version->value}");
        }
    }

    // ── The core behaviour ────────────────────────────────────────────────────

    public function testStubOnlyMethodOnACoreClassIsReported(): void
    {
        $stubClass = $this->makeStubClass('\\DOMDocument', [
            $this->makeMethod('renameNode'),
            $this->makeMethod('createElement'),
        ], 'dom/dom_c.php');
        $reflClass = $this->makeClass('\\DOMDocument', methods: [$this->createMockMethod('createElement')]);

        $result = $this->runCheck($stubClass, [$reflClass]);

        self::assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        self::assertArrayHasKey('\\DOMDocument::renameNode', $failures);
        self::assertStringContainsString('declared in stubs but does not exist', $failures['\\DOMDocument::renameNode']);
        self::assertArrayNotHasKey('\\DOMDocument::createElement', $failures, 'a method reflection has must not be reported');
    }

    public function testNoFailureWhenEveryStubMethodExistsInReflection(): void
    {
        $stubClass = $this->makeStubClass('\\DOMDocument', [$this->makeMethod('createElement')], 'dom/dom_c.php');
        $reflClass = $this->makeClass('\\DOMDocument', methods: [$this->createMockMethod('createElement')]);

        self::assertFalse($this->runCheck($stubClass, [$reflClass])->hasFailures());
    }

    public function testMethodMatchingIsCaseInsensitive(): void
    {
        // PHP method names are case-insensitive, and reflection casing does not always match the
        // stub's. Comparing case-sensitively would report every differently-cased method as stale.
        $stubClass = $this->makeStubClass('\\DOMDocument', [$this->makeMethod('createElement')], 'dom/dom_c.php');
        $reflClass = $this->makeClass('\\DOMDocument', methods: [$this->createMockMethod('CREATEELEMENT')]);

        self::assertFalse($this->runCheck($stubClass, [$reflClass])->hasFailures());
    }

    // ── Narrowing rule 1: core/bundled only ──────────────────────────────────

    public function testPeclClassIsNotJudged(): void
    {
        // A PECL extension is usually absent from the reflecting container, so its stub-only
        // members say nothing about the stub.
        $stubClass = $this->makeStubClass('\\Redis', [$this->makeMethod('onlyInStubs')], 'redis/Redis.php');

        self::assertFalse($this->runCheck($stubClass, [$this->makeClass('\\Redis')])->hasFailures());
    }

    public function testBundledClassIsJudged(): void
    {
        $stubClass = $this->makeStubClass('\\CurlHandle', [$this->makeMethod('onlyInStubs')], 'curl/curl_c.php');

        self::assertTrue($this->runCheck($stubClass, [$this->makeClass('\\CurlHandle')])->hasFailures());
    }

    public function testClassWithoutARecordedSourcePathIsNotJudged(): void
    {
        // No source path means the category cannot be established, so the class must not be judged
        // rather than defaulting to "judgeable".
        $stubClass = $this->makeClass('\\DOMDocument', methods: [$this->makeMethod('onlyInStubs')]);

        self::assertFalse($this->runCheck($stubClass, [$this->makeClass('\\DOMDocument')])->hasFailures());
    }

    // ── Narrowing rule 3: intentional stub-only names ────────────────────────

    /**
     * @return iterable<string, array{string}>
     */
    public static function intentionallyStubOnlyMethodProvider(): iterable
    {
        yield '__construct' => ['__construct'];
        yield '__wakeup' => ['__wakeup'];
        yield '__toString' => ['__toString'];
        yield 'reserved-keyword workaround' => ['PS_UNRESERVE_PREFIX_throw'];
    }

    #[DataProvider('intentionallyStubOnlyMethodProvider')]
    public function testIntentionallyStubOnlyMethodsAreNotReported(string $methodName): void
    {
        $stubClass = $this->makeStubClass('\\DOMDocument', [$this->makeMethod($methodName)], 'dom/dom_c.php');

        self::assertFalse(
            $this->runCheck($stubClass, [$this->makeClass('\\DOMDocument')])->hasFailures(),
            "{$methodName} is declared in stubs on purpose and must never be reported"
        );
    }

    // ── Version awareness ────────────────────────────────────────────────────

    public function testMethodBoundedOutOfThisVersionIsNotReported(): void
    {
        // A method already marked @removed for this version is correctly absent from reflection.
        $removed = $this->makeMethod('renameNode', removedVersion: '8.0');
        $stubClass = $this->makeStubClass('\\DOMDocument', [$removed], 'dom/dom_c.php');

        self::assertFalse($this->runCheck($stubClass, [$this->makeClass('\\DOMDocument')], '8.0')->hasFailures());
    }

    public function testMethodStillAvailableInThisVersionIsReported(): void
    {
        $stillBound = $this->makeMethod('renameNode', removedVersion: '8.0');
        $stubClass = $this->makeStubClass('\\DOMDocument', [$stillBound], 'dom/dom_c.php');

        self::assertTrue($this->runCheck($stubClass, [$this->makeClass('\\DOMDocument')], '7.4')->hasFailures());
    }

    // ── Entity-level short circuits ──────────────────────────────────────────

    public function testClassAbsentFromReflectionIsSkipped(): void
    {
        // EntityExistsCheck's subject: judging members here would report every one of them.
        $stubClass = $this->makeStubClass('\\Removed', [$this->makeMethod('a'), $this->makeMethod('b')], 'dom/dom_c.php');

        self::assertFalse($this->runCheck($stubClass, [])->hasFailures());
    }

    public function testClassMissingFromStubsFails(): void
    {
        $provider = $this->createMockReflectionProviderWithClasses([$this->makeClass('\\DOMDocument')]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([]);

        $result = (new ClassStaleMethodsCheck($provider))->run($stubs, '\\DOMDocument', '8.0');

        self::assertTrue($result->hasFailures());
        self::assertStringContainsString('not found in stubs', implode(' ', $result->getFailures()));
    }

    // ── Only own declarations, not the inherited hierarchy ───────────────────

    public function testInheritedParentMethodsAreNotAttributedToTheChild(): void
    {
        // Reading the collected hierarchy instead of getMethods() attributed a parent's own
        // (correctly unbounded) method to every subclass — e.g. SplFixedArray::rewind reappearing
        // via Iterator after its class-level declaration had been fixed.
        $parent = $this->makeClass('\\ParentClass', methods: [$this->makeMethod('parentOnlyInStubs')]);
        $stubClass = $this->makeStubClass('\\Child', [$this->makeMethod('createElement')], 'dom/dom_c.php');
        $stubClass->setParentClass($parent);

        $reflClass = $this->makeClass('\\Child', methods: [$this->createMockMethod('createElement')]);

        $result = $this->runCheck($stubClass, [$reflClass]);

        self::assertFalse(
            $result->hasFailures(),
            'Only methods declared on the class itself may be judged'
        );
    }

    // ── Known problems ───────────────────────────────────────────────────────

    private function registryWith(ProblemDefinition $problem): KnownProblemsRegistry
    {
        $provider = $this->createStub(KnownProblemsProvider::class);
        $provider->method('getProblems')->willReturn([$problem]);

        KnownProblemsRegistry::reset();

        return KnownProblemsRegistry::getInstance($provider);
    }

    public function testMethodLevelKnownProblemSuppressesTheFailure(): void
    {
        $registry = $this->registryWith(new ProblemDefinition(
            entityType: EntityType::METHOD,
            entityId: '\\DOMDocument::renameNode',
            type: ProblemType::INTERNAL_IMPLEMENTATION,
            affectedChecks: [CheckType::CLASS_STALE_METHODS],
            versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
            reason: 'Stale method skip reason'
        ));

        $stubClass = $this->makeStubClass('\\DOMDocument', [$this->makeMethod('renameNode')], 'dom/dom_c.php');
        $provider = $this->createMockReflectionProviderWithClasses([$this->makeClass('\\DOMDocument')]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaleMethodsCheck($provider, $registry))->run($stubs, '\\DOMDocument', '8.0');

        self::assertFalse($result->hasFailures());
        self::assertStringContainsString('Stale method skip reason', implode(' ', $result->getSuccesses()));
    }

    public function testClassLevelKnownProblemSuppressesTheEntireCheck(): void
    {
        $registry = $this->registryWith(new ProblemDefinition(
            entityType: EntityType::CLASS_TYPE,
            entityId: '\\DOMDocument',
            type: ProblemType::INTERNAL_IMPLEMENTATION,
            affectedChecks: [CheckType::CLASS_STALE_METHODS],
            versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
            reason: 'Whole-class skip reason'
        ));

        $stubClass = $this->makeStubClass('\\DOMDocument', [$this->makeMethod('renameNode')], 'dom/dom_c.php');
        $provider = $this->createMockReflectionProviderWithClasses([$this->makeClass('\\DOMDocument')]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassStaleMethodsCheck($provider, $registry))->run($stubs, '\\DOMDocument', '8.0');

        self::assertFalse($result->hasFailures());
        self::assertStringContainsString('Whole-class skip reason', implode(' ', $result->getSuccesses()));
    }

    // ── Reporting shape ──────────────────────────────────────────────────────

    public function testMultipleStaleMethodsAreAllReportedAndSorted(): void
    {
        $stubClass = $this->makeStubClass('\\DOMDocument', [
            $this->makeMethod('zzz'),
            $this->makeMethod('aaa'),
        ], 'dom/dom_c.php');

        $failures = $this->runCheck($stubClass, [$this->makeClass('\\DOMDocument')])->getFailures();

        self::assertSame(
            ['\\DOMDocument::aaa', '\\DOMDocument::zzz'],
            array_keys($failures),
            'Failures must be reported in sorted order so the output is stable across runs'
        );
    }

    public function testMethodWithoutANameIsIgnored(): void
    {
        $unnamed = new PHPMethod();
        $stubClass = $this->makeStubClass('\\DOMDocument', [$unnamed], 'dom/dom_c.php');

        self::assertFalse($this->runCheck($stubClass, [$this->makeClass('\\DOMDocument')])->hasFailures());
    }
}
