<?php

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

/**
 * The ReflectionEnum class reports information about an Enum.
 * @link https://php.net/manual/en/class.reflectionenum.php
 * @since 8.1
 */
class ReflectionEnum extends ReflectionClass
{
    /**
     * Instantiates a ReflectionEnum object
     * @link https://php.net/manual/en/reflectionenum.construct.php
     * @param object|string $objectOrClass An enum instance or a name.
     * @throws ReflectionException if the class does not exist.
     */
    public function __construct(object|string $objectOrClass) {}

    /**
     * Checks for a case on an Enum
     *
     * Determines if a given case is defined on an Enum.
     *
     * @link https://php.net/manual/en/reflectionenum.hascase.php
     * @param string $name
     * @return bool
     */
    public function hasCase(string $name): bool {}

    /**
     * Returns a list of all cases on an Enum
     *
     * An Enum may contain zero or more cases. This method retrieves all defined cases, in lexical
     * order (that is, the order they appear in the source code).
     *
     * @link https://php.net/manual/en/reflectionenum.getcases.php
     * @return ReflectionEnumUnitCase[]|ReflectionEnumBackedCase[]
     */
    public function getCases(): array {}

    /**
     * Returns a specific case of an Enum
     *
     * Returns the reflection object for a specific Enum case by name. If the requested case is not
     * defined, a ReflectionException is thrown.
     *
     * @link https://php.net/manual/en/reflectionenum.getcase.php
     * @return ReflectionEnumUnitCase|ReflectionEnumBackedCase
     * @throws ReflectionException If no found single reflection object for the corresponding case
     */
    public function getCase(string $name): ReflectionEnumUnitCase {}

    /**
     * Determines if an Enum is a Backed Enum
     *
     * A Backed Enum is one that has a native backing scalar equivalent, either a string or an int.
     * Not all Enums are backed.
     *
     * @link https://php.net/manual/en/reflectionenum.isbacked.php
     * @return bool
     */
    public function isBacked(): bool {}

    /**
     * Gets the backing type of an Enum, if any
     *
     * If the enumeration is a Backed Enum, this method will return an instance of ReflectionType
     * for the backing type of the Enum. If it is not a Backed Enum, it will return null.
     *
     * @link https://php.net/manual/en/reflectionenum.getbackingtype.php
     * @return ReflectionType|null
     */
    #[LanguageLevelTypeAware(['8.2' => 'null|ReflectionNamedType'], default: 'null|ReflectionType')]
    public function getBackingType() {}
}
