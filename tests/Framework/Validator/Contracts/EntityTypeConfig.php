<?php

namespace StubTests\Framework\Validator\Contracts;

use StubTests\Framework\Validator\Contracts\LookupKind;
use StubTests\Framework\Validator\KnownProblems\EntityType;

/**
 * Configuration for entity-type-specific behavior in check classes.
 *
 * Instead of creating Enum/Interface subclasses that only override template methods,
 * a base check can accept this config to operate on any entity type.
 */
final class EntityTypeConfig
{
    /**
     * @param LookupKind  $lookupKind          Which entity type to look up
     * @param EntityType  $entityType          EntityType for known-problem lookups
     * @param string      $label               Human-readable label for error messages ('Class', 'Enum', 'Interface')
     * @param EntityType|null $constantEntityType   EntityType for per-constant known-problem lookups
     */
    public function __construct(
        public readonly LookupKind $lookupKind,
        public readonly EntityType $entityType,
        public readonly string $label,
        public readonly ?EntityType $constantEntityType = null,
    ) {}

    public static function forClass(): self
    {
        return new self(
            lookupKind: LookupKind::CLASS_TYPE,
            entityType: EntityType::CLASS_TYPE,
            label: 'Class',
            constantEntityType: EntityType::CLASS_CONSTANT,
        );
    }

    public static function forEnum(): self
    {
        return new self(
            lookupKind: LookupKind::ENUM_TYPE,
            entityType: EntityType::ENUM_TYPE,
            label: 'Enum',
            constantEntityType: EntityType::ENUM_CONSTANT,
        );
    }

    public static function forInterface(): self
    {
        return new self(
            lookupKind: LookupKind::INTERFACE_TYPE,
            entityType: EntityType::INTERFACE_TYPE,
            label: 'Interface',
            constantEntityType: EntityType::INTERFACE_CONSTANT,
        );
    }
}
