<?php

/**
 * @link https://php.net/manual/en/class.reflectionenum.php
 * @since 8.1
 */
class ReflectionEnum extends ReflectionClass
{
    public function hasCase(string $name): bool {}

    /**
     * @return ReflectionEnumPureCase[]|ReflectionEnumBackedCase[]
     */
    public function getCases(): array {}

    /**
     * @throws ReflectionException If no found single reflection object for the corresponding case
     */
    public function getCase(string $name): ReflectionEnumPureCase|ReflectionEnumBackedCase {}

    public function isBacked(): bool {}

    public function getBackingType(): ?ReflectionType {}
}
