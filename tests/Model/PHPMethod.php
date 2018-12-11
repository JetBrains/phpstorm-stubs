<?php
declare(strict_types=1);

namespace StubTests\Model;

use PhpParser\Node\Stmt\ClassMethod;
use ReflectionParameter;

class PHPMethod extends PHPFunction
{
    public $access;
    public $is_static;
    public $is_final;
    public $parentName;

    /**
     * @param \ReflectionMethod $method
     * @return $this
     */
    public function readObjectFromReflection($method)
    {
        $this->name = $method->name;
        $this->is_static = $method->isStatic();
        $this->is_final = $method->isFinal();
        /**@var ReflectionParameter $parameter */
        foreach ($method->getParameters() as $parameter) {
            $this->parameters[] = (new PHPParameter())->readObjectFromReflection($parameter);
        }

        if ($method->isProtected()) {
            $access = 'protected';
        } elseif ($method->isPrivate()) {
            $access = 'private';
        } else {
            $access = 'public';
        }
        $this->access = $access;
        return $this;
    }

    /**
     * @param ClassMethod $node
     * @return $this
     */
    public function readObjectFromStubNode($node)
    {
        $this->parentName = $this->getFQN($node->getAttribute('parent'));
        $this->name = $node->name->name;

        $this->collectLinks($node);
        $this->checkDeprecationTag($node);
        $this->checkReturnTag($node);

        if (strncmp($this->name, 'PS_UNRESERVE_PREFIX_', 20) === 0) {
            $this->name = substr($this->name, strlen('PS_UNRESERVE_PREFIX_'));
        }
        foreach ($node->getParams() as $parameter) {
            $this->parameters[] = (new PHPParameter())->readObjectFromStubNode($parameter);
        }

        $this->is_final = $node->isFinal();
        $this->is_static = $node->isStatic();
        if ($node->isPrivate()) {
            $this->access = 'private';
        } elseif ($node->isProtected()) {
            $this->access = 'protected';
        } else {
            $this->access = 'public';
        }
        return $this;
    }
}
