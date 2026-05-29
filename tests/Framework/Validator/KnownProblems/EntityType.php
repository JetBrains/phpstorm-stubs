<?php

namespace StubTests\Framework\Validator\KnownProblems;

/**
 * Enumeration of entity types in PHP stubs.
 *
 * Represents the different kinds of PHP entities that can be validated
 * and have known problems.
 */
enum EntityType: string
{
    /**
     * Global functions (e.g., \dba_fetch, \strtr)
     */
    case FUNCTION = 'functions';

    /**
     * Class or interface methods (e.g., DateTime::format)
     */
    case METHOD = 'methods';

    /**
     * Classes
     */
    case CLASS_TYPE = 'classes';

    /**
     * Interfaces
     */
    case INTERFACE_TYPE = 'interfaces';

    /**
     * Enums
     */
    case ENUM_TYPE = 'enums';

    /**
     * Class properties (e.g., DateTime::$timezone)
     */
    case PROPERTY = 'properties';

    /**
     * Class constants (e.g., DateTime::ATOM)
     */
    case CLASS_CONSTANT = 'class_constants';

    /**
     * Interface constants (e.g., Countable::COUNT)
     */
    case INTERFACE_CONSTANT = 'interface_constants';

    /**
     * Enum constants (e.g., Status::ACTIVE)
     */
    case ENUM_CONSTANT = 'enum_constants';

    /**
     * Global constants (e.g., \PHP_INT_MAX, \STDIN)
     */
    case GLOBAL_CONSTANT = 'global_constants';

    /**
     * Get entity type from entity ID format.
     *
     * @param string $entityId Entity ID like "\dba_fetch" or "DateTime::format"
     * @return self The detected entity type
     */
    public static function fromEntityId(string $entityId): self
    {
        if (str_contains($entityId, '::')) {
            return self::METHOD;
        }

        // For now, assume all others are functions
        // Could be extended to detect classes/interfaces by naming conventions
        return self::FUNCTION;
    }
}
