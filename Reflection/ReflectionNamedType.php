<?php

use JetBrains\PhpStorm\Pure;

/**
 * @since 7.1
 */
class ReflectionNamedType extends ReflectionType
{
    /**
     * Get the text of the type hint.
     *
     * @link https://php.net/manual/en/reflectionnamedtype.getname.php
     * @return string Returns the text of the type hint.
     * @since 7.1
     */
    #[Pure]
    public function getName() {}
}
