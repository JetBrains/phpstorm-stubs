<?php

namespace StubTests;

use PHPUnit\Framework\Attributes\DataProvider;
use ReflectionClass;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Runner\RunnerScope;
use StubTests\Framework\Validator\PhpDoc\PhpDocLinksCheck;
use StubTests\Framework\Validator\PhpDoc\PhpDocTagsCheck;
use StubTests\Framework\Validator\PhpDoc\PhpDocVersionFormatCheck;
use StubTests\ValidatorTestBase;

/**
 * Validates that PhpDoc comments in stubs contain only recognized tag names,
 * and that @since/@deprecated/@removed use "major.minor" version format.
 *
 * Unlike other validator tests, this test iterates stubs entities directly
 * (not reflection data) and only runs at the LATEST PHP version — PhpDoc
 * content does not vary by PHP version.
 *
 * Each stub entity (function, class, interface, enum) is a separate test case.
 * For class-like entities the check also examines all declared method phpDocs.
 */
class PhpDocValidatorTest extends ValidatorTestBase
{
    /**
     * Entity ID prefixes that identify third-party / PECL extension stubs.
     *
     * Third-party stubs use their OWN library version numbers (e.g. "1.2.0"
     * for the MongoDB driver) which must not be forced to "major.minor" format.
     * The version-format check is intentionally limited to core PHP stubs only.
     */
    private const THIRD_PARTY_PREFIXES = [
        '\\MongoDB\\', '\\Swoole\\', '\\Co\\', '\\swoole_',
        '\\Relay\\',
        '\\Yaf\\', '\\Yaf_',
        '\\Yar\\', '\\Yar_',
        '\\Imagick', '\\ImagickDraw', '\\ImagickPixel', '\\ImagickKernel',
        '\\Redis', '\\RedisArray', '\\RedisCluster', '\\RedisSentinel',
        '\\Memcached',
        '\\Mongo',
        '\\geoip_', '\\newrelic_', '\\radius_', '\\libvirt_',
        '\\rpm',          // rpminfo extension: rpminfo, rpmvercmp, rpmdbinfo, rpmdbsearch, rpmaddtag
        '\\xxtea_', '\\XXTEA',
        '\\lzf_',
        '\\Sync',
        '\\http_', '\\Http',  // pecl_http: http_* functions + HttpQueryString, HttpMessage, etc.
    ];

    #[DataProvider('entityProvider')]
    public function testEntity(string $methodName, string $entityId, string $phpVersion): void
    {
        parent::testEntity($methodName, $entityId, $phpVersion);
    }

    #[DataProvider('coreStubsProvider')]
    public function testCoreEntity(string $methodName, string $entityId, string $phpVersion): void
    {
        parent::testEntity($methodName, $entityId, $phpVersion);
    }

    /**
     * Override to iterate stubs entities (not reflection) at LATEST version only.
     *
     * PhpDoc tag validity does not depend on the PHP runtime version, so there
     * is no benefit to running the same check across all supported versions.
     *
     * @return iterable<string, array{string, string, string}>
     */
    public static function entityProvider(): iterable
    {
        $reflector = new ReflectionClass(static::class);
        $version   = PhpVersions::LATEST->value;
        $stubs     = RunnerScope::get()->getStubs();

        foreach ($reflector->getMethods() as $method) {
            $attrs = $method->getAttributes(PhpVersionRange::class);
            if (empty($attrs)) {
                continue;
            }

            foreach ($attrs as $attr) {
                /** @var PhpVersionRange $range */
                $range = $attr->newInstance();
                if (!$range->includes($version)) {
                    continue;
                }

                $seenIds = [];
                foreach (static::getAllStubEntities($stubs) as $entity) {
                    $entityId = static::getEntityId($entity);
                    if ($entityId === null || isset($seenIds[$entityId])) {
                        continue;
                    }
                    $seenIds[$entityId] = true;

                    $testName = static::buildTestName($method->getName(), $entityId, $version);
                    yield $testName => [$method->getName(), $entityId, $version];
                }
            }
        }
    }

    /**
     * Yield all stubs entities: functions, classes, interfaces, enums.
     *
     * @return iterable<object>
     */
    private static function getAllStubEntities(StubDataQueryInterface $stubs): iterable
    {
        foreach ($stubs->getFunctions() as $entity) {
            yield $entity;
        }
        foreach ($stubs->getClasses() as $entity) {
            yield $entity;
        }
        foreach ($stubs->getInterfaces() as $entity) {
            yield $entity;
        }
        foreach ($stubs->getEnums() as $entity) {
            yield $entity;
        }
    }

    /**
     * Check that PhpDoc comments contain only valid phpDocumentor/PHPStan tags.
     *
     * Tags with phpstan-*, psalm-*, or phan-* prefixes are invalid.
     * Any tag not in the recognized whitelist is also flagged.
     */
    #[PhpVersionRange(PhpVersions::LATEST, PhpVersions::LATEST)]
    public function checkPhpDocContainsOnlyValidTag(string $entityId, string $phpVersion): void
    {
        $this->executeCheck(
            new PhpDocTagsCheck(),
            $entityId,
            $phpVersion,
            "PhpDoc of {$entityId} contains invalid tags in PHP {$phpVersion}"
        );
    }

    /**
     * Check that all @link URLs in PhpDoc comments use the https scheme
     * and, when CHECK_LINKS=true is set in the environment, are reachable.
     *
     * The liveness check is skipped by default because fetching thousands of
     * URLs would make the test suite unacceptably slow for regular CI runs.
     * Enable it explicitly:
     *
     *   CHECK_LINKS=true php vendor/bin/phpunit tests/PhpDocValidatorTest.php \
     *       --filter checkPhpDocLinks
     */
    #[PhpVersionRange(PhpVersions::LATEST, PhpVersions::LATEST)]
    public function checkPhpDocLinks(string $entityId, string $phpVersion): void
    {
        $this->executeCheck(
            new PhpDocLinksCheck(),
            $entityId,
            $phpVersion,
            "PhpDoc of {$entityId} has @link issues in PHP {$phpVersion}"
        );
    }

    /**
     * Data provider for checkDeprecatedRemovedSinceVersionsMajor.
     *
     * Yields only core PHP stubs entities (third-party PECL/library stubs use
     * their own version numbers which must not be forced to "major.minor" format).
     *
     * @return iterable<string, array{string, string, string}>
     */
    public static function coreStubsProvider(): iterable
    {
        $version = PhpVersions::LATEST->value;
        $stubs   = RunnerScope::get()->getStubs();
        $seenIds = [];

        foreach (static::getAllStubEntities($stubs) as $entity) {
            $entityId = static::getEntityId($entity);
            if ($entityId === null || isset($seenIds[$entityId]) || !static::isCoreStubsEntity($entityId)) {
                continue;
            }
            $seenIds[$entityId] = true;

            $testName = static::buildTestName('checkDeprecatedRemovedSinceVersionsMajor', $entityId, $version);
            yield $testName => ['checkDeprecatedRemovedSinceVersionsMajor', $entityId, $version];
        }
    }

    /**
     * Return true when the entity belongs to core PHP (not a third-party extension).
     */
    private static function isCoreStubsEntity(string $entityId): bool
    {
        foreach (self::THIRD_PARTY_PREFIXES as $prefix) {
            if (str_starts_with($entityId, $prefix)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Check that @since, @deprecated, and @removed tags use "major.minor" version
     * format (e.g. 8.0) rather than "major.minor.patch" (e.g. 8.0.1).
     *
     * This method is invoked via coreStubsProvider (not entityProvider) so that
     * only core PHP extension entities are checked — third-party extensions use
     * their own library version numbers.
     */
    public function checkDeprecatedRemovedSinceVersionsMajor(string $entityId, string $phpVersion): void
    {
        $this->executeCheck(
            new PhpDocVersionFormatCheck(),
            $entityId,
            $phpVersion,
            "PhpDoc of {$entityId} uses patch-level version in PHP {$phpVersion}"
        );
    }
}
