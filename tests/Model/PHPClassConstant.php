<?php

namespace StubTests\Model;

use PhpParser\Node\Stmt\Const_;

class PHPClassConstant extends BasePHPElement
{
    /**
     * @var bool|int|string|float|null
     */
    public $value;

    /**
     * @var string|null
     */
    public $parentId;

    /**
     * @var string|null
     */
    public $visibility;

    public function readObjectFromReflection($reflectionObject)
    {
        $this->name = $reflectionObject->name;
        $this->value = $reflectionObject->getValue();
        if (!empty($reflectionObject->getDeclaringClass()->getNamespaceName())) {
            $this->parentId = "\\" . $reflectionObject->getDeclaringClass()->getNamespaceName();
        }
        $this->parentId = "$this->parentId\\{$reflectionObject->getDeclaringClass()->getShortName()}";
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
     * @param Const_ $node
     * @return $this|PHPClassConstant
     */
    public function readObjectFromStubNode($node) {}

    public function readMutedProblems($jsonData) {}
}
