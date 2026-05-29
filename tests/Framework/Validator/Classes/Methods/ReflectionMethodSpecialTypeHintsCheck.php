<?php

namespace StubTests\Framework\Validator\Classes\Methods;

use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\AbstractClassCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\Services\TypeResolver;

/**
 * Validates that Reflection API methods declare version-aware type hints
 * (via LanguageLevelTypeAware) that narrow the generic ReflectionType base
 * to concrete subtypes (ReflectionNamedType, ReflectionUnionType,
 * ReflectionIntersectionType) for the PHP versions that introduced them.
 *
 * This is a stubs-only regression check (reflection data is never used).
 * It prevents inadvertent removal of the LanguageLevelTypeAware attribute
 * entries that the IDE relies on to show precise completion types.
 *
 * Motivation: https://youtrack.jetbrains.com/issue/WI-61052
 */
class ReflectionMethodSpecialTypeHintsCheck extends AbstractClassCheck
{

    /**
     * Required LanguageLevelTypeAware version-map entries for specific Reflection methods.
     *
     * Structure: class_entity_id → method_name → [ php_version => expected_type ]
     *
     * Each entry is verified to exist in the method's getLanguageLevelTypes() map
     * with an exactly-matching (normalised) type string.
     *
     * @var array<string, array<string, array<string, string>>>
     */
    private const REQUIRED_HINTS = [
        '\\ReflectionFunctionAbstract' => [
            'getReturnType' => [
                '7.1' => 'ReflectionNamedType|null',
                '8.0' => 'ReflectionNamedType|ReflectionUnionType|null',
                '8.1' => 'ReflectionNamedType|ReflectionUnionType|ReflectionIntersectionType|null',
            ],
        ],
        '\\ReflectionParameter' => [
            'getType' => [
                '7.1' => 'ReflectionNamedType|null',
                '8.0' => 'ReflectionNamedType|ReflectionUnionType|null',
                '8.1' => 'ReflectionNamedType|ReflectionUnionType|ReflectionIntersectionType|null',
            ],
        ],
        '\\ReflectionProperty' => [
            'getType' => [
                '8.0' => 'ReflectionNamedType|ReflectionUnionType|null',
                '8.1' => 'ReflectionNamedType|ReflectionUnionType|ReflectionIntersectionType|null',
            ],
        ],
        '\\ReflectionEnum' => [
            'getBackingType' => [
                '8.2' => 'ReflectionNamedType|null',
            ],
        ],
    ];

    public function supports(string $phpVersion): bool
    {
        return true;
    }

    public function run(StubDataQueryInterface $stubs, string $entityId, string $phpVersion): CheckResultSet
    {
        $results = new CheckResultSet();

        // Fast-path: entity not in our watch-list — nothing to check
        if (!isset(self::REQUIRED_HINTS[$entityId])) {
            $results->addSuccess($entityId);
            return $results;
        }

        if ($this->skipWithKnownProblem($results, EntityType::CLASS_TYPE->value, $entityId, 'ReflectionMethodSpecialTypeHintsCheck', $phpVersion)) {
            return $results;
        }

        $stubClass = $this->findClassById($stubs, $entityId);
        if ($stubClass === null) {
            // Class absent from stubs — ExistsCheck's responsibility
            $results->addSuccess($entityId);
            return $results;
        }

        $hasFailure = false;

        foreach (self::REQUIRED_HINTS[$entityId] as $methodName => $requiredVersions) {
            // Find the method by name (without version-filtering — we check the stub's
            // attribute declaration, not version-conditional method availability)
            $stubMethod = null;
            foreach ($stubClass->getMethods() as $m) {
                if ($m->getName() === $methodName) {
                    $stubMethod = $m;
                    break;
                }
            }

            if ($stubMethod === null) {
                // Method absent — ExistsCheck's responsibility
                continue;
            }

            $methodEntityId = $entityId . '::' . $methodName;

            if ($this->skipWithKnownProblem($results, EntityType::METHOD->value, $methodEntityId, 'ReflectionMethodSpecialTypeHintsCheck', $phpVersion)) {
                continue;
            }

            $actualVersionMap = $stubMethod->getStubsMetadata()?->getLanguageLevelTypes();
            if ($actualVersionMap === null) {
                $hasFailure = true;
                $results->addFailure(
                    $methodEntityId,
                    "{$methodEntityId} is missing LanguageLevelTypeAware version-specific entries"
                );
                continue;
            }

            foreach ($requiredVersions as $requiredVersion => $requiredType) {
                if (!array_key_exists($requiredVersion, $actualVersionMap)) {
                    $hasFailure = true;
                    $results->addFailure(
                        "{$methodEntityId}@{$requiredVersion}",
                        "{$methodEntityId} LanguageLevelTypeAware is missing entry for PHP {$requiredVersion}: expected '{$requiredType}'"
                    );
                    continue;
                }

                $actualType         = $actualVersionMap[$requiredVersion];
                $normalizedActual   = TypeResolver::normalizeType($actualType);
                $normalizedExpected = TypeResolver::normalizeType($requiredType);

                if ($normalizedActual !== $normalizedExpected) {
                    $hasFailure = true;
                    $results->addFailure(
                        "{$methodEntityId}@{$requiredVersion}",
                        "{$methodEntityId} LanguageLevelTypeAware entry for PHP {$requiredVersion}: expected '{$requiredType}', found '{$actualType}'"
                    );
                }
            }
        }

        if (!$hasFailure) {
            $results->addSuccess($entityId);
        }

        return $results;
    }
}
