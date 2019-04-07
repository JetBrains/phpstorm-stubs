<?php
declare(strict_types=1);

namespace StubTests\Model;

use PhpParser\Node\FunctionLike;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Function_;
use ReflectionParameter;
use stdClass;

class PHPParameter extends BasePHPElement
{
    public $type = '';
    public $type_from_php_doc = '';
    public $is_vararg;
    public $is_passed_by_ref;

    /**
     * @param ReflectionParameter $parameter
     * @return $this
     */
    public function readObjectFromReflection($parameter): self
    {
        $this->name = $parameter->name;
        if (!empty($parameter->getType())) {
            $this->type = $parameter->getType()->getName();
        }
        $this->is_vararg = $parameter->isVariadic();
        $this->is_passed_by_ref = $parameter->isPassedByReference();
        return $this;
    }

    protected function checkParameter(FunctionLike $node, Param $parameter): void
    {
        if ($node->getDocComment() !== null) {
            try {
                $phpDoc = StubsHelper::createDocBlockInstance()->create($node->getDocComment()->getText());
                $parsedParamTags = $phpDoc->getTagsByName('param');

                if (!empty($parsedParamTags)) {

                    foreach ($parsedParamTags as $parsedParamTag) {
                        if ($parsedParamTag instanceof \phpDocumentor\Reflection\DocBlock\Tags\Param) {

                            // check only the current "param"-tag
                            if ($parameter->var->name !== $parsedParamTag->getVariableName()) {
                                continue;
                            }

                            $type = $parsedParamTag->getType();

                            $returnTypeTmp = StubsHelper::parseDocTypeObject($type);
                            if (is_array($returnTypeTmp)) {
                                $this->type_from_php_doc = implode('|', StubsHelper::parseDocTypeObject($type));
                            } else {
                                $this->type_from_php_doc = $returnTypeTmp;
                            }

                        }
                    }
                }
            } catch (Exception $e) {
                throw new $e;

                $this->parseError = $e->getMessage();
            }
        }
    }

    /**
     * @param Param     $parameter
     * @param Function_ $node
     *
     * @return $this
     */
    public function readObjectFromStubNode($parameter, $node = null): self
    {
        $this->checkParameter($node, $parameter);

        $this->name = $parameter->var->name;
        if ($parameter->type !== null) {
            if (empty($parameter->type->name)) {
                if (!empty($parameter->type->parts)) {
                    $this->type = $parameter->type->parts[0];
                }
            } else {
                $this->type = $parameter->type->name;
            }
        }
        $this->is_vararg = $parameter->variadic;
        $this->is_passed_by_ref = $parameter->byRef;
        return $this;
    }

    public function readMutedProblems($jsonData): void
    {
        /**@var stdClass $parameter */
        foreach ($jsonData as $parameter) {
            if ($parameter->name === $this->name && !empty($parameter->problems)) {
                /**@var stdClass $problem */
                foreach ($parameter->problems as $problem) {
                    switch ($problem) {
                        case 'parameter type mismatch':
                            $this->mutedProblems[] = StubProblemType::PARAMETER_TYPE_MISMATCH;
                            break;
                        case 'parameter reference':
                            $this->mutedProblems[] = StubProblemType::PARAMETER_REFERENCE;
                            break;
                        case 'parameter vararg':
                            $this->mutedProblems[] = StubProblemType::PARAMETER_VARARG;
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
