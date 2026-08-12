<?php

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

/**
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
     * @link https://php.net/manual/en/reflectionenum.hascase.php
     * @param string $name
     * @return bool
     */
    public function hasCase(string $name): bool {}

    /**
     * @link https://php.net/manual/en/reflectionenum.getcases.php
     * @return ReflectionEnumUnitCase[]|ReflectionEnumBackedCase[]
     */
    public function getCases(): array {}

    /**
     * @link https://php.net/manual/en/reflectionenum.getcase.php
     * @return ReflectionEnumUnitCase|ReflectionEnumBackedCase
     * @throws ReflectionException If no found single reflection object for the corresponding case
     */
    public function getCase(string $name): ReflectionEnumUnitCase {}

    /**
     * @link https://php.net/manual/en/reflectionenum.isbacked.php
     * @return bool
     */
    public function isBacked(): bool {}

    /**
     * @link https://php.net/manual/en/reflectionenum.getbackingtype.php
     * @return ReflectionType|null
     */
    #[LanguageLevelTypeAware(['8.2' => 'null|ReflectionNamedType'], default: 'null|ReflectionType')]
    public function getBackingType() {}
}
