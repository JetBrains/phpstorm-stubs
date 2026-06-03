<?php

namespace StubTests\Framework\Validator;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPClassLikeObject;
use StubTests\Framework\Parsers\Model\PHPEnum;
use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Parsers\StubDataQueryInterface;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\Contracts\LookupKind;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\Services\EntityLookupService;
use StubTests\Framework\Validator\Services\MethodCollectionService;

/**
 * Thin coordinator that delegates to EntityLookupService and MethodCollectionService.
 *
 * Supports EntityTypeConfig for config-driven entity-type dispatch, eliminating
 * the need for boilerplate Enum/Interface subclasses in most checks.
 */
abstract class AbstractClassCheck extends AbstractReflectionCheck
{
    protected EntityLookupService $entityLookup;
    protected MethodCollectionService $methodCollection;
    protected ?EntityTypeConfig $entityTypeConfig;

    public function __construct(
        ?ReflectionProviderInterface $reflectionProvider = null,
        ?KnownProblemsRegistry $knownProblemsRegistry = null,
        ?EntityLookupService $entityLookup = null,
        ?MethodCollectionService $methodCollection = null,
        ?EntityTypeConfig $entityTypeConfig = null
    ) {
        parent::__construct($reflectionProvider, $knownProblemsRegistry);
        $this->entityLookup = $entityLookup ?? new EntityLookupService();
        $this->methodCollection = $methodCollection ?? new MethodCollectionService();
        $this->entityTypeConfig = $entityTypeConfig;
    }

    // ── Config-driven dispatch methods ────────────────────────────────────────

    /**
     * Look up an entity by ID, dispatching to the right lookup method based on config.
     * Defaults to class lookup when no config is set.
     */
    protected function lookupEntityById(StubDataQueryInterface $storage, string $entityId): ?PHPClassLikeObject
    {
        return match ($this->entityTypeConfig?->lookupKind ?? LookupKind::CLASS_TYPE) {
            LookupKind::ENUM_TYPE => $this->findEnumById($storage, $entityId),
            LookupKind::INTERFACE_TYPE => $this->findInterfaceById($storage, $entityId),
            LookupKind::CLASS_TYPE => $this->findClassById($storage, $entityId),
        };
    }

    /**
     * Collect version-filtered methods, dispatching based on config.
     * Defaults to class hierarchy traversal when no config is set.
     *
     * @return array<string, PHPMethod>
     */
    protected function collectEntityMethodsByConfig(PHPClassLikeObject $entity, string $phpVersion): array
    {
        return match ($this->entityTypeConfig?->lookupKind ?? LookupKind::CLASS_TYPE) {
            LookupKind::ENUM_TYPE => $this->methodCollection->collectForEnum($entity, $phpVersion),
            LookupKind::INTERFACE_TYPE => $this->methodCollection->collectForInterface($entity, $phpVersion),
            LookupKind::CLASS_TYPE => $this->methodCollection->collectForClass($entity, $phpVersion),
        };
    }

    /**
     * Collect version-filtered properties, dispatching based on config.
     * Only classes have properties; returns empty array for enum/interface.
     *
     * @return array<string, PHPProperty>
     */
    protected function collectEntityPropertiesByConfig(PHPClassLikeObject $entity, string $phpVersion): array
    {
        if (($this->entityTypeConfig === null || $this->entityTypeConfig->lookupKind === LookupKind::CLASS_TYPE)
            && $entity instanceof PHPClass
        ) {
            return $this->methodCollection->collectPropertiesForClass($entity, $phpVersion);
        }
        return [];
    }

    // ── Entity-type accessors ──────────────────────────────────────────────

    protected function getEntityLabel(): string
    {
        return $this->entityTypeConfig?->label ?? 'Class';
    }

    protected function getEntityType(): string
    {
        return $this->entityTypeConfig?->entityType->value ?? EntityType::CLASS_TYPE->value;
    }

    protected function getConstantEntityType(): string
    {
        return $this->entityTypeConfig?->constantEntityType->value ?? EntityType::CLASS_CONSTANT->value;
    }

    // ── Direct lookup methods ────────────────────────────────────────────────

    protected function findClassById(StubDataQueryInterface $storage, string $entityId): ?PHPClass
    {
        return $this->entityLookup->findClassById($storage, $entityId);
    }

    protected function findEnumById(StubDataQueryInterface $storage, string $entityId): ?PHPEnum
    {
        return $this->entityLookup->findEnumById($storage, $entityId);
    }

    protected function findInterfaceById(StubDataQueryInterface $storage, string $entityId): ?PHPInterface
    {
        return $this->entityLookup->findInterfaceById($storage, $entityId);
    }
}
