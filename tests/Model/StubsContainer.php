<?php
declare(strict_types=1);

namespace StubTests\Model;

use \RuntimeException;
use function array_key_exists;

class StubsContainer
{
    /**
     * @var PHPConst[]
     */
    private array $constants = [];
    /**
     * @var PHPFunction[]
     */
    private array $functions = [];
    /**
     * @var PHPClass[]
     */
    private array $classes = [];
    /**
     * @var PHPInterface[]
     */
    private array $interfaces = [];

    /**
     * @return PHPConst[]
     */
    public function getConstants(): array
    {
        return $this->constants;
    }

    /**
     * @throws RuntimeException
     */
    public function addConstant(PHPConst $constant): void
    {
        if (array_key_exists($constant->name, $this->constants)) {
            throw new RuntimeException($constant->name . ' is already defined in stubs');
        }
        $this->constants[$constant->name] = $constant;
    }

    /**
     * @return PHPFunction[]
     */
    public function getFunctions(): array
    {
        return $this->functions;
    }

    public function addFunction(PHPFunction $function): void
    {
        $this->functions[$function->name] = $function;
    }

    public function getClass(string $name): ?PHPClass
    {
        if (array_key_exists($name, $this->classes) && $this->classes[$name] !== null) {
            return $this->classes[$name];
        }

        return null;
    }

    /**
     * @return PHPClass[]
     */
    public function getClasses(): array
    {
        return $this->classes;
    }

    /**
     * @throws RuntimeException
     */
    public function addClass(PHPClass $class): void
    {
        if (array_key_exists($class->name, $this->classes)) {
            throw new RuntimeException($class->name . ' is already defined in stubs');
        }
        $this->classes[$class->name] = $class;
    }

    public function getInterface(string $name): ?PHPInterface
    {
        if (array_key_exists($name, $this->interfaces) && $this->interfaces[$name] !== null) {
            return $this->interfaces[$name];
        }

        return null;
    }

    /**
     * @return PHPInterface[]
     */
    public function getInterfaces(): array
    {
        return $this->interfaces;
    }

    /**
     * @throws RuntimeException
     */
    public function addInterface(PHPInterface $interface): void
    {
        if (array_key_exists($interface->name, $this->interfaces)) {
            throw new RuntimeException($interface->name . ' is already defined in stubs');
        }
        $this->interfaces[$interface->name] = $interface;
    }
}
