<?php

namespace StubTests\Framework\Parsers\Reflection;

use StubTests\Framework\Parsers\Model\PHPFunction;
use StubTests\Framework\Parsers\Reflection\ReflectionParameterParser;
use StubTests\Framework\Parsers\Reflection\ReflectionTypeParser;
use StubTests\Framework\Parsers\Reflection\Wrappers\AdaptedReflectionFunction;
use StubTests\Framework\Parsers\Parser;

/**
 * @template-implements Parser<AdaptedReflectionFunction>
 */
class ReflectionFunctionParser implements Parser {

    private ReflectionParameterParser $parameterParser;
    private ReflectionTypeParser $typeParser;

    public function __construct(?ReflectionParameterParser $parameterParser = null, ?ReflectionTypeParser $typeParser = null)
    {
        $this->parameterParser = $parameterParser ?? new ReflectionParameterParser();
        $this->typeParser = $typeParser ?? new ReflectionTypeParser();
    }

    public function canParse($object): bool
    {
        return $object instanceof AdaptedReflectionFunction;
    }

    /**
     * Parse an AdaptedReflectionFunction into a PHPFunction model
     *
     * @param AdaptedReflectionFunction $object
     * @return PHPFunction
     */
    public function parse($object): PHPFunction
    {
        $PHPFunction = new PHPFunction();
        $PHPFunction->setName(!empty($object->getShortName()) ? $object->getShortName() : null);
        $PHPFunction->setNamespace($object->getNamespaceName() ? '\\' . $object->getNamespaceName() : '\\');
        if (!$PHPFunction->getName()){
            $PHPFunction->setId(null);
        } elseif ($PHPFunction->getNamespace() === '\\') {
            $PHPFunction->setId('\\' . $PHPFunction->getName());
        } else {
            $PHPFunction->setId($PHPFunction->getNamespace() . '\\' . $PHPFunction->getName());
        }
        $PHPFunction->setHasTentativeReturnType($object->hasTentativeReturnType());
        $returnType = null;
        if ($object->hasTentativeReturnType()) {
            $returnType = $object->getTentativeReturnType();
        } elseif($object->hasReturnType()) {
            $returnType = $object->getReturnType();
        }
        $returnTypesFromSignature = $this->typeParser->parse($returnType);
        $PHPFunction->setReturnTypeFromSignature($returnTypesFromSignature);
        $PHPFunction->setDeprecated($object->isDeprecated());

        // Parse parameters using ReflectionParameterParser
        $parameters = [];
        foreach ($object->getParameters() as $parameter) {
            $parameters[] = $this->parameterParser->parse($parameter);
        }
        $PHPFunction->setParameters($parameters);

        return $PHPFunction;
    }
}