<?php

use JetBrains\PhpStorm\Pure;

/**
 * The ReflectionEnumUnitCase class reports information about an Enum unit case, which has no scalar
 * equivalent.
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
     * Gets the reflection of the enum of this case
     * @link https://php.net/manual/en/reflectionenumunitcase.getenum.php
     * @return ReflectionEnum A ReflectionEnum instance describing the Enum this case belongs to.
     */
    #[Pure]
    public function getEnum(): ReflectionEnum {}
}
