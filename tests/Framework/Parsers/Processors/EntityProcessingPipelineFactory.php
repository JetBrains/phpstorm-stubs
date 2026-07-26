<?php

namespace StubTests\Framework\Parsers\Processors;

/**
 * Builds the canonical entity-processing pipelines.
 *
 * The pipeline used when generating a cache must match the one used when the Runner
 * regenerates that same cache on the fly, otherwise the two produce different data for
 * identical input. Runner::getReflection() previously built its storage manager with the
 * default (empty) pipeline while run-reflection-processor.php installed
 * ReflectionDeduplicationProcessor, so a Runner-triggered regeneration wrote a
 * non-deduplicated cache over the committed path. Both sides now come through here.
 */
final class EntityProcessingPipelineFactory
{
    /**
     * Pipeline for reflection-sourced entities.
     *
     * Deduplication is required: get_declared_classes()/get_defined_functions() can report
     * the same entity more than once (case aliases, extensions registering twice).
     */
    public static function forReflection(): EntityProcessingPipeline
    {
        $pipeline = new EntityProcessingPipeline();
        $pipeline->addProcessor(new ReflectionDeduplicationProcessor());

        return $pipeline;
    }

    /**
     * Pipeline for stub-sourced entities.
     *
     * Deduplication is required: the same entity can be declared in more than one stub
     * file (version-specific variants of a class, for instance).
     */
    public static function forStubs(): EntityProcessingPipeline
    {
        $pipeline = new EntityProcessingPipeline();
        $pipeline->addProcessor(new StubsDeduplicationProcessor());

        return $pipeline;
    }
}
