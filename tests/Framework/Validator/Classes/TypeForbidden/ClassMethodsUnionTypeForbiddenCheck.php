<?php

namespace StubTests\Framework\Validator\Classes\TypeForbidden;

use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Model\Types\NullableType;
use StubTests\Framework\Validator\AbstractTypeForbiddenCheck;

/**
 * Validates that overridable stub methods available before PHP 8.0 do not declare
 * union type hints — neither on their return type nor on any parameter.
 *
 * Union type hints (T1|T2) were introduced in PHP 8.0. If a public or protected
 * method is available in PHP 7.x or earlier and its stub declares a union return
 * type or a union parameter type in the actual PHP signature, then child classes
 * written for those versions cannot provide a matching type-hinted override.
 *
 * Note: Only signature types are checked. LanguageLevelTypeAware attribute values
 * are IDE metadata and do not affect runtime PHP type compatibility.
 *
 * The nullable shorthand ?T (which serialises as T|null) is intentionally excluded:
 * it was introduced in PHP 7.1 and is therefore valid for PHP 7.1–7.4. Signature
 * NullableType objects are skipped before the union-type string check is applied.
 *
 * The check runs for every PHP version before 8.0 (PHP 5.6 through PHP 7.4).
 */
class ClassMethodsUnionTypeForbiddenCheck extends AbstractTypeForbiddenCheck
{
    protected function getCheckName(): string
    {
        return 'UnionTypeForbiddenCheck';
    }

    public function supports(string $phpVersion): bool
    {
        return version_compare($phpVersion, '8.0', '<');
    }

    protected function collectMethodIssues(string $entityId, string $methodName, PHPMethod $method, string $phpVersion): array
    {
        $methodEntityId = $entityId . '::' . $methodName;
        $issues = [];

        // ── Check return type ─────────────────────────────────────────────────
        // Skip NullableType (?T) — nullable type hints are valid from PHP 7.1.
        $signatureReturnType = $method->getReturnTypeFromSignature();
        if ($signatureReturnType !== null && !($signatureReturnType instanceof NullableType)) {
            $returnType = $signatureReturnType->toString();
            if ($returnType !== '' && str_contains($returnType, '|')) {
                $issues[$methodEntityId] =
                    "{$this->getEntityLabel()} method {$methodEntityId} has union return type '{$returnType}' " .
                    "but is available before PHP 8.0 (union type hints were introduced in PHP 8.0). " .
                    "Use #[LanguageLevelTypeAware(['8.0' => 'T1|T2'], default: '...')] to restrict the union hint to PHP 8.0+.";
            }
        }

        // ── Check parameter types ─────────────────────────────────────────────
        foreach ($this->methodCollection->filterAndDeduplicateParams($method->getParameters(), $phpVersion) as $param) {
            $declaredType = $param->getDeclaredType();
            // Skip NullableType (?T) — nullable type hints are valid from PHP 7.1.
            if ($declaredType instanceof NullableType) {
                continue;
            }
            $paramType = $declaredType->toString();
            if ($paramType !== '' && str_contains($paramType, '|')) {
                $paramEntityId = $methodEntityId . '::$' . $param->getName();
                $issues[$paramEntityId] =
                    "{$this->getEntityLabel()} method {$methodEntityId} parameter \${$param->getName()} " .
                    "has union type hint '{$paramType}' but the method is available before PHP 8.0 " .
                    "(union type hints were introduced in PHP 8.0). " .
                    "Use #[LanguageLevelTypeAware(['8.0' => 'T1|T2'], default: '...')] to restrict the union hint to PHP 8.0+.";
            }
        }

        return $issues;
    }
}
