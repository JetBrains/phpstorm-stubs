<?php

namespace StubTests\Framework\Validator\Functions;

use StubTests\Framework\Storage\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractCallableCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\Services\ParameterCountComparator;

/**
 * Validates that the number of parameters in stub functions matches reflection.
 *
 * For each function identified by $entityId the validator:
 * 1. Looks up the function in reflection data for the given PHP version.
 * 2. Looks up the function in stubs using version-aware selection
 *    (PhpStormStubsElementAvailable `from`/`to` on the function itself).
 * 3. If the stub function is not found it is silently skipped — existence is
 *    EntityExistsCheck's responsibility.
 * 4. When both sides are found, the stub parameter list is filtered by version
 *    (PhpStormStubsElementAvailable `from`/`to` on parameters →
 *    sinceVersion/removedVersion) and the resulting count is compared with
 *    the reflection count.
 *
 * Parameter version filtering compares removedVersion **exclusively** (`phpVersion <
 * removedVersion`), per StubsMetadata::isAvailableIn(). The inclusive reading belongs to
 * the attribute, not to removedVersion: DefaultAvailableVersionParser converts
 * `to: '7.0'` into `removedVersion = '7.1'`, so the parameter is still available in
 * PHP 7.0 even though the comparison itself is exclusive.
 *
 * Known problems are supported:
 * - EntityType::FUNCTION + functionId + 'ParametersCountCheck'
 *   → skips the parameter-count check for that specific function.
 */
class FunctionParametersCountCheck extends AbstractCallableCheck
{
    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, EntityType::FUNCTION->value, $entityId, CheckType::PARAMETERS_COUNT, $phpVersion)) {
            return $results;
        }

        $reflection = $this->reflectionProvider->getReflection($phpVersion);
        $reflFunction = $this->findCallable($reflection, $entityId, $phpVersion);

        if ($reflFunction === null) {
            $results->addFailure($entityId, "Function {$entityId} not found in reflection data");
            return $results;
        }

        $stubFunction = $this->findCallable($stubs, $entityId, $phpVersion);

        if ($stubFunction === null) {
            // Function absent from stubs — EntityExistsCheck's responsibility
            $results->addSuccess($entityId);
            return $results;
        }

        $mismatch = ParameterCountComparator::compare(
            $reflFunction->getParameters(),
            $stubFunction->getParameters(),
            $phpVersion
        );

        if ($mismatch !== null) {
            $results->addFailure(
                $entityId,
                "Function {$entityId} parameter count mismatch in PHP {$phpVersion}: {$mismatch}"
            );
            return $results;
        }

        $results->addSuccess($entityId);
        return $results;
    }
}
