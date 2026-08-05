<?php

namespace StubTests\Framework\Validator\Services;

use StubTests\Framework\Model\PHPFunction;
use StubTests\Framework\Model\PHPParameter;

/**
 * Resolves deprecation state at a given PHP version, and compares the two sides.
 *
 * Reflection reports deprecation for the single version it was captured under, so its flag is
 * already version-specific. Stubs describe every version at once, so a stub flag alone says
 * nothing about *when* deprecation starts — `#[Deprecated(since: '8.4')]` has to read as "not
 * deprecated" on 8.3 and "deprecated" on 8.4. That version lives in
 * {@see \StubTests\Framework\Model\StubsMetadata::getDeprecatedSinceVersion()}; without it,
 * deprecation applies to every version, which is also how reflection-side elements behave
 * (they carry no stub metadata at all).
 */
final class DeprecationComparator
{
    /**
     * Is the element deprecated as of $phpVersion?
     */
    public static function isDeprecatedIn(PHPFunction|PHPParameter $element, string $phpVersion): bool
    {
        if (!$element->isDeprecated()) {
            return false;
        }

        $since = $element->getStubsMetadata()?->getDeprecatedSinceVersion();

        return $since === null || version_compare($phpVersion, $since, '>=');
    }

    /**
     * Is the callable deprecated in reflection for $phpVersion but not in stubs?
     *
     * One-directional: reflection-deprecated -> stub must be deprecated. The reverse is not
     * enforced here.
     */
    public static function isMismatch(PHPFunction $reflCallable, PHPFunction $stubCallable, string $phpVersion): bool
    {
        return self::isDeprecatedIn($reflCallable, $phpVersion)
            && !self::isDeprecatedIn($stubCallable, $phpVersion);
    }
}
