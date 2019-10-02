<?php
declare(strict_types=1);

namespace StubTests\Model;

use Exception;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use phpDocumentor\Reflection\Type;
use PhpParser\Node\FunctionLike;
use PhpParser\Node\Stmt\Function_;
use ReflectionException;
use ReflectionFunction;
use ReflectionParameter;
use stdClass;
use StubTests\Parsers\DocFactoryProvider;

class PHPFunction extends BasePHPElement
{
    use PHPDocElement;

    /**
     * @var boolean $is_deprecated
     */
    public $is_deprecated;
    /**
     * @var PHPParameter[]
     */
    public $parameters = [];
    /**
     * @var Type $returnTag
     */
    public $returnTag;

    /**
     * @param ReflectionFunction $function
     * @return $this
     */
    public function readObjectFromReflection($function)
    {
        try {
            $reflectionFunction = new ReflectionFunction($function);
            $this->name = $reflectionFunction->name;
            $this->is_deprecated = $reflectionFunction->isDeprecated();
            /**@var ReflectionParameter $parameter */
            foreach ($reflectionFunction->getParameters() as $parameter) {
                $this->parameters[] = (new PHPParameter())->readObjectFromReflection($parameter);
            }
        } catch (ReflectionException $ex) {
            $this->parseError = $ex;
        }
        return $this;
    }

    /**
     * @param Function_ $node
     * @return $this
     */
    public function readObjectFromStubNode($node)
    {
        $functionName = $this->getFQN($node);
        $this->name = $functionName;

        foreach ($node->getParams() as $parameter) {
            $this->parameters[] = (new PHPParameter())->readObjectFromStubNode($parameter);
        }

        $this->collectLinks($node);
        $this->collectSinceDeprecatedVersions($node);
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
                $this->parseError = $e->getMessage();
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
                    $this->returnTag = $parsedReturnTag[0]->getType() . '';
                }
            } catch (Exception $e) {
                $this->parseError = $e->getMessage();
            }
        }
    }

    public function readMutedProblems($jsonData): void
    {
        /**@var stdClass $function */
        foreach ($jsonData as $function) {
            if ($function->name === $this->name && !empty($function->problems)) {
                /**@var stdClass $problem */
                foreach ($function->problems as $problem) {
                    switch ($problem) {
                        case 'parameter mismatch':
                            $this->mutedProblems[] = StubProblemType::FUNCTION_PARAMETER_MISMATCH;
                            break;
                        case 'missing function':
                            $this->mutedProblems[] = StubProblemType::STUB_IS_MISSED;
                            break;
                        case 'deprecated function':
                            $this->mutedProblems[] = StubProblemType::FUNCTION_IS_DEPRECATED;
                            break;
                        default:
                            $this->mutedProblems[] = -1;
                            break;
                    }
                }
                return;
            }
        }
    }
}
