<?php

namespace StubTests\Framework\Validator\Functions;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractCallableCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\Services\DeprecationComparator;
use StubTests\Framework\Validator\KnownProblems\EntityType;

/**
 * Validates that functions marked as deprecated in reflection are also deprecated in stubs.
 *
 * The check is one-directional: if reflection reports a function as deprecated, the stub
 * must also declare it deprecated. The reverse is not enforced — stubs may legitimately
 * mark a function deprecated before it appears in older reflection data.
 *
 * Known problems are supported at function level:
 * - EntityType::FUNCTION + functionId + 'FunctionDeprecationCheck'
 *   → skips the deprecation check for that specific function.
 */
class FunctionDeprecationCheck extends AbstractCallableCheck
{
    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, EntityType::FUNCTION->value, $entityId, 'DeprecationCheck', $phpVersion)) {
            return $results;
        }

        $reflection = $this->reflectionProvider->getReflection($phpVersion);
        $reflCallable = $this->findCallable($reflection, $entityId, $phpVersion);

        if ($reflCallable === null) {
            $results->addFailure($entityId, "Function {$entityId} not found in reflection data");
            return $results;
        }

        $stubCallable = $this->findCallable($stubs, $entityId, $phpVersion);

        if ($stubCallable === null) {
            $results->addFailure($entityId, "Function {$entityId} not found in stubs");
            return $results;
        }

        if (DeprecationComparator::isMismatch($reflCallable, $stubCallable)) {
            $results->addFailure(
                $entityId,
                "Function {$entityId} is deprecated in PHP {$phpVersion} but not marked as deprecated in stubs"
            );
            return $results;
        }

        $results->addSuccess($entityId);
        return $results;
    }
}
