<?php

namespace StubTests\Framework\Parsers\Model;

use StubTests\Framework\Parsers\Model\PHPClassConstant;
use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Model\PHPNamespacedElement;

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
}
