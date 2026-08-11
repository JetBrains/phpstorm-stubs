<?php

use JetBrains\PhpStorm\Pure;

/**
 * @link https://php.net/manual/en/class.reflectionenumbackedcase.php
 * @since 8.1
 */
class ReflectionEnumBackedCase extends ReflectionEnumUnitCase
{
    /**
     * Instantiates a ReflectionEnumBackedCase object
     * @link https://php.net/manual/en/reflectionenumbackedcase.construct.php
     * @param object|string $class An enum instance or a name.
     * @param string $constant An enum constant name.
     */
    public function __construct(object|string $class, string $constant) {}

    /**
     * Gets the scalar value backing this Enum case
     * @link https://php.net/manual/en/reflectionenumbackedcase.getbackingvalue.php
     * @return int|string The scalar equivalent of this enum case.
     */
    #[Pure]
    public function getBackingValue(): int|string {}
}
