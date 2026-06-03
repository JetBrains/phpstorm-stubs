<?php

namespace StubTests\Framework\Validator\Functions;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractCallableCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\EntityType;

/**
 * Validates that the tentative-return-type flag on functions/methods in stubs matches reflection.
 *
 * Tentative return types were introduced in PHP 8.1. The check is bidirectional:
 * - reflection tentative, stub not tentative → failure
 * - stub tentative, reflection not tentative → failure
 *
 * If the function is not found in stubs, validation is silently skipped
 * (FunctionExistsCheck handles existence).
 *
 * Known problems are supported at function level:
 * - EntityType::FUNCTION + functionId + 'TentativeReturnTypeCheck'
 */
class FunctionTentativeReturnTypeCheck extends AbstractCallableCheck
{
    public function supports(string $phpVersion): bool
    {
        // Tentative return types were introduced in PHP 8.1
        return version_compare($phpVersion, '8.1', '>=');
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        $entityType = EntityType::fromEntityId($entityId)->value;
        if ($this->skipWithKnownProblem($results, $entityType, $entityId, 'TentativeReturnTypeCheck', $phpVersion)) {
            return $results;
        }

        $reflection = $this->reflectionProvider->getReflection($phpVersion);
        $reflCallable = $this->findCallable($reflection, $entityId, $phpVersion);

        if ($reflCallable === null) {
            $results->addFailure($entityId, "Function/method {$entityId} not found in reflection data");
            return $results;
        }

        // Stub not found — FunctionExistsCheck's responsibility
        $stubCallable = $this->findCallable($stubs, $entityId, $phpVersion);
        if ($stubCallable === null) {
            $results->addSuccess($entityId);
            return $results;
        }

        $reflTentative = $reflCallable->hasTentativeReturnType();
        $stubTentative = $stubCallable->hasTentativeReturnType();

        if ($reflTentative === $stubTentative) {
            $results->addSuccess($entityId);
            return $results;
        }

        if ($reflTentative && !$stubTentative) {
            $results->addFailure(
                $entityId,
                "Function/method {$entityId} has a tentative return type in PHP {$phpVersion}"
                . " but is not marked with #[TentativeType] in stubs"
            );
        } else {
            $results->addFailure(
                $entityId,
                "Function/method {$entityId} is marked with #[TentativeType] in stubs"
                . " but does not have a tentative return type in PHP {$phpVersion}"
            );
        }

        return $results;
    }
}
