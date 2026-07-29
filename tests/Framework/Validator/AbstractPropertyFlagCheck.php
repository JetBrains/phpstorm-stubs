<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Model\PHPProperty;
use StubTests\Framework\Validator\Contracts\MemberKind;

/**
 * Base class for checks that compare a per-property attribute (e.g. isStatic, visibility, readonly)
 * between reflection and stubs.
 *
 * The comparison loop lives in {@see AbstractMemberFlagCheck} and the property-specific
 * configuration in {@see MemberKind::PROPERTY}, including the fact that properties are class-only in
 * the model — PHPEnum and PHPInterface have no getProperties(), so a non-class entity yields no
 * members rather than erroring.
 *
 * What remains here is the typed seam: re-declaring describeMismatch() with concrete PHPProperty
 * parameters so the 4 leaf checks get a typed signature, which a single `mixed` declaration on the
 * base could not offer (PHP forbids narrowing a parameter type in an override).
 *
 * Subclasses must implement:
 * - getCheckName(): the name used for known-problem lookups
 * - describeMismatch(): returns a failure message when the attributes differ, or null when they match
 */
abstract class AbstractPropertyFlagCheck extends AbstractMemberFlagCheck
{
    /**
     * Compare an attribute on the reflection and stub property.
     * Return a descriptive failure message if there is a mismatch, or null if they match.
     */
    abstract protected function describeMismatch(
        string $propertyEntityId,
        PHPProperty $reflProperty,
        PHPProperty $stubProperty,
        string $phpVersion
    ): ?string;

    protected function memberKind(): MemberKind
    {
        return MemberKind::PROPERTY;
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
