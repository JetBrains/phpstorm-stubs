<?php

use JetBrains\PhpStorm\Pure;

/**
 * The ReflectionAttribute class provides information about an Attribute.
 * @link https://php.net/manual/en/class.reflectionattribute.php
 * @since 8.0
 *
 * @template T of object
 */
class ReflectionAttribute implements Reflector
{
    public string $name;

    /**
     * Indicates that the search for a suitable attribute should not be by
     * strict comparison, but by the inheritance chain.
     *
     * Used for the argument of flags of the "getAttribute" method.
     *
     * @since 8.0
     */
    public const IS_INSTANCEOF = 2;

    /**
     * ReflectionAttribute cannot be created explicitly.
     * @link https://php.net/manual/en/reflectionattribute.construct.php
     * @since 8.0
     */
    private function __construct() {}

    /**
     * Gets attribute name
     *
     * @link https://php.net/manual/en/reflectionattribute.getname.php
     * @return string The name of the attribute parameter.
     * @since 8.0
     */
    #[Pure]
    public function getName(): string {}

    /**
     * Returns the target of the attribute as a bit mask format.
     *
     * @link https://php.net/manual/en/reflectionattribute.gettarget.php
     * @return int Gets target of the attribute as bitmask of Attribute::TARGET_* constants.
     * @since 8.0
     */
    #[Pure]
    public function getTarget(): int {}

    /**
     * Returns {@see true} if the attribute is repeated.
     *
     * @link https://php.net/manual/en/reflectionattribute.isrepeated.php
     * @return bool Returns true when attribute is used repeatedly, otherwise false.
     * @since 8.0
     */
    #[Pure]
    public function isRepeated(): bool {}

    /**
     * Gets list of passed attribute's arguments.
     *
     * @link https://php.net/manual/en/reflectionattribute.getarguments.php
     * @return array The arguments passed to attribute.
     * @since 8.0
     */
    #[Pure]
    public function getArguments(): array {}

    /**
     * Creates a new instance of the attribute with passed arguments
     *
     * @link https://php.net/manual/en/reflectionattribute.newinstance.php
     * @return T New instance of the attribute.
     * @since 8.0
     */
    public function newInstance(): object {}

    /**
     * ReflectionAttribute cannot be cloned
     *
     * @return void
     * @since 8.0
     */
    private function __clone(): void {}

    public function __toString(): string {}
}
