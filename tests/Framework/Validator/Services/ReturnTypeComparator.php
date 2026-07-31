<?php

namespace StubTests\Framework\Validator\Services;

/**
 * Decides whether a stub return type is equivalent to the reflected one.
 *
 * Extracted because the method and function variants of the return-type check had drifted:
 * ClassMethodsReturnTypesCheck carried two deliberate allowances that
 * Functions/FunctionReturnTypesCheck did not, and AbstractCallableCheck::findCallable()
 * resolves "Class::method" ids — so the function variant *can* be handed a method, and would
 * then report a mismatch its sibling accepts. Sharing the decision makes that drift
 * impossible rather than merely unlikely.
 *
 * Only the equivalence decision lives here. The two checks word their messages and their
 * success notes differently, and that is left to them.
 */
final class ReturnTypeComparator
{
    /**
     * Are the two already-normalised types equivalent, allowing for the documented cases?
     *
     * @param string|null $normalizedRefl Normalised reflection type
     * @param string|null $normalizedStub Normalised stub type
     */
    public static function areEquivalent(?string $normalizedRefl, ?string $normalizedStub): bool
    {
        if ($normalizedRefl === $normalizedStub) {
            return true;
        }

        if (self::stubStaticMatchesReflectionClassName($normalizedRefl, $normalizedStub)) {
            return true;
        }

        return self::stubNarrowsBool($normalizedRefl, $normalizedStub);
    }

    /**
     * A stub may declare the covariant `static` where reflection names a concrete class.
     *
     * Each `static` component in the stub must correspond to a class-name (non-primitive)
     * component in reflection; the remaining union parts must then match exactly. This covers
     * both direct declarations (stub `static` vs reflection `DateTime`) and inherited methods
     * (stub `static|null` from SimpleXMLElement vs reflection `SimpleXMLElement|null` reported
     * for SimpleXMLIterator).
     *
     * Note this is meaningless for global functions — there is no late static binding without a
     * class — but it is harmless there, and keeping one implementation is the point.
     */
    private static function stubStaticMatchesReflectionClassName(?string $normalizedRefl, ?string $normalizedStub): bool
    {
        if ($normalizedStub === null || !str_contains($normalizedStub, 'static')) {
            return false;
        }

        // If reflection also says 'static', the two are directly equivalent.
        if ($normalizedRefl !== null && str_contains($normalizedRefl, 'static')) {
            return true;
        }

        $primitives = TypeResolver::PRIMITIVES;
        $stubParts = explode('|', $normalizedStub);
        $reflParts = explode('|', (string)$normalizedRefl);

        foreach ($stubParts as $stubKey => $part) {
            if ($part !== 'static') {
                continue;
            }
            // Consume a class-name component from the reflection side.
            foreach ($reflParts as $reflKey => $reflPart) {
                if (!in_array($reflPart, $primitives, true)) {
                    unset($reflParts[$reflKey]);
                    break;
                }
            }
            unset($stubParts[$stubKey]);
        }

        sort($stubParts);
        sort($reflParts);

        return array_values($stubParts) === array_values($reflParts);
    }

    /**
     * A stub may narrow `bool` to `true` or `false` (the TentativeType pattern); reflection
     * always reports the wider `bool`. The stub is intentionally more specific.
     */
    private static function stubNarrowsBool(?string $normalizedRefl, ?string $normalizedStub): bool
    {
        return $normalizedRefl === 'bool' && ($normalizedStub === 'true' || $normalizedStub === 'false');
    }
}
