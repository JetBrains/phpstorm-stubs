<?php
declare(strict_types=1);

namespace StubTests\Model;

use Exception;
use function get_class;
use phpDocumentor\Reflection\DocBlock\DescriptionFactory;
use phpDocumentor\Reflection\DocBlock\StandardTagFactory;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use phpDocumentor\Reflection\DocBlockFactory;
use phpDocumentor\Reflection\FqsenResolver;
use phpDocumentor\Reflection\Type;
use phpDocumentor\Reflection\TypeResolver;
use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Types\ArrayArray;
use phpDocumentor\Reflection\Types\ArrayFloat;
use phpDocumentor\Reflection\Types\ArrayInt;
use phpDocumentor\Reflection\Types\ArrayString;
use phpDocumentor\Reflection\Types\Boolean;
use phpDocumentor\Reflection\Types\BooleanFalse;
use phpDocumentor\Reflection\Types\BooleanTrue;
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
     * @var string
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
     * @return string|string[]
     */
    protected function parseDocTypeObject(Type $type)
    {
        if ($type instanceof Object_) {
            $tmpObject = (string) $type->getFqsen();
            if ($tmpObject) {
                return $tmpObject;
            }

            return 'object';
        }

        if ($type instanceof Compound) {
            $types = [];
            foreach ($type as $subType) {
                $types[] = $this->parseDocTypeObject($subType);
            }

            return $types;
        }

        if ($type instanceof Array_) {
            $valueTypeTmp = $type->getValueType() . '';
            if ($valueTypeTmp !== 'mixed') {
                return $valueTypeTmp . '[]';
            }

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

        if ($type instanceof BooleanTrue) {
            return 'true';
        }

        if ($type instanceof BooleanFalse) {
            return 'false';
        }

        if ($type instanceof Boolean) {
            return 'bool';
        }

        if ($type instanceof Callable_) {
            return 'callable';
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

        return $type . '';

        // throw new \Exception('Unhandled PhpDoc type: ' . get_class($type));
    }

    protected function checkReturnTag(FunctionLike $node): void
    {
        if ($node->getDocComment() !== null) {
            try {
                $phpDoc = self::createDocBlockInstance()->create($node->getDocComment()->getText());
                $parsedReturnTag = $phpDoc->getTagsByName('return');
                if (!empty($parsedReturnTag) && $parsedReturnTag[0] instanceof Return_) {
                    /** @var Return_ $parsedReturnTagReturn */
                    $parsedReturnTagReturn = $parsedReturnTag[0];
                    $type = $parsedReturnTagReturn->getType();
                    $this->returnTag = $type . '';

                    $returnTypeTmp = $this->parseDocTypeObject($type);
                    if (is_array($returnTypeTmp)) {
                        $this->returnType = implode('|', $this->parseDocTypeObject($type));
                    } else {
                        $this->returnType = $returnTypeTmp;
                    }

                }
            } catch (Exception $e) {
                $this->parseError = $e->getMessage();
            }
        }
    }

    /**
     * Factory method for easy instantiation.
     *
     * @param string[] $additionalTags
     *
     * @return DocBlockFactory
     */
    protected static function createDocBlockInstance(array $additionalTags = []): DocBlockFactory
    {
        $fqsenResolver = new FqsenResolver();
        $tagFactory = new StandardTagFactory($fqsenResolver);
        $descriptionFactory = new DescriptionFactory($tagFactory);
        $typeResolver = new TypeResolver($fqsenResolver);

        $typeResolver->addKeyword('array[]', ArrayArray::class);
        $typeResolver->addKeyword('float[]', ArrayFloat::class);
        $typeResolver->addKeyword('int[]', ArrayInt::class);
        $typeResolver->addKeyword('string[]', ArrayString::class);
        $typeResolver->addKeyword('false', BooleanFalse::class);
        $typeResolver->addKeyword('true', BooleanTrue::class);

        $tagFactory->addService($descriptionFactory);
        $tagFactory->addService($typeResolver);

        $docBlockFactory = new DocBlockFactory($descriptionFactory, $tagFactory);
        foreach ($additionalTags as $tagName => $tagHandler) {
            $docBlockFactory->registerTagHandler($tagName, $tagHandler);
        }

        return $docBlockFactory;
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
