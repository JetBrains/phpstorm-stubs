<?php

use JetBrains\PhpStorm\Pure;

/**
 * @link https://php.net/manual/en/class.reflectionenumunitcase.php
 * @since 8.1
 */
class ReflectionEnumUnitCase extends ReflectionClassConstant
{
    /**
     * Instantiates a ReflectionEnumUnitCase object
     * @link https://php.net/manual/en/reflectionenumunitcase.construct.php
     * @param object|string $class An enum instance or a name.
     * @param string $constant An enum constant name.
     */
    public function __construct(object|string $class, string $constant) {}

    /**
     * Gets the enum case object described by this reflection object
     *
     * Returns the enum case object described by this reflection object.
     *
     * @link https://php.net/manual/en/reflectionenumunitcase.getvalue.php
     * @return UnitEnum The enum case object described by this reflection object.
     */
    #[Pure]
    public function getValue(): UnitEnum {}

    /**
     * @return ReflectionEnum
     */
    #[Pure]
    public function getEnum(): ReflectionEnum {}
}
