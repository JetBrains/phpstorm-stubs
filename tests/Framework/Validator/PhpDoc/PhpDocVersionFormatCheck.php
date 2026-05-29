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
 * Validates that @since, @deprecated, and @removed phpDoc tags use
 * "major.minor" version format (e.g. 8.0) rather than "major.minor.patch"
 * (e.g. 8.0.1) for style consistency.
 *
 * Only purely numeric three-or-more-component versions are flagged
 * (e.g. "5.1.2", "7.0.7", "4.4.5.35"). Non-numeric qualifiers like
 * "0.4.1(-1)" from library-specific versioning are not flagged.
 *
 * Only core PHP extension entities are checked — third-party extension stubs
 * use their own library version numbers (e.g. "1.2.0" for the MongoDB driver)
 * which are intentionally left unchanged. Entities from known third-party
 * extensions are skipped automatically via THIRD_PARTY_PREFIXES.
 *
 * For class-like entities (classes, interfaces, enums) the check examines:
 * - the entity-level phpDoc
 * - the phpDoc of every declared method
 *
 * For functions the check examines the function-level phpDoc only.
 *
 * Known problems are supported at entity level:
 * - entityType + entityId + 'PhpDocVersionFormatCheck' → skips all version checks for the entity.
 */
class PhpDocVersionFormatCheck extends AbstractReflectionCheck
{
    private EntityLookupService $entityLookup;

    public function __construct(
        ?ReflectionProviderInterface $reflectionProvider = null,
        ?KnownProblemsRegistry $knownProblemsRegistry = null,
        ?EntityLookupService $entityLookup = null
    ) {
        parent::__construct($reflectionProvider, $knownProblemsRegistry);
        $this->entityLookup = $entityLookup ?? new EntityLookupService();
    }

    /**
     * Regex that matches @since, @deprecated, or @removed followed by a version
     * string that has three or more purely numeric dot-separated components.
     *
     * Requires the version to end at whitespace or end-of-string so that
     * library-specific qualifiers like "0.4.1(-1)" are not matched.
     *
     * Capture groups:
     *   1 — tag name (since|deprecated|removed)
     *   2 — major.minor prefix to keep
     *   3 — the rest of the version (patch + any further components)
     */
    private const VERSION_PATTERN = '/^\s*\*\s+@(since|deprecated|removed)\s+(\d+\.\d+)((?:\.\d+)+)(?=\s|$)/m';

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

        if ($this->skipWithKnownProblem($results, $entityType->value, $entityId, 'PhpDocVersionFormatCheck', $phpVersion)) {
            return $results;
        }

        $violationsByLocation = $this->collectViolationsByLocation($entity, $entityId);

        if (empty($violationsByLocation)) {
            $results->addSuccess($entityId);
            return $results;
        }

        foreach ($violationsByLocation as $location => $versions) {
            $results->addFailure(
                $location,
                "{$location} uses patch-level version in phpDoc in PHP {$phpVersion}: " . implode(', ', $versions)
            );
        }

        return $results;
    }

    /**
     * Collect patch-level version violations across the entity phpDoc and all method phpDocs.
     *
     * @return array<string, string[]> Map of location (entityId or methodId) → offending version strings
     */
    private function collectViolationsByLocation(object $entity, string $entityId): array
    {
        $result = [];

        // Entity-level phpDoc
        $phpDoc = $entity->getStubsMetadata()?->getPhpDoc();
        if ($phpDoc !== null && $phpDoc !== '') {
            $violations = $this->findPatchVersions($phpDoc);
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
                $violations = $this->findPatchVersions($phpDoc);
                if (!empty($violations)) {
                    $methodId = $entityId . '::' . $method->getName();
                    $result[$methodId] = $violations;
                }
            }
        }

        return $result;
    }

    /**
     * Return all patch-level version strings found in $phpDoc.
     *
     * A patch-level version is one with three or more purely numeric components,
     * e.g. "5.1.2", "7.0.7", "4.4.5.35".
     *
     * @return string[] Deduplicated list of offending version strings (e.g. ["5.1.2", "7.0.7"])
     */
    private function findPatchVersions(string $phpDoc): array
    {
        $violations = [];
        if (preg_match_all(self::VERSION_PATTERN, $phpDoc, $matches)) {
            foreach ($matches[0] as $i => $fullMatch) {
                $version = $matches[2][$i] . $matches[3][$i];
                $violations[] = $version;
            }
        }
        return array_values(array_unique($violations));
    }

}
