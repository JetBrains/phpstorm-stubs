<?php

declare(strict_types=1);

namespace StubTests\Model;

use PhpParser\Node\Const_;
use PhpParser\Node\Stmt\ClassConst;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\NodeAbstract;
use ReflectionClassConstant;
use stdClass;
use PhpParser\Node\Expr\UnaryMinus;

class PHPConst extends BasePHPElement
{
    use PHPDocElement;

    public $parentName;
    public $value;

    /**
     * @param ReflectionClassConstant $constant
     * @return $this
     */
    public function readObjectFromReflection($constant)
    {
        $this->name = $constant->name;
        $this->value = $constant->getValue();
        return $this;
    }

    /**
     * @param Const_ $node
     * @return $this
     */
    public function readObjectFromStubNode($node)
    {
        $this->name = $this->getConstantFQN($node, $node->name->name);
        $this->value = $this->getConstValue($node);
        $this->collectLinks($node);
        $this->collectSinceDeprecatedVersions($node);
        if ($node->getAttribute('parent') instanceof ClassConst) {
            $this->parentName = $this->getFQN($node->getAttribute('parent')->getAttribute('parent'));
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
            } else {
                return $node->value->expr->value;
            }
        }
        if (in_array('name', $node->value->getSubNodeNames(), true)) {
            return $node->value->name->parts[0];
        }
        return null;
    }

    protected function getConstantFQN(NodeAbstract $node, string $nodeName): string
    {
        $namespace = '';
        $parentParentNode = $node->getAttribute('parent')->getAttribute('parent');
        if ($parentParentNode instanceof Namespace_ && !empty($parentParentNode->name)) {
            $namespace = '\\' . implode('\\', $parentParentNode->name->parts) . '\\';
        }

        return $namespace . $nodeName;
    }

    public function readMutedProblems($jsonData): void
    {
        /**@var stdClass $constant */
        foreach ($jsonData as $constant) {
            if ($constant->name === $this->name && !empty($constant->problems)) {
                /**@var stdClass $problem */
                foreach ($constant->problems as $problem) {
                    switch ($problem) {
                        case 'wrong value':
                            $this->mutedProblems[] = StubProblemType::WRONG_CONSTANT_VALUE;
                            break;
                        case 'missing constant':
                            $this->mutedProblems[] = StubProblemType::STUB_IS_MISSED;
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
