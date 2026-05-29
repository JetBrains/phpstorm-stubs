<?php

namespace StubTests\Framework\Validator\KnownProblems;

use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;

/**
 * Interface for providing known validation problems.
 *
 * Implementations define sets of entities that have known issues with
 * validation for documented reasons (e.g., overloaded signatures,
 * reflection limitations).
 *
 * This interface follows the Provider pattern used throughout the codebase
 * (e.g., StubsDataProvider, ReflectionDataProvider) for consistent architecture.
 */
interface KnownProblemsProvider
{
    /**
     * Get all known validation problems.
     *
     * @return ProblemDefinition[] Array of problem definitions
     */
    public function getProblems(): array;

    /**
     * Get problems for a specific entity.
     *
     * @param EntityType $entityType Type of entity (function, method, class)
     * @param string $entityId Fully qualified entity identifier
     * @return ProblemDefinition[] Array of problems for this entity
     */
    public function getProblemsForEntity(EntityType $entityType, string $entityId): array;
}
