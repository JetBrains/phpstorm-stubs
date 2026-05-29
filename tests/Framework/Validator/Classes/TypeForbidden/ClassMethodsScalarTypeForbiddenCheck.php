<?php

namespace StubTests\Framework\Validator\Classes\TypeForbidden;

use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Model\Types\NullableType;
use StubTests\Framework\Parsers\Model\Types\StandaloneType;
use StubTests\Framework\Validator\AbstractTypeForbiddenCheck;

/**
 * Validates that overridable stub methods available before PHP 7.0 do not declare
 * scalar parameter type hints (int, float, string, bool).
 *
 * Scalar type hints were introduced in PHP 7.0. If a public or protected method
 * is available in PHP 5.6 and its stub declares a scalar type hint on any parameter
 * in the actual PHP signature, then child classes written for PHP 5.6 cannot
 * provide a matching override.
 *
 * Note: only the actual PHP signature type is checked. LanguageLevelTypeAware
 * attribute values are IDE metadata and do not affect runtime PHP type compatibility.
 *
 * Note: this check covers only parameter type hints. Return type hints are already
 * fully covered by ClassMethodsReturnTypeForbiddenCheck (which forbids any return type
 * before PHP 7.0). Parameter type hints for class names, array, and callable were
 * valid in PHP 5.x and are not scalar types, so they are not checked here.
 *
 * The check runs only for PHP 5.6 (the sole version before PHP 7.0 in the test matrix).
 */
class ClassMethodsScalarTypeForbiddenCheck extends AbstractTypeForbiddenCheck
{
    /** Scalar parameter type hints introduced in PHP 7.0. */
    private const SCALAR_TYPES = ['int', 'float', 'string', 'bool'];

    protected function getCheckName(): string
    {
        return 'ScalarTypeForbiddenCheck';
    }

    public function supports(string $phpVersion): bool
    {
        return version_compare($phpVersion, '7.0', '<');
    }

    protected function collectMethodIssues(string $entityId, string $methodName, PHPMethod $method, string $phpVersion): array
    {
        $methodEntityId = $entityId . '::' . $methodName;
        $issues         = [];

        foreach ($this->methodCollection->filterAndDeduplicateParams($method->getParameters(), $phpVersion) as $param) {
            $declaredType = $param->getDeclaredType();
            // For NullableType (?T), extract the inner scalar to check it.
            $scalarCandidate = $declaredType instanceof NullableType
                ? $this->extractNullableInnerType($declaredType)
                : ($declaredType instanceof StandaloneType ? $declaredType->toString() : '');

            if ($scalarCandidate !== '' && in_array($scalarCandidate, self::SCALAR_TYPES, true)) {
                $paramType              = $declaredType->toString();
                $paramEntityId          = $methodEntityId . '::$' . $param->getName();
                $issues[$paramEntityId] =
                    "{$this->getEntityLabel()} method {$methodEntityId} parameter \${$param->getName()} " .
                    "has scalar type hint '{$paramType}' but the method is available before PHP 7.0 " .
                    "(scalar type hints were introduced in PHP 7.0). " .
                    "Use #[LanguageLevelTypeAware(['7.0' => '...'], default: '')] to restrict the scalar hint to PHP 7.0+.";
            }
        }

        return $issues;
    }

    /**
     * Extract the inner type name from a NullableType (?T).
     *
     * NullableType::toString() returns 'T|null'. Here we need the bare 'T' to check whether
     * it is a scalar type. We use toArray() which returns ['T', 'null'].
     */
    private function extractNullableInnerType(NullableType $type): string
    {
        foreach ($type->toArray() as $part) {
            if ($part !== 'null') {
                return $part;
            }
        }
        return '';
    }
}
