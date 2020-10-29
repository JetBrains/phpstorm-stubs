<?php
declare(strict_types=1);

namespace StubTests\Model;

use Exception;
use JetBrains\PhpStorm\Deprecated;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use phpDocumentor\Reflection\Type;
use PhpParser\Comment\Doc;
use PhpParser\Node\FunctionLike;
use PhpParser\Node\Stmt\Function_;
use PhpParser\NodeAbstract;
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

    public ?Type $returnTag = null;

    public ?NodeAbstract $returnType = null;

    public ?Doc $doc = null;

    /**
     * @param ReflectionFunction $reflectionObject
     * @return $this
     */
    public function readObjectFromReflection($reflectionObject): static
    {
        $this->name = $reflectionObject->name;
        $this->is_deprecated = $reflectionObject->isDeprecated();
        foreach ($reflectionObject->getParameters() as $parameter) {
            $this->parameters[] = (new PHPParameter())->readObjectFromReflection($parameter);
        }
        return $this;
    }

    /**
     * @param Function_ $node
     * @return $this
     */
    public function readObjectFromStubNode($node): static
    {
        $functionName = $this->getFQN($node);
        $this->name = $functionName;

        foreach ($node->getParams() as $parameter) {
            $this->parameters[] = (new PHPParameter())->readObjectFromStubNode($parameter);
        }

        $this->returnType = $node->getReturnType();
        $this->collectTags($node);
        $this->checkDeprecationTag($node);
        $this->checkReturnTag($node);
        $this->checkDoc($node);
        return $this;
    }


    protected function checkDoc(FunctionLike $node)
    {
        $this->doc = $node->getDocComment();
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
                    $this->returnTag = $parsedReturnTag[0]->getType();
                }
            } catch (Exception $e) {
                $this->parseError = $e;
            }
        }
    }

    public function readMutedProblems(stdClass|array $jsonData): void
    {
        foreach ($jsonData as $function) {
            if ($function->name === $this->name && !empty($function->problems)) {
                foreach ($function->problems as $problem) {
                    $this->mutedProblems[] = match ($problem) {
                        'parameter mismatch' => StubProblemType::FUNCTION_PARAMETER_MISMATCH,
                        'missing function' => StubProblemType::STUB_IS_MISSED,
                        'deprecated function' => StubProblemType::FUNCTION_IS_DEPRECATED,
                        'absent in meta' => StubProblemType::ABSENT_IN_META,
                        'has return typehint' => StubProblemType::FUNCTION_HAS_RETURN_TYPEHINT,
                        'wrong return type in docs' => StubProblemType::RETURN_TYPE_IS_WRONG_IN_OFICIAL_DOCS,
                        'wrong parmeter type in docs' => StubProblemType::PARAMETER_TYPE_IS_WRONG_IN_OFICIAL_DOCS,
                        default => -1
                    };
                }
                return;
            }
        }
    }

    private static function hasDeprecatedAttribute(FunctionLike $node) :bool
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

    private static function hasDeprecatedDocTag(?Doc $docComment) :bool
    {
        $phpDoc = $docComment != null ? DocFactoryProvider::getDocFactory()->create($docComment->getText()) : null;
        return $phpDoc != null && !empty($phpDoc->getTagsByName('deprecated'));
    }
}
