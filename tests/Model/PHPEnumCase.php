<?php

namespace StubTests\Model;

use PhpParser\Node\Stmt\EnumCase;

class PHPEnumCase extends PHPConst
{
    /**
     * @param \ReflectionEnumUnitCase $reflectionObject
     * @return static
     */
    public function readObjectFromReflection($reflectionObject)
    {
        $this->name = $reflectionObject->name;
        $this->value = $reflectionObject->getValue();
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
        $this->name = $this->getConstantFQN($node, $node->name->name);
        //$this->value = $this->getConstValue($node);
        //$this->collectTags($node);
        $parentNode = $node->getAttribute('parent');
        if (property_exists($parentNode, 'attrGroups')) {
            $this->availableVersionsRangeFromAttribute = self::findAvailableVersionsRangeFromAttribute($parentNode->attrGroups);
        }
        $this->parentName = self::getFQN($parentNode->namespacedName);
        return $this;
    }

    public function readMutedProblems($jsonData) {}
}
