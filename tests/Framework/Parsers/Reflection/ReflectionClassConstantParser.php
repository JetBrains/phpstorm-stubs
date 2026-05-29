<?php

namespace StubTests\Framework\Parsers\Reflection;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;
use StubTests\Framework\Parsers\Model\PHPClassConstant;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClassConstant;
use StubTests\Framework\Parsers\Parser;

/**
 * @template-implements Parser<AdaptedReflectionClassConstant|array>
 */
class ReflectionClassConstantParser implements Parser
{

    public function canParse($object): bool
    {
        return false;
    }

    /**
     * Parse a ReflectionClassConstant (adapted or array) into a PHPClassConstant model
     *
     * Accepts both AdaptedReflectionClassConstant objects and arrays for backward compatibility.
     *
     * @param \StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionClassConstant|array $object
     * @return PHPClassConstant
     */
    public function parse($object): PHPClassConstant
    {
        // Accept both AdaptedReflectionClassConstant and array (duck typing)
        if (is_object($object) && method_exists($object, 'getName') && method_exists($object, 'getValue')) {
            $constant = new PHPClassConstant();
            if (!empty($object->getName())) {
                $constant->setName($object->getName());
            }
            $constant->setValue($object->getValue());
            if ($object->getDeclaringClass()->getName()) {
                $constant->setParentId('\\' . $object->getDeclaringClass()->getName());
            }
            if ($object->isPrivate()) {
                $constant->setAccess(AccessModifier::PRIVATE);
            } elseif ($object->isProtected()) {
                $constant->setAccess(AccessModifier::PROTECTED);
            } else {
                $constant->setAccess(AccessModifier::PUBLIC);
            }
        } else {
            if (!is_array($object) || empty($object)) {
                throw new \InvalidArgumentException('ReflectionClassConstantParser::parse() expects a non-empty array or an adapted reflection object');
            }
            $constantName = array_key_first($object);
            $constant = new PHPClassConstant();
            $constant->setName((string) $constantName);
            $constant->setValue($object[$constantName]);
        }
        return $constant;
    }
}