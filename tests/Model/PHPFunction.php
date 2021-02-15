<?php
declare(strict_types=1);

namespace StubTests\Model;

use Exception;
use JetBrains\PhpStorm\Deprecated;
use phpDocumentor\Reflection\DocBlock\Tags\Param;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use phpDocumentor\Reflection\Types\Compound;
use PhpParser\Comment\Doc;
use PhpParser\Node\FunctionLike;
use PhpParser\Node\Stmt\Function_;
use ReflectionFunction;
use stdClass;
use StubTests\Parsers\DocFactoryProvider;

class PHPFunction extends BasePHPElement
{
    use PHPDocElement;

    public bool $is_deprecated;
    /**
     * @var PHPParameter[]
     */
    public array $parameters = [];

    /** @var string[] $returnTypesFromPhpDoc  */
    public array $returnTypesFromPhpDoc = [];

    /** @var string[] $returnTypesFromAttribute  */
    public array $returnTypesFromAttribute = [];

    /** @var string[] $returnTypesFromSignature  */
    public array $returnTypesFromSignature = [];

    /**
     * @param ReflectionFunction $reflectionObject
     * @return static
     */
    public function readObjectFromReflection($reflectionObject): static
    {
        $this->name = $reflectionObject->name;
        $this->is_deprecated = $reflectionObject->isDeprecated();
        foreach ($reflectionObject->getParameters() as $parameter) {
            $this->parameters[] = (new PHPParameter())->readObjectFromReflection($parameter);
        }
        array_push($this->returnTypesFromSignature, ...self::getReflectionTypeAsArray($reflectionObject->getReturnType()));
        return $this;
    }

    /**
     * @param Function_ $node
     * @return static
     */
    public function readObjectFromStubNode($node): static
    {
        $functionName = self::getFQN($node);
        $this->name = $functionName;
        $typesFromAttribute = self::findTypesFromAttribute($node->attrGroups);
        $this->availableVersionsRangeFromAttribute = self::findAvailableVersionsRangeFromAttribute($node->attrGroups);
        $this->returnTypesFromAttribute = $typesFromAttribute;
        array_push($this->returnTypesFromSignature, ...self::convertParsedTypeToArray($node->getReturnType()));
        foreach ($node->getParams() as $parameter) {
            $this->parameters[] = (new PHPParameter())->readObjectFromStubNode($parameter);
        }

        $this->collectTags($node);
        foreach ($this->parameters as $parameter) {
            $relatedParamTags = array_filter($this->paramTags, fn(Param $tag) => $tag->getVariableName() === $parameter->name);
            /** @var Param $relatedParamTag */
            $relatedParamTag = array_pop($relatedParamTags);
            if (!empty($relatedParamTag)){
                $parameter->isOptional = $parameter->isOptional || str_contains((string)$relatedParamTag->getDescription(), '[optional]');
            }
        }

        $this->checkDeprecationTag($node);
        $this->checkReturnTag($node);
        return $this;
    }

    protected function checkDeprecationTag(FunctionLike $node): void
    {
        try {
            $this->is_deprecated = self::hasDeprecatedAttribute($node) || self::hasDeprecatedDocTag($node->getDocComment());
        } catch (Exception $e) {
            $this->parseError = $e;
        }
    }

    protected function checkReturnTag(FunctionLike $node): void
    {
        if ($node->getDocComment() !== null) {
            try {
                $phpDoc = DocFactoryProvider::getDocFactory()->create($node->getDocComment()->getText());
                $parsedReturnTag = $phpDoc->getTagsByName('return');
                if (!empty($parsedReturnTag) && $parsedReturnTag[0] instanceof Return_) {
                    $returnType = $parsedReturnTag[0]->getType();
                    if ($returnType instanceof Compound) {
                        foreach ($returnType as $nextType) {
                            array_push($this->returnTypesFromPhpDoc, (string)$nextType);
                        }
                    } else {
                        array_push($this->returnTypesFromPhpDoc, (string)$returnType);
                    }
                }
            } catch (Exception $e) {
                $this->parseError = $e;
            }
        }
    }

    public function readMutedProblems(stdClass|array $jsonData): void
    {
        foreach ($jsonData as $function) {
            if ($function->name === $this->name) {
                if (!empty($function->problems)) {
                    foreach ($function->problems as $problem) {
                        $this->mutedProblems[] = match ($problem) {
                            'parameter mismatch' => StubProblemType::FUNCTION_PARAMETER_MISMATCH,
                            'missing function' => StubProblemType::STUB_IS_MISSED,
                            'deprecated function' => StubProblemType::FUNCTION_IS_DEPRECATED,
                            'absent in meta' => StubProblemType::ABSENT_IN_META,
                            'has return typehint' => StubProblemType::FUNCTION_HAS_RETURN_TYPEHINT,
                            'wrong return typehint' => StubProblemType::WRONG_RETURN_TYPEHINT,
                            'has duplicate in stubs' => StubProblemType::HAS_DUPLICATION,
                            'has type mismatch in signature and phpdoc' => StubProblemType::TYPE_IN_PHPDOC_DIFFERS_FROM_SIGNATURE,
                            default => -1
                        };
                    }
                }
                if (!empty($function->parameters)) {
                    foreach ($this->parameters as $parameter) {
                        $parameter->readMutedProblems($function->parameters);
                    }
                }
                return;
            }
        }
    }

    private static function hasDeprecatedAttribute(FunctionLike $node): bool
    {
        foreach ($node->getAttrGroups() as $group) {
            foreach ($group->attrs as $attr) {
                if ($attr->name == Deprecated::class) {
                    return true;
                }
            }
        }
        return false;
    }

    private static function hasDeprecatedDocTag(?Doc $docComment): bool
    {
        $phpDoc = $docComment != null ? DocFactoryProvider::getDocFactory()->create($docComment->getText()) : null;
        return $phpDoc != null && !empty($phpDoc->getTagsByName('deprecated'));
    }
}
