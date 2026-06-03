<?php

namespace StubTests\Framework\Validator\Classes\TypeForbidden;

use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Model\Types\NullableType;
use StubTests\Framework\Validator\AbstractTypeForbiddenCheck;

/**
 * Validates that overridable stub methods available before PHP 7.1 do not declare
 * nullable type hints — neither on their return type nor on any parameter.
 *
 * Nullable type hints (?T) were introduced in PHP 7.1.  If a public or protected
 * method is available in PHP 7.0 or earlier and its stub declares a nullable return
 * type or a nullable parameter type, then child classes written for PHP 5.6/7.0
 * cannot provide a matching type-hinted override — the `?T` syntax did not exist yet.
 *
 * Note: only the actual PHP signature type is checked. LanguageLevelTypeAware
 * attribute values are IDE metadata and do not affect runtime PHP type compatibility.
 *
 * The check runs for every PHP version before 7.1 (PHP 5.6 and PHP 7.0).
 */
class ClassMethodsNullableTypeForbiddenCheck extends AbstractTypeForbiddenCheck
{
    protected function getCheckName(): string
    {
        return 'NullableTypeForbiddenCheck';
    }

    public function supports(string $phpVersion): bool
    {
        return version_compare($phpVersion, '7.1', '<');
    }

    protected function collectMethodIssues(string $entityId, string $methodName, PHPMethod $method, string $phpVersion): array
    {
        $methodEntityId = $entityId . '::' . $methodName;
        $issues = [];

        // ── Check return type ─────────────────────────────────────────────────
        $signatureReturnType = $method->getReturnTypeFromSignature();
        if ($signatureReturnType instanceof NullableType) {
            $returnType = $signatureReturnType->toString();
            $issues[$methodEntityId] =
                "{$this->getEntityLabel()} method {$methodEntityId} has nullable return type '{$returnType}' " .
                "but is available before PHP 7.1 (nullable type hints were introduced in PHP 7.1). " .
                "Use #[LanguageLevelTypeAware(['7.1' => '?...'], default: '...')] to restrict the nullable hint to PHP 7.1+.";
        }

        // ── Check parameter types ─────────────────────────────────────────────
        foreach ($this->methodCollection->filterAndDeduplicateParams($method->getParameters(), $phpVersion) as $param) {
            $declaredType = $param->getDeclaredType();
            if ($declaredType instanceof NullableType) {
                $paramType = $declaredType->toString();
                $paramEntityId = $methodEntityId . '::$' . $param->getName();
                $issues[$paramEntityId] =
                    "{$this->getEntityLabel()} method {$methodEntityId} parameter \${$param->getName()} " .
                    "has nullable type hint '{$paramType}' but the method is available before PHP 7.1 " .
                    "(nullable type hints were introduced in PHP 7.1). " .
                    "Use #[LanguageLevelTypeAware(['7.1' => '?...'], default: '...')] to restrict the nullable hint to PHP 7.1+.";
            }
        }

        return $issues;
    }
}
