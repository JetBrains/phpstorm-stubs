<?php

namespace StubTests\Framework\Validator\Services;

use StubTests\Framework\Model\BasePHPElement;
use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPEnum;
use StubTests\Framework\Model\PHPConstant;
use StubTests\Framework\Model\PHPFunction;
use StubTests\Framework\Model\PHPInterface;
use StubTests\Framework\Storage\StubDataQueryInterface;
use StubTests\Framework\Validator\KnownProblems\EntityType;

/**
 * Service for looking up entities by ID with lazy indexing and caching.
 *
 * Extracted from AbstractClassCheck to enable reuse without inheritance.
 *
 * The index is cached per *storage object*, shared across every instance of this service.
 * That matters because ValidatorTestBase constructs a fresh check — and therefore a fresh
 * service — for every data-provider row, so an instance-level index was rebuilt and thrown
 * away once per test case: a full linear scan of the storage (thousands of entities) per
 * lookup. Sharing is safe because the index is a pure function of the storage contents.
 *
 * A WeakMap keyed on the storage object is used rather than spl_object_id(): object ids are
 * reused once an object is freed, so an id-keyed cache could hand back the index of an
 * unrelated storage that happened to reuse the id. WeakMap entries also disappear with the
 * storage, so nothing is retained after a test's mock storage goes out of scope.
 *
 * Caveat: the index snapshots the storage the first time a kind is queried. Storages are
 * read-only during validation, so this holds; a caller that mutates a storage after a
 * lookup must call clearIndexCache().
 */
class EntityLookupService
{
    /**
     * Index cache shared across instances.
     *
     * @var \WeakMap<StubDataQueryInterface, array<string, array<string, mixed>>>|null
     *      storage => kind => entityId => entity
     */
    private static ?\WeakMap $indexCache = null;

    /**
     * Discards every cached index. Only needed when a storage is mutated after being
     * queried, or to guarantee isolation between tests that reuse a storage instance.
     */
    public static function clearIndexCache(): void
    {
        self::$indexCache = null;
    }

    /**
     * Find an entity by ID in a lazily-built index keyed by getId().
     *
     * @param string                  $kind      Cache partition key (e.g. 'class', 'enum', 'interface')
     * @param StubDataQueryInterface $storage  Storage to look up
     * @param string                  $entityId  The ID to find
     * @param callable(): iterable    $getter    Returns the entity collection from storage
     */
    private function findInIndex(string $kind, StubDataQueryInterface $storage, string $entityId, callable $getter): mixed
    {
        self::$indexCache ??= new \WeakMap();

        $indexes = self::$indexCache[$storage] ?? [];
        if (!isset($indexes[$kind])) {
            $index = [];
            foreach ($getter() as $entity) {
                $id = $entity->getId();
                if ($id !== null) {
                    $index[$id] = $entity;
                }
            }
            // WeakMap returns array values by copy, so the whole entry is written back.
            $indexes[$kind] = $index;
            self::$indexCache[$storage] = $indexes;
        }

        return $indexes[$kind][$entityId] ?? null;
    }

    public function findClassById(StubDataQueryInterface $storage, string $entityId): ?PHPClass
    {
        return $this->findInIndex('class', $storage, $entityId, $storage->getClasses(...));
    }

    public function findEnumById(StubDataQueryInterface $storage, string $entityId): ?PHPEnum
    {
        return $this->findInIndex('enum', $storage, $entityId, $storage->getEnums(...));
    }

    public function findInterfaceById(StubDataQueryInterface $storage, string $entityId): ?PHPInterface
    {
        return $this->findInIndex('interface', $storage, $entityId, $storage->getInterfaces(...));
    }

    public function findFunctionById(StubDataQueryInterface $storage, string $entityId): ?PHPFunction
    {
        return $this->findInIndex('function', $storage, $entityId, $storage->getFunctions(...));
    }

    public function findConstantById(StubDataQueryInterface $storage, string $entityId): ?PHPConstant
    {
        return $this->findInIndex('constant', $storage, $entityId, $storage->getConstants(...));
    }

    /**
     * Find an entity by ID across all entity collections (class, interface, enum, function).
     *
     * @return array{0: BasePHPElement, 1: EntityType}|null Pair [entity, entityType], or null if not found
     */
    public function findAnyEntityById(StubDataQueryInterface $storage, string $entityId): ?array
    {
        $class = $this->findClassById($storage, $entityId);
        if ($class !== null) {
            return [$class, EntityType::CLASS_TYPE];
        }

        $interface = $this->findInterfaceById($storage, $entityId);
        if ($interface !== null) {
            return [$interface, EntityType::INTERFACE_TYPE];
        }

        $enum = $this->findEnumById($storage, $entityId);
        if ($enum !== null) {
            return [$enum, EntityType::ENUM_TYPE];
        }

        $function = $this->findFunctionById($storage, $entityId);
        if ($function !== null) {
            return [$function, EntityType::FUNCTION];
        }

        return null;
    }
}
