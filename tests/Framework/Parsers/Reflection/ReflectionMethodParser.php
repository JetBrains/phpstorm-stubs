<?php

namespace StubTests\Framework\Parsers\Reflection;

use StubTests\Framework\Parsers\Model\Access\AccessModifier;

use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Reflection\ReflectionParameterParser;
use StubTests\Framework\Parsers\Reflection\ReflectionTypeParser;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionMethod;
use StubTests\Framework\Parsers\Parser;

/**
 * @template-implements Parser<AdaptedReflectionMethod>
 */
class ReflectionMethodParser implements Parser
{
    private ReflectionParameterParser $parameterParser;
    private ReflectionTypeParser $typeParser;

    public function __construct(?ReflectionParameterParser $parameterParser = null, ?ReflectionTypeParser $typeParser = null)
    {
        $this->parameterParser = $parameterParser ?? new ReflectionParameterParser();
        $this->typeParser = $typeParser ?? new ReflectionTypeParser();
    }

    public function canParse($object): bool
    {
        return false;
    }

    /**
     * Parse an AdaptedReflectionMethod into a PHPMethod model
     *
     * @param AdaptedReflectionMethod $object
     * @return PHPMethod
     */
    public function parse($object): PHPMethod
    {
        $method = new PHPMethod();
        $method->setName($object->getName());
        $method->setId('\\' . $object->getDeclaringClass()->getName() . '::' . $object->getName());
        if ($object->isProtected()) {
            $method->setAccess(AccessModifier::PROTECTED);
        } elseif ($object->isPrivate()) {
            $method->setAccess(AccessModifier::PRIVATE);
        } else {
            $method->setAccess(AccessModifier::PUBLIC);
        }
        $method->setIsStatic($object->isStatic());
        $method->setIsFinal($object->isFinal());
        $method->setIsAbstract($object->isAbstract());
        $method->setDeprecated($object->isDeprecated());
        $method->setHasTentativeReturnType($object->hasTentativeReturnType());
        $returnType = null;
        if ($object->hasTentativeReturnType()) {
            $returnType = $object->getTentativeReturnType();
        } elseif($object->hasReturnType()) {
            $returnType = $object->getReturnType();
        }
        $returnTypesFromSignature = $this->typeParser->parse($returnType);
        $method->setReturnTypeFromSignature($returnTypesFromSignature);

        // Parse parameters
        $parameters = [];
        foreach ($object->getParameters() as $parameter) {
            $parameters[] = $this->parameterParser->parse($parameter);
        }
        $method->setParameters($parameters);

        return $method;
    }
}