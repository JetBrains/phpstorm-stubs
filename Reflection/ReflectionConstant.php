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
     * @since 8.5
     */
    public function getAttributes(?string $name = null, int $flags = 0): array {}
}
