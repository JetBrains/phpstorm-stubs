<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Validator\Contracts\CheckInterface;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;

abstract class AbstractReflectionCheck implements CheckInterface
{
    protected ReflectionProviderInterface $reflectionProvider;
    protected KnownProblemsRegistry $knownProblemsRegistry;

    public function __construct(
        ?ReflectionProviderInterface $reflectionProvider = null,
        ?KnownProblemsRegistry $knownProblemsRegistry = null
    ) {
        $this->reflectionProvider = $reflectionProvider ?? new RunnerReflectionProvider();
        $this->knownProblemsRegistry = $knownProblemsRegistry ?? KnownProblemsRegistry::getInstance();
    }

    /**
     * Records a skipped-success result if a known problem covers this entity, and returns true.
     * Returns false if validation should proceed normally.
     */
    protected function skipWithKnownProblem(
        CheckResultSet $results,
        string $entityType,
        string $entityId,
        string $checkName,
        string $phpVersion
    ): bool {
        if ($this->knownProblemsRegistry->shouldSkipValidation($entityType, $entityId, $checkName, $phpVersion)) {
            $reason = $this->knownProblemsRegistry->getSkipReason($entityType, $entityId, $checkName, $phpVersion);
            $results->addSuccess($entityId . ' (skipped: ' . $reason . ')');
            return true;
        }
        return false;
    }
}
