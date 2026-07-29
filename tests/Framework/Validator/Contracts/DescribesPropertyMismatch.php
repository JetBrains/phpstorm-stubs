<?php

namespace StubTests\Framework\Validator\Contracts;

use StubTests\Framework\Model\PHPProperty;

/**
 * Implemented by a member-flag check that compares a per-property attribute.
 *
 * The property-side counterpart to {@see DescribesMethodMismatch}; see that interface for why the
 * concrete parameter types are declared here rather than on AbstractMemberFlagCheck.
 *
 * @see MemberKind the orthogonal "which member kind" axis
 */
interface DescribesPropertyMismatch
{
    /**
     * Compare an attribute on the reflection and stub property.
     * Return a descriptive failure message if there is a mismatch, or null if they match.
     */
    public function describePropertyMismatch(
        string $propertyEntityId,
        PHPProperty $reflProperty,
        PHPProperty $stubProperty,
        string $phpVersion
    ): ?string;
}
