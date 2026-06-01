<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\DefaultKnownProblemsProvider;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;

/**
 * Registry for known validation problems in stubs.
 *
 * Some PHP entities (functions, methods) have known issues where stubs
 * cannot perfectly match reflection data. Common cases:
 * - Overloaded function signatures (multiple valid signatures, reflection returns only one)
 * - Version-specific parameter changes
 * - Internal implementation details that differ from public API
 *
 * This registry uses a Provider pattern to load problems from type-safe PHP code,
 * providing compile-time validation and IDE support.
 */
class KnownProblemsRegistry
{
    private static ?KnownProblemsRegistry $instance = null;

    /** @var ProblemDefinition Indexed by entityType => entityId => problems */
    private array $problemsIndex = [];

    public function __construct(
        private KnownProblemsProvider $provider = new DefaultKnownProblemsProvider()
    ) {
        $this->indexProblems();
    }

    /**
     * Get singleton instance of the registry.
     *
     * @param KnownProblemsProvider|null $provider Optional custom provider (mainly for testing)
     * @return self
     */
    public static function getInstance(?KnownProblemsProvider $provider = null): self
    {
        if (self::$instance === null) {
            self::$instance = new self($provider ?? new DefaultKnownProblemsProvider());
        } elseif ($provider !== null && $provider !== self::$instance->provider) {
            throw new \LogicException('KnownProblemsRegistry singleton already initialised with a different provider. ' . 'Call reset() first if you need to replace the provider.');
        }
        return self::$instance;
    }

    /**
     * Index all problems for fast lookup.
     *
     * When a problem has a non-empty $entityIds list, each ID in that list
     * is indexed separately (pointing to the same ProblemDefinition object).
     * Otherwise the single $entityId is used.
     */
    private function indexProblems(): void
    {
        foreach ($this->provider->getProblems() as $problem) {
            $entityTypeKey = $problem->entityType->value;
            $idsToIndex = !empty($problem->entityIds) ? $problem->entityIds : [$problem->entityId];

            if (!isset($this->problemsIndex[$entityTypeKey])) {
                $this->problemsIndex[$entityTypeKey] = [];
            }

            foreach ($idsToIndex as $entityId) {
                if (!isset($this->problemsIndex[$entityTypeKey][$entityId])) {
                    $this->problemsIndex[$entityTypeKey][$entityId] = [];
                }
                $this->problemsIndex[$entityTypeKey][$entityId][] = $problem;
            }
        }
    }

    /**
     * Check if an entity has a known problem for a specific check and PHP version.
     *
     * @param string $entityType Entity type: 'functions', 'methods', 'classes'
     * @param string $entityId Fully qualified entity ID (e.g., '\dba_fetch' or 'DateTime::format')
     * @param string $checkName Name of the check class (e.g., 'ParameterNamesCheck')
     * @param string $phpVersion PHP version being tested (e.g., '8.0')
     * @return bool True if entity has a known problem for this check and version
     */
    public function hasProblem(
        string $entityType,
        string $entityId,
        string $checkName,
        string $phpVersion
    ): bool {
        return $this->getProblemDefinition($entityType, $entityId, $checkName, $phpVersion) !== null;
    }

    /**
     * Get problem definition for an entity.
     *
     * @param string $entityType Entity type: 'functions', 'methods', 'classes'
     * @param string $entityId Fully qualified entity ID
     * @param string $checkName Name of the check class
     * @param string $phpVersion PHP version being tested
     * @return ProblemDefinition|null Problem definition or null if no problem exists
     */
    private function getProblemDefinition(
        string $entityType,
        string $entityId,
        string $checkName,
        string $phpVersion
    ): ?ProblemDefinition {
        $problems = $this->problemsIndex[$entityType][$entityId] ?? [];

        // Convert check name string to CheckType enum
        $checkType = CheckType::tryFrom($checkName);
        if ($checkType === null) {
            return null;
        }

        // Find matching problem
        foreach ($problems as $problem) {
            if ($problem->affects($checkType, $phpVersion)) {
                return $problem;
            }
        }

        return null;
    }

    /**
     * Check if validation should be skipped for an entity.
     *
     * @param string $entityType Entity type: 'functions', 'methods', 'classes'
     * @param string $entityId Fully qualified entity ID
     * @param string $checkName Name of the check class
     * @param string $phpVersion PHP version being tested
     * @return bool True if validation should be skipped
     */
    public function shouldSkipValidation(
        string $entityType,
        string $entityId,
        string $checkName,
        string $phpVersion
    ): bool {
        // All known problems skip validation by default
        return $this->hasProblem($entityType, $entityId, $checkName, $phpVersion);
    }

    /**
     * Get skip reason for an entity (for logging/reporting).
     *
     * @param string $entityType Entity type: 'functions', 'methods', 'classes'
     * @param string $entityId Fully qualified entity ID
     * @param string $checkName Name of the check class
     * @param string $phpVersion PHP version being tested
     * @return string|null Skip reason or null if validation should not be skipped
     */
    public function getSkipReason(
        string $entityType,
        string $entityId,
        string $checkName,
        string $phpVersion
    ): ?string {
        $problem = $this->getProblemDefinition($entityType, $entityId, $checkName, $phpVersion);

        return $problem?->reason;
    }

    /**
     * Reset the singleton instance (useful for testing).
     */
    public static function reset(): void
    {
        self::$instance = null;
    }

    /**
     * Get all registered problems (for debugging/reporting).
     *
     * @return ProblemDefinition[] All problems from provider
     */
    public function getAllProblems(): array
    {
        return $this->provider->getProblems();
    }

    /**
     * Get problems index (for debugging/reporting).
     *
     * @return ProblemDefinition
     */
    public function getProblemsIndex(): array
    {
        return $this->problemsIndex;
    }
}
