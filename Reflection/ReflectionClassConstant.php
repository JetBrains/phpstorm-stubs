<?php

/**
 * The ReflectionClassConstant class reports information about a class constant.
 *
 * @property-read string $name Constant name, same as calling the {@see ReflectionClassConstant::getName()} method
 * @property-read string $class Fully qualified class name where this constant was defined
 *
 * @link https://www.php.net/manual/en/class.reflectionclassconstant.php
 * @since 7.1
 */
class ReflectionClassConstant implements Reflector
{
    /**
     * Indicates that the constant is public.
     *
     * @since 8.0
     */
    const IS_PUBLIC = 1;

    /**
     * Indicates that the constant is protected.
     *
     * @since 8.0
     */
    const IS_PROTECTED = 2;

    /**
     * Indicates that the constant is private.
     *
     * @since 8.0
     */
    const IS_PRIVATE = 4;

    /**
     * ReflectionClassConstant constructor.
     *
     * @param string|object $class Either a string containing the name of the class to reflect, or an object.
     * @param string $name The name of the class constant.
     * @since 7.1
     * @link https://php.net/manual/en/reflectionclassconstant.construct.php
     */
    public function __construct($class, $name)
    {
    }

    /**
     * @link https://php.net/manual/en/reflectionclassconstant.export.php
     * @param string|object $class The reflection to export.
     * @param string $name The class constant name.
     * @param bool $return Setting to {@see true} will return the export, as opposed to emitting it. Setting
     * to {@see false} (the default) will do the opposite.
     * @return string|null
     * @since 7.1
     * @deprecated 7.4
     * @removed 8.0
     */
    public static function export($class, $name, $return = false)
    {
    }

    /**
     * Gets declaring class
     *
     * @return ReflectionClass
     * @link https://php.net/manual/en/reflectionclassconstant.getdeclaringclass.php
     * @since 7.1
     */
    public function getDeclaringClass()
    {
    }

    /**
     * Gets doc comments
     *
     * @return string|false The doc comment if it exists, otherwise {@see false}
     * @link https://php.net/manual/en/reflectionclassconstant.getdoccomment.php
     * @since 7.1
     */
    public function getDocComment()
    {
    }

    /**
     * Gets the class constant modifiers
     *
     * @return int A numeric representation of the modifiers. The actual meanings of these modifiers are described in
     * the predefined constants.
     * @link https://php.net/manual/en/reflectionclassconstant.getmodifiers.php
     * @since 7.1
     */
    public function getModifiers()
    {
    }

    /**
     * Get name of the constant
     *
     * @link https://php.net/manual/en/reflectionclassconstant.getname.php
     * @return string Returns the constant's name.
     * @since 7.1
     */
    public function getName()
    {
    }

    /**
     * Gets value
     *
     * @link https://php.net/manual/en/reflectionclassconstant.getvalue.php
     * @return mixed The value of the class constant.
     * @since 7.1
     */
    public function getValue()
    {
    }

    /**
     * Checks if class constant is private
     *
     * @link https://php.net/manual/en/reflectionclassconstant.isprivate.php
     * @return bool
     * @since 7.1
     */
    public function isPrivate()
    {
    }

    /**
     * Checks if class constant is protected
     *
     * @link https://php.net/manual/en/reflectionclassconstant.isprotected.php
     * @return bool
     * @since 7.1
     */
    public function isProtected()
    {
    }

    /**
     * Checks if class constant is public
     *
     * @link https://php.net/manual/en/reflectionclassconstant.ispublic.php
     * @return bool
     * @since 7.1
     */
    public function isPublic()
    {
    }

    /**
     * Returns the string representation of the ReflectionClassConstant object.
     *
     * @link https://php.net/manual/en/reflectionclassconstant.tostring.php
     * @return string
     * @since 7.1
     */
    public function __toString()
    {
    }

    /**
     * Returns an array of constant attributes.
     *
     * @param string|null $name Name of an attribute class
     * @param int $flags Сriteria by which the attribute is searched.
     * @return ReflectionAttribute[]
     * @since 8.0
     */
    public function getAttributes($name = null, $flags = 0)
    {
    }

    /**
     * ReflectionClassConstant cannot be cloned
     *
     * @return void
     */
    final private function __clone()
    {
    }
}
