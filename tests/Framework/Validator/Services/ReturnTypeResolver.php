<?php

namespace StubTests\Framework\Validator\Services;

use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Validator\Services\TypeResolver;

/**
 * Resolves return type strings from functions/methods with version-aware fallback.
 */
final class ReturnTypeResolver
{
    /**
     * Get the return type string representation from a function/method.
     *
     * Priority order:
     * 1. Signature type (if present) -- takes precedence over everything
     * 2. LanguageLevelTypeAware (if no signature type)
     *
     * @param PHPFunction $callable Function or method (PHPMethod extends PHPFunction)
     * @param string $phpVersion PHP version (e.g., '8.0')
     * @return string|null Returns null when no return type information is available
     */
    public static function getReturnTypeString(PHPFunction $callable, string $phpVersion): ?string
    {
        $returnType = $callable->getReturnTypeFromSignature();

        if ($returnType !== null) {
            $typeString = $returnType->toString();
            if ($typeString !== '') {
                return $typeString;
            }
        }

        $versionAwareType = TypeResolver::resolveVersionAwareType($callable, $phpVersion);
        if ($versionAwareType !== null) {
            return $versionAwareType;
        }

        return null;
    }
}
