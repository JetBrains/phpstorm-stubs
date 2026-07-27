<?php

namespace StubTests\Unit\Validator;

use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPConstant;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Services\EntityLookupService;
use StubTests\Framework\Validator\KnownProblems\EntityType;

class EntityLookupServiceTest extends CheckTestCase
{
    private EntityLookupService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new EntityLookupService();
    }

    // ── Helper ───────────────────────────────────────────────────────────────

    private function createMockStorage(
        array $classes = [],
        array $enums = [],
        array $interfaces = [],
        array $functions = [],
        array $constants = []
    ): StubDataQueryInterface {
        $storage = $this->createMock(StubDataQueryInterface::class);
        $storage->method('getClasses')->willReturn($classes);
        $storage->method('getEnums')->willReturn($enums);
        $storage->method('getInterfaces')->willReturn($interfaces);
        $storage->method('getFunctions')->willReturn($functions);
        $storage->method('getConstants')->willReturn($constants);
        return $storage;
    }

    // ── findClassById ────────────────────────────────────────────────────────

    public function testFindClassByIdReturnsEntityWhenFound(): void
    {
        $class = $this->makeClass('\\DateTime');
        $storage = $this->createMockStorage(classes: [$class]);

        $result = $this->service->findClassById($storage, '\\DateTime');

        $this->assertSame($class, $result);
    }

    public function testFindClassByIdReturnsNullWhenNotFound(): void
    {
        $storage = $this->createMockStorage(classes: [$this->makeClass('\\DateTime')]);

        $result = $this->service->findClassById($storage, '\\NonExistent');

        $this->assertNull($result);
    }

    // ── findEnumById ─────────────────────────────────────────────────────────

    public function testFindEnumByIdReturnsEntityWhenFound(): void
    {
        $enum = $this->makeEnum('\\Suit');
        $storage = $this->createMockStorage(enums: [$enum]);

        $result = $this->service->findEnumById($storage, '\\Suit');

        $this->assertSame($enum, $result);
    }

    public function testFindEnumByIdReturnsNullWhenNotFound(): void
    {
        $storage = $this->createMockStorage(enums: []);

        $this->assertNull($this->service->findEnumById($storage, '\\Missing'));
    }

    // ── findInterfaceById ────────────────────────────────────────────────────

    public function testFindInterfaceByIdReturnsEntityWhenFound(): void
    {
        $iface = $this->makeInterface('\\Countable');
        $storage = $this->createMockStorage(interfaces: [$iface]);

        $this->assertSame($iface, $this->service->findInterfaceById($storage, '\\Countable'));
    }

    public function testFindInterfaceByIdReturnsNullWhenNotFound(): void
    {
        $storage = $this->createMockStorage(interfaces: []);

        $this->assertNull($this->service->findInterfaceById($storage, '\\Missing'));
    }

    // ── findConstantById ──────────────────────────────────────────────────────

    public function testFindConstantByIdReturnsEntityWhenFound(): void
    {
        $constant = new PHPConstant();
        $constant->setId('\\PHP_INT_MAX');
        $constant->setName('PHP_INT_MAX');
        $storage = $this->createMockStorage(constants: [$constant]);

        $result = $this->service->findConstantById($storage, '\\PHP_INT_MAX');

        $this->assertSame($constant, $result);
    }

    public function testFindConstantByIdReturnsNullWhenNotFound(): void
    {
        $storage = $this->createMockStorage(constants: []);

        $this->assertNull($this->service->findConstantById($storage, '\\MISSING'));
    }

    // ── findFunctionById ─────────────────────────────────────────────────────

    public function testFindFunctionByIdReturnsEntityWhenFound(): void
    {
        $fn = $this->makeFunction('\\strlen');
        $storage = $this->createMockStorage(functions: [$fn]);

        $this->assertSame($fn, $this->service->findFunctionById($storage, '\\strlen'));
    }

    public function testFindFunctionByIdReturnsNullWhenNotFound(): void
    {
        $storage = $this->createMockStorage(functions: []);

        $this->assertNull($this->service->findFunctionById($storage, '\\missing'));
    }

    // ── Lazy indexing / caching ──────────────────────────────────────────────

    public function testSecondCallWithSameStorageUsesCachedIndex(): void
    {
        $class = $this->makeClass('\\DateTime');
        $storage = $this->createMockStorage(classes: [$class]);

        // Call twice — both should return the same entity object
        $first = $this->service->findClassById($storage, '\\DateTime');
        $second = $this->service->findClassById($storage, '\\DateTime');

        $this->assertSame($first, $second);
        $this->assertSame($class, $first);
    }

    // ── Different storage objects get separate indexes ────────────────────────

    public function testDifferentStorageObjectsGetSeparateIndexes(): void
    {
        $classA = $this->makeClass('\\ClassA');
        $classB = $this->makeClass('\\ClassB');
        $storageA = $this->createMockStorage(classes: [$classA]);
        $storageB = $this->createMockStorage(classes: [$classB]);

        // storageA has ClassA, not ClassB
        $this->assertSame($classA, $this->service->findClassById($storageA, '\\ClassA'));
        $this->assertNull($this->service->findClassById($storageA, '\\ClassB'));

        // storageB has ClassB, not ClassA
        $this->assertSame($classB, $this->service->findClassById($storageB, '\\ClassB'));
        $this->assertNull($this->service->findClassById($storageB, '\\ClassA'));
    }

    // ── Entities with null ID are skipped ────────────────────────────────────

    public function testEntitiesWithNullIdAreSkippedDuringIndexing(): void
    {
        $nullIdClass = new PHPClass();
        // No setId() call — getId() returns null
        $validClass = $this->makeClass('\\Valid');

        $storage = $this->createMockStorage(classes: [$nullIdClass, $validClass]);

        $this->assertSame($validClass, $this->service->findClassById($storage, '\\Valid'));
        // Should not crash or find null-ID entity
        $this->assertNull($this->service->findClassById($storage, ''));
    }

    // ── findAnyEntityById ────────────────────────────────────────────────────

    public function testFindAnyEntityByIdReturnsClassWithCorrectType(): void
    {
        $class = $this->makeClass('\\DateTime');
        $storage = $this->createMockStorage(classes: [$class]);

        $result = $this->service->findAnyEntityById($storage, '\\DateTime');

        $this->assertNotNull($result);
        $this->assertSame($class, $result[0]);
        $this->assertSame(EntityType::CLASS_TYPE, $result[1]);
    }

    public function testFindAnyEntityByIdReturnsInterfaceWithCorrectType(): void
    {
        $iface = $this->makeInterface('\\Countable');
        $storage = $this->createMockStorage(interfaces: [$iface]);

        $result = $this->service->findAnyEntityById($storage, '\\Countable');

        $this->assertNotNull($result);
        $this->assertSame($iface, $result[0]);
        $this->assertSame(EntityType::INTERFACE_TYPE, $result[1]);
    }

    public function testFindAnyEntityByIdReturnsEnumWithCorrectType(): void
    {
        $enum = $this->makeEnum('\\Suit');
        $storage = $this->createMockStorage(enums: [$enum]);

        $result = $this->service->findAnyEntityById($storage, '\\Suit');

        $this->assertNotNull($result);
        $this->assertSame($enum, $result[0]);
        $this->assertSame(EntityType::ENUM_TYPE, $result[1]);
    }

    public function testFindAnyEntityByIdReturnsFunctionWithCorrectType(): void
    {
        $fn = $this->makeFunction('\\strlen');
        $storage = $this->createMockStorage(functions: [$fn]);

        $result = $this->service->findAnyEntityById($storage, '\\strlen');

        $this->assertNotNull($result);
        $this->assertSame($fn, $result[0]);
        $this->assertSame(EntityType::FUNCTION, $result[1]);
    }

    public function testFindAnyEntityByIdReturnsNullWhenNotFound(): void
    {
        $storage = $this->createMockStorage();

        $this->assertNull($this->service->findAnyEntityById($storage, '\\missing'));
    }

    // ── Priority: class > interface > enum > function ────────────────────────

    public function testFindAnyEntityByIdPrefersClassOverOtherTypes(): void
    {
        // Same ID across all collections — class should win
        $class = $this->makeClass('\\Shared');
        $iface = $this->makeInterface('\\Shared');
        $enum = $this->makeEnum('\\Shared');
        $fn = $this->makeFunction('\\Shared');

        $storage = $this->createMockStorage(
            classes: [$class],
            interfaces: [$iface],
            enums: [$enum],
            functions: [$fn]
        );

        $result = $this->service->findAnyEntityById($storage, '\\Shared');

        $this->assertNotNull($result);
        $this->assertSame($class, $result[0]);
        $this->assertSame(EntityType::CLASS_TYPE, $result[1]);
    }

    // ── Shared index cache ───────────────────────────────────────────────────

    /**
     * The index is cached per storage object and shared across service instances, because
     * ValidatorTestBase builds a fresh check (and service) per data-provider row. Without
     * sharing, every lookup rescanned the whole storage.
     */
    public function testIndexIsSharedAcrossServiceInstancesForTheSameStorage(): void
    {
        $class = $this->makeClass('\\DateTime');
        $storage = $this->createMockStorage(classes: [$class]);

        $first = (new EntityLookupService())->findClassById($storage, '\\DateTime');
        $second = (new EntityLookupService())->findClassById($storage, '\\DateTime');

        $this->assertSame($class, $first);
        $this->assertSame($first, $second, 'A separate instance must resolve to the same entity.');
    }

    /**
     * The correctness property that matters most: sharing must be keyed on the storage, so
     * two storages never see each other's entities. A cache keyed on spl_object_id() could
     * violate this once an id is reused after an object is freed.
     */
    public function testIndexesOfDistinctStoragesDoNotLeakIntoEachOther(): void
    {
        $alpha = $this->makeClass('\\Alpha');
        $beta = $this->makeClass('\\Beta');
        $storageA = $this->createMockStorage(classes: [$alpha]);
        $storageB = $this->createMockStorage(classes: [$beta]);

        $service = new EntityLookupService();

        $this->assertSame($alpha, $service->findClassById($storageA, '\\Alpha'));
        $this->assertSame($beta, $service->findClassById($storageB, '\\Beta'));
        $this->assertNull($service->findClassById($storageA, '\\Beta'), 'Storage A must not see B\'s entities.');
        $this->assertNull($service->findClassById($storageB, '\\Alpha'), 'Storage B must not see A\'s entities.');
    }

    /**
     * Each entity kind is indexed independently, so indexing classes must not mask a
     * later interface lookup on the same storage.
     */
    public function testKindsAreIndexedIndependently(): void
    {
        $class = $this->makeClass('\\Shared');
        $iface = $this->makeInterface('\\OnlyInterface');
        $storage = $this->createMockStorage(classes: [$class], interfaces: [$iface]);

        $service = new EntityLookupService();
        $service->findClassById($storage, '\\Shared');

        $this->assertSame($iface, $service->findInterfaceById($storage, '\\OnlyInterface'));
        $this->assertNull($service->findClassById($storage, '\\OnlyInterface'));
    }

    /**
     * The storage is only scanned once per kind: the mock is configured to allow a single
     * getClasses() call, so a second lookup that rescanned would fail the expectation.
     */
    public function testStorageIsScannedOnlyOncePerKind(): void
    {
        $class = $this->makeClass('\\DateTime');
        $storage = $this->createMock(StubDataQueryInterface::class);
        $storage->expects($this->once())->method('getClasses')->willReturn([$class]);

        (new EntityLookupService())->findClassById($storage, '\\DateTime');
        (new EntityLookupService())->findClassById($storage, '\\DateTime');
        (new EntityLookupService())->findClassById($storage, '\\Missing');
    }

    public function testClearIndexCacheForcesAReindex(): void
    {
        $class = $this->makeClass('\\DateTime');
        $storage = $this->createMock(StubDataQueryInterface::class);
        $storage->expects($this->exactly(2))->method('getClasses')->willReturn([$class]);

        $service = new EntityLookupService();
        $service->findClassById($storage, '\\DateTime');
        EntityLookupService::clearIndexCache();
        $this->assertSame($class, $service->findClassById($storage, '\\DateTime'));
    }
}
