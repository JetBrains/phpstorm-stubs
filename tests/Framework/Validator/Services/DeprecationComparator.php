<?php

namespace StubTests\Framework\Validator\Services;

use StubTests\Framework\Model\PHPClassConstant;
use StubTests\Framework\Model\PHPConstant;
use StubTests\Framework\Model\PHPFunction;
use StubTests\Framework\Model\PHPParameter;
use StubTests\Framework\Runner\PhpVersions;

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

    /**
     * Compares a constant's deprecation in reflection with the stubs. Unlike callables, a stub
     * deprecation that names a PHP version is a claim about the runtime, so it must match too.
     */
    public static function describeConstantMismatch(
        PHPConstant|PHPClassConstant $reflConstant,
        PHPConstant|PHPClassConstant $stubConstant,
        string $constantId,
        string $phpVersion
    ): ?string {
        $since = $stubConstant->getStubsMetadata()?->getDeprecatedSinceVersion();
        $stubDeprecated = $stubConstant->isDeprecated() && ($since === null || version_compare($phpVersion, $since, '>='));

        if ($reflConstant->isDeprecated() && !$stubDeprecated) {
            return "Constant {$constantId} is deprecated in PHP {$phpVersion} but not marked as deprecated in stubs"
                . ($stubConstant->isDeprecated() ? " (stubs say since {$since})" : '');
        }
        // An extension version or other text in `since` says nothing about the PHP runtime.
        $sinceIsPhpVersion = $since !== null && PhpVersions::normalizePhpVersion($since) !== null;
        if (!$reflConstant->isDeprecated() && $stubDeprecated && $sinceIsPhpVersion) {
            return "Constant {$constantId} is marked as deprecated since PHP {$since} in stubs but PHP {$phpVersion} does not deprecate it";
        }
        return null;
    }
}
