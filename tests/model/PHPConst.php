<?php

namespace Model;

class PHPConst extends PHPElementWithPHPDoc
{

    public $value;

    public function __construct($aName)
    {
        $this->name = $aName;
    }

    public function serialize($value): self
    {
        $this->name = utf8_encode($this->name);
        $this->value = is_resource($value) ? 'PHPSTORM_RESOURCE' : utf8_encode($value);
        return $this;
    }
}