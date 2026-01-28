<?php

use JetBrains\PhpStorm\Pure;

/**
 * @link https://php.net/manual/en/class.reflectionenumbackedcase.php
 * @since 8.1
 * @template TReflectedClass of BackedEnum
 */
class ReflectionEnumBackedCase extends ReflectionEnumUnitCase
{
    /**
     * @param class-string<TReflectedClass>|TReflectedClass $class
     */
    public function __construct(object|string $class, string $constant) {}

    #[Pure]
    public function getBackingValue(): int|string {}
}
