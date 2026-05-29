<?php

namespace StubTests\Framework\Validator\Functions;

use StubTests\Framework\Validator\Functions\description;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractCallableCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\Services\OptionalParametersComparator;

/**
 * Validates that parameters optional in reflection are also optional in stub functions.
 *
 * The check is one-directional: if reflection reports a parameter as optional,
 * the stub must also declare it optional. The reverse is not enforced — stubs may
 * legitimately mark additional parameters as optional.
 *
 * A stub parameter is considered optional when:
 * - It has a default value in the signature (e.g. `$mode = SORT_REGULAR`), or
 * - It is variadic (e.g. `...$args`), or
 * - Its @param description contains [optional].
 *
 * If the stub function is not found it is silently skipped — existence is
 * FunctionExistsCheck's responsibility.
 *
 * Known problems are supported at function level:
 * - EntityType::FUNCTION + functionId + 'OptionalParametersCheck'
 *   → skips the optional-parameters check for that specific function.
 */
class FunctionOptionalParametersCheck extends AbstractCallableCheck
{
    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, EntityType::FUNCTION->value, $entityId, 'OptionalParametersCheck', $phpVersion)) {
            return $results;
        }

        $reflection   = $this->reflectionProvider->getReflection($phpVersion);
        $reflFunction = $this->findCallable($reflection, $entityId, $phpVersion);

        if ($reflFunction === null) {
            $results->addFailure($entityId, "Function {$entityId} not found in reflection data");
            return $results;
        }

        $stubFunction = $this->findCallable($stubs, $entityId, $phpVersion);

        if ($stubFunction === null) {
            // Function absent from stubs — FunctionExistsCheck's responsibility
            $results->addSuccess($entityId);
            return $results;
        }

        $mismatches = OptionalParametersComparator::findMismatches(
            $reflFunction->getParameters(),
            $stubFunction->getParameters(),
            $phpVersion
        );

        if (!empty($mismatches)) {
            $paramList = implode(', ', $mismatches);
            $results->addFailure(
                $entityId,
                "Function {$entityId}: parameter(s) optional in PHP {$phpVersion} but not in stubs: {$paramList}"
            );
            return $results;
        }

        $results->addSuccess($entityId);
        return $results;
    }
}
