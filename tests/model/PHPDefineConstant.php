<?php
/**
 * Created by PhpStorm.
 * User: ifedorov
 * Date: 2018-12-08
 * Time: 21:28
 */

namespace Model;


class PHPDefineConstant extends BasePHPConstant
{
    public function readObjectFromStubNode($node)
    {
        if ($node->name->parts[0] === 'define') {
            $constName = $this->getConstantFQN($node, $node->args[0]->value->value);
            if (in_array($constName, ['null', 'true', 'false'])) {
                $constName = strtoupper($constName);
            }
            $this->name = $constName;
            $this->value = $this->getConstValue($node->args[1]);
            $this->parseError = null;
            $this->collectLinks($node);
        }
        return $this;
    }

    /**
     * @param mixed $object
     * @return mixed
     */
    public function readObjectFromReflection($object)
    {
        // TODO: Implement readObjectFromReflection() method.
    }
}