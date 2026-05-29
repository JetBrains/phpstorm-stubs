<?php

namespace StubTests\Framework\Validator\Constants;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\AbstractReflectionCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Framework\Validator\Services\EntityLookupService;

/**
 * Validates that the values of global constants in stubs match reflection.
 *
 * Value comparison is intentionally limited to the latest PHP version to avoid
 * false positives from historical value changes across PHP releases.
 *
 * For each constant identified by $entityId the validator:
 * 1. Skips comparison for non-LATEST PHP versions.
 * 2. Looks up the constant in reflection by ID.
 * 3. Looks up the constant in stubs by ID.
 * 4. If not found in either, silently succeeds — ConstantExistsCheck handles existence.
 * 5. Skips if either value is null (complex/dynamic expressions cannot be compared).
 * 6. Skips resource values stored as 'PHPSTORM_RESOURCE' by the reflection parser.
 * 7. Reports a failure if the string representations of the values differ.
 *
 * Known problems are supported via EntityType::GLOBAL_CONSTANT + constantId + 'ConstantValueCheck'.
 */
class ConstantValueCheck extends AbstractReflectionCheck
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

        if ($this->skipWithKnownProblem($results, EntityType::GLOBAL_CONSTANT->value, $entityId, 'ConstantValueCheck', $phpVersion)) {
            return $results;
        }

        // Value comparison is only meaningful at the latest PHP version
        if ($phpVersion !== PhpVersions::LATEST->value) {
            $results->addSuccess($entityId);
            return $results;
        }

        $reflection = $this->reflectionProvider->getReflection($phpVersion);

        $reflConstant = $this->entityLookup->findConstantById($reflection, $entityId);
        if ($reflConstant === null) {
            $results->addSuccess($entityId);
            return $results;
        }

        $stubConstant = $this->entityLookup->findConstantById($stubs, $entityId);
        if ($stubConstant === null) {
            // Not in stubs — ConstantExistsCheck's responsibility
            $results->addSuccess($entityId);
            return $results;
        }

        // Skip resource values — stored as 'PHPSTORM_RESOURCE' by the reflection parser
        if ($reflConstant->getValue() === 'PHPSTORM_RESOURCE') {
            $results->addSuccess($entityId);
            return $results;
        }

        // Skip if either value is null (complex expressions cannot be compared)
        if ($reflConstant->getValue() === null || $stubConstant->getValue() === null) {
            $results->addSuccess($entityId);
            return $results;
        }

        if ((string) $reflConstant->getValue() !== (string) $stubConstant->getValue()) {
            $results->addFailure(
                $entityId,
                "Constant {$entityId} value mismatch: reflection='{$reflConstant->getValue()}', stub='{$stubConstant->getValue()}'"
            );
            return $results;
        }

        $results->addSuccess($entityId);
        return $results;
    }
}
