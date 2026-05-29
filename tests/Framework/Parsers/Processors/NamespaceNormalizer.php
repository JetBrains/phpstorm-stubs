<?php

namespace StubTests\Framework\Parsers\Processors;

use StubTests\Framework\Parsers\Model\PHPNamespacedElement;
use StubTests\Framework\Parsers\Processors\EntityProcessor;

class NamespaceNormalizer implements EntityProcessor
{
    public function process($entity, array $context = [])
    {
        if ($entity instanceof PHPNamespacedElement) {
            $ns = $entity->getNamespace();
            if ($ns !== null) {
                $entity->setNamespace(ltrim($ns, '\\'));
            }
        }

        return $entity;
    }
}
