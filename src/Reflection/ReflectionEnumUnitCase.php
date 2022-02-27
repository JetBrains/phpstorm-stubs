<?php

/**
 * @link https://php.net/manual/en/class.reflectionenumunitcase.php
 * @since 8.1
 */
class ReflectionEnumUnitCase extends ReflectionClassConstant
{
    public function __construct(object|string $class, string $constant) {}

    public function getValue(): UnitEnum {}

    /**
     * @return ReflectionEnum
     */
    public function getEnum(): ReflectionEnum {}
}
