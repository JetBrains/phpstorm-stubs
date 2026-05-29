<?php

namespace StubTests\Framework\Validator\Contracts;

/**
 * Type-safe enum for entity lookup dispatch in EntityTypeConfig.
 *
 * Replaces magic strings ('class', 'enum', 'interface') with compile-time
 * validated values, preventing silent bugs from typos.
 */
enum LookupKind: string
{
    case CLASS_TYPE = 'class';
    case ENUM_TYPE = 'enum';
    case INTERFACE_TYPE = 'interface';
}
