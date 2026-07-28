<?php

namespace StubTests\Framework\Validator\PhpDoc;

use StubTests\Framework\Model\PHPClassLikeObject;

/**
 * Walks the PhpDoc-bearing locations of an entity — the entity itself, then each of its methods
 * when it is class-like — and collects whatever an inspector reports at each one.
 *
 * PhpDocTagsCheck, PhpDocVersionFormatCheck and PhpDocLinksCheck each carried their own copy of
 * this traversal, identical apart from the predicate applied to the doc string and the local
 * variable names. Only the predicate ever differed, so only the predicate is passed in.
 *
 * Method-level keys are `"{$entityId}::{$methodName}"`, matching what all three produced.
 */
trait PhpDocLocationWalkerTrait
{
    /**
     * @param callable(string): array $inspect Receives one non-empty PhpDoc string, returns the
     *                                         violations found in it (empty array when clean)
     * @return array<string, array> location id => violations, omitting locations with none
     */
    private function collectByPhpDocLocation(object $entity, string $entityId, callable $inspect): array
    {
        $result = [];

        $entityPhpDoc = $entity->getStubsMetadata()?->getPhpDoc();
        if ($entityPhpDoc !== null && $entityPhpDoc !== '') {
            $violations = $inspect($entityPhpDoc);
            if (!empty($violations)) {
                $result[$entityId] = $violations;
            }
        }

        if ($entity instanceof PHPClassLikeObject) {
            foreach ($entity->getMethods() as $method) {
                $phpDoc = $method->getStubsMetadata()?->getPhpDoc();
                if ($phpDoc === null || $phpDoc === '') {
                    continue;
                }
                $violations = $inspect($phpDoc);
                if (!empty($violations)) {
                    $result[$entityId . '::' . $method->getName()] = $violations;
                }
            }
        }

        return $result;
    }
}
