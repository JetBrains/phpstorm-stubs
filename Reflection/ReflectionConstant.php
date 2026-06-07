<?php
/**
 * @since 8.4
 */
class ReflectionConstant implements Reflector
{
    public string $name;

    public function __construct(string $name) {}

    public function getName(): string {}

    public function getNamespaceName(): string {}

    public function getShortName(): string {}

    public function getValue(): mixed {}

    public function isDeprecated(): bool {}

    public function __toString(): string {}

    /**
     * @since 8.5
     */
    public function getFileName(): string|false {}

    /**
     * @since 8.5
     */
    public function getExtension(): ?ReflectionExtension {}

    /**
     * @since 8.5
     */
    public function getExtensionName(): string|false {}

    /**
     * Returns an array of extension attributes.
     *
     * @template TAttributeClass of object
     * @param class-string<TAttributeClass>|null $name Name of an attribute class
     * @param int $flags Сriteria by which the attribute is searched.
     * @return ($name is null ? list<ReflectionAttribute<object>> : list<ReflectionAttribute<TAttributeClass>>)
     * @since 8.5
     */
    public function getAttributes(?string $name = null, int $flags = 0): array {}
}
