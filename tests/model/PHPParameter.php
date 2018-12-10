<?php

namespace Model;


use ReflectionParameter;

class PHPParameter extends BasePHPElement
{
    public $type = '';
    public $is_vararg;
    public $is_passed_by_ref;

    /**
     * @param ReflectionParameter $parameter
     * @return PHPParameter
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

    /**
     * @param mixed $node
     * @return mixed
     */
    public function readObjectFromStubNode($node)
    {
        // TODO: Implement readObjectFromStubNode() method.
    }
}