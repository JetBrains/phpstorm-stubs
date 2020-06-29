<?php

/**
 * The ReflectionType class reports information about a function's parameters.
 *
 * @link https://www.php.net/manual/en/class.reflectiontype.php
 * @since 7.0
 */
abstract class ReflectionType implements Stringable
{
    /**
     * Checks if null is allowed
     *
     * @link https://php.net/manual/en/reflectiontype.allowsnull.php
     * @return bool Returns {@see true} if {@see null} is allowed, otherwise {@see false}
     * @since 7.0
     */
    public function allowsNull(): bool
    {
    }

    /**
     * Checks if it is a built-in type
     *
     * @link https://php.net/manual/en/reflectiontype.isbuiltin.php
     * @return bool Returns {@see true} if it's a built-in type, otherwise {@see false}
     * @since 7.0
     *
     * @deprecated Since 8.0 this method has been removed from the ReflectionType
     * class and moved to the ReflectionNamedType child.
     */
    public function isBuiltin(): bool
    {
    }

    /**
     * To string
     *
     * @link https://php.net/manual/en/reflectiontype.tostring.php
     * @return string Returns the type of the parameter.
     * @since 7.0
     * @deprecated Since PHP 7.1. Please use {@see ReflectionType::getName()} instead.
     */
    public function __toString(): string
    {
    }

    /**
     * Cloning of this class is prohibited
     *
     * @return void
     */
    final private function __clone()
    {
    }
}
