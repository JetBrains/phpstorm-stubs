<?php

namespace StubTests\Framework\Parsers\Reflection;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;

use StubTests\Framework\Parsers\Model\PHPProperty;
use StubTests\Framework\Parsers\Reflection\ReflectionTypeParser;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionProperty;
use StubTests\Framework\Parsers\Parser;

/**
 * @template-implements Parser<AdaptedReflectionProperty>
 */
class ReflectionPropertyParser implements Parser
{

    private ReflectionTypeParser $typeParser;

    public function __construct(?ReflectionTypeParser $typeParser = null)
    {
        $this->typeParser = $typeParser ?? new ReflectionTypeParser();
    }

    public function canParse($object): bool
    {
        return false;
    }

    /**
     * Parse an AdaptedReflectionProperty into a PHPProperty model
     *
     * @param AdaptedReflectionProperty $object
     * @return PHPProperty
     */
    public function parse($object): PHPProperty
    {
        $property = new PHPProperty();
        $property->setName($object->getName());
        $property->setIsStatic($object->isStatic());
        $property->setIsReadonly($object->isReadonly());
        if ($object->isProtected()) {
            $property->setAccess(AccessModifier::PROTECTED);
        } elseif ($object->isPrivate()) {
            $property->setAccess(AccessModifier::PRIVATE);
        } else {
            $property->setAccess(AccessModifier::PUBLIC);
        }
        $property->setTypeFromSignature($this->typeParser->parse($object->getType() ?? null));

        // Parse default value if available
        if (method_exists($object, 'hasDefaultValue') && $object->hasDefaultValue()) {
            $property->setDefaultValue($object->getDefaultValue());
        }

        return $property;
    }
}