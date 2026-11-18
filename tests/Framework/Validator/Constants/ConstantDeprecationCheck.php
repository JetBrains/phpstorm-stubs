<?php

namespace StubTests\Framework\Validator\Constants;

use StubTests\Framework\Storage\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractReflectionCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Framework\Validator\Services\DeprecationComparator;
use StubTests\Framework\Validator\Services\EntityLookupService;

/**
 * Validates global constant deprecation against reflection. Runs from PHP 8.4, the first
 * version whose reflection (ReflectionConstant::isDeprecated()) reports it.
 */
class ConstantDeprecationCheck extends AbstractReflectionCheck
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
        return version_compare($phpVersion, '8.4', '>=');
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, EntityType::GLOBAL_CONSTANT->value, $entityId, CheckType::CONSTANT_DEPRECATION, $phpVersion)) {
            return $results;
        }

        $reflConstant = $this->entityLookup->findConstantById($this->reflectionProvider->getReflection($phpVersion), $entityId);
        $stubConstant = $this->entityLookup->findConstantById($stubs, $entityId);
        // A constant missing on either side is ConstantExistsCheck's or StaleEntityCheck's responsibility
        if ($reflConstant === null || $stubConstant === null || !($stubConstant->getStubsMetadata()?->isAvailableIn($phpVersion) ?? true)) {
            $results->addSuccess($entityId);
            return $results;
        }

        $mismatch = DeprecationComparator::describeConstantMismatch($reflConstant, $stubConstant, $entityId, $phpVersion);
        if ($mismatch !== null) {
            $results->addFailure($entityId, $mismatch);
        } else {
            $results->addSuccess($entityId);
        }

        return $results;
    }
}
