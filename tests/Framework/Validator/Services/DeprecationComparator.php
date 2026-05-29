<?php

namespace StubTests\Framework\Validator\Services;

use StubTests\Framework\Parsers\Model\PHPFunction;

/**
 * Checks if a function/method is deprecated in reflection but not in stubs.
 *
 * One-directional: reflection-deprecated -> stub must be deprecated.
 * The reverse is not enforced.
 */
final class DeprecationComparator
{
    public static function isMismatch(PHPFunction $reflCallable, PHPFunction $stubCallable): bool
    {
        return $reflCallable->isDeprecated() && !$stubCallable->isDeprecated();
    }
}
