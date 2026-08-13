<?php

use JetBrains\PhpStorm\Pure;

/**
 * @since 8.1
 */
class ReflectionIntersectionType extends ReflectionType
{
    /**
     * Returns the types included in the intersection type
     *
     * Returns the reflections of types included in the intersection type.
     *
     * @link https://php.net/manual/en/reflectionintersectiontype.gettypes.php
     * @return ReflectionType[]
     */
    #[Pure]
    public function getTypes(): array {}
}
