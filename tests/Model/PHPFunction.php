<?php

namespace StubTests\Model;

use Exception;
use JetBrains\PhpStorm\Internal\TentativeType;
use phpDocumentor\Reflection\DocBlock\Tags\Param;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use phpDocumentor\Reflection\PseudoTypes\List_;
use phpDocumentor\Reflection\Type;
use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Types\Collection;
use phpDocumentor\Reflection\Types\Compound;
use PhpParser\Comment\Doc;
use PhpParser\Node\FunctionLike;
use PhpParser\Node\Stmt\Function_;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use RuntimeException;
use stdClass;
use StubTests\Parsers\DocFactoryProvider;
use StubTests\Parsers\ParserUtils;

class PHPFunction extends PHPNamespacedElement
{
    /**
     * @var PHPParameter[]
     */
    public $parameters = [];

    /** @var string[] */
    public $returnTypesFromPhpDoc = [];

    /** @var string[][] */
    public $returnTypesFromAttribute = [];

    /** @var string[] */
    public $returnTypesFromSignature = [];
    public $hasTentativeReturnType = false;

    /**
     * @param ReflectionFunction|ReflectionFunctionAbstract $reflectionObject
     * @return static
     */
    public function readObjectFromReflection($reflectionObject)
    {
        $NamespaceParts = explode("\\", $reflectionObject->getName());
        $this->id = "\\" . implode("\\", $NamespaceParts);
        $this->name = array_pop($NamespaceParts);
        $this->isDeprecated = $reflectionObject->isDeprecated();
        $this->namespace = $reflectionObject->getNamespaceName();
        foreach ($reflectionObject->getParameters() as $parameter) {
            $this->parameters[] = (new PHPParameter())->readObjectFromReflection($parameter);
        }
        if (method_exists($reflectionObject, 'getReturnType')) {
            $returnTypes = self::getReflectionTypeAsArray($reflectionObject->getReturnType());
        }
        if (!empty($returnTypes)) {
            array_push($this->returnTypesFromSignature, ...$returnTypes);
        }
        return $this;
    }

    /**
     * @param Function_ $node
     * @return static
     * @throws RuntimeException
     */
    public function readObjectFromStubNode($node)
    {
        $NamespaceParts = explode("\\", $node->namespacedName);
        $this->id = "\\" . implode("\\", $NamespaceParts);
        $this->name = array_pop($NamespaceParts);
        $this->namespace = trim(implode("\\", $NamespaceParts), '\\');
        $typesFromAttribute = self::findTypesFromAttribute($node->attrGroups);
        $this->availableVersionsRangeFromAttribute = self::findAvailableVersionsRangeFromAttribute($node->attrGroups);
        $this->returnTypesFromAttribute = $typesFromAttribute;
        array_push($this->returnTypesFromSignature, ...self::convertParsedTypeToArray($node->getReturnType()));
        $index = 0;
        foreach ($node->getParams() as $parameter) {
            $parsedParameter = (new PHPParameter())->readObjectFromStubNode($parameter);
            if (ParserUtils::entitySuitsCurrentPhpVersion($parsedParameter)) {
                $parsedParameter->indexInSignature = $index;
                $addedParameters = array_filter($this->parameters, function (PHPParameter $addedParameter) use ($parsedParameter) {
                    return $addedParameter->name === $parsedParameter->name;
                });
                if (!empty($addedParameters)) {
                    if ($parsedParameter->is_vararg) {
                        $parsedParameter->isOptional = false;
                        $index--;
                        $parsedParameter->indexInSignature = $index;
                    }
                }
                $this->parameters[$parsedParameter->name] = $parsedParameter;
                $index++;
            }
        }

        $this->collectTags($node);
        foreach ($this->parameters as $parameter) {
            $relatedParamTags = array_filter($this->paramTags, function (Param $tag) use ($parameter) {
                return $tag->getVariableName() === $parameter->name;
            });
            /** @var Param $relatedParamTag */
            $relatedParamTag = array_pop($relatedParamTags);
            if ($relatedParamTag !== null) {
                $parameter->isOptional = $parameter->isOptional || str_contains((string)$relatedParamTag->getDescription(), '[optional]');
                $parameter->markedOptionalInPhpDoc = str_contains((string)$relatedParamTag->getDescription(), '[optional]');
            }
        }

        $this->checkIfReturnTypeIsTentative($node);
        $this->checkDeprecationTag($node);
        $this->checkReturnTag();
        $this->stubObjectHash = spl_object_hash($this);
        return $this;
    }

    protected function checkIfReturnTypeIsTentative(FunctionLike $node) {
        $this->hasTentativeReturnType = self::hasTentativeReturnTypeAttribute($node);
    }

    protected function checkReturnTag()
    {
        if (!empty($this->returnTags) && $this->returnTags[0] instanceof Return_) {
            $type = $this->returnTags[0]->getType();
            $this->returnTypesFromPhpDoc = self::handleType($type);
        }
    }

    /**
     * @param Type|null $type
     * @return string[]
     */
    protected static function handleType($type) {
        if ($type instanceof Collection) {
            return [$type->getFqsen()->getName()];
        } elseif ($type instanceof Array_ && $type->getValueType() instanceof Collection) {
            return ["array"];
        } elseif ($type instanceof List_) {
            return ["array"];
        } else {
            if ($type instanceof Compound) {
                $types = [];
                foreach ($type as $nextType) {
                    $types[] = self::handleType($nextType);
                }
                return CommonUtils::flattenArray($types, false);
            } else {
                return [(string)$type];
            }
        }
    }

    /**
     * @param stdClass|array $jsonData
     * @throws Exception
     */
    public function readMutedProblems($jsonData)
    {
        foreach ($jsonData as $function) {
            if ($function->name === $this->name) {
                if (!empty($function->problems)) {
                    foreach ($function->problems as $problem) {
                        switch ($problem->description) {
                            case 'parameter mismatch':
                                $this->mutedProblems[StubProblemType::FUNCTION_PARAMETER_MISMATCH] = $problem->versions;
                                break;
                            case 'missing function':
                                $this->mutedProblems[StubProblemType::STUB_IS_MISSED] = $problem->versions;
                                break;
                            case 'deprecated function':
                                $this->mutedProblems[StubProblemType::FUNCTION_IS_DEPRECATED] = $problem->versions;
                                break;
                            case 'absent in meta':
                                $this->mutedProblems[StubProblemType::ABSENT_IN_META] = $problem->versions;
                                break;
                            case 'has return typehint':
                                $this->mutedProblems[StubProblemType::FUNCTION_HAS_RETURN_TYPEHINT] = $problem->versions;
                                break;
                            case 'wrong return typehint':
                                $this->mutedProblems[StubProblemType::WRONG_RETURN_TYPEHINT] = $problem->versions;
                                break;
                            case 'has duplicate in stubs':
                                $this->mutedProblems[StubProblemType::HAS_DUPLICATION] = $problem->versions;
                                break;
                            case 'has type mismatch in signature and phpdoc':
                                $this->mutedProblems[StubProblemType::TYPE_IN_PHPDOC_DIFFERS_FROM_SIGNATURE] = $problem->versions;
                                break;
                            default:
                                throw new Exception("Unexpected value $problem->description");
                        }
                    }
                }
                if (!empty($function->parameters)) {
                    foreach ($this->parameters as $parameter) {
                        $parameter->readMutedProblems($function->parameters);
                    }
                }
            }
        }
    }

    /**
     * @param FunctionLike $node
     * @return bool
     */
    public static function hasTentativeReturnTypeAttribute(FunctionLike $node)
    {
        foreach ($node->getAttrGroups() as $group) {
            foreach ($group->attrs as $attr) {
                if ((string)$attr->name === TentativeType::class) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param Doc|null $docComment
     * @return bool
     */
    private static function hasDeprecatedDocTag($docComment)
    {
        $phpDoc = $docComment !== null ? DocFactoryProvider::getDocFactory()->create($docComment->getText()) : null;
        return $phpDoc !== null && !empty($phpDoc->getTagsByName('deprecated'));
    }

    public function getParameter(string $parameterName)
    {
        $parameters = array_filter($this->parameters, function (PHPParameter $parameter) use ($parameterName) {
            return $parameter->name === $parameterName && $parameter->duplicateOtherElement === false
                && ParserUtils::entitySuitsCurrentPhpVersion($parameter);
        });
        if (empty($parameters)) {
            throw new RuntimeException("Parameter $parameterName not found in stubs for set language version");
        }
        return array_pop($parameters);
    }
}
