<?php

namespace Model;

use PhpParser\Node\Stmt\ClassConst;
use ReflectionClassConstant;

class PHPConst extends BasePHPConstant
{
    public $parentName;

    /**
     * @param array $constant
     * @return PHPConst
     */
    public function readObjectFromReflection($constant): self
    {
        $this->name = utf8_encode($constant[0]);
        $this->value = is_resource($constant[1]) ? 'PHPSTORM_RESOURCE' : utf8_encode($constant[1]);
        return $this;
    }

    public function readObjectFromStubNode($node)
    {
        $constName = $this->getConstantFQN($node, $node->name->name);
        $this->name = $constName;
        $this->value = $this->getConstValue($node);
        $this->parseError = null;
        $this->collectLinks($node);
        if ($node->getAttribute('parent') instanceof ClassConst) {
            $this->parentName = $this->getFQN($node->getAttribute('parent')->getAttribute('parent'));
        }
        return $this;
    }
}