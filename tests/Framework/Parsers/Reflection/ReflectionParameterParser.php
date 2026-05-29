<?php

namespace StubTests\Framework\Parsers\Reflection;

use StubTests\Framework\Parsers\Model\PHPParameter;
use StubTests\Framework\Parsers\Reflection\ReflectionTypeParser;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionParameter;
use StubTests\Framework\Parsers\Parser;

/**
 * @template-implements Parser<AdaptedReflectionParameter>
 */
class ReflectionParameterParser implements Parser
{
    private ReflectionTypeParser $typeParser;

    public function __construct(?ReflectionTypeParser $typeParser = null)
    {
        $this->typeParser = $typeParser ?? new ReflectionTypeParser();
    }

    public function canParse($object): bool
    {
        return $object instanceof AdaptedReflectionParameter;
    }

    /**
     * Parse an AdaptedReflectionParameter into a PHPParameter model
     *
     * @param AdaptedReflectionParameter $object
     * @return PHPParameter
     */
    public function parse($object): PHPParameter
    {
        $parameter = new PHPParameter($object->getName());

        // Set position
        $parameter->setPosition($object->getPosition());

        // Set optional
        $parameter->setIsOptional($object->isOptional());

        // Set variadic
        $parameter->setIsVariadic($object->isVariadic());

        // Set passed by reference
        $parameter->setIsPassedByReference($object->isPassedByReference());

        // Parse type information using ReflectionTypeParser
        $type = $this->typeParser->parse($object->hasType() ? $object->getType() : null);
        $parameter->setType($type);

        // Parse default value
        if ($object->isDefaultValueAvailable()) {
            $parameter->setHasDefaultValue(true);
            try {
                $parameter->setDefaultValue($object->getDefaultValue());
            } catch (\ReflectionException $e) {
                // If we can't get the default value, leave it as null
                $parameter->setDefaultValue(null);
            }
        } else {
            $parameter->setHasDefaultValue(false);
        }

        // Detect deprecation via method_exists guard (future PHP) or attributes check
        $deprecated = method_exists($object, 'isDeprecated') && (bool) $object->isDeprecated();
        if (!$deprecated && method_exists($object, 'getAttributes')) {
            foreach ($object->getAttributes() as $attr) {
                $attrName = is_array($attr) ? ($attr['name'] ?? '') : (method_exists($attr, 'getName') ? $attr->getName() : '');
                if ($attrName === 'Deprecated' || $attrName === '\\Deprecated') {
                    $deprecated = true;
                    break;
                }
            }
        }
        $parameter->setDeprecated($deprecated);

        return $parameter;
    }
}
