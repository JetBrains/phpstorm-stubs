<?php

namespace StubTests\Framework\Validator\Functions;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractCallableCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\Services\ReturnTypeResolver;
use StubTests\Framework\Validator\Services\TypeResolver;

/**
 * Validates that return types in stub functions match those in reflection.
 *
 * For each function identified by $entityId the validator:
 * 1. Looks up the function in reflection data for the given PHP version.
 * 2. Looks up the function in stubs using version-aware selection.
 * 3. If the stub function is not found it is silently skipped — existence is
 *    FunctionExistsCheck's responsibility.
 * 4. When both sides are found, return types are compared using version-aware
 *    resolution (LanguageLevelTypeAware attribute) and semantic normalisation.
 *
 * Special case: when reflection has no return type information (null) but the
 * stub documents one, the check succeeds — the stub correctly adds information
 * that the Reflection API does not expose (common in PHP 7.x and some PHP 8.x
 * functions).
 *
 * Known problems: EntityType::FUNCTION + functionId + 'ReturnTypesCheck'
 * → skips the return-type check for that specific function.
 */
class FunctionReturnTypesCheck extends AbstractCallableCheck
{

    public function supports(string $phpVersion): bool
    {
        // Return type declarations were introduced in PHP 7.0
        return version_compare($phpVersion, '7.0', '>=');
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, EntityType::FUNCTION->value, $entityId, 'ReturnTypesCheck', $phpVersion)) {
            return $results;
        }

        $reflection = $this->reflectionProvider->getReflection($phpVersion);
        $reflectionCallable = $this->findCallable($reflection, $entityId, $phpVersion);

        if ($reflectionCallable === null) {
            $results->addFailure($entityId, "Function {$entityId} not found in reflection data");
            return $results;
        }

        $stubCallable = $this->findCallable($stubs, $entityId, $phpVersion);

        if ($stubCallable === null) {
            // Function absent from stubs — FunctionExistsCheck's responsibility
            $results->addSuccess($entityId);
            return $results;
        }

        $reflectionReturnType = ReturnTypeResolver::getReturnTypeString($reflectionCallable, $phpVersion);
        $stubReturnType       = ReturnTypeResolver::getReturnTypeString($stubCallable, $phpVersion);

        // When reflection has no type info but stub documents one, the stub is
        // providing additional documentation beyond what the Reflection API exposes.
        if ($reflectionReturnType === null && $stubReturnType !== null) {
            $versionContext = version_compare($phpVersion, '8.0', '<') ? 'PHP 7.x' : 'PHP ' . $phpVersion;
            $results->addSuccess($entityId . ' (return type not available in Reflection API for ' . $versionContext . ')');
            return $results;
        }

        if ($reflectionReturnType === null && $stubReturnType === null) {
            $results->addSuccess($entityId);
            return $results;
        }

        $normalizedReflectionType = TypeResolver::normalizeType($reflectionReturnType);
        $normalizedStubType       = TypeResolver::normalizeType($stubReturnType);

        if ($normalizedReflectionType !== $normalizedStubType) {
            $results->addFailure(
                $entityId,
                "Return type mismatch: reflection has '{$reflectionReturnType}', stubs have '{$stubReturnType}'"
            );
        } else {
            $results->addSuccess($entityId);
        }

        return $results;
    }
}
