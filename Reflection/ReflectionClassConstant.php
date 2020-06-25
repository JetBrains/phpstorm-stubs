<?php

/**
 * The ReflectionClassConstant class reports information about a class constant.
 *
 * @link https://www.php.net/manual/en/class.reflectionclassconstant.php
 * @since 7.1
 */
class ReflectionClassConstant implements Reflector
{
    /**
     * Indicates that the constant is public.
     *
     * @var int
     * @since 8.0
     */
    public const IS_PUBLIC = 1;

    /**
     * Indicates that the constant is protected.
     *
     * @var int
     * @since 8.0
     */
    public const IS_PROTECTED = 2;

    /**
     * Indicates that the constant is private.
     *
     * @var int
     * @since 8.0
     */
    public const IS_PRIVATE = 4;

    /**
     * Constant name. Read-only, throws {@see ReflectionException} in attempt to write.
     *
     * @link https://www.php.net/manual/en/class.reflectionclassconstant.php#reflectionclassconstant.props.name
     * @var string
     */
    public string $name = '';

    /**
     * Class name. Read-only, throws {@see ReflectionException} in attempt to write.
     *
     * @link https://www.php.net/manual/en/class.reflectionclassconstant.php#reflectionclassconstant.props.class
     * @var string
     */
    public string $class = '';

    /**
     * ReflectionClassConstant constructor.
     *
     * @param string|object $class Either a string containing the name of the class to reflect, or an object.
     * @param string $name The name of the class constant.
     * @since 7.1
     * @link https://php.net/manual/en/reflectionclassconstant.construct.php
     */
    public function __construct(string|object $class, string $name)
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
     * @deprecated Since PHP 7.4 and removed in 8.0
     */
    public static function export(string|object $class, string $name, bool $return = false): ?string
    {
    }

    /**
     * Gets declaring class
     *
     * @return ReflectionClass
     * @link https://php.net/manual/en/reflectionclassconstant.getdeclaringclass.php
     * @since 7.1
     */
    public function getDeclaringClass(): ReflectionClass
    {
    }

    /**
     * Gets doc comments
     *
     * @return string|false The doc comment if it exists, otherwise {@see false}
     * @link https://php.net/manual/en/reflectionclassconstant.getdoccomment.php
     * @since 7.1
     */
    public function getDocComment(): string|false
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
    public function getModifiers(): int
    {
    }

    /**
     * Get name of the constant
     *
     * @link https://php.net/manual/en/reflectionclassconstant.getname.php
     * @return string Returns the constant's name.
     * @since 7.1
     */
    public function getName(): string
    {
    }

    /**
     * Gets value
     *
     * @link https://php.net/manual/en/reflectionclassconstant.getvalue.php
     * @return mixed The value of the class constant.
     * @since 7.1
     */
    public function getValue(): mixed
    {
    }

    /**
     * Checks if class constant is private
     *
     * @link https://php.net/manual/en/reflectionclassconstant.isprivate.php
     * @return bool
     * @since 7.1
     */
    public function isPrivate(): bool
    {
    }

    /**
     * Checks if class constant is protected
     *
     * @link https://php.net/manual/en/reflectionclassconstant.isprotected.php
     * @return bool
     * @since 7.1
     */
    public function isProtected(): bool
    {
    }

    /**
     * Checks if class constant is public
     *
     * @link https://php.net/manual/en/reflectionclassconstant.ispublic.php
     * @return bool
     * @since 7.1
     */
    public function isPublic(): bool
    {
    }

    /**
     * Returns the string representation of the ReflectionClassConstant object.
     *
     * @link https://php.net/manual/en/reflectionclassconstant.tostring.php
     * @return string
     * @since 7.1
     */
    public function __toString(): string
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
    public function getAttributes(string $name = null, int $flags = 0): array
    {
    }

    /**
     * @return void
     */
    final private function __clone()
    {
    }
}
