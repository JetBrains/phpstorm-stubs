<?php

use JetBrains\PhpStorm\Pure;

/**
 * @since 8.1
 */
class ReflectionIntersectionType extends ReflectionType
{
    /**
     * @link https://php.net/manual/en/reflectionintersectiontype.gettypes.php
     * @return ReflectionType[]
     */
    #[Pure]
    public function getTypes(): array {}
}
