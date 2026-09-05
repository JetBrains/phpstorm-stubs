<?php

namespace StubTests\Framework\Validator\Functions;

use StubTests\Framework\Storage\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractCallableCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\Services\ParameterTypeComparator;

/**
 * Validates that parameter types in stubs match those in reflection.
 *
 * The entityId should be in format: "FunctionName" or "ClassName::methodName"
 */
class ParameterTypesCheck extends AbstractCallableCheck
{
    public function supports(string $phpVersion): bool
    {
        return version_compare($phpVersion, '7.0', '>=');
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        $entityType = EntityType::fromEntityId($entityId)->value;
        if ($this->skipWithKnownProblem($results, $entityType, $entityId, CheckType::PARAMETER_TYPES, $phpVersion)) {
            return $results;
        }

        $reflection = $this->reflectionProvider->getReflection($phpVersion);
        $reflectionCallable = $this->findCallable($reflection, $entityId, $phpVersion);

        if ($reflectionCallable === null) {
            // EntityExistsCheck handles existence; silently succeed here
            $results->addSuccess($entityId);
            return $results;
        }

        $stubCallable = $this->findCallable($stubs, $entityId, $phpVersion);

        if ($stubCallable === null) {
            // EntityExistsCheck handles existence; silently succeed here
            $results->addSuccess($entityId);
            return $results;
        }

        $reflectionParams = $reflectionCallable->getParameters();
        $mismatches = [];
        foreach (ParameterTypeComparator::compare($reflectionParams, $stubCallable->getParameters(), $phpVersion) as $m) {
            $display = $m['stubType'] ?? 'none';
            $mismatches[] = "Parameter '\${$m['name']}' type mismatch: reflection has '{$m['reflType']}', " .
                "stubs have '{$display}'";
        }

        if (!empty($mismatches)) {
            $results->addFailure($entityId, implode("\n", $mismatches));
        } else {
            $results->addSuccess($entityId);
        }

        return $results;
    }
}
