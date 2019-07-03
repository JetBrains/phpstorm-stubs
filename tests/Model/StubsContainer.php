<?php
declare(strict_types=1);

namespace StubTests\Model;

use function array_key_exists;

class StubsContainer
{
    /**
     * @var PHPConst[]
     */
    private $constants = [];
    /**
     * @var PHPFunction[]
     */
    private $functions = [];
    /**
     * @var PHPClass[]
     */
    private $classes = [];
    /**
     * @var PHPInterface[]
     */
    private $interfaces = [];

    /**
     * @return PHPConst[]
     */
    public function getConstants(): array
    {
        return $this->constants;
    }

    /**
     * @param PHPConst $constant
     */
    public function addConstant(PHPConst $constant): void
    {
        if (array_key_exists($constant->name, $this->constants)) {
            throw new \Exception($constant->name . " is already defined in stubs");
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

    /**
     * @param PHPFunction $function
     */
    public function addFunction(PHPFunction $function): void
    {
        $this->functions[$function->name] = $function;
    }

    /**
     * @param string $name
     * @return PHPClass | null
     */
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
     * @param PHPClass $class
     */
    public function addClass(PHPClass $class): void
    {
        if (array_key_exists($class->name, $this->classes)) {
            throw new \Exception($class->name . " is already defined in stubs");
        }
        $this->classes[$class->name] = $class;
    }

    /**
     * @param string $name
     * @return PHPInterface | null
     */
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
     * @param PHPInterface $interface
     */
    public function addInterface(PHPInterface $interface): void
    {
        if (array_key_exists($interface->name, $this->interfaces)) {
            throw new \Exception($interface->name . " is already defined in stubs");
        }
        $this->interfaces[$interface->name] = $interface;
    }
}
