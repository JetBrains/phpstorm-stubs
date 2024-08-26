<?php

namespace StubTests\Model;

use PhpParser\Node\Expr\Cast;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Expr\UnaryMinus;
use PhpParser\Node\Stmt\ClassLike;
use PhpParser\Node\Stmt\Namespace_;

class PHPConstantDeclaration extends BasePHPElement
{
    public $constants = [];

    public function readObjectFromReflection($reflectionObject) {}

    public function readObjectFromStubNode($node)
    {
        $parentNode = $node->getAttribute('parent');
        foreach ($node->consts as $const) {
            if ($parentNode instanceof ClassLike) {
                $constant = new PHPClassConstant();
                if ($node->isPrivate()) {
                    $constant->visibility = 'private';
                } elseif ($node->isProtected()) {
                    $constant->visibility = 'protected';
                } else {
                    $constant->visibility = 'public';
                }
                $constant->parentId = self::getFQN($parentNode);
            } elseif ($parentNode instanceof Namespace_){
                $constant = new PHPConstant();
                $constant->id = self::getFQN($const);
                $constant->namespace = rtrim(str_replace((string)$const->name, "", "\\" . $const->namespacedName), '\\');
            } else {
                $constant = new PHPConstant();
                $constant->id = self::getFQN($const);
                $constant->namespace = rtrim(str_replace((string)$const->name, "", "\\" . $const->namespacedName), '\\');
            }
            $constant->name = $const->name->name;
            $constant->value = $this->getConstValue($const);
            if (property_exists($node, 'attrGroups')) {
                $constant->availableVersionsRangeFromAttribute = self::findAvailableVersionsRangeFromAttribute($node->attrGroups);
            }
            $constant->collectTags($node);
            $constant->checkDeprecationTag($node);
            $constant->stubObjectHash = spl_object_hash($constant);
            array_push($this->constants, $constant);
        }

        return $this;
    }

    protected function getConstValue($node)
    {
        if (in_array('value', $node->value->getSubNodeNames(), true)) {
            return $node->value->value;
        }
        if (in_array('expr', $node->value->getSubNodeNames(), true)) {
            if ($node->value instanceof UnaryMinus) {
                return -$node->value->expr->value;
            } elseif ($node->value instanceof Cast && $node->value->expr instanceof ConstFetch) {
                return $node->value->expr->name->name;
            }
            return $node->value->expr->value;
        }
        if (in_array('name', $node->value->getSubNodeNames(), true)) {
            $value = isset($node->value->name->parts[0]) ? $node->value->name->parts[0] : $node->value->name->name;
            return $value === 'null' ? null : $value;
        }
        return null;
    }

    public function readMutedProblems($jsonData) {}
}
