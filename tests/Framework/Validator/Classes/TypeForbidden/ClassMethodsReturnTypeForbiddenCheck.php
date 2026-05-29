<?php

namespace StubTests\Framework\Validator\Classes\TypeForbidden;

use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Validator\AbstractTypeForbiddenCheck;

/**
 * Validates that overridable stub methods available before PHP 7.0 do not declare
 * a return type hint in their PHP signature.
 *
 * Return type hints were introduced in PHP 7.0. If a public or protected method
 * is available in PHP 5.6 and its stub declares a return type in the actual signature,
 * then child classes written for PHP 5.6 cannot provide a matching override — the
 * `: T` syntax did not exist yet.
 *
 * Note: only the actual PHP signature type is checked. LanguageLevelTypeAware attribute
 * values are IDE metadata and do not affect runtime PHP type compatibility.
 *
 * Note: this check covers only return types. Parameter type hints for class names,
 * `array`, and `callable` were already valid in PHP 5.x and are not checked here.
 *
 * The check runs only for PHP 5.6 (the sole version before PHP 7.0 in the test matrix).
 */
class ClassMethodsReturnTypeForbiddenCheck extends AbstractTypeForbiddenCheck
{
    protected function getCheckName(): string
    {
        return 'ReturnTypeForbiddenCheck';
    }

    public function supports(string $phpVersion): bool
    {
        return version_compare($phpVersion, '7.0', '<');
    }

    protected function collectMethodIssues(string $entityId, string $methodName, PHPMethod $method, string $phpVersion): array
    {
        $signatureType = $method->getReturnTypeFromSignature();
        $returnType    = $signatureType !== null ? $signatureType->toString() : '';

        if ($returnType === '') {
            return [];
        }

        $methodEntityId = $entityId . '::' . $methodName;

        return [
            $methodEntityId =>
                "{$this->getEntityLabel()} method {$methodEntityId} has return type '{$returnType}' " .
                "but is available before PHP 7.0 (return type hints were introduced in PHP 7.0). " .
                "Use #[LanguageLevelTypeAware(['7.0' => '...'], default: '')] to restrict the return type to PHP 7.0+.",
        ];
    }
}
