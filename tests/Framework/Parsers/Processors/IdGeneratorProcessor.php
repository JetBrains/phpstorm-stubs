<?php

namespace StubTests\Framework\Parsers\Processors;

use StubTests\Framework\Parsers\Model\PHPClass;

class IdGeneratorProcessor implements EntityProcessor
{
    public function process($entity, array $context = [])
    {
        if ($entity instanceof PHPClass && $entity->getId() === null) {
            $entity->setId(uniqid('class_', true));
        }

        return $entity;
    }
}
