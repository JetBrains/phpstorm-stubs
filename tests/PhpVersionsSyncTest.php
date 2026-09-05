<?php

namespace StubTests;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Runner\PhpVersions;

/**
 * Guards against drift between PhpVersions.php and everything keyed off it: the reflection
 * cache files, the pinned-patch manifest, the per-version Docker images, and the
 * EARLIEST/LATEST boundary constants.
 *
 * When a new PHP version is added to PhpVersions.php, the corresponding
 * Reflection{X.Y}.json cache file must also be generated. These tests catch
 * that omission in CI before validators silently skip the new version.
 */
class PhpVersionsSyncTest extends TestCase
{
    /**
     * One representative symbol per extension the per-version Docker images build, and the PHP
     * version that dropped the extension from core (`null` while it is still bundled).
     *
     * Every entry is a *sentinel*, not an inventory: if the symbol is in the cache the extension was
     * loaded when that version's reflection cache was generated, and all of its symbols came with
     * it. Extensions whose only symbols are PDO drivers (pdo_mysql, pdo_odbc, …) are absent from the
     * list on purpose — they expose nothing reflectable of their own.
     *
     * @var array<string, array{0: string, 1: string|null}>
     */
    private const EXTENSION_SENTINELS = [
        'bcmath' => ['bcadd', null],
        'bz2' => ['bzopen', null],
        'calendar' => ['cal_days_in_month', null],
        'dba' => ['dba_open', null],
        'enchant' => ['enchant_broker_init', null],
        'exif' => ['exif_read_data', null],
        'ffi' => ['FFI', null],
        'ftp' => ['ftp_connect', null],
        'gd' => ['imagecreate', null],
        'gettext' => ['gettext', null],
        'gmp' => ['gmp_add', null],
        // Unbundled in PHP 8.4 and moved to PECL: https://wiki.php.net/rfc/unbundle_imap_pspell_oci8
        'imap' => ['imap_open', '8.4'],
        'intl' => ['IntlDateFormatter', null],
        'ldap' => ['ldap_connect', null],
        'mbstring' => ['mb_strlen', null],
        'mysqli' => ['mysqli', null],
        'odbc' => ['odbc_connect', null],
        'opcache' => ['opcache_get_status', null],
        'pcntl' => ['pcntl_fork', null],
        'pgsql' => ['pg_connect', null],
        // Unbundled in PHP 8.4, same RFC as imap.
        'pspell' => ['pspell_new', '8.4'],
        'shmop' => ['shmop_open', null],
        'soap' => ['SoapClient', null],
        'sockets' => ['socket_create', null],
        'sysvmsg' => ['msg_get_queue', null],
        'sysvsem' => ['sem_get', null],
        'sysvshm' => ['shm_attach', null],
        'tidy' => ['tidy_parse_string', null],
        // Removed from core in PHP 7.4: https://wiki.php.net/rfc/deprecations_php_7_4#wddx_extension
        'wddx' => ['wddx_serialize_value', '7.4'],
        'xml' => ['xml_parser_create', null],
        'xsl' => ['XSLTProcessor', null],
        'zip' => ['ZipArchive', null],
    ];
    private string $cacheDir;

    protected function setUp(): void
    {
        $this->cacheDir = __DIR__ . '/cache';
    }

    public function testEachPhpVersionHasReflectionCacheFile(): void
    {
        foreach (PhpVersions::cases() as $version) {
            self::assertFileExists(
                $this->cacheDir . '/Reflection' . $version->value . '.json',
                "Reflection cache missing for PHP {$version->value}. " .
                "Run tests/run-all-reflection-parsers.sh to regenerate, " .
                "then commit the new cache file."
            );
        }
    }

    /**
     * EARLIEST/LATEST are hand-maintained, and ~456 CheckDescriptors are ranged against LATEST.
     * Adding a case without bumping LATEST silently yields zero test cases for the new version
     * (PhpVersionRange::includes() returns false) while every other test still passes.
     */
    public function testEarliestAndLatestPointAtTheBoundaryCases(): void
    {
        $cases = PhpVersions::cases();

        self::assertSame(
            $cases[0],
            PhpVersions::EARLIEST,
            'PhpVersions::EARLIEST must be the first enum case, otherwise every ' .
            'CheckDescriptor ranged from EARLIEST skips the versions before it.'
        );
        self::assertSame(
            $cases[count($cases) - 1],
            PhpVersions::LATEST,
            'PhpVersions::LATEST must be the last enum case, otherwise every ' .
            'CheckDescriptor ranged to LATEST silently skips the newest version.'
        );
    }

    public function testEachPhpVersionHasAPinnedPatchInTheManifest(): void
    {
        $manifestPath = $this->cacheDir . '/php-versions.json';
        self::assertFileExists($manifestPath);

        $manifest = json_decode(file_get_contents($manifestPath), true, 512, JSON_THROW_ON_ERROR);

        foreach (PhpVersions::cases() as $version) {
            self::assertArrayHasKey(
                $version->value,
                $manifest,
                "tests/cache/php-versions.json has no pinned patch for PHP {$version->value}. " .
                "run-all-reflection-parsers.sh reads it to pin the base image, so an unpinned " .
                "version regenerates its cache from a floating patch release."
            );
        }

        foreach (array_keys($manifest) as $minor) {
            self::assertNotNull(
                PhpVersions::tryFrom((string)$minor),
                "tests/cache/php-versions.json pins PHP {$minor}, which has no PhpVersions case. " .
                "Either add the case or drop the manifest entry."
            );
        }
    }

    public function testEachPhpVersionHasADockerImage(): void
    {
        foreach (PhpVersions::cases() as $version) {
            self::assertFileExists(
                __DIR__ . '/DockerImages/' . $version->value . '/Dockerfile',
                "tests/DockerImages/{$version->value}/Dockerfile is missing, so the reflection " .
                "cache for PHP {$version->value} cannot be regenerated."
            );
        }
    }

    /**
     * The per-version Dockerfiles are maintained by hand, and an extension that fails to build on
     * one Alpine edge snapshot tends to get commented out to get the image green again. Nothing
     * noticed: the cache for that version is simply generated without the extension, every entity it
     * declares becomes invisible to the validators, and the suite goes green *because* there is
     * nothing left to compare. 696 entities were missing at LATEST when this guard was written —
     * tidy, odbc, xsl, ftp, gettext, exif and mbstring, all still bundled with PHP.
     *
     * The rule is monotonic coverage: once an extension appears in some version's cache it must
     * appear in every later one, unless EXTENSION_SENTINELS declares the release that dropped it
     * from core. That way a genuine unbundling (imap, pspell, wddx) is a one-line declaration and a
     * broken image build is a failure.
     */
    public function testExtensionCoverageNeverRegressesBetweenVersions(): void
    {
        $firstSeenIn = [];
        // Every regression is collected instead of failing on the first one: fixing this means
        // rebuilding images and regenerating caches, and that is worth doing once for the whole list.
        $problems = [];

        foreach (PhpVersions::cases() as $version) {
            $symbols = $this->symbolNamesInReflectionCache($version);

            foreach (self::EXTENSION_SENTINELS as $extension => [$symbol, $removedIn]) {
                $isPresent = isset($symbols[strtolower($symbol)]);
                $isAfterRemoval = $removedIn !== null && version_compare($version->value, $removedIn, '>=');

                if ($isPresent) {
                    $firstSeenIn[$extension] ??= $version->value;
                    if ($isAfterRemoval) {
                        $problems[] = "{$extension}: declared removed in PHP {$removedIn}, but {$symbol} " .
                            "is still in the PHP {$version->value} cache — correct the 'removedIn' entry, " .
                            "a wrong one hides real coverage loss after it";
                    }
                    continue;
                }

                if (!isset($firstSeenIn[$extension]) || $isAfterRemoval) {
                    // Not built yet at this point in the version series, or legitimately gone.
                    continue;
                }

                $problems[] = "{$extension}: missing from the PHP {$version->value} cache " .
                    "({$symbol} is gone) but present from PHP {$firstSeenIn[$extension]} onwards";
            }
        }

        self::assertSame(
            [],
            $problems,
            "Reflection cache coverage regressed:\n  - " . implode("\n  - ", $problems) . "\n\n" .
            "Either the version's tests/DockerImages/<version>/Dockerfile stopped building the " .
            "extension — restore it and regenerate with tests/run-all-reflection-parsers.sh — or the " .
            "extension really left core, in which case declare the release in " .
            "PhpVersionsSyncTest::EXTENSION_SENTINELS."
        );
    }

    /**
     * @return array<string, true> Lower-cased short names of every entity in the version's cache
     */
    private function symbolNamesInReflectionCache(PhpVersions $version): array
    {
        $path = $this->cacheDir . '/Reflection' . $version->value . '.json';
        self::assertFileExists($path);

        $entities = json_decode(file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);

        $names = [];
        foreach ($entities as $entity) {
            if (isset($entity['name'])) {
                $names[strtolower($entity['name'])] = true;
            }
        }

        return $names;
    }

    public function testNoOrphanedReflectionCacheFiles(): void
    {
        $enumVersions = array_map(fn (PhpVersions $v) => $v->value, PhpVersions::cases());
        $cacheFiles = glob($this->cacheDir . '/Reflection*.json') ?: [];

        foreach ($cacheFiles as $file) {
            $version = substr(basename($file, '.json'), strlen('Reflection'));
            self::assertContains(
                $version,
                $enumVersions,
                "Orphaned cache file Reflection{$version}.json has no matching PhpVersions case. " .
                "Either add the case to PhpVersions.php or delete the stale cache file."
            );
        }
    }
}
