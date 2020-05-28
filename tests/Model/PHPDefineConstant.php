<?php
declare(strict_types=1);

namespace StubTests\Model;

use PhpParser\Node\Expr\FuncCall;
use function is_float;
use function is_string;

class PHPDefineConstant extends PHPConst
{
    /**
     * @param array $constant
     * @return $this
     */
    public function readObjectFromReflection($constant): self
    {
        if (is_string($constant[0])) {
            $this->name = utf8_encode($constant[0]);
        } else {
            $this->name = $constant[0];
        }
        $constantValue = $constant[1];
        if ($constantValue !== null) {
            if (is_resource($constantValue)) {
                $this->value = 'PHPSTORM_RESOURCE';
            } elseif (is_string($constantValue) || is_float($constantValue)) {
                $this->value = utf8_encode((string)$constantValue);
            } else {
                $this->value = $constantValue;
            }
        } else {
            $this->value = null;
        }
        return $this;
    }

    /**
     * @param FuncCall $node
     * @return $this
     */
    public function readObjectFromStubNode($node): self
    {
        $constName = $this->getConstantFQN($node, $node->args[0]->value->value);
        if (in_array($constName, ['null', 'true', 'false'])) {
            $constName = strtoupper($constName);
        }
        $this->name = $constName;
        $this->value = $this->getConstValue($node->args[1]);
        $this->collectTags($node);
        return $this;
    }
}
