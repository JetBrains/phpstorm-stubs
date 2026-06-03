<?php

namespace StubTests\Framework\Validator\Functions;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractCallableCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\Services\ParameterFilterHelper;
use StubTests\Framework\Validator\Services\TypeResolver;

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
        if ($this->skipWithKnownProblem($results, $entityType, $entityId, 'ParameterTypesCheck', $phpVersion)) {
            return $results;
        }

        $reflection = $this->reflectionProvider->getReflection($phpVersion);
        $reflectionCallable = $this->findCallable($reflection, $entityId, $phpVersion);

        if ($reflectionCallable === null) {
            // FunctionExistsCheck handles existence; silently succeed here
            $results->addSuccess($entityId);
            return $results;
        }

        $stubCallable = $this->findCallable($stubs, $entityId, $phpVersion);

        if ($stubCallable === null) {
            // FunctionExistsCheck handles existence; silently succeed here
            $results->addSuccess($entityId);
            return $results;
        }

        $reflectionParams = $reflectionCallable->getParameters();
        $stubParams = $stubCallable->getParameters();

        // Filter and deduplicate stub parameters by version
        $stubParams = ParameterFilterHelper::filterAndDeduplicate($stubParams, $phpVersion);

        // Build name-based stub param map (matching ClassMethodsParameterTypesCheck approach)
        $stubParamsByName = [];
        foreach ($stubParams as $param) {
            $stubParamsByName[$param->getName()] = $param;
        }

        // Compare parameter types by name
        $mismatches = [];
        foreach ($reflectionParams as $reflectionParam) {
            $name = $reflectionParam->getName();

            if (!isset($stubParamsByName[$name])) {
                // Parameter absent from stubs — ParametersCountCheck's responsibility
                continue;
            }

            $reflType = TypeResolver::getParamTypeString($reflectionParam, $phpVersion);

            if ($reflType === null) {
                continue;
            }

            $stubType = TypeResolver::getParamTypeString($stubParamsByName[$name], $phpVersion);
            $normalRefl = TypeResolver::normalizeType($reflType);
            $normalStub = TypeResolver::normalizeType($stubType);

            if ($normalRefl !== $normalStub) {
                $display = $stubType ?? 'none';
                $mismatches[] = "Parameter '\${$name}' type mismatch: reflection has '{$reflType}', " .
                    "stubs have '{$display}'";
            }
        }

        if (!empty($mismatches)) {
            $results->addFailure($entityId, implode("\n", $mismatches));
        } else {
            $results->addSuccess($entityId);
        }

        return $results;
    }
}
