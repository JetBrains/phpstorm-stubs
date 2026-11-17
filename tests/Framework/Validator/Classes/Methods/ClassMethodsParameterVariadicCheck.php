<?php

namespace StubTests\Framework\Validator\Classes\Methods;

use StubTests\Framework\Validator\AbstractMemberFlagCheck;
use StubTests\Framework\Validator\Contracts\DescribesMethodMismatch;
use StubTests\Framework\Validator\Contracts\MemberKind;
use StubTests\Framework\Model\PHPMethod;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\Services\ParameterPassingComparator;

/**
 * Validates that a method takes a variadic parameter in stubs exactly when it does in
 * reflection (see ParameterPassingComparator for why only presence is compared).
 *
 * Used for classes, interfaces and enums. The check is bidirectional; a method absent from the
 * stubs is skipped — existence is ClassMethodsExistCheck's responsibility.
 *
 * Known problems are supported at two granularities:
 * - class-level: EntityType::{CLASS_TYPE|ENUM_TYPE|INTERFACE_TYPE} + entityId + 'ParameterVariadicCheck'
 *   → skips the check for every method of the entity.
 * - method-level: EntityType::METHOD + '\ClassName::methodName' + 'ParameterVariadicCheck'
 *   → skips only that specific method.
 */
class ClassMethodsParameterVariadicCheck extends AbstractMemberFlagCheck implements DescribesMethodMismatch
{
    protected function memberKind(): MemberKind
    {
        return MemberKind::METHOD;
    }

    protected function getCheckName(): CheckType
    {
        return CheckType::PARAMETER_VARIADIC;
    }

    public function describeMethodMismatch(
        string $methodEntityId,
        PHPMethod $reflMethod,
        PHPMethod $stubMethod,
        string $phpVersion
    ): ?string {
        $mismatch = ParameterPassingComparator::describeVariadicMismatch(
            $reflMethod->getParameters(),
            $stubMethod->getParameters(),
            $phpVersion
        );

        return $mismatch === null ? null : "Method {$methodEntityId} in PHP {$phpVersion}: {$mismatch}";
    }
}
