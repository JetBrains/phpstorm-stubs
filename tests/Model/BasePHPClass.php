<?php
declare(strict_types=1);

namespace StubTests\Model;

abstract class BasePHPClass extends PHPElementWithPHPDoc
{
    /**
     * @var PHPMethod[]
     */
    public $methods = [];

    /**
     * @var PHPConst[]
     */
    public $constants = [];
}
