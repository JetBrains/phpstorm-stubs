<?php
declare(strict_types=1);

namespace StubTests\Model;

use Exception;
use function get_class;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use phpDocumentor\Reflection\Type;
use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Types\Boolean;
use phpDocumentor\Reflection\Types\Callable_;
use phpDocumentor\Reflection\Types\Compound;
use phpDocumentor\Reflection\Types\Float_;
use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\Mixed_;
use phpDocumentor\Reflection\Types\Null_;
use phpDocumentor\Reflection\Types\Object_;
use phpDocumentor\Reflection\Types\Resource_;
use phpDocumentor\Reflection\Types\Scalar;
use phpDocumentor\Reflection\Types\String_;
use phpDocumentor\Reflection\Types\Void_;
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
     * @var bool
     */
    public $is_deprecated;

    /**
     * @var PHPParameter[]
     */
    public $parameters = [];

    /**
     * @var Type
     */
    public $returnTag;

    /**
     * @var string|string[]
     */
    public $returnType;

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

    /**
     * @param Type $type
     *
     * @return string|string[]
     */
    protected static function parseDocTypeObject(Type $type)
    {
        if ($type instanceof Object_) {
            return (string) $type->getFqsen();
        }
        if ($type instanceof Array_) {
            /*
            $value = $type->getValueType();
            if ($value instanceof Mixed_) {
                return 'mixed';
            }
            */
            return 'array';
        }
        if ($type instanceof Null_) {
            return 'null';
        }
        if ($type instanceof Mixed_) {
            return 'mixed';
        }
        if ($type instanceof Scalar) {
            return 'string|int|float|bool';
        }
        if ($type instanceof Boolean) {
            return 'bool';
        }
        if ($type instanceof Callable_) {
            return 'callable';
        }
        if ($type instanceof Compound) {
            $types = [];
            foreach ($type as $subType) {
                $types[] = self::parseDocTypeObject($subType);
            }
            return $types;
        }
        if ($type instanceof Float_) {
            return 'float';
        }
        if ($type instanceof String_) {
            return 'string';
        }
        if ($type instanceof Integer) {
            return 'int';
        }
        if ($type instanceof Void_) {
            return 'void';
        }
        if ($type instanceof Resource_) {
            return 'resource';
        }
        throw new \Exception('Unhandled PhpDoc type: ' . get_class($type));
    }

    protected function checkReturnTag(FunctionLike $node): void
    {
        if ($node->getDocComment() !== null) {
            try {
                $phpDoc = DocFactoryProvider::getDocFactory()->create($node->getDocComment()->getText());
                $parsedReturnTag = $phpDoc->getTagsByName('return');
                if (!empty($parsedReturnTag) && $parsedReturnTag[0] instanceof Return_) {
                    /** @var Return_ $parsedReturnTagReturn */
                    $parsedReturnTagReturn = $parsedReturnTag[0];
                    $type = $parsedReturnTagReturn->getType();
                    $this->returnTag = $type . '';
                    $this->returnType = self::parseDocTypeObject($type);
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
