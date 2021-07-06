<?php
declare(strict_types=1);

namespace StubTests\Model;

use phpDocumentor\Reflection\DocBlock\Tags\Param;
use PhpParser\Node\Stmt\ClassMethod;
use ReflectionMethod;
use RuntimeException;
use stdClass;
use StubTests\Parsers\ParserUtils;

class PHPMethod extends PHPFunction
{
    /**
     * @var string
     */
    public $access;
    /**
     * @var bool
     */
    public $isStatic;
    /**
     * @var bool
     */
    public $isFinal;
    /**
     * @var string
     */
    public $parentName;

    /**
     * @param ReflectionMethod $reflectionObject
     * @return static
     */
    public function readObjectFromReflection($reflectionObject)
    {
        $this->name = $reflectionObject->name;
        $this->isStatic = $reflectionObject->isStatic();
        $this->isFinal = $reflectionObject->isFinal();
        $this->parentName = $reflectionObject->class;
        foreach ($reflectionObject->getParameters() as $parameter) {
            $this->parameters[] = (new PHPParameter())->readObjectFromReflection($parameter);
        }

        if ($reflectionObject->isProtected()) {
            $access = 'protected';
        } elseif ($reflectionObject->isPrivate()) {
            $access = 'private';
        } else {
            $access = 'public';
        }
        $this->access = $access;
        return $this;
    }

    /**
     * @param ClassMethod $node
     * @return static
     * @throws RuntimeException
     */
    public function readObjectFromStubNode($node)
    {
        $this->parentName = self::getFQN($node->getAttribute('parent'));
        $this->name = $node->name->name;
        $typesFromAttribute = self::findTypesFromAttribute($node->attrGroups);
        $this->availableVersionsRangeFromAttribute = self::findAvailableVersionsRangeFromAttribute($node->attrGroups);
        $this->returnTypesFromAttribute = $typesFromAttribute;
        array_push($this->returnTypesFromSignature, ...self::convertParsedTypeToArray($node->getReturnType()));
        $this->collectTags($node);
        $this->checkDeprecationTag($node);
        $this->checkReturnTag($node);

        if (strncmp($this->name, 'PS_UNRESERVE_PREFIX_', 20) === 0) {
            $this->name = substr($this->name, strlen('PS_UNRESERVE_PREFIX_'));
        }
        $index = 0;
        foreach ($node->getParams() as $parameter) {
            $parsedParameter = (new PHPParameter())->readObjectFromStubNode($parameter);
            if (in_array(doubleval(getenv('PHP_VERSION')), ParserUtils::getAvailableInVersions($parsedParameter))) {
                $parsedParameter->indexInSignature = $index;
                $this->parameters[] = $parsedParameter;
                $index++;
            }
        }

        foreach ($this->parameters as $parameter) {
            $relatedParamTags = array_filter($this->paramTags, function (Param $tag) use ($parameter) {
                return $tag->getVariableName() === $parameter->name;
            });
            /** @var Param $relatedParamTag */
            $relatedParamTag = array_pop($relatedParamTags);
            if (!empty($relatedParamTag)) {
                $parameter->isOptional = $parameter->isOptional || str_contains((string)$relatedParamTag->getDescription(), '[optional]');
            }
        }

        $this->isFinal = $node->isFinal();
        $this->isStatic = $node->isStatic();
        if ($node->isPrivate()) {
            $this->access = 'private';
        } elseif ($node->isProtected()) {
            $this->access = 'protected';
        } else {
            $this->access = 'public';
        }
        return $this;
    }

    /**
     * @param stdClass|array $jsonData
     */
    public function readMutedProblems($jsonData): void
    {
        foreach ($jsonData as $method) {
            if ($method->name === $this->name) {
                if (!empty($method->problems)) {
                    foreach ($method->problems as $problem) {
                        switch ($problem->description) {
                            case 'parameter mismatch':
                                $this->mutedProblems[StubProblemType::FUNCTION_PARAMETER_MISMATCH] = $problem->versions;
                                break;
                            case 'missing method':
                                $this->mutedProblems[StubProblemType::STUB_IS_MISSED] = $problem->versions;
                                break;
                            case 'deprecated method':
                                $this->mutedProblems[StubProblemType::FUNCTION_IS_DEPRECATED] = $problem->versions;
                                break;
                            case 'absent in meta':
                                $this->mutedProblems[StubProblemType::ABSENT_IN_META] = $problem->versions;
                                break;
                            case 'wrong access':
                                $this->mutedProblems[StubProblemType::FUNCTION_ACCESS] = $problem->versions;
                                break;
                            case 'has duplicate in stubs':
                                $this->mutedProblems[StubProblemType::HAS_DUPLICATION] = $problem->versions;
                                break;
                            case 'has nullable typehint':
                                $this->mutedProblems[StubProblemType::HAS_NULLABLE_TYPEHINT] = $problem->versions;
                                break;
                            case 'has union typehint':
                                $this->mutedProblems[StubProblemType::HAS_UNION_TYPEHINT] = $problem->versions;
                                break;
                            case 'wrong return typehint':
                                $this->mutedProblems[StubProblemType::WRONG_RETURN_TYPEHINT] = $problem->versions;
                                break;
                            case 'has type mismatch in signature and phpdoc':
                                $this->mutedProblems[StubProblemType::TYPE_IN_PHPDOC_DIFFERS_FROM_SIGNATURE] = $problem->versions;
                                break;
                            case 'has wrong final modifier':
                                $this->mutedProblems[StubProblemType::WRONG_FINAL_MODIFIER] = $problem->versions;
                                break;
                            case 'has wrong static modifier':
                                $this->mutedProblems[StubProblemType::WRONG_STATIC_MODIFIER] = $problem->versions;
                                break;
                        }
                    }
                }
                if (!empty($method->parameters)) {
                    foreach ($this->parameters as $parameter) {
                        $parameter->readMutedProblems($method->parameters);
                    }
                }
                return;
            }
        }
    }
}
