<?php

namespace StubTests\Framework\Validator\KnownProblems;

/**
 * Provides a fixed list of problems, such as the default ones with one entry left out.
 */
final class InMemoryKnownProblemsProvider implements KnownProblemsProvider
{
    /**
     * @param ProblemDefinition[] $problems
     */
    public function __construct(
        private readonly array $problems
    ) {}

    public function getProblems(): array
    {
        return $this->problems;
    }

    public function getProblemsForEntity(EntityType $entityType, string $entityId): array
    {
        return array_filter(
            $this->problems,
            fn (ProblemDefinition $problem) => $problem->entityType === $entityType
                && (
                    $problem->entityId === $entityId
                    || (!empty($problem->entityIds) && in_array($entityId, $problem->entityIds, true))
                )
        );
    }
}
