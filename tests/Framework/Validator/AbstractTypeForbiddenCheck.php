<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\AbstractClassCheck;
use StubTests\Framework\Validator\KnownProblems\EntityType;

/**
 * Base class for checks that detect type hints forbidden in older PHP versions.
 *
 * Provides the common run() skeleton shared by all "type forbidden" checks:
 * 1. Skip entity via known problems.
 * 2. Look up the entity in stubs; succeed silently if absent.
 * 3. Succeed silently for final classes (non-overridable).
 * 4. Iterate overridable methods, delegating type-specific inspection to subclasses.
 * 5. Report failures with per-method known-problem support.
 *
 * Subclasses provide:
 * - getCheckName(): the name used for known-problem lookups
 * - supports(): which PHP versions this check applies to
 * - collectMethodIssues(): the type-specific inspection logic
 */
abstract class AbstractTypeForbiddenCheck extends AbstractClassCheck
{
    /**
     * Check name used for known-problem lookups.
     */
    abstract protected function getCheckName(): string;

    /**
     * Inspect a single overridable method for type violations.
     *
     * @return array<string, string> Map of entityId → failure message (empty = no issues)
     */
    abstract protected function collectMethodIssues(
        string $entityId,
        string $methodName,
        PHPMethod $method,
        string $phpVersion
    ): array;

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        if ($this->skipWithKnownProblem($results, $this->getEntityType(), $entityId, $this->getCheckName(), $phpVersion)) {
            return $results;
        }

        $entity = $this->lookupEntityById($stubs, $entityId);
        if ($entity === null) {
            $results->addSuccess($entityId);
            return $results;
        }

        if ($entity->isFinal()) {
            $results->addSuccess($entityId);
            return $results;
        }

        $stubMethods = $this->collectEntityMethodsByConfig($entity, $phpVersion);

        $hasMismatch = false;
        foreach ($stubMethods as $methodName => $method) {
            if ($this->isNonOverridable($method)) {
                continue;
            }

            $issues = $this->collectMethodIssues($entityId, $methodName, $method, $phpVersion);

            if (empty($issues)) {
                continue;
            }

            $hasMismatch    = true;
            $methodEntityId = $entityId . '::' . $methodName;

            if (!$this->skipWithKnownProblem($results, EntityType::METHOD->value, $methodEntityId, $this->getCheckName(), $phpVersion)) {
                foreach ($issues as $issueId => $issueMessage) {
                    $results->addFailure($issueId, $issueMessage);
                }
            }
        }

        if (!$hasMismatch) {
            $results->addSuccess($entityId);
        }

        return $results;
    }

    /**
     * Whether the method cannot be overridden (private, final, or tentative return type).
     */
    private function isNonOverridable(PHPMethod $method): bool
    {
        $access = $method->getAccess();
        if ($access === AccessModifier::PRIVATE) {
            return true;
        }
        if ($method->isFinal()) {
            return true;
        }
        if ($method->hasTentativeReturnType()) {
            return true;
        }
        return false;
    }
}
