<?php

namespace StubTests\Framework\Validator\Services;

use StubTests\Framework\Parsers\Model\BasePHPElement;
use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPEnum;
use StubTests\Framework\Parsers\Model\PHPConstant;
use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\KnownProblems\EntityType;

/**
 * Service for looking up entities by ID with lazy indexing and caching.
 *
 * Extracted from AbstractClassCheck to enable reuse without inheritance.
 */
class EntityLookupService
{
    /** @var array<string, array<int, array<string, mixed>>> Entity index cache, keyed by kind => storageId => entityId */
    private array $entityIndex = [];

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
        $storageId = spl_object_id($storage);
        if (!isset($this->entityIndex[$kind][$storageId])) {
            $this->entityIndex[$kind][$storageId] = [];
            foreach ($getter() as $entity) {
                $id = $entity->getId();
                if ($id !== null) {
                    $this->entityIndex[$kind][$storageId][$id] = $entity;
                }
            }
        }
        return $this->entityIndex[$kind][$storageId][$entityId] ?? null;
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
