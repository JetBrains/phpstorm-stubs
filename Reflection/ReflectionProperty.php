<?php

use JetBrains\PhpStorm\Deprecated;
use JetBrains\PhpStorm\Immutable;
use JetBrains\PhpStorm\Internal\TentativeType;
use JetBrains\PhpStorm\Pure;

/**
 * The <b>ReflectionProperty</b> class reports information about a classes
 * properties.
 *
 * @link https://php.net/manual/en/class.reflectionproperty.php
 */
class ReflectionProperty implements Reflector
{
    /**
     * Indicates that the property is static.
     *
     * @link https://www.php.net/manual/en/class.reflectionproperty.php#reflectionproperty.constants.is-static
     */
    public const IS_STATIC = 16;

    /**
     * Indicates that the property is public.
     *
     * @link https://www.php.net/manual/en/class.reflectionproperty.php#reflectionproperty.constants.is-public
     */
    public const IS_PUBLIC = 1;

    /**
     * Indicates that the property is protected.
     *
     * @link https://www.php.net/manual/en/class.reflectionproperty.php#reflectionproperty.constants.is-protected
     */
    public const IS_PROTECTED = 2;

    /**
     * Indicates that the property is private.
     *
     * @link https://www.php.net/manual/en/class.reflectionproperty.php#reflectionproperty.constants.is-private
     */
    public const IS_PRIVATE = 4;

    /**
     * @var string Name of the property, same as calling the {@see ReflectionProperty::getName()} method
     */
    #[Immutable]
    public $name;

    /**
     * @var string Fully qualified class name where this property was defined
     */
    #[Immutable]
    public $class;

    /**
     * Construct a ReflectionProperty object
     *
     * @link https://php.net/manual/en/reflectionproperty.construct.php
     * @param string|object $class The class name, that contains the property.
     * @param string $property The name of the property being reflected.
     * @throws ReflectionException if the class or property does not exist.
     */
    public function __construct($class, $property) {}

    /**
     * Export
     *
     * @link https://php.net/manual/en/reflectionproperty.export.php
     * @param mixed $class The reflection to export.
     * @param string $name The property name.
     * @param bool $return Setting to {@see true} will return the export, as
     * opposed to emitting it. Setting to {@see false} (the default) will do the
     * opposite.
     * @return string|null
     * @removed 8.0
     */
    #[Deprecated(since: "7.4")]
    public static function export($class, $name, $return = false) {}

    /**
     * To string
     *
     * @link https://php.net/manual/en/reflectionproperty.tostring.php
     * @return string
     */
    #[TentativeType]
    public function __toString(): string {}

    /**
     * Gets property name
     *
     * @link https://php.net/manual/en/reflectionproperty.getname.php
     * @return string The name of the reflected property.
     */
    #[Pure]
    #[TentativeType]
    public function getName(): string {}

    /**
     * Gets value
     *
     * @link https://php.net/manual/en/reflectionproperty.getvalue.php
     * @param object|null $object If the property is non-static an object must be
     * provided to fetch the property from. If you want to fetch the default
     * property without providing an object use {@see ReflectionClass::getDefaultProperties}
     * instead.
     * @return mixed The current value of the property.
     */
    #[Pure]
    #[TentativeType]
    public function getValue($object = null): mixed {}

    /**
     * Set property value
     *
     * @link https://php.net/manual/en/reflectionproperty.setvalue.php
     * @param mixed $objectOrValue If the property is non-static an object must
     * be provided to change the property on. If the property is static this
     * parameter is left out and only $value needs to be provided.
     * @param mixed $value The new value.
     * @return void No value is returned.
     */
    #[TentativeType]
    public function setValue($objectOrValue, $value = null): void {}

    /**
     * Checks if property is public
     *
     * @link https://php.net/manual/en/reflectionproperty.ispublic.php
     * @return bool Return {@see true} if the property is public, {@see false} otherwise.
     */
    #[Pure]
    #[TentativeType]
    public function isPublic(): bool {}

    /**
     * Checks if property is private
     *
     * @link https://php.net/manual/en/reflectionproperty.isprivate.php
     * @return bool Return {@see true} if the property is private, {@see false} otherwise.
     */
    #[Pure]
    #[TentativeType]
    public function isPrivate(): bool {}

    /**
     * Checks if property is protected
     *
     * @link https://php.net/manual/en/reflectionproperty.isprotected.php
     * @return bool Returns {@see true} if the property is protected, {@see false} otherwise.
     */
    #[Pure]
    #[TentativeType]
    public function isProtected(): bool {}

    /**
     * Checks if property is static
     *
     * @link https://php.net/manual/en/reflectionproperty.isstatic.php
     * @return bool Returns {@see true} if the property is static, {@see false} otherwise.
     */
    #[Pure]
    #[TentativeType]
    public function isStatic(): bool {}

    /**
     * Checks if default value
     *
     * @link https://php.net/manual/en/reflectionproperty.isdefault.php
     * @return bool Returns {@see true} if the property was declared at
     * compile-time, or {@see false} if it was created at run-time.
     */
    #[Pure]
    #[TentativeType]
    public function isDefault(): bool {}

    /**
     * Gets modifiers
     *
     * @link https://php.net/manual/en/reflectionproperty.getmodifiers.php
     * @return int A numeric representation of the modifiers.
     */
    #[Pure]
    #[TentativeType]
    public function getModifiers(): int {}

    /**
     * Gets declaring class
     *
     * @link https://php.net/manual/en/reflectionproperty.getdeclaringclass.php
     * @return ReflectionClass A {@see ReflectionClass} object.
     */
    #[Pure]
    #[TentativeType]
    public function getDeclaringClass(): ReflectionClass {}

    /**
     * Gets doc comment
     *
     * @link https://php.net/manual/en/reflectionproperty.getdoccomment.php
     * @return string|false The doc comment if it exists, otherwise {@see false}
     */
    #[Pure]
    #[TentativeType]
    public function getDocComment(): string|false {}

    /**
     * Set property accessibility
     *
     * @link https://php.net/manual/en/reflectionproperty.setaccessible.php
     * @param bool $accessible A boolean {@see true} to allow accessibility, or {@see false}
     * @return void No value is returned.
     */
    #[TentativeType]
    public function setAccessible($accessible): void {}

    /**
     * Clone
     *
     * @link https://php.net/manual/en/reflectionproperty.clone.php
     * @return void
     * @since 5.4
     */
    final private function __clone(): void {}
}
