<?php

namespace StubTests\Framework\Validator\Classes\Constants;

use StubTests\Framework\Storage\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractClassCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\CheckType;

/**
 * Validates that the constants of a class in stubs match reflection, in both directions.
 *
 * PHP reflection reports ALL constants of a class including those inherited via the
 * parent-class chain and implemented interfaces.  Stubs only declare constants that are
 * directly introduced (not inherited), so the two sides are compared as follows:
 *
 * - Each constant declared directly in the stub must appear in reflection's full constant
 *   list (which includes all inherited ones). This catches spurious stub constants.
 * - Each constant in reflection's list must be declared somewhere in the stub hierarchy
 *   (the class, its parents and its interfaces; enum cases count as constants). This
 *   catches constants missing from the stubs, or whose @since is too late.
 *
 * Visibility is validated separately by ClassConstantsVisibilityCheck.
 * Values are validated separately by ClassConstantsValueCheck.
 *
 * For interfaces and enums, pass EntityTypeConfig::forInterface() or
 * EntityTypeConfig::forEnum() to override the entity-lookup and label methods.
 *
 * Known problems are supported at two levels:
 *  - Entity-level: EntityType::CLASS_TYPE + classId + 'ClassConstantsCheck' → skips entire class.
 *  - Constant-level: EntityType::CLASS_CONSTANT + 'ClassName::CONST' + 'ClassConstantsCheck' → skips one constant.
 */
class ClassConstantsCheck extends AbstractClassCheck
{
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

        $reflEntity = $this->lookupEntityById($reflection, $entityId);
        if ($reflEntity === null) {
            $results->addFailure($entityId, "{$this->getEntityLabel()} {$entityId} not found in reflection data");
            return $results;
        }

        $stubEntity = $this->lookupEntityById($stubs, $entityId);
        if ($stubEntity === null) {
            $results->addFailure($entityId, "{$this->getEntityLabel()} {$entityId} not found in stubs");
            return $results;
        }

        // Build name → PHPClassConstant map from reflection (includes all inherited constants)
        $reflMap = [];
        foreach ($reflEntity->getConstants() as $constant) {
            $reflMap[$constant->getName()] = $constant;
        }

        // Validate each constant that is directly declared in the stub and available in this PHP version
        $hasFailures = false;
        foreach ($stubEntity->getConstants() as $stubConstant) {
            if (!($stubConstant->getStubsMetadata()?->isAvailableIn($phpVersion) ?? true)) {
                continue;
            }

            $name = $stubConstant->getName();
            $constantId = "{$entityId}::{$name}";

            if ($this->skipWithKnownProblem($results, $this->getConstantEntityType(), $constantId, $this->getCheckName(), $phpVersion)) {
                continue;
            }

            if (!isset($reflMap[$name])) {
                $results->addFailure(
                    $constantId,
                    "Constant '{$name}' is declared in stubs for {$this->getEntityLabel()} {$entityId} but not found in reflection"
                );
                $hasFailures = true;
            }
        }

        // Validate that each reflection constant is declared somewhere in the stub hierarchy
        $stubNames = $this->methodCollection->collectConstantNames($stubEntity, $phpVersion);
        foreach ($reflMap as $name => $reflConstant) {
            if (isset($stubNames[$name])) {
                continue;
            }

            $constantId = "{$entityId}::{$name}";

            if ($this->skipWithKnownProblem($results, $this->getConstantEntityType(), $constantId, $this->getCheckName(), $phpVersion)) {
                continue;
            }

            $results->addFailure(
                $constantId,
                "Constant '{$name}' exists in reflection for {$this->getEntityLabel()} {$entityId} but is not declared in stubs"
            );
            $hasFailures = true;
        }

        if (!$hasFailures) {
            $results->addSuccess($entityId);
        }

        return $results;
    }

    protected function getCheckName(): CheckType
    {
        return CheckType::CLASS_CONSTANTS;
    }
}
