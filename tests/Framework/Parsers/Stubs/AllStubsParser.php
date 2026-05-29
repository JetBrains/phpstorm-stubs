<?php

namespace StubTests\Framework\Parsers\Stubs;

use StubTests\Framework\DataProvider\StubsDataProvider;
use StubTests\Framework\Parsers\Storage\ParsedDataStorageManager;
use StubTests\Framework\Parsers\Stubs\MultiEntityStubParserInterface;

class AllStubsParser
{
    /**
     * @param StubsDataProvider $dataProvider
     * @param ParsedDataStorageManager $storageManager
     * @param MultiEntityStubParserInterface[] $parsers Array of parsers implementing MultiEntityStubParserInterface
     */
    public function __construct(
        private StubsDataProvider $dataProvider,
        private ParsedDataStorageManager $storageManager,
        private array $parsers
    ) {}

    public function parseAll(): void
    {
        $files = $this->dataProvider->getAllStubFiles();

        // PHASE 1: Collect all entities (deferred processing)
        foreach ($files as $filePath) {
            $content = $this->dataProvider->getStubFileContent($filePath);

            // Parse with all parsers using polymorphic interface
            foreach ($this->parsers as $parser) {
                try {
                    $entities = $parser->extractAndParseAll($content);

                    foreach ($entities as $entity) {
                        $entity->initStubsMetadata()->setSourcePath($filePath);
                        $this->storageManager->addEntityRaw($entity);
                    }
                } catch (\PhpParser\Error|\RuntimeException $e) {
                    // Skip files that don't contain this entity type
                    continue;
                }
            }
        }

        // PHASE 2: Process all collected entities through pipeline (includes deduplication if configured)
        $this->storageManager->process();
    }
}