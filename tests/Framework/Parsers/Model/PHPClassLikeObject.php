<?php

namespace StubTests\Framework\Parsers\Model;

class PHPClassLikeObject extends PHPNamespacedElement
{
    /** @var PHPMethod[] */
    private array $methods = [];

    /** @var PHPClassConstant[] */
    private array $constants = [];

    /** @var PHPInterface[] */
    private array $interfaces = [];
    private bool $isFinal = false;
    private bool $isReadonly = false;

    /**
     * Attributes applied to this class-like element, kept as a parser-agnostic list.
     * Each entry is ['name' => string, 'arguments' => array], where arguments are keyed
     * by position (int) or by named-argument name (string) and hold already-evaluated
     * scalar values (e.g. the `#[Attribute(...)]` flags bitmask is stored as an int).
     *
     * @var array<int, array{name: string, arguments: array}>
     */
    private array $attributes = [];

    /** @return PHPInterface[] */
    public function getImplementedInterfaces(): array
    {
        return $this->interfaces;
    }

    public function setImplementedInterfaces(array $interfaces): void
    {
        $this->interfaces = $interfaces;
    }

    public function addImplementedInterface(PHPInterface $interface): void
    {
        $this->interfaces[] = $interface;
    }

    public function isFinal(): bool
    {
        return $this->isFinal;
    }

    public function setIsFinal(bool $isFinal): void
    {
        $this->isFinal = $isFinal;
    }

    public function isReadonly(): bool
    {
        return $this->isReadonly;
    }

    public function setIsReadonly(bool $isReadonly): void
    {
        $this->isReadonly = $isReadonly;
    }

    /** @return PHPClassConstant[] */
    public function getConstants(): array
    {
        return $this->constants;
    }

    public function setConstants(array $constants): void
    {
        $this->constants = $constants;
    }

    public function addConstant(PHPClassConstant $constant): void
    {
        $this->constants[] = $constant;
    }

    /** @return PHPMethod[] */
    public function getMethods(): array
    {
        return $this->methods;
    }

    public function setMethods(array $methods): void
    {
        $this->methods = $methods;
    }

    public function addMethod(PHPMethod $method): void
    {
        $this->methods[] = $method;
    }

    /**
     * @return array<int, array{name: string, arguments: array}>
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array<int, array{name: string, arguments: array}> $attributes
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    public function addAttribute(string $name, array $arguments = []): void
    {
        $this->attributes[] = ['name' => $name, 'arguments' => $arguments];
    }
}
