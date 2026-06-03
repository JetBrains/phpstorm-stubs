<?php

namespace StubTests\Framework\Parsers\Processors;

use StubTests\Framework\Parsers\Model\PHPNamespacedElement;

class StubsDeduplicationProcessor implements EntityProcessor
{
    /** @var array<string, PHPNamespacedElement> First-seen entity per dedup key */
    private array $seenByKey = [];

    public function process($entity, array $context = [])
    {
        if ($entity instanceof PHPNamespacedElement) {
            $key = get_class($entity) . '::' . $entity->getNamespace() . '\\' . $entity->getName();

            if (isset($this->seenByKey[$key])) {
                $existing = $this->seenByKey[$key];

                // Cross-reference source paths between duplicate and first-seen entity
                $duplicateSourcePath = $entity->getStubsMetadata()?->getSourcePath();
                $existingSourcePath = $existing->getStubsMetadata()?->getSourcePath();

                if ($duplicateSourcePath !== null) {
                    $existing->initStubsMetadata()->addDuplicate($duplicateSourcePath);
                }

                if ($existingSourcePath !== null) {
                    $entity->initStubsMetadata()->addDuplicate($existingSourcePath);
                }
            } else {
                $this->seenByKey[$key] = $entity;
            }
        }

        return $entity;
    }
}
