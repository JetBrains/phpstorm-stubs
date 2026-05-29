<?php

namespace StubTests\Unit\Validator\PhpDoc;

use PHPUnit\Framework\Attributes\DataProvider;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Framework\Validator\PhpDoc\PhpDocTagsCheck;
use StubTests\Unit\Validator\PhpDoc\PhpDocCheckTestCase;

class PhpDocTagsCheckTest extends PhpDocCheckTestCase
{
    private PhpDocTagsCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new PhpDocTagsCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    private function runCheck(
		\StubTests\Framework\Parsers\StubDataQueryInterface $stubs,
	    string                                              $entityId
    ): \StubTests\Framework\Validator\Contracts\CheckResultSet {
        return $this->check->run($stubs, $entityId, PhpVersions::LATEST->value);
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllVersions(): void
    {
        $this->assertTrue($this->check->supports(PhpVersions::EARLIEST->value), 'PHP 5.6 must be supported');
        $this->assertTrue($this->check->supports(PhpVersions::PHP_7_0->value),  'PHP 7.0 must be supported');
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_0->value),  'PHP 8.0 must be supported');
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value),   'PHP 8.4 must be supported');
    }

    // ── Entity not found ──────────────────────────────────────────────────────

    public function testEntityNotFoundSucceeds(): void
    {
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([]);
        $stubs->method('getInterfaces')->willReturn([]);
        $stubs->method('getEnums')->willReturn([]);
        $stubs->method('getFunctions')->willReturn([]);

        $result = $this->runCheck($stubs, '\NonExistent');

        $this->assertFalse($result->hasFailures(), 'Missing entity should not be a failure');
    }

    // ── No phpDoc / empty phpDoc ───────────────────────────────────────────────

    public function testEntityWithNoPhpDocSucceeds(): void
    {
        $class = $this->makeClass('\TestClass');
        $result = $this->runCheck($this->makeStubsWithClass($class), '\TestClass');
        $this->assertFalse($result->hasFailures());
    }

    public function testFunctionWithNoPhpDocSucceeds(): void
    {
        $function = $this->makePhpDocFunction('\testFunc', null);
        $result = $this->runCheck($this->makeStubsWithFunction($function), '\testFunc');
        $this->assertFalse($result->hasFailures());
    }

    // ── Valid tags ─────────────────────────────────────────────────────────────

    /**
     * @return array<string, array{string}>
     */
    public static function validTagProvider(): array
    {
        return [
            'param'           => ['param'],
            'return'          => ['return'],
            'throws'          => ['throws'],
            'since'           => ['since'],
            'deprecated'      => ['deprecated'],
            'var'             => ['var'],
            'see'             => ['see'],
            'link'            => ['link'],
            'internal'        => ['internal'],
            'template'        => ['template'],
            'template-covariant' => ['template-covariant'],
            'extends'         => ['extends'],
            'implements'      => ['implements'],
            'immutable'       => ['immutable'],
            'readonly'        => ['readonly'],
            'removed'         => ['removed'],
            'xglobal'         => ['xglobal'],
            'inheritdoc'      => ['inheritdoc'],
            'no-named-arguments' => ['no-named-arguments'],
        ];
    }

    #[DataProvider('validTagProvider')]
    public function testValidTagSucceeds(string $tagName): void
    {
        $phpDoc = "/**\n * @{$tagName} something\n */";
        $class = $this->makeClass('\TestClass', phpDoc: $phpDoc);
        $result = $this->runCheck($this->makeStubsWithClass($class), '\TestClass');
        $this->assertFalse($result->hasFailures(), "@{$tagName} should be valid");
    }

    // ── Invalid tags ───────────────────────────────────────────────────────────

    /**
     * @return array<string, array{string}>
     */
    public static function invalidTagProvider(): array
    {
        return [
            'phpstan-type'           => ['phpstan-type'],
            'phpstan-param'          => ['phpstan-param'],
            'phpstan-return'         => ['phpstan-return'],
            'phpstan-assert'         => ['phpstan-assert'],
            'phpstan-assert-if-true' => ['phpstan-assert-if-true'],
            'phpstan-import-type'    => ['phpstan-import-type'],
            'phpstan-ignore'         => ['phpstan-ignore'],
            'phpstan-impure'         => ['phpstan-impure'],
            'psalm-pure'             => ['psalm-pure'],
            'psalm-assert'           => ['psalm-assert'],
            'psalm-immutable'        => ['psalm-immutable'],
            'psalm-param'            => ['psalm-param'],
            'psalm-return'           => ['psalm-return'],
            'psalm-var'              => ['psalm-var'],
            'phan-type'              => ['phan-type'],
            'unknown-tag'            => ['unknown-tag'],
        ];
    }

    #[DataProvider('invalidTagProvider')]
    public function testInvalidTagIsFailure(string $tagName): void
    {
        $phpDoc = "/**\n * @{$tagName} something\n */";
        $class = $this->makeClass('\TestClass', phpDoc: $phpDoc);
        $result = $this->runCheck($this->makeStubsWithClass($class), '\TestClass');
        $this->assertTrue($result->hasFailures(), "@{$tagName} should be flagged as invalid");
    }

    // ── Case-insensitive tag matching ─────────────────────────────────────────

    public function testInheritDocUppercaseIsValid(): void
    {
        $phpDoc = "/**\n * @inheritDoc\n */";
        $class = $this->makeClass('\TestClass', phpDoc: $phpDoc);
        $result = $this->runCheck($this->makeStubsWithClass($class), '\TestClass');
        $this->assertFalse($result->hasFailures(), '@inheritDoc (mixed case) should be valid');
    }

    public function testPhpstanTypeLowercaseIsInvalid(): void
    {
        $phpDoc = "/**\n * @phpstan-type Foo = int\n */";
        $class = $this->makeClass('\TestClass', phpDoc: $phpDoc);
        $result = $this->runCheck($this->makeStubsWithClass($class), '\TestClass');
        $this->assertTrue($result->hasFailures(), '@phpstan-type should be invalid even lowercase');
    }

    // ── Tag in email address is not matched ───────────────────────────────────

    public function testEmailInAuthorTagIsNotFlaggedAsSeparateTag(): void
    {
        // The @gmail in "user@gmail.com" is inside an @author line — not a block tag
        $phpDoc = "/**\n * @author Jane Doe <jane@gmail.com>\n */";
        $class = $this->makeClass('\TestClass', phpDoc: $phpDoc);
        $result = $this->runCheck($this->makeStubsWithClass($class), '\TestClass');
        $this->assertFalse($result->hasFailures(), 'Email address should not produce false-positive tag');
    }

    // ── Inline tags ───────────────────────────────────────────────────────────

    public function testInlineInheritDocIsValid(): void
    {
        $phpDoc = "/**\n * {@inheritDoc}\n */";
        $class = $this->makeClass('\TestClass', phpDoc: $phpDoc);
        $result = $this->runCheck($this->makeStubsWithClass($class), '\TestClass');
        $this->assertFalse($result->hasFailures(), '{@inheritDoc} inline tag should be valid');
    }

    // ── Method phpDoc is also checked ─────────────────────────────────────────

    public function testInvalidTagInMethodPhpDocIsFailure(): void
    {
        $method = $this->makeMethodWithPhpDoc('doSomething', "/**\n * @psalm-pure\n */");
        $class = $this->makeClass('\TestClass', methods: [$method]);
        $result = $this->runCheck($this->makeStubsWithClass($class), '\TestClass');
        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey('\TestClass::doSomething', $failures, 'Failure should identify the specific method');
    }

    public function testValidTagInMethodPhpDocSucceeds(): void
    {
        $method = $this->makeMethodWithPhpDoc('doSomething', "/**\n * @param string \$foo\n * @return void\n */");
        $class = $this->makeClass('\TestClass', methods: [$method]);
        $result = $this->runCheck($this->makeStubsWithClass($class), '\TestClass');
        $this->assertFalse($result->hasFailures());
    }

    // ── Entity phpDoc invalid + method phpDoc valid ───────────────────────────

    public function testInvalidEntityTagAndValidMethodTagReportsEntityOnly(): void
    {
        $method = $this->makeMethodWithPhpDoc('doSomething', "/**\n * @param string \$foo\n */");
        $class = $this->makeClass('\TestClass', methods: [$method], phpDoc: "/**\n * @phpstan-type Foo = int\n */");
        $result = $this->runCheck($this->makeStubsWithClass($class), '\TestClass');
        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey('\TestClass', $failures, 'Class-level failure expected');
        $this->assertArrayNotHasKey('\TestClass::doSomething', $failures, 'No method failure expected');
    }

    // ── Multiple invalid tags in one phpDoc ───────────────────────────────────

    public function testMultipleInvalidTagsAllReported(): void
    {
        $phpDoc = "/**\n * @phpstan-type Foo = int\n * @psalm-pure\n * @param string \$x\n */";
        $class = $this->makeClass('\TestClass', phpDoc: $phpDoc);
        $result = $this->runCheck($this->makeStubsWithClass($class), '\TestClass');
        $this->assertTrue($result->hasFailures());
        $message = implode('', $result->getFailures());
        $this->assertStringContainsString('phpstan-type', $message);
        $this->assertStringContainsString('psalm-pure', $message);
        $this->assertStringNotContainsString('param', $message);
    }

    // ── Function entity ───────────────────────────────────────────────────────

    public function testFunctionWithValidTagsSucceeds(): void
    {
        $phpDoc = "/**\n * @param string \$needle\n * @return int|false\n */";
        $function = $this->makePhpDocFunction('\strpos', $phpDoc);
        $result = $this->runCheck($this->makeStubsWithFunction($function), '\strpos');
        $this->assertFalse($result->hasFailures());
    }

    public function testFunctionWithInvalidTagIsFailure(): void
    {
        $phpDoc = "/**\n * @psalm-pure\n * @param string \$needle\n */";
        $function = $this->makePhpDocFunction('\strpos', $phpDoc);
        $result = $this->runCheck($this->makeStubsWithFunction($function), '\strpos');
        $this->assertTrue($result->hasFailures());
    }

    // ── Known problems ────────────────────────────────────────────────────────

    public function testKnownProblemAtEntityLevelSkipsCheck(): void
    {
        KnownProblemsRegistry::reset();
        $provider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $provider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: '\TestClass',
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::PHPDOC_TAGS],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Uses tool-specific tags for internal implementation reasons'
            ),
        ]);
        KnownProblemsRegistry::getInstance($provider);
        $check = new PhpDocTagsCheck();  // must be created AFTER the custom registry is in place

        $phpDoc = "/**\n * @phpstan-type Foo = int\n */";
        $class = $this->makeClass('\TestClass', phpDoc: $phpDoc);
        $result = $check->run($this->makeStubsWithClass($class), '\TestClass', PhpVersions::LATEST->value);
        $this->assertFalse($result->hasFailures(), 'Known problem should suppress the failure');
    }
}
