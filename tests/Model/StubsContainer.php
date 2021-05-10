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
        if (isset($constant->name)) {
            if (array_key_exists($constant->name, $this->constants)) {
                $amount = count(array_filter(
                    $this->constants,
                    function (PHPConst $nextConstant) use ($constant) {
                        return $nextConstant->name === $constant->name
                ;
                    }
                ));
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
        $functions = array_filter($this->functions, function (PHPFunction $function) use ($name): bool {
            return $function->name === $name && $function->duplicateOtherElement === false
                && BasePHPElement::entitySuitesCurrentPhpVersion($function);
        });
        if (count($functions) === 1) {
            return array_pop($functions);
        } else {
            if ($sourceFilePath !== null) {
                $functions = array_filter($functions, function (PHPFunction $function) use ($sourceFilePath) {
                    return $function->sourceFilePath === $sourceFilePath
                        && BasePHPElement::entitySuitesCurrentPhpVersion($function);
                });
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
                $amount = count(array_filter(
                    $this->functions,
                    function (PHPFunction $nextFunction) use ($function) {
                        return $nextFunction->name === $function->name
                ;
                    }
                ));
                $function->duplicateOtherElement = true;
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
        $classes = array_filter($this->classes, function (PHPClass $class) use ($name): bool {
            return $class->name === $name;
        });
        if (count($classes) === 1) {
            return array_pop($classes);
        } else {
            if ($sourceFilePath !== null) {
                $classes = array_filter($classes, function (PHPClass $class) use ($sourceFilePath) {
                    return $class->sourceFilePath === $sourceFilePath;
                });
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
        return array_filter($this->classes, function (PHPClass $class): bool {
            return $class->stubBelongsToCore === true;
        });
    }

    /**
     * @param PHPClass $class
     */
    public function addClass(PHPClass $class): void
    {
        if (isset($class->name)) {
            if (array_key_exists($class->name, $this->classes)) {
                $amount = count(array_filter(
                    $this->classes,
                    function (PHPClass $nextClass) use ($class) {
                        return $nextClass->name === $class->name
                ;
                    }
                ));
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
        $interfaces = array_filter($this->interfaces, function (PHPInterface $interface) use ($name): bool {
            return $interface->name === $name;
        });
        if (count($interfaces) === 1) {
            return array_pop($interfaces);
        } else {
            if ($sourceFilePath !== null) {
                $interfaces = array_filter($interfaces, function (PHPInterface $interface) use ($sourceFilePath) {
                    return $interface->sourceFilePath === $sourceFilePath;
                });
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
        return array_filter($this->interfaces, function (PHPInterface $interface): bool {
            return $interface->stubBelongsToCore === true;
        });
    }

    /**
     * @param PHPInterface $interface
     */
    public function addInterface(PHPInterface $interface): void
    {
        if (isset($interface->name)) {
            if (array_key_exists($interface->name, $this->interfaces)) {
                $amount = count(array_filter(
                    $this->interfaces,
                    function (PHPInterface $nextInterface) use ($interface) {
                        return $nextInterface->name === $interface->name
                ;
                    }
                ));
                $this->interfaces[$interface->name . '_duplicated_' . $amount] = $interface;
            } else {
                $this->interfaces[$interface->name] = $interface;
            }
        }
    }
}
