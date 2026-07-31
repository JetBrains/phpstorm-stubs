<?php

namespace StubTests\Unit\Parsers\Storage;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Reflection\AllReflectionParser;
use StubTests\Framework\Parsers\Stubs\AllStubsParser;
use StubTests\Framework\Storage\StubDataQueryInterface;
use StubTests\Framework\Runner\Runner;
use StubTests\Framework\Serialization\PhpDocRepository;
use StubTests\Framework\Storage\DefaultParsedDataStorageManager;
use StubTests\Framework\Storage\ParsedDataPersistence;
use StubTests\Framework\Storage\ParsedDataStorageManager;
use StubTests\Framework\Storage\ParsedDataWriter;
use StubTests\Framework\Storage\PhpDocStorage;

/**
 * Guards the storage-interface split: that each consumer declares the narrowest type it needs, and
 * that the narrow types stay narrow.
 *
 * ParsedDataStorageManager was a single 22-method interface with one implementor, handed whole to
 * every consumer — so a validator receiving a store for querying could call save() or load() on the
 * committed cache, and a test double had to stub 22 methods.
 *
 * These are structural assertions rather than behavioural ones, deliberately: the split's whole value
 * is which methods are *reachable* from which type, and that is invisible to a behavioural test. The
 * earlier per-entity query split ([W5]) was deleted precisely because nothing verified that it had
 * client types, and it turned out to have none.
 */
class StorageInterfaceSegregationTest extends TestCase
{
    /** The methods that must not be reachable from a read-only handle. */
    private const MUTATING = ['save', 'load', 'process', 'addEntity', 'addEntityRaw', 'addClass', 'getPipeline'];

    #[DataProvider('runnerAccessors')]
    public function testRunnerHandsOutOnlyTheReadInterface(string $method)
    {
        $returnType = (string)(new \ReflectionMethod(Runner::class, $method))->getReturnType();

        self::assertSame(StubDataQueryInterface::class, $returnType, "Runner::{$method}() must not widen");
    }

    public static function runnerAccessors(): array
    {
        return [['getStubs'], ['getReflection']];
    }

    #[DataProvider('mutatingMethods')]
    public function testTheReadInterfaceExposesNoMutatingMethod(string $method)
    {
        self::assertFalse(
            (new \ReflectionClass(StubDataQueryInterface::class))->hasMethod($method),
            "{$method}() is reachable from a read-only handle"
        );
    }

    public static function mutatingMethods(): array
    {
        return array_map(static fn (string $m): array => [$m], self::MUTATING);
    }

    public function testTheReadInterfaceIsTheEightQueryMethods()
    {
        $methods = array_map(
            static fn (\ReflectionMethod $m): string => $m->getName(),
            (new \ReflectionClass(StubDataQueryInterface::class))->getMethods()
        );
        sort($methods);

        self::assertSame(
            ['getClasses', 'getConstants', 'getEnums', 'getFunctions', 'getInterfaces',
             'hasClass', 'hasEnum', 'hasInterface'],
            $methods
        );
    }

    /**
     * Both parsers only produce, so they must declare the writer — not the composite. This is the
     * half of the split that has genuine client types.
     *
     * @param class-string $parserClass
     */
    #[DataProvider('producers')]
    public function testParsersDeclareOnlyTheWriter(string $parserClass, int $parameterIndex)
    {
        $params = (new \ReflectionMethod($parserClass, '__construct'))->getParameters();
        $type = (string)$params[$parameterIndex]->getType();

        self::assertSame(ParsedDataWriter::class, $type, $parserClass . ' should need only the writer');
    }

    public static function producers(): array
    {
        return [
            'stubs parser' => [AllStubsParser::class, 1],
            'reflection parser' => [AllReflectionParser::class, 1],
        ];
    }

    /** The writer must not carry persistence: filling a store and committing it are separate rights. */
    public function testWriterDoesNotGrantPersistence()
    {
        $writer = new \ReflectionClass(ParsedDataWriter::class);

        self::assertFalse($writer->hasMethod('save'));
        self::assertFalse($writer->hasMethod('load'));
    }

    /** The composite must still cover every concern, since the generation scripts use all of them. */
    public function testCompositeStillComposesEveryConcern()
    {
        $composite = new \ReflectionClass(ParsedDataStorageManager::class);

        foreach ([StubDataQueryInterface::class, ParsedDataWriter::class, ParsedDataPersistence::class] as $part) {
            self::assertTrue($composite->implementsInterface($part), "composite lost {$part}");
        }
    }

    public function testTheSoleImplementorStillSatisfiesTheComposite()
    {
        self::assertTrue(
            (new \ReflectionClass(DefaultParsedDataStorageManager::class))
                ->implementsInterface(ParsedDataStorageManager::class)
        );
    }

    /**
     * Serialization/ must not name Storage\PhpDocStorage. Fourteen files there used to, while
     * Storage\JsonParsedDataStorage names Serialization\EntitySerializerInterface — a cycle. Only
     * SerializerHelperTrait ever called anything on it (getPhpDoc/setPhpDoc); the rest mentioned the
     * class purely in type declarations, so the cycle bought nothing and cost a serializer unit test
     * a real PhpDocStorage — file path, lazy loading, and a save() it must never call — to exercise a
     * pure array transform.
     *
     * Asserted on source text rather than on reflection because the coupling this guards against is
     * a *type declaration*, and a `?PhpDocStorage $x = null` parameter that nobody passes is
     * invisible to any runtime check.
     */
    public function testSerializationDoesNotDependOnStorage()
    {
        $offenders = [];
        $dir = __DIR__ . '/../../../Framework/Serialization';
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir));

        foreach ($files as $file) {
            if (!$file->isFile() || $file->getExtension() !== 'php') {
                continue;
            }
            // The interface's own docblock explains what it replaced, so skip it by name.
            if ($file->getFilename() === 'PhpDocRepository.php') {
                continue;
            }
            if (preg_match('/\bStorage\\\\PhpDocStorage\b|(?<![\w\\\\$])PhpDocStorage\b/', file_get_contents($file->getPathname()))) {
                $offenders[] = $file->getFilename();
            }
        }
        sort($offenders);

        self::assertSame([], $offenders, 'Serialization/ must depend on PhpDocRepository, not on Storage\PhpDocStorage');
    }

    /**
     * The query contract must stay in Storage/, next to the only class that satisfies it. It sat in
     * Parsers/ while nothing under Parsers/ referenced it — the framework's only Storage -> Parsers
     * edge existed purely so Storage/ could import its own contract back.
     */
    public function testTheQueryContractLivesWithItsImplementor()
    {
        self::assertSame(
            'StubTests\Framework\Storage',
            (new \ReflectionClass(StubDataQueryInterface::class))->getNamespaceName()
        );

        $parsersDir = __DIR__ . '/../../../Framework/Parsers';
        $offenders = [];
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($parsersDir));

        foreach ($files as $file) {
            if (!$file->isFile() || $file->getExtension() !== 'php') {
                continue;
            }
            if (str_contains(file_get_contents($file->getPathname()), 'StubDataQueryInterface')) {
                $offenders[] = $file->getFilename();
            }
        }
        sort($offenders);

        self::assertSame([], $offenders, 'Parsers/ has no use for the query contract; keep it out');
    }

    /** The slice handed to serializers must stay a slice: no file lifecycle, no bulk access. */
    public function testThePhpDocSliceExposesNothingButOneReaderAndOneWriter()
    {
        $methods = array_map(
            static fn (\ReflectionMethod $m): string => $m->getName(),
            (new \ReflectionClass(PhpDocRepository::class))->getMethods()
        );
        sort($methods);

        self::assertSame(['getPhpDoc', 'setPhpDoc'], $methods);
        self::assertTrue(
            (new \ReflectionClass(PhpDocStorage::class))->implementsInterface(PhpDocRepository::class),
            'PhpDocStorage must remain usable wherever a PhpDocRepository is expected'
        );
    }
}
