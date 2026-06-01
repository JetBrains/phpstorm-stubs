<?php

namespace StubTests\Framework\Parsers\Reflection;

use ReflectionConstant;
use StubTests\Framework\Parsers\Model\PHPConstant;
use StubTests\Framework\Parsers\Parser;

/**
 * @template-implements Parser<ReflectionConstant>
 */
class ReflectionModernConstantParser implements Parser
{
    public function canParse($object): bool
    {
        return $object instanceof \ReflectionConstant || is_array($object);
    }

    public function parse($object): PHPConstant
    {
        $namespace = '\\';
        $parsedConstant = new PHPConstant();

        // Handle both ReflectionConstant objects and arrays (duck typing)
        if (is_object($object) && method_exists($object, 'getShortName')) {
            $parsedConstant->setName($object->getShortName());
            $parsedConstant->setValue($object->getValue());
            if ($object->getNamespaceName()) {
                $namespace .= $object->getNamespaceName() . '\\';
            }
        } elseif (is_array($object)) {
            // Fallback: handle indexed array format [name, value]
            $parsedConstant->setName($object[0]);
            $parsedConstant->setValue(is_resource($object[1]) ? 'PHPSTORM_RESOURCE' : $object[1]);
        }

        $parsedConstant->setNamespace($namespace);
        $parsedConstant->setId($namespace . $parsedConstant->getName());
        return $parsedConstant;
    }
}
