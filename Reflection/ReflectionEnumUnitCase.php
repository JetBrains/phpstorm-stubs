<?php

use JetBrains\PhpStorm\Pure;

/**
 * @link https://php.net/manual/en/class.reflectionenumunitcase.php
 * @since 8.1
 * @template TReflectedClass of UnitEnum
 * @extends ReflectionClassConstant<TReflectedClass>
 */
class ReflectionEnumUnitCase extends ReflectionClassConstant
{
    /**
     * @param class-string<TReflectedClass>|TReflectedClass $class
     */
    public function __construct(object|string $class, string $constant) {}

    #[Pure]
    public function getValue(): UnitEnum {}

    /**
     * @return ReflectionEnum
     */
    #[Pure]
    public function getEnum(): ReflectionEnum {}
}
