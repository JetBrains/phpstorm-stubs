<?php
declare(strict_types=1);

namespace StubTests\Model;

use RuntimeException;
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
     * @param PHPConst $constant
     */
    public function addConstant(PHPConst $constant): void
    {
        if (isset($constant->name)) {
            if (array_key_exists($constant->name, $this->constants)) {
                $amount = count(array_filter($this->constants,
                    fn(PHPConst $nextConstant) => $nextConstant->name === $constant->name));
                $this->constants[$constant->name . '_duplicated_' . $amount] = $constant;
            } else {
                $this->constants[$constant->name] = $constant;
            }
        }
    }

    /**
     * @return PHPFunction[]
     */
    public function getFunctions(): array
    {
        return $this->functions;
    }

    /**
     * @param string $name
     * @param string|null $sourceFilePath
     * @return PHPFunction|null
     * @throws RuntimeException
     */
    public function getFunction(string $name, ?string $sourceFilePath = null): ?PHPFunction
    {
        $functions = array_filter($this->functions, fn(PHPFunction $function): bool => $function->name === $name);
        if (count($functions) === 1) {
            return array_pop($functions);
        } else {
            if ($sourceFilePath !== null) {
                $functions = array_filter($functions, fn(PHPFunction $function) => $function->sourceFilePath === $sourceFilePath);
            }
            if (count($functions) > 1) {
                throw new RuntimeException("Multiple functions with name $name found");
            }
            if (!empty($functions)) {
                return array_pop($functions);
            }
        }
        return null;
    }

    public function addFunction(PHPFunction $function): void
    {
        if (isset($function->name)) {
            if (array_key_exists($function->name, $this->functions)) {
                $amount = count(array_filter($this->functions,
                    fn(PHPFunction $nextFunction) => $nextFunction->name === $function->name));
                $this->functions[$function->name . '_duplicated_' . $amount] = $function;
            } else {
                $this->functions[$function->name] = $function;
            }
        }
    }

    /**
     * @param string $name
     * @param string|null $sourceFilePath
     * @return PHPClass|null
     * @throws RuntimeException
     */
    public function getClass(string $name, ?string $sourceFilePath = null): ?PHPClass
    {
        $classes = array_filter($this->classes, fn(PHPClass $class): bool => $class->name === $name);
        if (count($classes) === 1) {
            return array_pop($classes);
        } else {
            if ($sourceFilePath !== null) {
                $classes = array_filter($classes, fn(PHPClass $class) => $class->sourceFilePath === $sourceFilePath);
            }
            if (count($classes) > 1) {
                throw new RuntimeException("Multiple classes with name $name found");
            }
            if (!empty($classes)) {
                return array_pop($classes);
            }
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
     * @return PHPClass[]
     */
    public function getCoreClasses(): array
    {
        return array_filter($this->classes, fn(PHPClass $class): bool => $class->stubBelongsToCore === true);
    }

    /**
     * @param PHPClass $class
     */
    public function addClass(PHPClass $class): void
    {
        if (isset($class->name)) {
            if (array_key_exists($class->name, $this->classes)) {
                $amount = count(array_filter($this->classes,
                    fn(PHPClass $nextClass) => $nextClass->name === $class->name));
                $this->classes[$class->name . '_duplicated_' . $amount] = $class;
            } else {
                $this->classes[$class->name] = $class;
            }
        }
    }

    /**
     * @param string $name
     * @param string|null $sourceFilePath
     * @return PHPInterface|null
     * @throws RuntimeException
     */
    public function getInterface(string $name, ?string $sourceFilePath = null): ?PHPInterface
    {
        $interfaces = array_filter($this->interfaces, fn(PHPInterface $interface): bool => $interface->name === $name);
        if (count($interfaces) === 1) {
            return array_pop($interfaces);
        } else {
            if ($sourceFilePath !== null) {
                $interfaces = array_filter($interfaces, fn(PHPInterface $interface) => $interface->sourceFilePath === $sourceFilePath);
            }
            if (count($interfaces) > 1) {
                throw new RuntimeException("Multiple interfaces with name $name found");
            }
            if (!empty($interfaces)) {
                return array_pop($interfaces);
            }
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
     * @return PHPInterface[]
     */
    public function getCoreInterfaces(): array
    {
        return array_filter($this->interfaces, fn(PHPInterface $interface): bool => $interface->stubBelongsToCore === true);
    }

    /**
     * @param PHPInterface $interface
     */
    public function addInterface(PHPInterface $interface): void
    {
        if (isset($interface->name)) {
            if (array_key_exists($interface->name, $this->interfaces)) {
                $amount = count(array_filter($this->interfaces,
                    fn(PHPInterface $nextInterface) => $nextInterface->name === $interface->name));
                $this->interfaces[$interface->name . '_duplicated_' . $amount] = $interface;
            } else {
                $this->interfaces[$interface->name] = $interface;
            }
        }
    }
}
