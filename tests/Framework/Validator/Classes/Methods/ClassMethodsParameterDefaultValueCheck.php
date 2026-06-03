<?php

namespace StubTests\Framework\Validator\Classes\Methods;

use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\AbstractMethodFlagCheck;
use StubTests\Framework\Validator\Services\ParameterDefaultValueComparator;

/**
 * Validates that default parameter values in stub methods match those in reflection.
 *
 * Only runs against the latest PHP version since stubs do not support version-aware
 * default values (there is no LanguageLevelTypeAware equivalent for defaults).
 *
 * For each class identified by $entityId the validator:
 * 1. Iterates all methods reported by reflection.
 * 2. For each reflection parameter that has an accessible default value, checks
 *    whether the stub parameter declares a matching evaluated default.
 * 3. Comparison is skipped when either side's value is null — this avoids false
 *    positives from stub constants that cannot be evaluated at parse time
 *    (e.g. extension-specific constants) and from genuine null defaults whose
 *    ambiguity we cannot resolve without a richer model.
 * 4. Parameter absent from stubs → silently skipped (ParametersCountCheck handles it).
 * 5. Stub has no default at all → silently skipped (OptionalParametersCheck handles it).
 *
 * Known problems are supported at two granularities:
 * - class-level:  EntityType::CLASS_TYPE + classId + 'ParameterDefaultValueCheck'
 * - method-level: EntityType::METHOD + '\ClassName::methodName' + 'ParameterDefaultValueCheck'
 */
class ClassMethodsParameterDefaultValueCheck extends AbstractMethodFlagCheck
{
    public function supports(string $phpVersion): bool
    {
        return $phpVersion === PhpVersions::LATEST->value;
    }

    protected function getCheckName(): string
    {
        return 'ParameterDefaultValueCheck';
    }

    protected function describeMismatch(
        string $methodEntityId,
        mixed $reflMethod,
        PHPMethod $stubMethod,
        string $phpVersion
    ): ?string {
        $stubParamsByName = [];
        foreach ($this->methodCollection->filterAndDeduplicateParams($stubMethod->getParameters(), $phpVersion) as $param) {
            $stubParamsByName[$param->getName()] = $param;
        }

        $mismatches = ParameterDefaultValueComparator::buildMismatches($reflMethod->getParameters(), $stubParamsByName);

        if (empty($mismatches)) {
            return null;
        }

        return "Method {$methodEntityId}: parameter default value mismatch(es): "
            . implode('; ', $mismatches);
    }
}
