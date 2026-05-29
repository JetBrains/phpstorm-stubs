<?php

namespace StubTests\Framework\Validator\Constants;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractReflectionCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;
use StubTests\Framework\Validator\Services\EntityLookupService;

/**
 * Validates that global constants from reflection exist in stubs.
 */
class ConstantExistsCheck extends AbstractReflectionCheck
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

    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, EntityType::GLOBAL_CONSTANT->value, $entityId, 'ConstantExistsCheck', $phpVersion)) {
            return $results;
        }

        if ($this->entityLookup->findConstantById($stubs, $entityId) !== null) {
            $results->addSuccess($entityId);
        } else {
            $results->addFailure($entityId, "Constant {$entityId} exists in PHP {$phpVersion} but not in stubs");
        }

        return $results;
    }
}
