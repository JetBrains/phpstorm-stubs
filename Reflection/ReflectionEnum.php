<?php

/**
 * @link https://php.net/manual/en/class.reflectionenum.php
 * @since 8.1
 */
class ReflectionEnum extends ReflectionClass
{
    public function __construct(object|string $objectOrClass) {}

    /**
     * @param string $name
     * @return bool
     */
    public function hasCase(string $name) {}

    /**
     * @return ReflectionEnumPureCase[]|ReflectionEnumBackedCase[]
     */
    public function getCases() {}

    /**
     * @throws ReflectionException If no found single reflection object for the corresponding case
     * @return ReflectionEnumPureCase|ReflectionEnumBackedCase
     */
    public function getCase(string $name) {}

    /**
     * @return bool
     */
    public function isBacked() {}

    /**
     * @return ReflectionType|null
     */
    public function getBackingType() {}
}
