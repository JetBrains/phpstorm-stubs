<?php

namespace StubTests\Framework\Validator\Classes\Methods;

use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Validator\AbstractMethodFlagCheck;
use StubTests\Framework\Validator\Services\PhpDocConformanceService;
use StubTests\Framework\Validator\Services\ReturnTypeResolver;
use StubTests\Framework\Validator\Services\TypeResolver;

/**
 * Validates that return types in stub methods match those in reflection.
 *
 * For each class identified by $entityId the validator:
 * 1. Iterates all methods reported by reflection for the class.
 * 2. Looks up each method in the version-filtered stub hierarchy (parent classes
 *    and interfaces), stripping PS_UNRESERVE_PREFIX_ where needed.
 * 3. If the stub method is not found it is silently skipped — existence is
 *    ClassMethodsExistCheck's responsibility.
 * 4. When both sides are found, return types are compared using version-aware
 *    resolution (LanguageLevelTypeAware attribute) and semantic normalisation.
 *
 * When reflection has no return type information (null), the check passes
 * — the stub may correctly document a type that the Reflection API does not expose.
 *
 * Known problems are supported at two granularities:
 * - class-level:  EntityType::CLASS_TYPE + classId + 'ReturnTypesCheck'
 *   → skips all return-type checks for the class.
 * - method-level: EntityType::METHOD + '\ClassName::methodName' + 'ReturnTypesCheck'
 *   → skips only that specific mismatch.
 */
class ClassMethodsReturnTypesCheck extends AbstractMethodFlagCheck
{
    public function supports(string $phpVersion): bool
    {
        // Return type declarations were introduced in PHP 7.0
        return version_compare($phpVersion, '7.0', '>=');
    }

    protected function getCheckName(): string
    {
        return 'ReturnTypesCheck';
    }

    protected function describeMismatch(
        string $methodEntityId,
        mixed $reflMethod,
        PHPMethod $stubMethod,
        string $phpVersion
    ): ?string {
        $reflType = ReturnTypeResolver::getReturnTypeString($reflMethod, $phpVersion);
        $stubType = ReturnTypeResolver::getReturnTypeString($stubMethod, $phpVersion);

        // When reflection has no type info, skip validation (Reflection API limitation).
        // The stub may legitimately document a type that reflection does not expose.
        if ($reflType === null) {
            return null;
        }

        $normalizedRefl = TypeResolver::normalizeType($reflType);
        $normalizedStub = TypeResolver::normalizeType($stubType);

        // When stub uses 'static' (covariant return type), validate semantically:
        // each 'static' component in the stub must correspond to a class-name (non-primitive)
        // component in reflection; the remaining union parts must match exactly.
        //
        // This handles both direct declarations (stub 'static' matches reflection 'DateTime')
        // and inherited methods (stub 'static|null' inherited from SimpleXMLElement matches
        // reflection 'SimpleXMLElement|null' reported for SimpleXMLIterator).
        if ($normalizedStub !== null && str_contains($normalizedStub, 'static')) {
            // If reflection also uses 'static', they are directly equivalent.
            if (str_contains($normalizedRefl, 'static')) {
                return null;
            }
            // PHP primitive / keyword types that are never class names.
            $primitives = PhpDocConformanceService::PRIMITIVES;
            $stubParts = explode('|', $normalizedStub);
            $reflParts = explode('|', $normalizedRefl);
            foreach ($stubParts as $stubKey => $part) {
                if ($part === 'static') {
                    // Consume a class-name component from the reflection side.
                    foreach ($reflParts as $reflKey => $reflPart) {
                        if (!in_array($reflPart, $primitives, true)) {
                            unset($reflParts[$reflKey]);
                            break;
                        }
                    }
                    unset($stubParts[$stubKey]);
                }
            }
            sort($stubParts);
            sort($reflParts);
            if (array_values($stubParts) === array_values($reflParts)) {
                return null;
            }
            // Types genuinely differ even after static matching — fall through to report.
        }

        // When stub narrows 'bool' to 'true' or 'false' (TentativeType pattern), reflection
        // always reports the wider 'bool'. The stub is intentionally more specific.
        if ($normalizedRefl === 'bool' && ($normalizedStub === 'true' || $normalizedStub === 'false')) {
            return null;
        }

        if ($normalizedRefl !== $normalizedStub) {
            return "Return type mismatch for {$methodEntityId}: reflection has '{$reflType}', stubs have '{$stubType}'";
        }

        return null;
    }
}
