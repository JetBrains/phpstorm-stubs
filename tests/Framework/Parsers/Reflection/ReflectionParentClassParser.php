<?php

namespace StubTests\Framework\Parsers\Reflection;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClassReference;
use StubTests\Framework\Parsers\Parser;

/**
 * @template-implements Parser<AdaptedReflectionClassReference>
 */
class ReflectionParentClassParser implements Parser
{
    public function canParse($object): bool
    {
        return false;
    }

    /**
     * Parse an AdaptedReflectionClassReference (parent class reference) into a PHPClass model
     *
     * @param AdaptedReflectionClassReference $object
     * @return PHPClass
     */
    public function parse($object): PHPClass
    {
        $class = new PHPClass();
        $class->setName($object->getName());
        return $class;
    }
}
