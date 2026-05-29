<?php

namespace StubTests\Framework\Validator\Functions;

use StubTests\Framework\Validator\Functions\must;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractCallableCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;

/**
 * Validates that specific array functions document the correct union return type
 * in their PhpDoc, where the PHP signature uses only 'mixed' and loses the
 * failure case.
 *
 * Two groups are checked:
 *
 *  - MIXED_FALSE_RETURN_FUNCTIONS: array-traversal functions (\end, \prev, etc.)
 *    that return the current element or **false** for an empty/exhausted array.
 *    PhpDoc must contain 'mixed|false' (see https://youtrack.jetbrains.com/issue/WI-57991).
 *
 *  - MIXED_NULL_RETURN_FUNCTIONS: array-mutation functions (\array_pop, \array_shift)
 *    that remove and return an element, or **null** when the array is empty.
 *    PhpDoc must contain 'mixed|null'.
 *
 * The check is a no-op for all other functions.
 */
class FunctionSpecialTypeHintsCheck extends AbstractCallableCheck
{
    /**
     * Functions whose PhpDoc @return must contain both 'mixed' and 'false'.
     */
    private const MIXED_FALSE_RETURN_FUNCTIONS = [
        '\end',
        '\prev',
        '\next',
        '\reset',
        '\current',
    ];

    /**
     * Functions whose PhpDoc @return must contain both 'mixed' and 'null'.
     *
     * array_pop() and array_shift() remove and return the last/first element of
     * an array, or null when the array is empty.  The PHP 8 signature uses 'mixed',
     * which hides the null-on-empty-array case.  The PhpDoc must therefore
     * explicitly state 'mixed|null' so that IDEs can model both outcomes.
     */
    private const MIXED_NULL_RETURN_FUNCTIONS = [
        '\array_pop',
        '\array_shift',
    ];

    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        $isMixedFalse = in_array($entityId, self::MIXED_FALSE_RETURN_FUNCTIONS, true);
        $isMixedNull  = in_array($entityId, self::MIXED_NULL_RETURN_FUNCTIONS, true);

        if (!$isMixedFalse && !$isMixedNull) {
            $results->addSuccess($entityId);
            return $results;
        }

        $stubFunction = $this->findCallable($stubs, $entityId, $phpVersion);

        if ($stubFunction === null) {
            // FunctionExistsCheck is responsible for reporting absence
            $results->addSuccess($entityId);
            return $results;
        }

        $docReturnType = $stubFunction->getStubsMetadata()?->getTypeFromPhpDoc();

        $requiredSecond  = $isMixedFalse ? 'false' : 'null';
        $expectedPattern = "mixed|{$requiredSecond}";

        if ($docReturnType === null || $docReturnType === '') {
            $results->addFailure(
                $entityId,
                "Function {$entityId} must have '@return {$expectedPattern}' in PhpDoc " .
                "but the @return tag is missing. (see https://youtrack.jetbrains.com/issue/WI-57991)"
            );
            return $results;
        }

        $parts    = array_map('trim', explode('|', $docReturnType));
        $hasMixed = in_array('mixed', $parts, true);
        $hasSecond = in_array($requiredSecond, $parts, true);

        if (!$hasMixed || !$hasSecond) {
            $missing = [];
            if (!$hasMixed) {
                $missing[] = 'mixed';
            }
            if (!$hasSecond) {
                $missing[] = $requiredSecond;
            }

            $results->addFailure(
                $entityId,
                "Function {$entityId} PhpDoc @return must contain '{$expectedPattern}' " .
                "but is missing: " . implode(', ', $missing) . " (got '{$docReturnType}'). (see https://youtrack.jetbrains.com/issue/WI-57991)"
            );
            return $results;
        }

        $results->addSuccess($entityId);
        return $results;
    }
}
