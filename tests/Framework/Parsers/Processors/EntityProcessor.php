<?php

namespace StubTests\Framework\Parsers\Processors;

interface EntityProcessor
{
    /**
     * Process a single entity
     *
     * @param mixed $entity The entity to process
     * @param array $context Additional context (e.g., ['existingEntities' => [...]])
     * @return mixed|null Processed entity, or null to filter it out
     */
    public function process($entity, array $context = []);
}
