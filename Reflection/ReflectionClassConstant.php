<?php

use JetBrains\PhpStorm\Deprecated;
use JetBrains\PhpStorm\Immutable;
use JetBrains\PhpStorm\Internal\TentativeType;
use JetBrains\PhpStorm\Pure;

/**
 * The ReflectionClassConstant class reports information about a class constant.
 *
 * @link https://www.php.net/manual/en/class.reflectionclassconstant.php
 * @since 7.1
 */
class ReflectionClassConstant implements Reflector
{
    /**
     * @var string Constant name, same as calling the {@see ReflectionClassConstant::getName()} method
     */
    #[Immutable]
    public $name;

    /**
     * @var string Fully qualified class name where this constant was defined
     */
    #[Immutable]
    public $class;

    /**
     * @var bool
     * @since 8.1
     */
    #[Immutable]
    public bool $isFinal;

    /**
     * ReflectionClassConstant constructor.
     *
     * @param string|object $class Either a string containing the name of the class to reflect, or an object.
     * @param string $constant The name of the class constant.
     * @since 7.1
     * @link https://php.net/manual/en/reflectionclassconstant.construct.php
     */
    public function __construct($class, string $constant) {}

    /**
     * @link https://php.net/manual/en/reflectionclassconstant.export.php
     * @param string|object $class The reflection to export.
     * @param string $name The class constant name.
     * @param bool $return Setting to {@see true} will return the export, as opposed to emitting it. Setting
     * to {@see false} (the default) will do the opposite.
     * @return string|null
     * @since 7.1
     * @removed 8.0
     */
    #[Deprecated(since: "7.4")]
    public static function export($class, $name, $return = false) {}

    /**
     * Gets declaring class
     *
     * @return ReflectionClass
     * @link https://php.net/manual/en/reflectionclassconstant.getdeclaringclass.php
     * @since 7.1
     */
    #[Pure]
    #[TentativeType]
    public function getDeclaringClass(): ReflectionClass {}

    /**
     * Gets doc comments
     *
     * @return string|false The doc comment if it exists, otherwise {@see false}
     * @link https://php.net/manual/en/reflectionclassconstant.getdoccomment.php
     * @since 7.1
     */
    #[Pure]
    #[TentativeType]
    public function getDocComment(): string|false {}

    /**
     * Gets the class constant modifiers
     *
     * @return int A numeric representation of the modifiers. The actual meanings of these modifiers are described in
     * the predefined constants.
     * @link https://php.net/manual/en/reflectionclassconstant.getmodifiers.php
     * @since 7.1
     */
    #[Pure]
    #[TentativeType]
    public function getModifiers(): int {}

    /**
     * Get name of the constant
     *
     * @link https://php.net/manual/en/reflectionclassconstant.getname.php
     * @return string Returns the constant's name.
     * @since 7.1
     */
    #[Pure]
    #[TentativeType]
    public function getName(): string {}

    /**
     * Gets value
     *
     * @link https://php.net/manual/en/reflectionclassconstant.getvalue.php
     * @return mixed The value of the class constant.
     * @since 7.1
     */
    #[Pure]
    #[TentativeType]
    public function getValue(): mixed {}

    /**
     * Checks if class constant is private
     *
     * @link https://php.net/manual/en/reflectionclassconstant.isprivate.php
     * @return bool
     * @since 7.1
     */
    #[Pure]
    #[TentativeType]
    public function isPrivate(): bool {}

    /**
     * Checks if class constant is protected
     *
     * @link https://php.net/manual/en/reflectionclassconstant.isprotected.php
     * @return bool
     * @since 7.1
     */
    #[Pure]
    #[TentativeType]
    public function isProtected(): bool {}

    /**
     * Checks if class constant is public
     *
     * @link https://php.net/manual/en/reflectionclassconstant.ispublic.php
     * @return bool
     * @since 7.1
     */
    #[Pure]
    #[TentativeType]
    public function isPublic(): bool {}

    /**
     * Returns the string representation of the ReflectionClassConstant object.
     *
     * @link https://php.net/manual/en/reflectionclassconstant.tostring.php
     * @return string
     * @since 7.1
     */
    public function __toString(): string {}

    /**
     * ReflectionClassConstant cannot be cloned
     *
     * @return void
     */
    final private function __clone(): void {}
}
