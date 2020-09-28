<?php
declare(strict_types=1);

namespace StubTests\Model;

use Exception;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use phpDocumentor\Reflection\Type;
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
        return $this;
    }

    protected function checkDeprecationTag(FunctionLike $node): void
    {
        if ($node->getDocComment() !== null) {
            try {
                $phpDoc = DocFactoryProvider::getDocFactory()->create($node->getDocComment()->getText());
                if (empty($phpDoc->getTagsByName('deprecated'))) {
                    $this->is_deprecated = false;
                } else {
                    $this->is_deprecated = true;
                }
            } catch (Exception $e) {
                $this->parseError = $e;
            }
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
                        default => -1
                    };
                }
                return;
            }
        }
    }
}
