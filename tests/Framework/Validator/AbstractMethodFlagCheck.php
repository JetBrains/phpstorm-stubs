<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Model\PHPMethod;
use StubTests\Framework\Validator\Contracts\MemberKind;

/**
 * Base class for checks that compare a per-method attribute (e.g. isFinal, isStatic, return type)
 * between reflection and stubs.
 *
 * The comparison loop lives in {@see AbstractMemberFlagCheck} and the method-specific configuration
 * in {@see MemberKind::METHOD}. What remains here is the one thing neither can express: re-declaring
 * describeMismatch() with a concrete PHPMethod parameter so the 12 leaf checks get a typed
 * signature. PHP forbids narrowing a parameter type in an override, so without this seam every leaf
 * would have to accept `mixed`.
 *
 * Subclasses must implement:
 * - getCheckName(): the name used for known-problem lookups
 * - describeMismatch(): returns a failure message when the attributes differ, or null when they match
 */
abstract class AbstractMethodFlagCheck extends AbstractMemberFlagCheck
{
    /**
     * Compare an attribute on the reflection and stub method.
     * Return a descriptive failure message if there is a mismatch, or null if they match.
     *
     * @param mixed $reflMethod reflection method object
     */
    abstract protected function describeMismatch(
        string $methodEntityId,
        mixed $reflMethod,
        PHPMethod $stubMethod,
        string $phpVersion
    ): ?string;

    protected function memberKind(): MemberKind
    {
        return MemberKind::METHOD;
    }

    protected function describeMemberMismatch(
        string $memberId,
        mixed $reflectionMember,
        mixed $stubMember,
        string $phpVersion
    ): ?string {
        return $this->describeMismatch($memberId, $reflectionMember, $stubMember, $phpVersion);
    }
}
