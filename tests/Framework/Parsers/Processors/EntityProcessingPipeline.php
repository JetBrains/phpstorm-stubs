<?php

namespace StubTests\Framework\Parsers\Processors;

use StubTests\Framework\Parsers\Processors\EntityProcessor;

class EntityProcessingPipeline
{
    /** @var EntityProcessor[] */
    private array $processors = [];

    /**
     * Add a processor to the pipeline
     *
     * @param EntityProcessor $processor
     * @return self For fluent interface
     */
    public function addProcessor(EntityProcessor $processor): self
    {
        $this->processors[] = $processor;
        return $this;
    }

    /**
     * Remove a processor by class name
     *
     * @param string $processorClass
     * @return self For fluent interface
     */
    public function removeProcessor(string $processorClass): self
    {
        $this->processors = array_values(array_filter(
            $this->processors,
            fn($p) => !($p instanceof $processorClass)
        ));
        return $this;
    }

    /**
     * Get all processors in the pipeline
     *
     * @return EntityProcessor[]
     */
    public function getProcessors(): array
    {
        return $this->processors;
    }

    /**
     * Clear all processors from the pipeline
     *
     * @return self For fluent interface
     */
    public function clearProcessors(): self
    {
        $this->processors = [];
        return $this;
    }

    /**
     * Process a single entity through the pipeline
     *
     * @param mixed $entity The entity to process
     * @param array $context Additional context for processors
     * @return mixed|null Processed entity, or null if filtered out
     */
    public function processSingle($entity, array $context = [])
    {
        foreach ($this->processors as $processor) {
            $entity = $processor->process($entity, $context);
            if ($entity === null) {
                return null;  // Filtered out by processor
            }
        }
        return $entity;
    }

    /**
     * Process multiple entities through the pipeline (batch processing)
     *
     * @param array $entities
     * @return array Processed entities (filtered entities removed)
     */
    public function processBatch(array $entities): array
    {
        $processed = [];
        foreach ($entities as $entity) {
            $result = $this->processSingle($entity, ['existingEntities' => $entities]);
            if ($result !== null) {
                $processed[] = $result;
            }
        }
        return $processed;
    }
}
