<?php

namespace StubTests\Unit\Validator\PhpDoc;

use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Framework\Validator\PhpDoc\PhpDocLinksCheck;
use StubTests\Unit\Validator\PhpDoc\PhpDocCheckTestCase;

class PhpDocLinksCheckTest extends PhpDocCheckTestCase
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
     * Build a check instance with liveness disabled and an optional URL fetcher spy.
     *
     * @param callable(string): int|null $urlFetcher
     */
    private function makeCheck(?callable $urlFetcher = null, bool $checkLiveness = false): PhpDocLinksCheck
    {
        return new PhpDocLinksCheck(
            reflectionProvider: null,
            knownProblemsRegistry: null,
            urlFetcher: $urlFetcher,
            checkLiveness: $checkLiveness
        );
    }

    private function runCheck(
		PhpDocLinksCheck                                    $check,
	    \StubTests\Framework\Parsers\StubDataQueryInterface $stubs,
	    string                                              $entityId
    ): \StubTests\Framework\Validator\Contracts\CheckResultSet {
        return $check->run($stubs, $entityId, PhpVersions::LATEST->value);
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllVersions(): void
    {
        $check = $this->makeCheck();
        $this->assertTrue($check->supports(PhpVersions::EARLIEST->value), 'PHP 5.6 must be supported');
        $this->assertTrue($check->supports(PhpVersions::PHP_7_0->value),  'PHP 7.0 must be supported');
        $this->assertTrue($check->supports(PhpVersions::PHP_8_0->value),  'PHP 8.0 must be supported');
        $this->assertTrue($check->supports(PhpVersions::LATEST->value),   'PHP 8.4 must be supported');
    }

    // ── Entity not found ──────────────────────────────────────────────────────

    public function testEntityNotFoundSucceeds(): void
    {
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([]);
        $stubs->method('getInterfaces')->willReturn([]);
        $stubs->method('getEnums')->willReturn([]);
        $stubs->method('getFunctions')->willReturn([]);

        $result = $this->runCheck($this->makeCheck(), $stubs, '\\NonExistent');

        $this->assertFalse($result->hasFailures(), 'Missing entity should not be a failure');
    }

    // ── No phpDoc / no @link tags ─────────────────────────────────────────────

    public function testEntityWithNoPhpDocSucceeds(): void
    {
        $class = $this->makeClass('\\TestClass');
        $result = $this->runCheck($this->makeCheck(), $this->makeStubsWithClass($class), '\\TestClass');
        $this->assertFalse($result->hasFailures());
    }

    public function testEntityWithPhpDocButNoLinkTagSucceeds(): void
    {
        $phpDoc = "/**\n * @since 8.0\n * @return string\n */";
        $class = $this->makeClass('\\TestClass', phpDoc: $phpDoc);
        $result = $this->runCheck($this->makeCheck(), $this->makeStubsWithClass($class), '\\TestClass');
        $this->assertFalse($result->hasFailures());
    }

    // ── https scheme (format check, always runs) ─────────────────────────────

    public function testHttpsLinkSucceeds(): void
    {
        $phpDoc = "/**\n * @link https://php.net/manual/en/function.fopen.php\n */";
        $class = $this->makeClass('\\TestClass', phpDoc: $phpDoc);
        $result = $this->runCheck($this->makeCheck(), $this->makeStubsWithClass($class), '\\TestClass');
        $this->assertFalse($result->hasFailures(), 'https:// link should pass format check');
    }

    public function testHttpLinkIsFailure(): void
    {
        $phpDoc = "/**\n * @link http://php.net/manual/en/function.fopen.php\n */";
        $class = $this->makeClass('\\TestClass', phpDoc: $phpDoc);
        $result = $this->runCheck($this->makeCheck(), $this->makeStubsWithClass($class), '\\TestClass');
        $this->assertTrue($result->hasFailures(), 'http:// link must be flagged');
        $this->assertStringContainsString(
            'must use https',
            implode(' ', $result->getFailures()),
            'Failure message should mention the https requirement'
        );
    }

    public function testNonUrlLinkReferenceIsIgnored(): void
    {
        // @link with a non-URL cross-reference should not be matched
        $phpDoc = "/**\n * @link SomeClass::someMethod\n */";
        $class = $this->makeClass('\\TestClass', phpDoc: $phpDoc);
        $result = $this->runCheck($this->makeCheck(), $this->makeStubsWithClass($class), '\\TestClass');
        $this->assertFalse($result->hasFailures(), '@link without http(s):// should be ignored');
    }

    // ── Multiple links ────────────────────────────────────────────────────────

    public function testMultipleHttpLinksAllReported(): void
    {
        $phpDoc = "/**\n * @link http://php.net/fopen\n * @link http://php.net/fclose\n */";
        $class = $this->makeClass('\\TestClass', phpDoc: $phpDoc);
        $result = $this->runCheck($this->makeCheck(), $this->makeStubsWithClass($class), '\\TestClass');
        $this->assertTrue($result->hasFailures());
        $message = implode(' ', $result->getFailures());
        $this->assertStringContainsString('http://php.net/fopen', $message);
        $this->assertStringContainsString('http://php.net/fclose', $message);
    }

    public function testMixedLinksOnlyHttpFlagged(): void
    {
        $phpDoc = "/**\n * @link https://php.net/fopen Good link.\n * @link http://php.net/fclose Bad link.\n */";
        $class = $this->makeClass('\\TestClass', phpDoc: $phpDoc);
        $result = $this->runCheck($this->makeCheck(), $this->makeStubsWithClass($class), '\\TestClass');
        $this->assertTrue($result->hasFailures());
        $message = implode(' ', $result->getFailures());
        $this->assertStringNotContainsString('php.net/fopen', $message, 'https link must not be flagged');
        $this->assertStringContainsString('http://php.net/fclose', $message);
    }

    // ── Method-level phpDoc ───────────────────────────────────────────────────

    public function testHttpLinkInMethodPhpDocIsFailure(): void
    {
        $method = $this->makeMethodWithPhpDoc('doSomething', "/**\n * @link http://php.net/doSomething\n */");
        $class = $this->makeClass('\\TestClass', methods: [$method]);
        $result = $this->runCheck($this->makeCheck(), $this->makeStubsWithClass($class), '\\TestClass');
        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey('\\TestClass::doSomething', $failures, 'Failure should identify the method');
    }

    public function testHttpsLinkInMethodPhpDocSucceeds(): void
    {
        $method = $this->makeMethodWithPhpDoc('doSomething', "/**\n * @link https://php.net/doSomething\n */");
        $class = $this->makeClass('\\TestClass', methods: [$method]);
        $result = $this->runCheck($this->makeCheck(), $this->makeStubsWithClass($class), '\\TestClass');
        $this->assertFalse($result->hasFailures());
    }

    // ── Function entity ───────────────────────────────────────────────────────

    public function testFunctionWithHttpsLinkSucceeds(): void
    {
        $phpDoc = "/**\n * @link https://php.net/manual/en/function.strpos.php\n */";
        $function = $this->makePhpDocFunction('\\strpos', $phpDoc);
        $result = $this->runCheck($this->makeCheck(), $this->makeStubsWithFunction($function), '\\strpos');
        $this->assertFalse($result->hasFailures());
    }

    public function testFunctionWithHttpLinkIsFailure(): void
    {
        $phpDoc = "/**\n * @link http://php.net/manual/en/function.strpos.php\n */";
        $function = $this->makePhpDocFunction('\\strpos', $phpDoc);
        $result = $this->runCheck($this->makeCheck(), $this->makeStubsWithFunction($function), '\\strpos');
        $this->assertTrue($result->hasFailures());
    }

    // ── Liveness check (opt-in, injected urlFetcher) ─────────────────────────

    public function testLivenessNotCheckedByDefault(): void
    {
        $fetcher = function (string $url): int {
            $this->fail('urlFetcher must not be called when liveness is disabled');
        };

        $phpDoc = "/**\n * @link https://php.net/example\n */";
        $class  = $this->makeClass('\\TestClass', phpDoc: $phpDoc);
        $check  = new PhpDocLinksCheck(null, null, $fetcher, checkLiveness: false);
        $result = $check->run($this->makeStubsWithClass($class), '\\TestClass', PhpVersions::LATEST->value);
        $this->assertFalse($result->hasFailures());
    }

    public function testLivenessCheckPassesFor200(): void
    {
        $fetcher = fn(string $url): int => 200;

        $phpDoc = "/**\n * @link https://php.net/example\n */";
        $class  = $this->makeClass('\\TestClass', phpDoc: $phpDoc);
        $check  = new PhpDocLinksCheck(null, null, $fetcher, checkLiveness: true);
        $result = $check->run($this->makeStubsWithClass($class), '\\TestClass', PhpVersions::LATEST->value);
        $this->assertFalse($result->hasFailures(), 'HTTP 200 should be alive');
    }

    public function testLivenessCheckFailsFor404(): void
    {
        $fetcher = fn(string $url): int => 404;

        $phpDoc = "/**\n * @link https://php.net/example\n */";
        $class  = $this->makeClass('\\TestClass', phpDoc: $phpDoc);
        $check  = new PhpDocLinksCheck(null, null, $fetcher, checkLiveness: true);
        $result = $check->run($this->makeStubsWithClass($class), '\\TestClass', PhpVersions::LATEST->value);
        $this->assertTrue($result->hasFailures(), 'HTTP 404 should be a dead link');
        $this->assertStringContainsString('dead link (HTTP 404)', implode(' ', $result->getFailures()));
    }

    public function testLivenessCheckFailsFor410(): void
    {
        $fetcher = fn(string $url): int => 410;

        $phpDoc = "/**\n * @link https://php.net/example\n */";
        $class  = $this->makeClass('\\TestClass', phpDoc: $phpDoc);
        $check  = new PhpDocLinksCheck(null, null, $fetcher, checkLiveness: true);
        $result = $check->run($this->makeStubsWithClass($class), '\\TestClass', PhpVersions::LATEST->value);
        $this->assertTrue($result->hasFailures(), 'HTTP 410 (Gone) should be a dead link');
        $this->assertStringContainsString('dead link (HTTP 410)', implode(' ', $result->getFailures()));
    }

    public function testLivenessCheckFailsOnConnectionFailure(): void
    {
        $fetcher = fn(string $url): int => 0;  // 0 = curl connection failure

        $phpDoc = "/**\n * @link https://php.net/example\n */";
        $class  = $this->makeClass('\\TestClass', phpDoc: $phpDoc);
        $check  = new PhpDocLinksCheck(null, null, $fetcher, checkLiveness: true);
        $result = $check->run($this->makeStubsWithClass($class), '\\TestClass', PhpVersions::LATEST->value);
        $this->assertTrue($result->hasFailures(), 'Connection failure should be reported');
        $this->assertStringContainsString('unreachable', implode(' ', $result->getFailures()));
    }

    public function testLivenessCheckPassesFor403(): void
    {
        // 403 means the server exists but won't serve — treated as alive
        $fetcher = fn(string $url): int => 403;

        $phpDoc = "/**\n * @link https://php.net/example\n */";
        $class  = $this->makeClass('\\TestClass', phpDoc: $phpDoc);
        $check  = new PhpDocLinksCheck(null, null, $fetcher, checkLiveness: true);
        $result = $check->run($this->makeStubsWithClass($class), '\\TestClass', PhpVersions::LATEST->value);
        $this->assertFalse($result->hasFailures(), 'HTTP 403 should not be treated as dead');
    }

    public function testLivenessCheckPassesFor301(): void
    {
        // curl follows redirects by default; fetchUrl would get the final code.
        // Even if 301 is returned directly it should be treated as alive.
        $fetcher = fn(string $url): int => 301;

        $phpDoc = "/**\n * @link https://php.net/example\n */";
        $class  = $this->makeClass('\\TestClass', phpDoc: $phpDoc);
        $check  = new PhpDocLinksCheck(null, null, $fetcher, checkLiveness: true);
        $result = $check->run($this->makeStubsWithClass($class), '\\TestClass', PhpVersions::LATEST->value);
        $this->assertFalse($result->hasFailures(), 'HTTP 301 should not be treated as dead');
    }

    public function testHttpLinkSkipsLivenessCheck(): void
    {
        // http:// links should NOT have liveness checked — they fail format first
        $called = false;
        $fetcher = function (string $url) use (&$called): int {
            $called = true;
            return 200;
        };

        $phpDoc = "/**\n * @link http://php.net/example\n */";
        $class  = $this->makeClass('\\TestClass', phpDoc: $phpDoc);
        $check  = new PhpDocLinksCheck(null, null, $fetcher, checkLiveness: true);
        $check->run($this->makeStubsWithClass($class), '\\TestClass', PhpVersions::LATEST->value);
        $this->assertFalse($called, 'http:// links must not be checked for liveness');
    }

    // ── Known problems ────────────────────────────────────────────────────────

    public function testKnownProblemAtEntityLevelSkipsCheck(): void
    {
        KnownProblemsRegistry::reset();
        $provider = $this->createMock(KnownProblemsProvider::class);
        $provider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\\TestClass',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PHPDOC_LINKS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Known dead link in legacy phpDoc'
            ),
        ]);
        KnownProblemsRegistry::getInstance($provider);

        $phpDoc = "/**\n * @link http://example.com/dead\n */";
        $class  = $this->makeClass('\\TestClass', phpDoc: $phpDoc);
        $check  = new PhpDocLinksCheck();
        $result = $check->run($this->makeStubsWithClass($class), '\\TestClass', PhpVersions::LATEST->value);
        $this->assertFalse($result->hasFailures(), 'Known problem should suppress the failure');
    }
}
