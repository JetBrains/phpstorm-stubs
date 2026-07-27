<?php

namespace StubTests\Unit\Parsers\Processors;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Pipeline\EntityProcessingPipelineFactory;
use StubTests\Framework\Pipeline\ReflectionDeduplicationProcessor;
use StubTests\Framework\Pipeline\StubsDeduplicationProcessor;

/**
 * Guards the cache-generation pipelines against drifting apart.
 *
 * Runner::getReflection() once built its storage manager with the default empty pipeline
 * while run-reflection-processor.php installed ReflectionDeduplicationProcessor, so a
 * Runner-triggered regeneration silently wrote a non-deduplicated cache over the committed
 * file. Both paths now build their pipeline here, and these tests assert the deduplication
 * processor is actually present.
 */
class EntityProcessingPipelineFactoryTest extends TestCase
{
    public function testReflectionPipelineInstallsDeduplication()
    {
        $processors = EntityProcessingPipelineFactory::forReflection()->getProcessors();

        self::assertCount(1, $processors);
        self::assertInstanceOf(ReflectionDeduplicationProcessor::class, $processors[0]);
    }

    public function testStubsPipelineInstallsDeduplication()
    {
        $processors = EntityProcessingPipelineFactory::forStubs()->getProcessors();

        self::assertCount(1, $processors);
        self::assertInstanceOf(StubsDeduplicationProcessor::class, $processors[0]);
    }

    public function testEachCallReturnsAnIndependentPipeline()
    {
        $first = EntityProcessingPipelineFactory::forStubs();
        $second = EntityProcessingPipelineFactory::forStubs();

        self::assertNotSame($first, $second, 'A shared pipeline instance would leak processors between runs');
        self::assertNotSame($first->getProcessors()[0], $second->getProcessors()[0]);
    }

    public function testReflectionAndStubsPipelinesUseDifferentProcessors()
    {
        self::assertNotInstanceOf(
            StubsDeduplicationProcessor::class,
            EntityProcessingPipelineFactory::forReflection()->getProcessors()[0]
        );
        self::assertNotInstanceOf(
            ReflectionDeduplicationProcessor::class,
            EntityProcessingPipelineFactory::forStubs()->getProcessors()[0]
        );
    }
}
