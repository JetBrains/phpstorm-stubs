<?php

namespace StubTests\Framework\Validator\Classes\Properties;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractClassCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\EntityType;

/**
 * Validates that all properties present in reflection also exist in stubs.
 *
 * The check is performed per-class: for each class entity ID the validator
 * 1. collects all properties from the reflection class,
 * 2. collects all version-appropriate properties from the stub class and its full
 *    parent class chain in stubs,
 * 3. reports any reflection property that is absent from the stub property set.
 *
 * Parent-chain traversal is necessary because PHP's ReflectionClass::getProperties()
 * returns inherited public/protected properties from all ancestor classes, while stubs
 * typically declare each property only once on the class where it is first introduced.
 *
 * Version filtering for stub properties uses sinceVersion/removedVersion stored on
 * each PHPProperty. A stub property is considered available for a given PHP version if:
 *   - sinceVersion is null OR phpVersion >= sinceVersion
 *   - AND removedVersion is null OR phpVersion < removedVersion
 *
 * Known problems are supported at two granularities:
 * - class-level: EntityType::CLASS_TYPE + classId + 'ClassPropertiesExistCheck'
 *   → skips all property checks for the class.
 * - property-level: EntityType::PROPERTY + '\ClassName::$propertyName' + 'ClassPropertiesExistCheck'
 *   → skips only that specific missing-property failure.
 */
class ClassPropertiesExistCheck extends AbstractClassCheck
{
    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        // Class-level known problem skips all property validation for this class
        if ($this->skipWithKnownProblem($results, $this->getEntityType(), $entityId, 'ClassPropertiesExistCheck', $phpVersion)) {
            return $results;
        }

        $reflection = $this->reflectionProvider->getReflection($phpVersion);
        $label      = $this->getEntityLabel();

        $reflectionClass = $this->lookupEntityById($reflection, $entityId);
        if (!$reflectionClass instanceof PHPClass) {
            $results->addFailure($entityId, "{$label} {$entityId} not found in reflection data");
            return $results;
        }

        $stubClass = $this->lookupEntityById($stubs, $entityId);
        if (!$stubClass instanceof PHPClass) {
            $results->addFailure($entityId, "{$label} {$entityId} not found in stubs");
            return $results;
        }

        // Collect all property names from reflection (includes inherited public/protected props).
        $reflectionPropertyNames = [];
        foreach ($reflectionClass->getProperties() as $property) {
            $name = $property->getName();
            if ($name !== null) {
                $reflectionPropertyNames[$name] = true;
            }
        }

        // Collect version-appropriate property names from the stub class and its full parent chain.
        $stubPropertyNames = $this->methodCollection->collectPropertiesForClass($stubClass, $phpVersion);

        $missingProperties = array_diff(array_keys($reflectionPropertyNames), array_keys($stubPropertyNames));

        if (empty($missingProperties)) {
            $results->addSuccess($entityId);
            return $results;
        }

        // For each missing property, check for a property-level known problem entry.
        sort($missingProperties);
        foreach ($missingProperties as $propertyName) {
            $propertyEntityId = $entityId . '::$' . $propertyName;

            if (!$this->skipWithKnownProblem($results, EntityType::PROPERTY->value, $propertyEntityId, 'ClassPropertiesExistCheck', $phpVersion)) {
                $results->addFailure(
                    $propertyEntityId,
                    "Property {$propertyEntityId} exists in PHP {$phpVersion} but not in stubs"
                );
            }
        }

        return $results;
    }
}
