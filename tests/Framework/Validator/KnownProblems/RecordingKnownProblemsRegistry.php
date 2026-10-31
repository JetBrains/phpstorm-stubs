<?php

namespace StubTests\Framework\Validator\KnownProblems;

use StubTests\Framework\Validator\KnownProblemsRegistry;

/**
 * A KnownProblemsRegistry that also records which checks asked it for a known problem.
 *
 * A check asks the registry about every entity and member it validates, whether or not an
 * entry exists for it, so the check types asked about show which checks a validator test
 * case actually ran. KnownProblemNecessityAnalyzer uses this to tell the cases that can
 * exercise an entry from the ones that run unrelated checks on the same entity.
 *
 * Checks take the registry from the singleton, so install this one with
 * KnownProblemsRegistry::reset() followed by RecordingKnownProblemsRegistry::getInstance().
 */
class RecordingKnownProblemsRegistry extends KnownProblemsRegistry
{
    /** @var array<string, CheckType> */
    private array $askedChecks = [];

    public function hasProblem(
        string $entityType,
        string $entityId,
        CheckType $checkType,
        string $phpVersion
    ): bool {
        $this->askedChecks[$checkType->value] = $checkType;

        return parent::hasProblem($entityType, $entityId, $checkType, $phpVersion);
    }

    /**
     * Returns the checks that asked since the previous call, and forgets them.
     *
     * @return list<CheckType>
     */
    public function takeAskedChecks(): array
    {
        $checks = array_values($this->askedChecks);
        $this->askedChecks = [];

        return $checks;
    }
}
