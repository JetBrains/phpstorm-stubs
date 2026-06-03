<?php

namespace StubTests\Framework\Validator\KnownProblems;

use StubTests\Framework\Runner\PhpVersionRange;

/**
 * Immutable value object representing a known validation problem.
 *
 * Defines a specific entity (function/method/class) that has known issues
 * with validation for documented reasons.
 *
 * When $entityIds is non-empty it lists the specific sub-entity identifiers
 * (e.g., individual constants like '\PDO::PGSQL_ASSOC') this problem covers.
 * $entityId then serves as a grouping label (e.g., '\PDO').
 * When $entityIds is empty, $entityId is the single entity identifier.
 */
readonly class ProblemDefinition
{
    /**
     * @param EntityType $entityType Type of entity (function, method, class, class_constant, …)
     * @param string $entityId Fully qualified entity identifier, or a grouping label when $entityIds is non-empty
     * @param ProblemType $type Category of problem
     * @param CheckType[] $affectedChecks List of validator checks that should skip this entity
     * @param PhpVersionRange $versionRange PHP version range where this problem exists
     * @param string $reason Human-readable explanation of why validation is skipped
     * @param string[] $entityIds When non-empty, the problem applies to each ID in this list instead of $entityId
     */
    public function __construct(
        public EntityType $entityType,
        public string $entityId,
        public ProblemType $type,
        public array $affectedChecks,
        public PhpVersionRange $versionRange,
        public string $reason,
        public array $entityIds = [],
    ) {
        // Validate that affectedChecks only contains CheckType instances
        foreach ($affectedChecks as $check) {
            if (!$check instanceof CheckType) {
                throw new \InvalidArgumentException('All affected checks must be instances of CheckType enum');
            }
        }
        foreach ($entityIds as $id) {
            if (!is_string($id)) {
                throw new \InvalidArgumentException('All entityIds must be strings');
            }
        }
    }

    /**
     * Check if this problem affects a specific check for a given PHP version.
     *
     * @param CheckType $check The validator check to test
     * @param string $phpVersion PHP version (e.g., '8.0')
     * @return bool True if this problem affects the given check and version
     */
    public function affects(CheckType $check, string $phpVersion): bool
    {
        return in_array($check, $this->affectedChecks, true)
            && $this->versionRange->includes($phpVersion);
    }

    /**
     * Check if this problem applies to a given PHP version.
     *
     * @param string $phpVersion PHP version (e.g., '8.0')
     * @return bool True if problem exists in this PHP version
     */
    public function appliesToVersion(string $phpVersion): bool
    {
        return $this->versionRange->includes($phpVersion);
    }
}
