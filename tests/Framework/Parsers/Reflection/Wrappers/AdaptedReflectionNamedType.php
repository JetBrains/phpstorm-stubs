<?php

namespace StubTests\Framework\Parsers\Reflection\Wrappers;

/**
 * Adapter wrapper for a named type (simple helper)
 *
 * PHP 5.6+ compatible
 */
class AdaptedReflectionNamedType
{
    private $name;

    public function __construct($typeName)
    {
        $this->name = $typeName;
    }

    public function getName()
    {
        return $this->name;
    }
}
