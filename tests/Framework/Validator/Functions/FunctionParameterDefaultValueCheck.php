<?php

namespace StubTests\Framework\Validator\Functions;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\AbstractCallableCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\Services\ParameterDefaultValueComparator;
use StubTests\Framework\Validator\Services\ParameterFilterHelper;

/**
 * Validates that default parameter values in stub functions match those in reflection.
 *
 * Only runs against the latest PHP version since stubs do not support version-aware
 * default values (no LanguageLevelTypeAware equivalent for defaults).
 *
 * For each function identified by $entityId the validator:
 * 1. Looks up the function in reflection and stubs.
 * 2. If the stub function is not found it is silently skipped — existence is
 *    FunctionExistsCheck's responsibility.
 * 3. For each reflection parameter with an accessible default, checks whether
 *    the matching stub parameter (by name) declares the same evaluated default.
 * 4. Comparison is skipped when either side's value is null (see class-level check
 *    docs for the rationale).
 *
 * Known problems are supported at function level:
 * - EntityType::FUNCTION + functionId + 'ParameterDefaultValueCheck'
 */
class FunctionParameterDefaultValueCheck extends AbstractCallableCheck
{
    public function supports(string $phpVersion): bool
    {
        return $phpVersion === PhpVersions::LATEST->value;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, EntityType::FUNCTION->value, $entityId, 'ParameterDefaultValueCheck', $phpVersion)) {
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
            // Function absent from stubs — FunctionExistsCheck's responsibility
            $results->addSuccess($entityId);
            return $results;
        }

        // Build version-filtered stub param map by name
        $stubParamsByName = [];
        foreach (ParameterFilterHelper::filterAndDeduplicate($stubFunction->getParameters(), $phpVersion) as $param) {
            $stubParamsByName[$param->getName()] = $param;
        }

        $mismatches = ParameterDefaultValueComparator::buildMismatches($reflFunction->getParameters(), $stubParamsByName);

        if (!empty($mismatches)) {
            $results->addFailure(
                $entityId,
                "Function {$entityId}: parameter default value mismatch(es): " . implode('; ', $mismatches)
            );
            return $results;
        }

        $results->addSuccess($entityId);
        return $results;
    }
}
