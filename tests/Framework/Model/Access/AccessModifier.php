<?php

namespace StubTests\Framework\Model\Access;

/**
 * Access modifier for class methods, properties, and constants.
 *
 * Backed string enum replacing the previous interface + 3 concrete classes
 * (PublicAccessModifier, ProtectedAccessModifier, PrivateAccessModifier).
 */
enum AccessModifier: string
{
    case PUBLIC = 'public';
    case PROTECTED = 'protected';
    case PRIVATE = 'private';
}
