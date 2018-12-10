<?php

namespace Model;

use Exception;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use phpDocumentor\Reflection\DocBlockFactory;
use PhpParser\Node\FunctionLike;
use ReflectionException;
use ReflectionFunction;

class PHPFunction extends PHPElementWithPHPDoc
{
    public $name;
    public $is_deprecated;
    public $parameters = [];
    public $returnTag;

    public function readObjectFromReflection($function)
    {
        try {
            $reflectionFunction = new ReflectionFunction($function);
            $this->name = $reflectionFunction->name;
            $this->is_deprecated = $reflectionFunction->isDeprecated();
            foreach ($reflectionFunction->getParameters() as $parameter) {
                $this->parameters[] = (new PHPParameter())->readObjectFromReflection($parameter);
            }
        } catch (ReflectionException $ex) {
            $this->parseError = $ex;
        }
        return $this;
    }

    public function readObjectFromStubNode($node)
    {
        $functionName = $this->getFQN($node);
        $this->name = $functionName;

        $this->parameters = $this->parseParams($node);

        $this->parseError = null;
        $this->collectLinks($node);
        $this->checkDeprecationTag($node);
        $this->checkReturnTag($node);
        return $this;
    }

    protected function parseParams(FunctionLike $node): array
    {
        $params = $node->getParams();
        $parsedParams = [];
        /** @var Node\Param $param */
        foreach ($params as $param) {
            $parsedParam = new PHPParameter();
            $parsedParam->name = $param->var->name;
            if ($param->type !== null) {
                if (empty($param->type->name)) {
                    if (!empty($param->type->parts)) {
                        $parsedParam->type = $param->type->parts[0];
                    }
                } else {
                    $parsedParam->type = $param->type->name;
                }

            } else {
                $parsedParam->type = '';
            }
            $parsedParam->is_vararg = $param->variadic;
            $parsedParam->is_passed_by_ref = $param->byRef;
            $parsedParams[] = $parsedParam;
        }

        return $parsedParams;
    }

    protected function checkDeprecationTag(FunctionLike $node)
    {
        if (self::$docFactory === null) {
            self::$docFactory = DocBlockFactory::createInstance();
        }
        if ($node->getDocComment() !== null) {
            try {
                $phpDoc = self::$docFactory->create($node->getDocComment()->getText());
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

    protected function checkReturnTag(FunctionLike $node)
    {
        if (self::$docFactory === null) {
            self::$docFactory = DocBlockFactory::createInstance();
        }
        if ($node->getDocComment() !== null) {
            try {
                $phpDoc = self::$docFactory->create($node->getDocComment()->getText());
                $parsedReturnTag = $phpDoc->getTagsByName('return');
                if (!empty($parsedReturnTag) && $parsedReturnTag[0] instanceof Return_) {
                    $this->returnTag = $parsedReturnTag[0]->getType() . "";
                }
            } catch (Exception $e) {
                $this->parseError = $e->getMessage();
            }
        }
    }
}