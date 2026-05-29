<?php

namespace StubTests\Framework\Validator\Functions;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractCallableCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\Services\ParameterFilterHelper;

/**
 * Validates that parameters deprecated in reflection are also deprecated in stubs
 * for functions (and methods when used via entityId format).
 *
 * The check is one-directional: if reflection reports a parameter as deprecated,
 * the stub must also declare it deprecated. The reverse is not enforced.
 *
 * Known problems are supported via EntityType::FUNCTION / EntityType::METHOD
 * (auto-detected from the entityId format) with checkName 'ParameterDeprecationCheck'.
 */
class FunctionParameterDeprecationCheck extends AbstractCallableCheck
{
    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        $entityType = EntityType::fromEntityId($entityId)->value;
        if ($this->skipWithKnownProblem($results, $entityType, $entityId, 'ParameterDeprecationCheck', $phpVersion)) {
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

        $reflParams = $reflCallable->getParameters();
        $stubParams = $stubCallable->getParameters();

        $stubParams = ParameterFilterHelper::filterAndDeduplicate($stubParams, $phpVersion);

        // Build stub param map by name
        $stubParamsByName = [];
        foreach ($stubParams as $stubParam) {
            $stubParamsByName[$stubParam->getName()] = $stubParam;
        }

        $mismatches = [];
        foreach ($reflParams as $reflParam) {
            $reflName = $reflParam->getName();

            $reflDeprecated = $reflParam->isDeprecated();
            if (!$reflDeprecated) {
                continue;
            }

            if (!isset($stubParamsByName[$reflName])) {
                continue;
            }

            $stubDeprecated = $stubParamsByName[$reflName]->isDeprecated();

            if (!$stubDeprecated) {
                $mismatches[] = "\${$reflName}";
            }
        }

        if (!empty($mismatches)) {
            $results->addFailure(
                $entityId,
                "Function/method {$entityId}: parameter(s) deprecated in PHP {$phpVersion} but not in stubs: "
                . implode(', ', $mismatches)
            );
        } else {
            $results->addSuccess($entityId);
        }

        return $results;
    }
}
