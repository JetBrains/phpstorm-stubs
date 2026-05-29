<?php

namespace StubTests\Framework\Validator\PhpDoc;

use StubTests\Framework\Parsers\Model\PHPClassLikeObject;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractReflectionCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\Services\EntityLookupService;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;

/**
 * Validates that every @link URL in phpDoc comments:
 *   1. Uses the https scheme (always checked).
 *   2. Is reachable and not dead (checked only when the CHECK_LINKS environment
 *      variable is set to "true").
 *
 * For class-like entities (classes, interfaces, enums) the check examines:
 * - the entity-level phpDoc
 * - the phpDoc of every declared method
 *
 * For functions the check examines the function-level phpDoc only.
 *
 * Non-URL values after @link (e.g. cross-references like "ClassName::method")
 * are silently ignored — only entries starting with "http://" or "https://" are
 * validated.
 *
 * Dead-link detection uses an in-process static cache so that the same URL is
 * fetched at most once per test run. Only HTTP 404 / 410 and connection failures
 * are reported; other non-200 responses (403, 429, 5xx …) are treated as alive.
 *
 * To enable liveness checking, export CHECK_LINKS=true before running PHPUnit:
 *   CHECK_LINKS=true php vendor/bin/phpunit tests/PhpDocValidatorTest.php
 *
 * Known problems are supported at entity level:
 * - entityType + entityId + 'PhpDocLinksCheck' → skips all link checks for that entity.
 */
class PhpDocLinksCheck extends AbstractReflectionCheck
{
    /**
     * Matches "@link http://..." or "@link https://..." in a phpDoc block.
     * Capture group 1 is the full URL (no whitespace).
     */
    private const LINK_PATTERN = '/^\s*\*\s+@link\s+(https?:\/\/\S+)/m';

    /**
     * In-process cache: URL → HTTP status code (0 = connection failure).
     *
     * @var array<string, int>
     */
    private static array $urlCache = [];

    /**
     * Callable that takes a URL string and returns an HTTP status code (int).
     * Returns 0 on connection failure.
     *
     * @var callable(string): int
     */
    private $urlFetcher;

    /**
     * When non-null, overrides the CHECK_LINKS environment variable.
     * Useful in unit tests to avoid mutating process-wide state.
     */
    private ?bool $checkLiveness;

    private EntityLookupService $entityLookup;

    public function __construct(
        ?ReflectionProviderInterface $reflectionProvider = null,
        ?KnownProblemsRegistry $knownProblemsRegistry = null,
        ?callable $urlFetcher = null,
        ?bool $checkLiveness = null,
        ?EntityLookupService $entityLookup = null
    ) {
        parent::__construct($reflectionProvider, $knownProblemsRegistry);
        $this->urlFetcher    = $urlFetcher ?? [self::class, 'fetchUrl'];
        $this->checkLiveness = $checkLiveness;
        $this->entityLookup  = $entityLookup ?? new EntityLookupService();
    }

    /**
     * Fetch the HTTP status code for a URL via a cURL HEAD request.
     * Follows redirects (up to 5). Returns 0 on connection / SSL failure.
     *
     * Results are cached in a static map so the same URL is requested only once
     * per PHP process (i.e. per PHPUnit test run).
     */
    public static function fetchUrl(string $url): int
    {
        if (array_key_exists($url, self::$urlCache)) {
            return self::$urlCache[$url];
        }

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_NOBODY         => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS      => 5,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_USERAGENT      => 'phpstorm-stubs-link-checker/1.0 (+https://github.com/JetBrains/phpstorm-stubs)',
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
        ]);
        curl_exec($ch);
        $code = curl_errno($ch) === CURLE_OK
            ? (int) curl_getinfo($ch, CURLINFO_HTTP_CODE)
            : 0;
        curl_close($ch);

        self::$urlCache[$url] = $code;
        return $code;
    }

    /**
     * Clear the static URL cache. Call in test tearDown() to prevent cross-test pollution.
     */
    public static function resetCache(): void
    {
        self::$urlCache = [];
    }

    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        $found = $this->entityLookup->findAnyEntityById($stubs, $entityId);
        if ($found === null) {
            $results->addSuccess($entityId);
            return $results;
        }

        [$entity, $entityType] = $found;

        if ($this->skipWithKnownProblem($results, $entityType->value, $entityId, 'PhpDocLinksCheck', $phpVersion)) {
            return $results;
        }

        $checkLiveness = $this->checkLiveness ?? (getenv('CHECK_LINKS') === 'true');

        $violationsByLocation = $this->collectViolationsByLocation($entity, $entityId, $checkLiveness);

        if (empty($violationsByLocation)) {
            $results->addSuccess($entityId);
            return $results;
        }

        foreach ($violationsByLocation as $location => $violations) {
            $results->addFailure(
                $location,
                "{$location} has @link issues in PHP {$phpVersion}: " . implode('; ', $violations)
            );
        }

        return $results;
    }

    /**
     * Collect @link violations across the entity phpDoc and all method phpDocs.
     *
     * @return array<string, string[]> Map of location → list of violation messages
     */
    private function collectViolationsByLocation(object $entity, string $entityId, bool $checkLiveness): array
    {
        $result = [];

        // Entity-level phpDoc
        $phpDoc = $entity->getStubsMetadata()?->getPhpDoc();
        if ($phpDoc !== null && $phpDoc !== '') {
            $violations = $this->checkLinks($phpDoc, $checkLiveness);
            if (!empty($violations)) {
                $result[$entityId] = $violations;
            }
        }

        // Method-level phpDocs for class-like entities
        if ($entity instanceof PHPClassLikeObject) {
            foreach ($entity->getMethods() as $method) {
                $phpDoc = $method->getStubsMetadata()?->getPhpDoc();
                if ($phpDoc === null || $phpDoc === '') {
                    continue;
                }
                $violations = $this->checkLinks($phpDoc, $checkLiveness);
                if (!empty($violations)) {
                    $methodId = $entityId . '::' . $method->getName();
                    $result[$methodId] = $violations;
                }
            }
        }

        return $result;
    }

    /**
     * Check @link entries in one phpDoc string and return violation messages.
     *
     * @return string[] List of human-readable violation descriptions
     */
    private function checkLinks(string $phpDoc, bool $checkLiveness): array
    {
        if (!preg_match_all(self::LINK_PATTERN, $phpDoc, $matches)) {
            return [];
        }

        $violations = [];

        foreach (array_unique($matches[1]) as $url) {
            if (!str_starts_with($url, 'https://')) {
                $violations[] = "must use https: {$url}";
                // Skip liveness check for non-https URLs (they would need to be
                // fixed to https first anyway).
                continue;
            }

            if ($checkLiveness) {
                $code = ($this->urlFetcher)($url);
                if ($code === 0) {
                    $violations[] = "unreachable: {$url}";
                } elseif ($code === 404 || $code === 410) {
                    $violations[] = "dead link (HTTP {$code}): {$url}";
                }
            }
        }

        return $violations;
    }

}
