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
     * Both sides are PHPMethod: the reflection half is read back out of the reflection cache into
     * the same model as the stub half, and MemberKind::METHOD only ever yields
     * PHPClassLikeObject::getMethods(). Declaring it rather than `mixed` is the whole point of
     * this interface — it lets the 12 leaves state a concrete signature instead of narrowing an
     * inherited one — and it matches DescribesPropertyMismatch, which types both sides
     * PHPProperty. AbstractMemberFlagCheck dispatches through a `mixed` argument, so a wrong type
     * now surfaces as a TypeError here instead of a silently skipped comparison.
     */
    public function describeMethodMismatch(
        string $methodEntityId,
        PHPMethod $reflMethod,
        PHPMethod $stubMethod,
        string $phpVersion
    ): ?string;
}
