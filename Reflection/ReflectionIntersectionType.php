<?php

use JetBrains\PhpStorm\Pure;

/**
 * @since 8.1
 */
class ReflectionIntersectionType extends ReflectionType
{
    /** @return list<ReflectionType> */
    #[Pure]
    public function getTypes(): array {}
}
