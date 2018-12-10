<?php

namespace Model;


abstract class BasePHPConstant extends PHPElementWithPHPDoc
{
    public $value;

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
}