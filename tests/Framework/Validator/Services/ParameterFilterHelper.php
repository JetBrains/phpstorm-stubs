<?php

namespace StubTests\Framework\Validator\Services;

use StubTests\Framework\Model\PHPParameter;

/**
 * Shared utility for filtering and deduplicating parameters by PHP version.
 *
 * Consolidates the parameter filtering algorithm previously duplicated in
 * MethodCollectionService, the PhpDoc conformance checks and
 * Functions\ParameterNamesCheck. The PhpDoc conformance path reached it through a
 * PhpDocConformanceService pass-through for a while; the checks now call it directly, so
 * "which parameters exist at version X" no longer looks like a PhpDoc question.
 */
final class ParameterFilterHelper
{
    /**
     * Filter parameters by PHP version availability, then merge consecutive
     * same-named pairs where the second is variadic.
     *
     * @param PHPParameter[] $params
     * @return PHPParameter[]
     */
    public static function filterAndDeduplicate(array $params, string $phpVersion): array
    {
        $filtered = [];
        foreach ($params as $param) {
            if ($param->getStubsMetadata()?->isAvailableIn($phpVersion) ?? true) {
                $filtered[] = $param;
            }
        }

        $merged = [];
        $count = count($filtered);
        for ($i = 0; $i < $count; $i++) {
            $current = $filtered[$i];
            $next = $filtered[$i + 1] ?? null;

            if ($next !== null
                && $current->getName() === $next->getName()
                && $next->isVariadic()
            ) {
                $merged[] = $next;
                $i++;
            } else {
                $merged[] = $current;
            }
        }

        return $merged;
    }
}
