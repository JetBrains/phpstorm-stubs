<?php

namespace Model;


use PhpParser\Node\Param;
use ReflectionParameter;

class PHPParameter extends BasePHPElement
{
    public $type = '';
    public $is_vararg;
    public $is_passed_by_ref;

    /**
     * @param ReflectionParameter $parameter
     * @return $this
     */
    public function readObjectFromReflection($parameter)
    {
        $this->name = $parameter->name;
        if (!empty($parameter->getType())) {
            $this->type = $parameter->getType()->getName();
        }
        $this->is_vararg = $parameter->isVariadic();
        $this->is_passed_by_ref = $parameter->isPassedByReference();
        return $this;
    }

    /**
     * @param Param $node
     * @return $this
     */
    public function readObjectFromStubNode($node)
    {
        $this->name = $node->var->name;
        if ($node->type !== null) {
            if (empty($node->type->name)) {
                if (!empty($node->type->parts)) {
                    $this->type = $node->type->parts[0];
                }
            } else {
                $this->type = $node->type->name;
            }
        } else {
            $this->type = '';
        }
        $this->is_vararg = $node->variadic;
        $this->is_passed_by_ref = $node->byRef;
        return $this;
    }
}