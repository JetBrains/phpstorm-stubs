<?php

namespace StubTests\Framework\Parsers\Reflection;

use StubTests\Framework\Model\Access\AccessModifier;
use StubTests\Framework\Model\PHPClassConstant;
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
            // Final class constants are PHP 8.1+. Nothing in core declares one today, so this
            // reads as false everywhere — but the wrapper has always exposed isFinal() and
            // dropping it meant a final internal constant would silently cache as non-final.
            $constant->setIsFinal((bool)$object->isFinal());
        } else {
            if (!is_array($object) || empty($object)) {
                throw new \InvalidArgumentException('ReflectionClassConstantParser::parse() expects a non-empty array or an adapted reflection object');
            }
            // name => value only, from ReflectionClass::getConstants(). Reached when the raw
            // data has no getReflectionConstants entry, i.e. runtimes before PHP 7.1 (verified:
            // Reflection5.6.json and Reflection7.0.json carry no such key, 7.1+ do).
            //
            // The PUBLIC / non-final defaults are therefore correct by construction rather than
            // lossy: class-constant visibility arrived in PHP 7.1 and final constants in 8.1 —
            // the same 7.1 that added getReflectionConstants() — so no constant visible to this
            // branch can be anything but public and non-final.
            //
            // parentId stays null here, unlike the object branch. Left as-is deliberately: it
            // has no consumer for these versions, and changing it would rewrite the 5.6/7.0
            // reflection caches for no behavioural gain.
            $constantName = array_key_first($object);
            $constant = new PHPClassConstant();
            $constant->setName((string)$constantName);
            $constant->setValue($object[$constantName]);
        }
        return $constant;
    }
}
