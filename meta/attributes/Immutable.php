<?php

namespace JetBrains\PhpStorm;

use Attribute;

/**
 * Mark property (or all properties of the class in case of class) as immutable.
 * IDE will highlight write accesses on such fields if they located outside constructor by default (this scope is customizable, see below).
 *
 * One can provide custom allowed write scopes, possible values:
 * <ul>
 * <li>{@link Immutable::CONSTRUCTOR_WRITE_SCOPE}: write is allowed only in containing class constructor (default choice)</li>
 * <li>{@link Immutable::PRIVATE_WRITE_SCOPE}: write is allowed only in places where field would be accessible if it would have 'private' visibility modifier</li>
 * <li>{@link Immutable::PROTECTED_WRITE_SCOPE}: write is allowed only in places where field would be accessible if it would have 'protected' visibility modifier</li>
 * </ul>
 * @since 8.0
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS)]
class Immutable
{
    const CONSTRUCTOR_WRITE_SCOPE = "constructor";
    const PRIVATE_WRITE_SCOPE = "private";
    const PROTECTED_WRITE_SCOPE = "protected";

    public function __construct(#[ExpectedValues(valuesFromClass: Immutable::class)]
                                $allowedWriteScope = self::CONSTRUCTOR_WRITE_SCOPE)
    {
    }
}
