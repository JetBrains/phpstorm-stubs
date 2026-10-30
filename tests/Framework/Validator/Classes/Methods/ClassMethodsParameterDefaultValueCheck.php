<?php

namespace StubTests\Framework\Validator\Classes\Methods;

use StubTests\Framework\Validator\AbstractMemberFlagCheck;
use StubTests\Framework\Validator\Contracts\DescribesMethodMismatch;
use StubTests\Framework\Validator\Contracts\MemberKind;
use StubTests\Framework\Model\PHPMethod;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\KnownProblems\CheckType;
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
 * 3. Comparison is skipped when either side's default could not be evaluated (an
 *    unresolvable constant, say, recorded by isDefaultValueResolved()), whose null
 *    value says nothing about the real default. A genuine null default is compared
 *    like any other value.
 * 4. Parameter absent from stubs → silently skipped (ParametersCountCheck handles it).
 * 5. Stub has no default at all → silently skipped (OptionalParametersCheck handles it).
 *
 * Known problems are supported at two granularities:
 * - class-level:  EntityType::CLASS_TYPE + classId + 'ParameterDefaultValueCheck'
 * - method-level: EntityType::METHOD + '\ClassName::methodName' + 'ParameterDefaultValueCheck'
 */
class ClassMethodsParameterDefaultValueCheck extends AbstractMemberFlagCheck implements DescribesMethodMismatch
{
    protected function memberKind(): MemberKind
    {
        return MemberKind::METHOD;
    }

    public function supports(string $phpVersion): bool
    {
        return $phpVersion === PhpVersions::LATEST->value;
    }

    protected function getCheckName(): CheckType
    {
        return CheckType::PARAMETER_DEFAULT_VALUE;
    }

    public function describeMethodMismatch(
        string $methodEntityId,
        PHPMethod $reflMethod,
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
