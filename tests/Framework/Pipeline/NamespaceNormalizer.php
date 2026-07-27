<?php

namespace StubTests\Framework\Pipeline;

use StubTests\Framework\Model\PHPNamespacedElement;

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
