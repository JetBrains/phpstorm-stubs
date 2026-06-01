<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Parsers\Model\PHPClassConstant;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckResultSet;

/**
 * Base class for checks that compare a single attribute (e.g. visibility) on class/interface/enum
 * constants between reflection and stubs.
 *
 * Iterates over stub constants that are available for the given PHP version, looks each one up in
 * the reflection map (which includes all inherited constants), and delegates to
 * {@see describeMismatch()} for the actual comparison.  Constants that exist only in stubs but not
 * in reflection are silently skipped — ClassConstantsCheck is responsible for reporting those.
 *
 * Subclasses must implement:
 * - getCheckName(): the name used for known-problem lookups
 * - describeMismatch(): returns a failure message when the attribute differs, or null when it matches
 */
abstract class AbstractConstantFlagCheck extends AbstractClassCheck
{
    abstract protected function getCheckName(): string;

    /**
     * Compare a single attribute on the reflection and stub constant.
     * Return a descriptive failure message if there is a mismatch, or null if they match.
     */
    abstract protected function describeMismatch(
        string $constantEntityId,
        PHPClassConstant $reflConstant,
        PHPClassConstant $stubConstant,
        string $phpVersion
    ): ?string;

    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, $this->getEntityType(), $entityId, $this->getCheckName(), $phpVersion)) {
            return $results;
        }

        $reflection = $this->reflectionProvider->getReflection($phpVersion);
        $label = $this->getEntityLabel();

        $reflEntity = $this->lookupEntityById($reflection, $entityId);
        if ($reflEntity === null) {
            $results->addFailure($entityId, "{$label} {$entityId} not found in reflection data");
            return $results;
        }

        $stubEntity = $this->lookupEntityById($stubs, $entityId);
        if ($stubEntity === null) {
            $results->addFailure($entityId, "{$label} {$entityId} not found in stubs");
            return $results;
        }

        // Build name → PHPClassConstant map from reflection (includes all inherited constants)
        $reflMap = [];
        foreach ($reflEntity->getConstants() as $constant) {
            $reflMap[$constant->getName()] = $constant;
        }

        $hasMismatch = false;
        foreach ($stubEntity->getConstants() as $stubConstant) {
            if (!($stubConstant->getStubsMetadata()?->isAvailableIn($phpVersion) ?? true)) {
                continue;
            }

            $name = $stubConstant->getName();
            $constantId = "{$entityId}::{$name}";

            if (!isset($reflMap[$name])) {
                // Constant exists only in stubs — ClassConstantsCheck's responsibility, skip here
                continue;
            }

            if ($this->skipWithKnownProblem($results, $this->getConstantEntityType(), $constantId, $this->getCheckName(), $phpVersion)) {
                continue;
            }

            $mismatchMessage = $this->describeMismatch($constantId, $reflMap[$name], $stubConstant, $phpVersion);
            if ($mismatchMessage !== null) {
                $results->addFailure($constantId, $mismatchMessage);
                $hasMismatch = true;
            }
        }

        if (!$hasMismatch) {
            $results->addSuccess($entityId);
        }

        return $results;
    }
}
