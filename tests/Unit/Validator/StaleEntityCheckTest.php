<?php

namespace StubTests\Unit\Validator;

use PHPUnit\Framework\Attributes\DataProvider;
use StubTests\Framework\Model\BasePHPElement;
use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPConstant;
use StubTests\Framework\Model\PHPFunction;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Storage\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\Contracts\LookupKind;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Framework\Validator\Services\ExtensionPresenceService;
use StubTests\Framework\Validator\StaleEntityCheck;

/**
 * Covers StaleEntityCheck — stubs → reflection for top-level entities.
 *
 * Like ClassStaleMethodsCheck, its value comes from its narrowing rules (ships with PHP, extension
 * loaded in this version, intentional stub-only names), and each of them is a silent-pass path. These
 * tests pin each rule in both directions.
 */
class StaleEntityCheckTest extends CheckTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        ExtensionPresenceService::clearCache();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        ExtensionPresenceService::clearCache();
        parent::tearDown();
    }

    private function stubFunction(string $id, string $sourcePath, ?string $since = null, ?string $removed = null): PHPFunction
    {
        $function = $this->makeFunction($id, sinceVersion: $since, removedVersion: $removed);
        $function->initStubsMetadata()->setSourcePath($sourcePath);

        return $function;
    }

    private function stubConstant(string $id, string $sourcePath): PHPConstant
    {
        $constant = $this->makeGlobalConstant($id);
        $constant->initStubsMetadata()->setSourcePath($sourcePath);

        return $constant;
    }

    /**
     * @param list<PHPFunction> $functions
     * @param list<PHPConstant> $constants
     * @param list<PHPClass> $classes
     */
    private function storage(array $functions = [], array $constants = [], array $classes = []): StubDataQueryInterface
    {
        $storage = $this->createMockStorageManager();
        $storage->method('getFunctions')->willReturn($functions);
        $storage->method('getConstants')->willReturn($constants);
        $storage->method('getClasses')->willReturn($classes);
        $storage->method('getInterfaces')->willReturn([]);
        $storage->method('getEnums')->willReturn([]);

        return $storage;
    }

    private function provider(StubDataQueryInterface $reflection): ReflectionProviderInterface
    {
        $provider = $this->createStub(ReflectionProviderInterface::class);
        $provider->method('getReflection')->willReturn($reflection);

        return $provider;
    }

    /**
     * @param list<BasePHPElement> $stubFunctions  The stubs; the first one is the entity under test
     * @param list<BasePHPElement> $reflFunctions
     */
    private function runFunctionCheck(array $stubFunctions, array $reflFunctions, string $phpVersion = '8.0', ?KnownProblemsRegistry $registry = null): CheckResultSet
    {
        $check = new StaleEntityCheck(EntityTypeConfig::forFunction(), $this->provider($this->storage($reflFunctions)), $registry);

        return $check->run($this->storage($stubFunctions), $stubFunctions[0]->getId(), $phpVersion);
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsEveryVersion(): void
    {
        $check = new StaleEntityCheck();

        foreach (PhpVersions::cases() as $version) {
            self::assertTrue($check->supports($version->value), "must support {$version->value}");
        }
    }

    // ── The core behaviour ────────────────────────────────────────────────────

    public function testStubOnlyFunctionIsReportedWhenItsExtensionIsLoaded(): void
    {
        $stale = $this->stubFunction('\\intltz_getGMT', 'intl/intl.php');
        $sibling = $this->stubFunction('\\intltz_get_gmt', 'intl/intl.php');

        $result = $this->runFunctionCheck([$stale, $sibling], [$this->makeFunction('\\intltz_get_gmt')]);

        self::assertTrue($result->hasFailures());
        self::assertStringContainsString('declared in stubs but does not exist in PHP 8.0', $result->getFailures()['\\intltz_getGMT']);
    }

    public function testFunctionPresentInReflectionPasses(): void
    {
        $function = $this->stubFunction('\\intltz_get_gmt', 'intl/intl.php');

        self::assertFalse($this->runFunctionCheck([$function], [$this->makeFunction('\\intltz_get_gmt')])->hasFailures());
    }

    public function testFunctionMatchingIsCaseInsensitive(): void
    {
        // PHP function names are case-insensitive; a casing difference is not a stale stub. The
        // sibling keeps intl loaded, so only the case-insensitive match keeps this from being reported.
        $function = $this->stubFunction('\\intltz_getWindowsID', 'intl/intl.php');
        $sibling = $this->stubFunction('\\intltz_get_gmt', 'intl/intl.php');

        self::assertFalse($this->runFunctionCheck(
            [$function, $sibling],
            [$this->makeFunction('\\intltz_getwindowsid'), $this->makeFunction('\\intltz_get_gmt')]
        )->hasFailures());
    }

    public function testConstantMatchingIsCaseSensitive(): void
    {
        // Constants are case-sensitive, so `E_all` is not the `E_ALL` reflection reports.
        $stub = $this->stubConstant('\\E_all', 'Core/Core_d.php');
        $sibling = $this->stubConstant('\\E_ALL', 'Core/Core_d.php');
        $reflection = $this->storage(constants: [$this->makeGlobalConstant('\\E_ALL')]);

        $check = new StaleEntityCheck(EntityTypeConfig::forConstant(), $this->provider($reflection));
        $result = $check->run($this->storage(constants: [$stub, $sibling]), '\\E_all', '8.0');

        self::assertTrue($result->hasFailures());
    }

    // ── Narrowing rule 1: extensions that ship with PHP only ─────────────────

    public function testPeclFunctionIsNotJudged(): void
    {
        $function = $this->stubFunction('\\redis_only', 'redis/Redis.php');
        $sibling = $this->stubFunction('\\redis_loaded', 'redis/Redis.php');

        self::assertFalse($this->runFunctionCheck([$function, $sibling], [$this->makeFunction('\\redis_loaded')])->hasFailures());
    }

    public function testExternalExtensionIsJudged(): void
    {
        // EXTERNAL extensions (intl, gmp, sockets…) are built from the PHP source tree.
        $function = $this->stubFunction('\\gmp_only_in_stubs', 'gmp/gmp.php');
        $sibling = $this->stubFunction('\\gmp_add', 'gmp/gmp.php');

        self::assertTrue($this->runFunctionCheck([$function, $sibling], [$this->makeFunction('\\gmp_add')])->hasFailures());
    }

    public function testDeclarationWithoutASourcePathIsNotJudged(): void
    {
        $function = $this->makeFunction('\\no_source');

        $result = $this->runFunctionCheck([$function], []);

        self::assertFalse($result->hasFailures());
        self::assertStringContainsString('not declared for this version in an extension that ships with PHP', implode(' ', $result->getSuccesses()));
    }

    // ── Narrowing rule 2: the extension must be loaded in this version ───────

    public function testFunctionIsNotJudgedWhenNothingFromItsExtensionIsInReflection(): void
    {
        // snmp, com_dotnet and the SAPI directories are never loaded in the reflecting containers.
        $function = $this->stubFunction('\\snmpget', 'snmp/snmp.php');

        $result = $this->runFunctionCheck([$function], [$this->makeFunction('\\strlen')]);

        self::assertFalse($result->hasFailures());
        self::assertStringContainsString('extension not loaded', implode(' ', $result->getSuccesses()));
    }

    // ── Version awareness ────────────────────────────────────────────────────

    public function testFunctionBoundedOutOfThisVersionIsNotJudged(): void
    {
        $function = $this->stubFunction('\\is_real', 'standard/standard_5.php', removed: '8.0');
        $sibling = $this->stubFunction('\\is_float', 'standard/standard_5.php');

        self::assertFalse($this->runFunctionCheck([$function, $sibling], [$this->makeFunction('\\is_float')], '8.0')->hasFailures());
    }

    public function testFunctionStillClaimedForThisVersionIsReported(): void
    {
        $function = $this->stubFunction('\\is_real', 'standard/standard_5.php', removed: '8.0');
        $sibling = $this->stubFunction('\\is_float', 'standard/standard_5.php');

        self::assertTrue($this->runFunctionCheck([$function, $sibling], [$this->makeFunction('\\is_float')], '7.4')->hasFailures());
    }

    public function testVersionSplitDeclarationsAreJudgedTogether(): void
    {
        // bcdiv() has one declaration up to 8.0 and another from 8.0. Picking a single declaration
        // would read the entity as unavailable in versions only the other one covers.
        $old = $this->stubFunction('\\bcdiv', 'bcmath/bcmath.php', removed: '8.0');
        $new = $this->stubFunction('\\bcdiv', 'bcmath/bcmath.php', since: '8.0');
        $sibling = $this->stubFunction('\\bcadd', 'bcmath/bcmath.php');

        $result = $this->runFunctionCheck([$old, $new, $sibling], [$this->makeFunction('\\bcadd')], '8.0');

        self::assertTrue($result->hasFailures(), 'the 8.0+ declaration claims 8.0, so the absence must be reported');
    }

    // ── Intentional stub-only names ──────────────────────────────────────────

    /**
     * @return iterable<string, array{EntityTypeConfig, string}>
     */
    public static function intentionallyStubOnlyProvider(): iterable
    {
        yield 'reserved-keyword workaround' => [EntityTypeConfig::forFunction(), '\\PS_UNRESERVE_PREFIX_die'];
        yield 'IDE helper namespace' => [EntityTypeConfig::forClass(), '\\___PHPSTORM_HELPERS\\object'];
        yield 'magic constant' => [EntityTypeConfig::forConstant(), '\\__CLASS__'];
    }

    #[DataProvider('intentionallyStubOnlyProvider')]
    public function testIntentionallyStubOnlyNamesAreNotReported(EntityTypeConfig $config, string $entityId): void
    {
        // Declared in a loaded extension (strlen is in reflection) and missing from reflection, so
        // only the name rule keeps these from being reported.
        $entity = match ($config->lookupKind) {
            LookupKind::FUNCTION => $this->makeFunction($entityId),
            LookupKind::CLASS_TYPE => $this->makeClass($entityId),
            LookupKind::CONSTANT => $this->makeGlobalConstant($entityId),
        };
        $entity->initStubsMetadata()->setSourcePath('standard/standard_0.php');
        $stubs = $this->storage(
            functions: [$this->stubFunction('\\strlen', 'standard/standard_0.php'), ...($entity instanceof PHPFunction ? [$entity] : [])],
            constants: $entity instanceof PHPConstant ? [$entity] : [],
            classes: $entity instanceof PHPClass ? [$entity] : [],
        );

        $check = new StaleEntityCheck($config, $this->provider($this->storage([$this->makeFunction('\\strlen')])));

        self::assertFalse($check->run($stubs, $entityId, '8.0')->hasFailures());
    }

    // ── Caching ──────────────────────────────────────────────────────────────

    public function testExtensionPresenceIsNotSharedBetweenStubStorages(): void
    {
        // Presence depends on which entities a stub directory declares, so two stubs storages checked
        // against the same reflection must not share an answer.
        $reflection = $this->storage([$this->makeFunction('\\gmp_add')]);
        $declaresLoadedFunction = $this->storage([$this->stubFunction('\\gmp_add', 'gmp/gmp.php')]);
        $declaresOnlyStubFunction = $this->storage([$this->stubFunction('\\gmp_only_in_stubs', 'gmp/gmp.php')]);
        $service = new ExtensionPresenceService();

        self::assertTrue($service->isExtensionPresent($declaresLoadedFunction, $reflection, 'gmp'));
        self::assertFalse($service->isExtensionPresent($declaresOnlyStubFunction, $reflection, 'gmp'));
    }

    public function testDeclarationIndexIsBuiltOncePerStorage(): void
    {
        // ValidatorTestBase builds a fresh check, and so a fresh service, for every data-provider
        // row, so the index must be shared across instances rather than rebuilt per row.
        $storage = $this->createStorageManagerMock();
        $storage->expects($this->once())->method('getFunctions')->willReturn([$this->stubFunction('\\strlen', 'standard/standard_0.php')]);

        (new ExtensionPresenceService())->findDeclarations($storage, LookupKind::FUNCTION, '\\strlen');
        (new ExtensionPresenceService())->findDeclarations($storage, LookupKind::FUNCTION, '\\STRLEN');
    }

    // ── Known problems ───────────────────────────────────────────────────────

    public function testKnownProblemSuppressesTheFailure(): void
    {
        $provider = $this->createStub(KnownProblemsProvider::class);
        $provider->method('getProblems')->willReturn([new ProblemDefinition(
            entityType: EntityType::FUNCTION,
            entityId: 'windows-only',
            type: ProblemType::INTERNAL_IMPLEMENTATION,
            affectedChecks: [CheckType::STALE_ENTITY],
            versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
            reason: 'Windows-only skip reason',
            entityIds: ['\\sapi_windows_cp_get'],
        )]);
        $registry = KnownProblemsRegistry::getInstance($provider);

        $function = $this->stubFunction('\\sapi_windows_cp_get', 'standard/standard_9.php');
        $sibling = $this->stubFunction('\\strlen', 'standard/standard_9.php');
        $result = $this->runFunctionCheck([$function, $sibling], [$this->makeFunction('\\strlen')], '8.0', $registry);

        self::assertFalse($result->hasFailures());
        self::assertStringContainsString('Windows-only skip reason', implode(' ', $result->getSuccesses()));
    }
}
