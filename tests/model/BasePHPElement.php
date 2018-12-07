<?php

namespace Model;

abstract class BasePHPElement
{
    public $name;
    public $parseError;

    /**
     * @param mixed $object
     *
     * @return mixed
     */
    public abstract function serialize($object);
}