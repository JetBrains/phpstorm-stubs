<?php

namespace StubTests\Unit\Validator\PhpDoc;

use PHPUnit\Framework\Attributes\DataProvider;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Storage\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Framework\Validator\PhpDoc\PhpDocSingleReturnCheck;

class PhpDocSingleReturnCheckTest extends PhpDocCheckTestCase
{
    private PhpDocSingleReturnCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new PhpDocSingleReturnCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    private function runCheck(StubDataQueryInterface $stubs, string $entityId): CheckResultSet
    {
        return $this->check->run($stubs, $entityId, PhpVersions::LATEST->value);
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllVersions(): void
    {
        foreach (PhpVersions::cases() as $version) {
            $this->assertTrue(
                $this->check->supports($version->value),
                "PHP {$version->value} must be supported"
            );
        }
    }

    // ── Entity not found ──────────────────────────────────────────────────────

    public function testEntityNotFoundSucceeds(): void
    {
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([]);
        $stubs->method('getInterfaces')->willReturn([]);
        $stubs->method('getEnums')->willReturn([]);
        $stubs->method('getFunctions')->willReturn([]);

        $result = $this->runCheck($stubs, '\\NonExistent');

        $this->assertFalse($result->hasFailures(), 'Missing entity should not be a failure');
    }

    // ── No phpDoc / no @return ────────────────────────────────────────────────

    public function testEntityWithNoPhpDocSucceeds(): void
    {
        $class = $this->makeClass('\\TestClass');
        $result = $this->runCheck($this->makeStubsWithClass($class), '\\TestClass');
        $this->assertFalse($result->hasFailures());
    }

    public function testPhpDocWithoutReturnSucceeds(): void
    {
        $phpDoc = "/**\n * Does something.\n * @param string \$needle\n * @since 8.0\n */";
        $class = $this->makeClass('\\TestClass', phpDoc: $phpDoc);
        $result = $this->runCheck($this->makeStubsWithClass($class), '\\TestClass');
        $this->assertFalse($result->hasFailures());
    }

    // ── Exactly one @return ───────────────────────────────────────────────────

    public function testSingleReturnSucceeds(): void
    {
        $method = $this->makeMethodWithPhpDoc('doSomething', "/**\n * @return string\n */");
        $class = $this->makeClass('\\TestClass', methods: [$method]);
        $result = $this->runCheck($this->makeStubsWithClass($class), '\\TestClass');
        $this->assertFalse($result->hasFailures());
    }

    public function testSingleReturnWithMultiLineDescriptionSucceeds(): void
    {
        // The continuation lines must not be counted as further @return tags.
        $phpDoc = "/**\n * @return string The formatted value,\n *                which may span\n *                several lines.\n */";
        $method = $this->makeMethodWithPhpDoc('format', $phpDoc);
        $class = $this->makeClass('\\TestClass', methods: [$method]);
        $result = $this->runCheck($this->makeStubsWithClass($class), '\\TestClass');
        $this->assertFalse($result->hasFailures());
    }

    /**
     * A description mentioning "@return" mid-line is prose, not a tag.
     */
    public function testReturnWordInsideDescriptionIsNotCounted(): void
    {
        $phpDoc = "/**\n * @return string Unlike @return in other docs, this is prose.\n */";
        $method = $this->makeMethodWithPhpDoc('format', $phpDoc);
        $class = $this->makeClass('\\TestClass', methods: [$method]);
        $result = $this->runCheck($this->makeStubsWithClass($class), '\\TestClass');
        $this->assertFalse($result->hasFailures());
    }

    /**
     * Longer tag names that merely start with "return" are different tags; they are
     * rejected (or accepted) by PhpDocTagsCheck, not counted here.
     *
     * @return array<string, array{string}>
     */
    public static function nonReturnTagProvider(): array
    {
        return [
            '@returns' => ['returns'],
            '@return-type' => ['return-type'],
            '@return_value' => ['return_value'],
        ];
    }

    #[DataProvider('nonReturnTagProvider')]
    public function testSimilarlyNamedTagIsNotCountedAsReturn(string $tag): void
    {
        $phpDoc = "/**\n * @return string\n * @{$tag} string\n */";
        $method = $this->makeMethodWithPhpDoc('doSomething', $phpDoc);
        $class = $this->makeClass('\\TestClass', methods: [$method]);
        $result = $this->runCheck($this->makeStubsWithClass($class), '\\TestClass');
        $this->assertFalse($result->hasFailures(), "@{$tag} is a different tag and must not count as a second @return");
    }

    // ── More than one @return ─────────────────────────────────────────────────

    public function testTwoReturnsInMethodPhpDocIsFailure(): void
    {
        $phpDoc = "/**\n * Gets the end date\n * @return DateTimeInterface|null\n * @since 5.6\n * @return TEnd\n */";
        $method = $this->makeMethodWithPhpDoc('getEndDate', $phpDoc);
        $class = $this->makeClass('\\DatePeriod', methods: [$method]);

        $result = $this->runCheck($this->makeStubsWithClass($class), '\\DatePeriod');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey('\\DatePeriod::getEndDate', $failures, 'Failure should identify the specific method');
        $this->assertStringContainsString('DateTimeInterface|null', $failures['\\DatePeriod::getEndDate'], 'Failure should name both competing types');
        $this->assertStringContainsString('TEnd', $failures['\\DatePeriod::getEndDate']);
    }

    public function testThreeReturnsAreAllReported(): void
    {
        $phpDoc = "/**\n * @return int\n * @return string\n * @return bool\n */";
        $method = $this->makeMethodWithPhpDoc('doSomething', $phpDoc);
        $class = $this->makeClass('\\TestClass', methods: [$method]);

        $result = $this->runCheck($this->makeStubsWithClass($class), '\\TestClass');

        $this->assertTrue($result->hasFailures());
        $message = implode(' ', $result->getFailures());
        $this->assertStringContainsString('3 @return tags', $message);
        foreach (['int', 'string', 'bool'] as $type) {
            $this->assertStringContainsString($type, $message);
        }
    }

    /**
     * Two identical @return tags are still two tags — deduplicating them would hide
     * a duplicate that is just as dead as a conflicting one.
     */
    public function testIdenticalDuplicateReturnsAreFailure(): void
    {
        $phpDoc = "/**\n * @return string\n * @return string\n */";
        $method = $this->makeMethodWithPhpDoc('doSomething', $phpDoc);
        $class = $this->makeClass('\\TestClass', methods: [$method]);

        $result = $this->runCheck($this->makeStubsWithClass($class), '\\TestClass');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('2 @return tags', implode(' ', $result->getFailures()));
    }

    public function testDuplicateReturnInEntityPhpDocIsFailure(): void
    {
        $phpDoc = "/**\n * @return int\n * @return string\n */";
        $class = $this->makeClass('\\TestClass', phpDoc: $phpDoc);

        $result = $this->runCheck($this->makeStubsWithClass($class), '\\TestClass');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey('\\TestClass', $result->getFailures(), 'Failure should be reported at the entity level');
    }

    /**
     * Each location is judged on its own docblock: one @return per method is fine
     * even when several methods each declare one.
     */
    public function testOneReturnPerMethodAcrossManyMethodsSucceeds(): void
    {
        $class = $this->makeClass('\\TestClass', methods: [
            $this->makeMethodWithPhpDoc('first', "/**\n * @return int\n */"),
            $this->makeMethodWithPhpDoc('second', "/**\n * @return string\n */"),
        ]);

        $result = $this->runCheck($this->makeStubsWithClass($class), '\\TestClass');

        $this->assertFalse($result->hasFailures());
    }

    public function testEveryOffendingMethodIsReportedSeparately(): void
    {
        $class = $this->makeClass('\\TestClass', methods: [
            $this->makeMethodWithPhpDoc('first', "/**\n * @return int\n * @return string\n */"),
            $this->makeMethodWithPhpDoc('clean', "/**\n * @return void\n */"),
            $this->makeMethodWithPhpDoc('second', "/**\n * @return bool\n * @return false\n */"),
        ]);

        $result = $this->runCheck($this->makeStubsWithClass($class), '\\TestClass');

        $failures = $result->getFailures();
        $this->assertArrayHasKey('\\TestClass::first', $failures);
        $this->assertArrayHasKey('\\TestClass::second', $failures);
        $this->assertArrayNotHasKey('\\TestClass::clean', $failures, 'A method with a single @return must not be reported');
    }

    // ── Function entity ───────────────────────────────────────────────────────

    public function testFunctionWithSingleReturnSucceeds(): void
    {
        $phpDoc = "/**\n * @param string \$needle\n * @return int|false\n * @since 5.6\n */";
        $function = $this->makePhpDocFunction('\\strpos', $phpDoc);
        $result = $this->runCheck($this->makeStubsWithFunction($function), '\\strpos');
        $this->assertFalse($result->hasFailures());
    }

    public function testFunctionWithDuplicateReturnIsFailure(): void
    {
        $phpDoc = "/**\n * @param string \$needle\n * @return int|false\n * @return int\n */";
        $function = $this->makePhpDocFunction('\\strpos', $phpDoc);

        $result = $this->runCheck($this->makeStubsWithFunction($function), '\\strpos');

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey('\\strpos', $result->getFailures());
    }

    // ── Known problems ────────────────────────────────────────────────────────

    public function testKnownProblemAtEntityLevelSkipsCheck(): void
    {
        KnownProblemsRegistry::reset();
        $provider = $this->createStub(KnownProblemsProvider::class);
        $provider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\TestClass',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PHPDOC_SINGLE_RETURN],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Duplicate @return kept deliberately'
            ),
        ]);
        KnownProblemsRegistry::getInstance($provider);
        $check = new PhpDocSingleReturnCheck();  // must be created AFTER the custom registry

        $phpDoc = "/**\n * @return int\n * @return string\n */";
        $class = $this->makeClass('\\TestClass', phpDoc: $phpDoc);

        $result = $check->run($this->makeStubsWithClass($class), '\\TestClass', PhpVersions::LATEST->value);

        $this->assertFalse($result->hasFailures(), 'Known problem should suppress the failure');
    }
}
