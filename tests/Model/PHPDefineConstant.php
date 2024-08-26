<?php

namespace StubTests\Model;

use PhpParser\Node\Expr\Cast;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\UnaryMinus;
use function in_array;
use function is_float;
use function is_resource;
use function is_string;

class PHPDefineConstant extends BasePHPElement
{
    /**
     * @var bool|int|string|float|null
     */
    public $value;

    /**
     * @param array $reflectionObject
     * @return static
     */
    public function readObjectFromReflection($reflectionObject)
    {
        if (is_string($reflectionObject[0])) {
            $this->name = mb_convert_encoding($reflectionObject[0], 'UTF-8');
        } else {
            $this->name = $reflectionObject[0];
        }
        $constantValue = $reflectionObject[1];
        if ($constantValue !== null) {
            if (is_resource($constantValue)) {
                $this->value = 'PHPSTORM_RESOURCE';
            } elseif (is_string($constantValue) || is_float($constantValue)) {
                $this->value = mb_convert_encoding((string)$constantValue, 'UTF-8');
            } else {
                $this->value = $constantValue;
            }
        } else {
            $this->value = null;
        }
        $this->id = "\\$this->name";
        return $this;
    }

    /**
     * @param FuncCall $node
     * @return static
     */
    public function readObjectFromStubNode($node)
    {
        $constName = $node->args[0]->value->value;
        if (in_array($constName, ['null', 'true', 'false'])) {
            $constName = strtoupper($constName);
        }
        $this->name = $constName;
        $this->id = "\\$this->name";
        $this->value = $this->getConstValue($node->args[1]);
        $this->collectTags($node);
        $this->checkDeprecationTag($node);
        $this->stubObjectHash = spl_object_hash($this);
        return $this;
    }

    public function readMutedProblems($jsonData) {}

    /**
     * @param $node
     * @return int|string|bool|float|null
     */
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
}
