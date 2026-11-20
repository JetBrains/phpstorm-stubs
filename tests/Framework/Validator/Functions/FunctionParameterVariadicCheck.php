<?php

namespace StubTests\Framework\Validator\Functions;

use StubTests\Framework\Storage\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractCallableCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\Services\ParameterPassingComparator;

/**
 * Validates that a function takes a variadic parameter in stubs exactly when it does in
 * reflection (see ParameterPassingComparator for why only presence is compared).
 *
 * The check is bidirectional. If the stub function is not found it is skipped —
 * existence is EntityExistsCheck's responsibility.
 *
 * Known problems are supported via EntityType::FUNCTION / EntityType::METHOD
 * (auto-detected from the entityId format) with checkName 'ParameterVariadicCheck'.
 */
class FunctionParameterVariadicCheck extends AbstractCallableCheck
{
    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        $entityType = EntityType::fromEntityId($entityId)->value;
        if ($this->skipWithKnownProblem($results, $entityType, $entityId, CheckType::PARAMETER_VARIADIC, $phpVersion)) {
            return $results;
        }

        $reflection = $this->reflectionProvider->getReflection($phpVersion);
        $reflCallable = $this->findCallable($reflection, $entityId, $phpVersion);

        if ($reflCallable === null) {
            $results->addFailure($entityId, "Function/method {$entityId} not found in reflection data");
            return $results;
        }

        // Stub not found — EntityExistsCheck's responsibility
        $stubCallable = $this->findCallable($stubs, $entityId, $phpVersion);
        if ($stubCallable === null) {
            $results->addSuccess($entityId);
            return $results;
        }

        $mismatch = ParameterPassingComparator::describeVariadicMismatch(
            $reflCallable->getParameters(),
            $stubCallable->getParameters(),
            $phpVersion
        );

        if ($mismatch !== null) {
            $results->addFailure($entityId, "Function/method {$entityId} in PHP {$phpVersion}: {$mismatch}");
        } else {
            $results->addSuccess($entityId);
        }

        return $results;
    }
}
