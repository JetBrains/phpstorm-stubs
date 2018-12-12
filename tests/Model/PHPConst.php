<?php
declare(strict_types=1);

namespace StubTests\Model;

use PhpParser\Node\Const_;
use PhpParser\Node\Stmt\ClassConst;
use ReflectionClassConstant;
use stdClass;

class PHPConst extends PHPElementWithPHPDoc
{
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
        $this->name  = $this->getConstantFQN($node, $node->name->name);
        $this->value = $this->getConstValue($node);
        $this->collectLinks($node);
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
            return $node->value->expr->value;
        }
        if (in_array('name', $node->value->getSubNodeNames(), true)) {
            return $node->value->name->parts[0];
        }
        return null;
    }

    public function readStubProblems($jsonData): void
    {
        /**@var stdClass $constant */
        foreach ($jsonData->constants as $constant) {
            if ($constant->name === $this->name) {
                /**@var stdClass $problem */
                foreach ($constant->problems as $problem) {
                    switch ($problem) {
                        case 'wrong value':
                            $this->relatedStubProblems[] = StubProblemType::WRONG_CONSTANT_VALUE;
                            break;
                        case 'missing constant':
                            $this->relatedStubProblems[] = StubProblemType::STUB_IS_MISSED;
                            break;
                        default:
                            $this->relatedStubProblems[] = -1;
                            break;
                    }
                }
                return;
            }
        }
    }
}
