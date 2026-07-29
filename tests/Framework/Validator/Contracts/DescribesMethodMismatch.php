<?php

namespace StubTests\Framework\Validator\Contracts;

use StubTests\Framework\Model\PHPMethod;

/**
 * Implemented by a member-flag check that compares a per-method attribute.
 *
 * This exists so that the "which attribute is compared" axis is expressed by implementing an
 * interface rather than by occupying a level of the inheritance chain. AbstractMethodFlagCheck
 * previously sat between AbstractMemberFlagCheck and the 12 method leaves for one reason: PHP
 * forbids narrowing a parameter type in an override, so a leaf could not declare
 * `PHPMethod $stubMethod` against a base that declared `mixed`. Declaring the concrete type *here*
 * sidesteps that — the leaf implements this signature exactly rather than narrowing one — which
 * removes the need for that intermediate class.
 *
 * The trade-off is visibility: interface methods must be public, so the 12 leaves expose this where
 * they previously had a protected describeMismatch(). AbstractMemberFlagCheck is the only caller.
 *
 * @see DescribesPropertyMismatch the property-side counterpart
 * @see MemberKind the orthogonal "which member kind" axis
 */
interface DescribesMethodMismatch
{
    /**
     * Compare an attribute on the reflection and stub method.
     * Return a descriptive failure message if there is a mismatch, or null if they match.
     *
     * @param mixed $reflMethod reflection method object
     */
    public function describeMethodMismatch(
        string $methodEntityId,
        mixed $reflMethod,
        PHPMethod $stubMethod,
        string $phpVersion
    ): ?string;
}
