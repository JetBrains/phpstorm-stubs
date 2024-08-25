<?php

namespace StubTests\Model;

use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\EnumCase;

class PHPEnumCase extends PHPClassConstant
{
    /**
     * @param \ReflectionEnumUnitCase $reflectionObject
     * @return static
     */
    public function readObjectFromReflection($reflectionObject)
    {
        $this->name = $reflectionObject->name;
        $this->value = $reflectionObject->getValue();
        $this->parentId = "\\{$reflectionObject->class}";
        if ($reflectionObject->isPrivate()) {
            $this->visibility = 'private';
        } elseif ($reflectionObject->isProtected()) {
            $this->visibility = 'protected';
        } else {
            $this->visibility = 'public';
        }
        return $this;
    }

    /**
     * @param EnumCase $node
     * @return $this|PHPEnumCase
     */
    public function readObjectFromStubNode($node)
    {
        $this->name = $node->name->name;
        $this->value = $this->getEnumCaseValue($node);
        //$this->collectTags($node);
        $parentNode = $node->getAttribute('parent');
        if (property_exists($parentNode, 'attrGroups')) {
            $this->availableVersionsRangeFromAttribute = self::findAvailableVersionsRangeFromAttribute($parentNode->attrGroups);
        }
        $this->parentId = self::getFQN($parentNode);
        $this->stubObjectHash = spl_object_hash($this);
        return $this;
    }

    public function readMutedProblems($jsonData) {}

    protected function getEnumCaseValue($node)
    {
        if (empty($node->expr) && !empty($node->name)) {
            $value = $node->name->name;
        } elseif ($node->expr instanceof ClassConstFetch) {
            $value = $node->expr->class->toCodeString() . "::" . $node->expr->name;
        } elseif ($node->expr instanceof String_) {
            $value = $node->expr->value;
        } else {
            $value = $node->expr;
        }
        return $value;
    }
}
