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
        $files     = $this->dataProvider->getAllStubFiles();
        $stubsRoot = $this->dataProvider->getStubsRootPath();

        // PHASE 1: Collect all entities (deferred processing)
        foreach ($files as $filePath) {
            $content = $this->dataProvider->getStubFileContent($filePath);
            $sourcePath = self::relativizePath($filePath, $stubsRoot);

            // Parse with all parsers using polymorphic interface
            foreach ($this->parsers as $parser) {
                try {
                    $entities = $parser->extractAndParseAll($content);

                    foreach ($entities as $entity) {
                        $entity->initStubsMetadata()->setSourcePath($sourcePath);
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

    /**
     * Return $absolutePath as a forward-slash path relative to $stubsRoot.
     *
     * Source paths are persisted to the JSON cache and shared across
     * environments (local macOS, Linux CI, Docker, WSL), so storing the
     * absolute path would tie the cache to the machine that generated it.
     * The relative form (e.g. "gmp/gmp.php") is portable and lets consumers
     * decide whether to resolve against the current root.
     *
     * Falls back to the unmodified path when it does not live under the
     * configured stubs root — defensive, but should not occur with the
     * standard AllStubsDataProvider.
     */
    private static function relativizePath(string $absolutePath, string $stubsRoot): string
    {
        $normalizedPath = str_replace('\\', '/', $absolutePath);
        $normalizedRoot = rtrim(str_replace('\\', '/', $stubsRoot), '/');

        if ($normalizedRoot !== '' && str_starts_with($normalizedPath, $normalizedRoot . '/')) {
            return substr($normalizedPath, strlen($normalizedRoot) + 1);
        }

        return $normalizedPath;
    }
}