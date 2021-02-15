<?php
declare(strict_types=1);

namespace StubTests\Model;

use phpDocumentor\Reflection\DocBlock\Tags\Param;
use PhpParser\Node\Stmt\ClassMethod;
use ReflectionMethod;
use stdClass;

class PHPMethod extends PHPFunction
{
    public string $access;
    public bool $isStatic;
    public bool $isFinal;
    public string $parentName;

    /**
     * @param ReflectionMethod $reflectionObject
     * @return static
     */
    public function readObjectFromReflection($reflectionObject): static
    {
        $this->name = $reflectionObject->name;
        $this->isStatic = $reflectionObject->isStatic();
        $this->isFinal = $reflectionObject->isFinal();
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
     */
    public function readObjectFromStubNode($node): static
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
        foreach ($node->getParams() as $parameter) {
            $this->parameters[] = (new PHPParameter())->readObjectFromStubNode($parameter);
        }

        foreach ($this->parameters as $parameter) {
            $relatedParamTags = array_filter($this->paramTags, fn(Param $tag) => $tag->getVariableName() === $parameter->name);
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

    public function readMutedProblems(stdClass|array $jsonData): void
    {
        foreach ($jsonData as $method) {
            if ($method->name === $this->name) {
                if (!empty($method->problems)) {
                    foreach ($method->problems as $problem) {
                        $this->mutedProblems[] = match ($problem) {
                            'parameter mismatch' => StubProblemType::FUNCTION_PARAMETER_MISMATCH,
                            'missing method' => StubProblemType::STUB_IS_MISSED,
                            'deprecated method' => StubProblemType::FUNCTION_IS_DEPRECATED,
                            'absent in meta' => StubProblemType::ABSENT_IN_META,
                            'wrong access' => StubProblemType::FUNCTION_ACCESS,
                            'has duplicate in stubs' => StubProblemType::HAS_DUPLICATION,
                            'has nullable typehint' => StubProblemType::HAS_NULLABLE_TYPEHINT,
                            'has union typehint' => StubProblemType::HAS_UNION_TYPEHINT,
                            'wrong return typehint' => StubProblemType::WRONG_RETURN_TYPEHINT,
                            'has type mismatch in signature and phpdoc' => StubProblemType::TYPE_IN_PHPDOC_DIFFERS_FROM_SIGNATURE,
                            default => -1
                        };
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
