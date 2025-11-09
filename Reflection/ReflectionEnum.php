<?php

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

/**
 * @link https://php.net/manual/en/class.reflectionenum.php
 * @since 8.1
 * @template TReflectedClass of UnitEnum
 */
class ReflectionEnum extends ReflectionClass
{
    /**
     * @param class-string<TReflectedClass>|TReflectedClass $objectOrClass
     */
    public function __construct(object|string $objectOrClass) {}

    /**
     * @param string $name
     * @return bool
     */
    public function hasCase(string $name): bool {}

    /**
     * @return (TReflectedClass is BackedEnum ? list<ReflectionEnumBackedCase<TReflectedClass>> : list<ReflectionEnumUnitCase<TReflectedClass>>)
     */
    public function getCases(): array {}

    /**
     * @param non-empty-string $name
     * @return (TReflectedClass is BackedEnum ? ReflectionEnumBackedCase<TReflectedClass> : ReflectionEnumUnitCase<TReflectedClass>)
     * @throws ReflectionException If no found single reflection object for the corresponding case
     */
    public function getCase(string $name): ReflectionEnumUnitCase {}

    /**
     * @return bool
     */
    public function isBacked(): bool {}

    /**
     * @return ReflectionType|null
     */
    #[LanguageLevelTypeAware(['8.2' => 'null|ReflectionNamedType'], default: 'null|ReflectionType')]
    public function getBackingType() {}
}
