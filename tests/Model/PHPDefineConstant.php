<?php

namespace StubTests\Model;

use PhpParser\Node\Expr\FuncCall;

class PHPDefineConstant extends PHPConst
{
    /**
     * @param array $constant
     * @return $this
     */
    public function readObjectFromReflection($constant)
    {
        $this->name = utf8_encode($constant[0]);
        $this->value = is_resource($constant[1]) ? 'PHPSTORM_RESOURCE' : utf8_encode($constant[1]);
        return $this;
    }

    /**
     * @param FuncCall $node
     * @return $this
     */
    public function readObjectFromStubNode($node)
    {
        $constName = $this->getConstantFQN($node, $node->args[0]->value->value);
        if (in_array($constName, ['null', 'true', 'false'])) {
            $constName = strtoupper($constName);
        }
        $this->name = $constName;
        $this->value = $this->getConstValue($node->args[1]);
        $this->collectLinks($node);
        $this->collectSinceDeprecatedVersions($node);
        return $this;
    }
}
