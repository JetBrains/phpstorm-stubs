<?php

namespace StubTests\Framework\Runner;

use StubTests\Framework\Serialization\Reflection\ReflectionEntitySerializer;
use StubTests\Framework\Serialization\Stubs\StubsEntitySerializer;
use StubTests\Framework\DataProvider\AllStubsDataProvider;
use StubTests\Framework\DataProvider\CurrentRuntimeReflectionRawDataProvider;
use StubTests\Framework\Hierarchy\ClassHierarchyResolver;
use StubTests\Framework\Hierarchy\InheritDocVersionResolver;
use StubTests\Framework\Parsers\Reflection\AllReflectionParser;
use StubTests\Framework\Parsers\Stubs\AllStubsParser;
use StubTests\Framework\Parsers\Stubs\StubClassParser;
use StubTests\Framework\Parsers\Stubs\StubDefineConstantParser;
use StubTests\Framework\Parsers\Stubs\StubEnumParser;
use StubTests\Framework\Parsers\Stubs\StubFunctionParser;
use StubTests\Framework\Parsers\Stubs\StubInterfaceParser;
use StubTests\Framework\Parsers\Stubs\StubModernConstantParser;
use StubTests\Framework\Pipeline\EntityProcessingPipelineFactory;
use StubTests\Framework\Storage\DefaultParsedDataStorageManager;
use StubTests\Framework\Storage\JsonParsedDataStorage;
use StubTests\Framework\Storage\MultiFileJsonStorage;
use StubTests\Framework\Storage\ParsedDataStorageManager;
use StubTests\Framework\Storage\PhpDocStorage;

class Runner
{
    /** @var array<string, ParsedDataStorageManager> */
    private array $reflectionCache = [];
    private ?ParsedDataStorageManager $stubsCache = null;
    private readonly string $cacheDir;
    private readonly ClassHierarchyResolver $hierarchyResolver;
    private readonly InheritDocVersionResolver $inheritDocResolver;

    public function __construct(
        ?string $cacheDir = null,
        ?ClassHierarchyResolver $hierarchyResolver = null,
        ?InheritDocVersionResolver $inheritDocResolver = null,
    ) {
        $this->cacheDir = $cacheDir ?? __DIR__ . '/../../cache';
        $this->hierarchyResolver = $hierarchyResolver ?? new ClassHierarchyResolver();
        $this->inheritDocResolver = $inheritDocResolver ?? new InheritDocVersionResolver();
    }

    public function getReflection(string $phpVersion): ParsedDataStorageManager
    {
        if (PhpVersions::tryFrom($phpVersion) === null) {
            throw new \InvalidArgumentException("Unknown PHP version '{$phpVersion}'. Valid versions: " . implode(', ', array_map(fn (PhpVersions $v) => $v->value, PhpVersions::cases())));
        }

        if (isset($this->reflectionCache[$phpVersion])) {
            return $this->reflectionCache[$phpVersion];
        }

        $cacheFilePath = $this->cacheDir . "/Reflection$phpVersion.json";
        $serializer = new ReflectionEntitySerializer();

        if (file_exists($cacheFilePath)) {
            $manager = new DefaultParsedDataStorageManager(
                new JsonParsedDataStorage($cacheFilePath, $serializer, true)
            );
        } else {
            $runtimeVersion = PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION;
            if ($runtimeVersion !== $phpVersion) {
                throw new \RuntimeException("Reflection cache file not found: $cacheFilePath. " . "Cannot generate cache for PHP $phpVersion on runtime PHP $runtimeVersion. " . "Run the reflection cache generation script for PHP $phpVersion first.");
            }

            // Must use the same pipeline as tests/run-reflection-processor.php: without
            // deduplication this writes a cache containing duplicate entities over the
            // committed path, and every validator then compares against corrupted data.
            $parsedReflectionDataStorageManager = new DefaultParsedDataStorageManager(
                new JsonParsedDataStorage($cacheFilePath, $serializer, false),
                EntityProcessingPipelineFactory::forReflection()
            );
            $parser = new AllReflectionParser(
                new CurrentRuntimeReflectionRawDataProvider(),
                $parsedReflectionDataStorageManager
            );
            $parser->parseAll();
            $parsedReflectionDataStorageManager->save();

            $manager = $parsedReflectionDataStorageManager;
        }

        $this->hierarchyResolver->resolve($manager->getClasses(), $manager->getInterfaces(), $manager->getEnums());

        $this->reflectionCache[$phpVersion] = $manager;

        return $manager;
    }

    public function getStubs(): ParsedDataStorageManager
    {
        if ($this->stubsCache !== null) {
            return $this->stubsCache;
        }

        $cacheFilePath = $this->cacheDir . '/Stubs.json';
        $phpDocCacheFilePath = $this->cacheDir . '/StubsPhpDoc.json';

        if ($this->isStubsCacheComplete()) {
            $phpDocStorage = new PhpDocStorage($phpDocCacheFilePath);
            $serializer = new StubsEntitySerializer($phpDocStorage);
            $storage = new MultiFileJsonStorage($cacheFilePath, $serializer, true, $phpDocStorage);
            $manager = new DefaultParsedDataStorageManager($storage);
        } else {
            $phpDocStorage = new PhpDocStorage($phpDocCacheFilePath, false);
            $serializer = new StubsEntitySerializer($phpDocStorage);
            $storage = new MultiFileJsonStorage($cacheFilePath, $serializer, false, $phpDocStorage);
            $parsedStubsDataStorageManager = new DefaultParsedDataStorageManager(
                $storage,
                EntityProcessingPipelineFactory::forStubs()
            );
            $parser = new AllStubsParser(
                new AllStubsDataProvider(),
                $parsedStubsDataStorageManager,
                [new StubClassParser(), new StubFunctionParser(), new StubInterfaceParser(), new StubEnumParser(), new StubDefineConstantParser(), new StubModernConstantParser()]
            );
            $parser->parseAll();
            $parsedStubsDataStorageManager->save();

            $manager = $parsedStubsDataStorageManager;
        }

        $this->hierarchyResolver->resolve($manager->getClasses(), $manager->getInterfaces(), $manager->getEnums());
        $this->inheritDocResolver->resolve($manager->getClasses(), $manager->getInterfaces(), $manager->getEnums());

        $this->stubsCache = $manager;

        return $manager;
    }

    /**
     * Whether every stub cache artifact required by the read-from-cache path is present.
     *
     * MultiFileJsonStorage reads the five per-type files (StubsClasses/Functions/Interfaces/
     * Enums/Constants.json) — the "Stubs.json" base path is only used to derive those names and
     * is never read itself — and PhpDocStorage reads StubsPhpDoc.json. A partial cache (e.g. the
     * per-type files present but StubsPhpDoc.json missing) must fall through to regeneration;
     * otherwise the entities would load with all PhpDoc metadata (sinceVersion, removedVersion,
     * typeFromPhpDoc, …) silently dropped, yielding wrong validation results.
     */
    public function isStubsCacheComplete(): bool
    {
        $requiredFiles = [
            'StubsClasses.json',
            'StubsFunctions.json',
            'StubsInterfaces.json',
            'StubsEnums.json',
            'StubsConstants.json',
            'StubsPhpDoc.json',
        ];

        foreach ($requiredFiles as $file) {
            if (!file_exists($this->cacheDir . '/' . $file)) {
                return false;
            }
        }

        return true;
    }
}
