<?php

namespace StubTests\Framework\Validator\Classes\Methods;

use StubTests\Framework\Validator\AbstractMemberFlagCheck;
use StubTests\Framework\Validator\Contracts\DescribesMethodMismatch;
use StubTests\Framework\Validator\Contracts\MemberKind;
use StubTests\Framework\Model\PHPMethod;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\Services\ParameterPassingComparator;

/**
 * Validates that method parameters are passed by reference in stubs exactly where reflection
 * passes them by reference (see ParameterPassingComparator for matching and prefer-ref handling).
 *
 * Used for classes, interfaces and enums. The check is bidirectional; a method absent from the
 * stubs is skipped — existence is ClassMethodsExistCheck's responsibility.
 *
 * Known problems are supported at two granularities:
 * - class-level: EntityType::{CLASS_TYPE|ENUM_TYPE|INTERFACE_TYPE} + entityId + 'ParameterByReferenceCheck'
 *   → skips the check for every method of the entity.
 * - method-level: EntityType::METHOD + '\ClassName::methodName' + 'ParameterByReferenceCheck'
 *   → skips only that specific method.
 */
class ClassMethodsParameterByReferenceCheck extends AbstractMemberFlagCheck implements DescribesMethodMismatch
{
    protected function memberKind(): MemberKind
    {
        return MemberKind::METHOD;
    }

    protected function getCheckName(): CheckType
    {
        return CheckType::PARAMETER_BY_REFERENCE;
    }

    public function describeMethodMismatch(
        string $methodEntityId,
        PHPMethod $reflMethod,
        PHPMethod $stubMethod,
        string $phpVersion
    ): ?string {
        $mismatches = ParameterPassingComparator::findByReferenceMismatches(
            $reflMethod->getParameters(),
            $stubMethod->getParameters(),
            $phpVersion
        );

        if (empty($mismatches)) {
            return null;
        }

        return "Method {$methodEntityId}: parameter(s) passed differently in PHP {$phpVersion}: "
            . implode(', ', $mismatches);
    }
}
