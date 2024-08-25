<?php

namespace StubTests\Model;

use RuntimeException;
use StubTests\Parsers\ParserUtils;
use function array_key_exists;
use function count;

class StubsContainer
{
    /**
     * @var PHPConstant[]
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
     * @var PHPEnum[]
     */
    private $enums = [];

    /**
     * @return PHPConstant[]
     */
    public function getConstants()
    {
        return $this->constants;
    }

    /**
     * @param string $constantId
     * @param string|null $sourceFilePath
     * @param true $fromReflection
     * @param true $shouldSuitCurrentPhpVersion
     * @return PHPConstant|null
     * @throws RuntimeException
     */
    public function getConstant($constantId, $sourceFilePath = null, $fromReflection = false, $shouldSuitCurrentPhpVersion = true)
    {
        if ($fromReflection) {
            $constants = array_filter($this->constants, function ($const) use ($constantId) {
                return $const->id === $constantId && $const->stubObjectHash == null;
            });
        } else {
            $constants = array_filter($this->constants, function ($const) use ($constantId, $shouldSuitCurrentPhpVersion) {
                return $const->id === $constantId && $const->duplicateOtherElement === false
                    && (!$shouldSuitCurrentPhpVersion || ParserUtils::entitySuitsCurrentPhpVersion($const));
            });
        }
        if (count($constants) === 1) {
            return array_pop($constants);
        }

        if ($sourceFilePath !== null) {
            $constants = array_filter($constants, function ($constant) use ($sourceFilePath, $shouldSuitCurrentPhpVersion) {
                return $constant->sourceFilePath === $sourceFilePath
                    && (!$shouldSuitCurrentPhpVersion || ParserUtils::entitySuitsCurrentPhpVersion($constant));
            });
        }
        if (count($constants) > 1) {
            throw new RuntimeException("Multiple constants with name $constantId found");
        }
        if (!empty($constants)) {
            return array_pop($constants);
        }
        return null;
    }

    public function addConstant($constant)
    {
        if (isset($constant->name)) {
            if (array_key_exists($constant->id, $this->constants)) {
                $amount = count(array_filter(
                    $this->constants,
                    function ($nextConstant) use ($constant) {
                        return $nextConstant->id === $constant->id;
                    }
                ));
                $constant->duplicateOtherElement = true;
                $this->constants[$constant->id . '_duplicated_' . $amount] = $constant;
            } else {
                $this->constants[$constant->id] = $constant;
            }
        }
    }

    /**
     * @return PHPFunction[]
     */
    public function getFunctions()
    {
        return $this->functions;
    }

    /**
     * @param string $id
     * @param string|null $sourceFilePath
     * @param bool $shouldSuitCurrentPhpVersion
     * @param false $fromReflection
     *
     * @return PHPFunction|null
     * @throws RuntimeException
     */
    public function getFunction($id, $sourceFilePath = null, $shouldSuitCurrentPhpVersion = true, $fromReflection = false)
    {
        if ($fromReflection) {
            $functions = array_filter($this->functions, function (PHPFunction $function) use ($id) {
                return $function->id === $id && $function->stubObjectHash == null;
            });
        } else {
            $functions = array_filter($this->functions, function (PHPFunction $function) use ($shouldSuitCurrentPhpVersion, $id) {
                return $function->id === $id && (!$shouldSuitCurrentPhpVersion || ParserUtils::entitySuitsCurrentPhpVersion($function));
            });
        }
        if (count($functions) > 1) {
            $functions = array_filter($functions, function (PHPFunction $function) {
                return $function->duplicateOtherElement === false;
            });
        }
        if (count($functions) === 1) {
            return array_pop($functions);
        }

        if ($sourceFilePath !== null) {
            $functions = array_filter($functions, function (PHPFunction $function) use ($shouldSuitCurrentPhpVersion, $sourceFilePath) {
                return $function->sourceFilePath === $sourceFilePath
                    && (!$shouldSuitCurrentPhpVersion || ParserUtils::entitySuitsCurrentPhpVersion($function));
            });
        }
        if (count($functions) > 1) {
            throw new RuntimeException("Multiple functions with name $id found");
        }
        return array_pop($functions);
    }

    public function addFunction(PHPFunction $function)
    {
        if (isset($function->id)) {
            if (array_key_exists($function->id, $this->functions)) {
                $amount = count(array_filter(
                    $this->functions,
                    function (PHPFunction $nextFunction) use ($function) {
                        return $nextFunction->id === $function->id;
                    }
                ));
                $function->duplicateOtherElement = true;
                $this->functions[$function->id . '_duplicated_' . $amount] = $function;
            } else {
                $this->functions[$function->id] = $function;
            }
        }
    }

    /**
     * @return PHPClass[]
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @param string $id
     * @param string|null $sourceFilePath
     * @param bool $shouldSuitCurrentPhpVersion
     * @param false $fromReflection
     *
     * @return PHPClass|null
     * @throws RuntimeException
     */
    public function getClass($id, $sourceFilePath = null, $shouldSuitCurrentPhpVersion = true, $fromReflection = false)
    {
        if ($fromReflection) {
            $classes = array_filter($this->classes, function (PHPClass $class) use ($id) {
                return $class->id === $id && $class->stubObjectHash == null;
            });
        } else {
            $classes = array_filter($this->classes, function (PHPClass $class) use ($shouldSuitCurrentPhpVersion, $id) {
                return $class->id === $id && (!$shouldSuitCurrentPhpVersion || ParserUtils::entitySuitsCurrentPhpVersion($class));
            });
        }
        if (count($classes) === 1) {
            return array_pop($classes);
        }

        if ($sourceFilePath !== null) {
            $classes = array_filter($classes, function (PHPClass $class) use ($shouldSuitCurrentPhpVersion, $sourceFilePath) {
                return $class->sourceFilePath === $sourceFilePath &&
                    (!$shouldSuitCurrentPhpVersion || ParserUtils::entitySuitsCurrentPhpVersion($class));
            });
        }
        if (count($classes) > 1) {
            throw new RuntimeException("Multiple classes with name $id found");
        }
        if (!empty($classes)) {
            return array_pop($classes);
        }
        return null;
    }

    public function getClassByHash(string $hash)
    {
        $classes = array_filter($this->classes, function (PHPClass $class) use ($hash) {
            return $class->stubObjectHash === $hash;
        });
        if (count($classes) > 1) {
            throw new RuntimeException("Multiple classes with name $hash found");
        }
        return array_pop($classes);
    }

    /**
     * @param string $id
     * @param string|null $sourceFilePath
     * @param bool $shouldSuitCurrentPhpVersion
     * @param true $useFQNAsName
     * @param false $fromReflection
     *
     * @return PHPEnum|null
     * @throws RuntimeException
     */
    public function getEnum($id, $sourceFilePath = null, $shouldSuitCurrentPhpVersion = true, $fromReflection = false)
    {
        $enums = array_filter($this->enums, function (PHPEnum $enum) use ($shouldSuitCurrentPhpVersion, $id) {
            return $enum->id === $id && (!$shouldSuitCurrentPhpVersion || ParserUtils::entitySuitsCurrentPhpVersion($enum));
        });
        if (count($enums) === 1) {
            return array_pop($enums);
        }

        if ($sourceFilePath !== null) {
            $enums = array_filter($enums, function (PHPEnum $enum) use ($shouldSuitCurrentPhpVersion, $sourceFilePath) {
                return $enum->sourceFilePath === $sourceFilePath &&
                    (!$shouldSuitCurrentPhpVersion || ParserUtils::entitySuitsCurrentPhpVersion($enum));
            });
        }
        if (count($enums) > 1) {
            throw new RuntimeException("Multiple enums with name $id found");
        }
        if (!empty($enums)) {
            return array_pop($enums);
        }
        return null;
    }

    public function getEnumByHash(string $hash)
    {
        $enums = array_filter($this->enums, function (PHPEnum $class) use ($hash) {
            return $class->stubObjectHash === $hash;
        });
        if (count($enums) > 1) {
            throw new RuntimeException("Multiple enums with name $hash found");
        }
        return array_pop($enums);
    }

    /**
     * @param true $shouldSuitCurrentLanguageVersion
     * @return PHPClass[]
     */
    public function getCoreClasses($shouldSuitCurrentPhpVersion = true)
    {
        return array_filter($this->classes, function (PHPClass $class) use ($shouldSuitCurrentPhpVersion) {
            return $class->stubBelongsToCore === true && (!$shouldSuitCurrentPhpVersion || ParserUtils::entitySuitsCurrentPhpVersion($class));
        });
    }

    public function addClass(PHPClass $class)
    {
        if (isset($class->id)) {
            if (array_key_exists($class->id, $this->classes)) {
                $amount = count(array_filter(
                    $this->classes,
                    function (PHPClass $nextClass) use ($class) {
                        return $nextClass->id === $class->id;
                    }
                ));
                $this->classes[$class->id . '_duplicated_' . $amount] = $class;
            } else {
                $this->classes[$class->id] = $class;
            }
        }
    }

    /**
     * @param string $id
     * @param string|null $sourceFilePath
     * @param bool $shouldSuitCurrentPhpVersion
     * @param false $fromReflection
     *
     * @return PHPInterface|null
     * @throws RuntimeException
     */
    public function getInterface($id, $sourceFilePath = null, $shouldSuitCurrentPhpVersion = true, $fromReflection = false)
    {
        if ($fromReflection) {
            $interfaces = array_filter($this->interfaces, function (PHPInterface $interface) use ($id) {
                return $interface->id === $id && $interface->stubObjectHash == null;
            });
        } else {
            $interfaces = array_filter($this->interfaces, function (PHPInterface $interface) use ($shouldSuitCurrentPhpVersion, $id) {
                return $interface->id === $id && (!$shouldSuitCurrentPhpVersion || ParserUtils::entitySuitsCurrentPhpVersion($interface));
            });
        }
        if (count($interfaces) === 1) {
            return array_pop($interfaces);
        }

        if ($sourceFilePath !== null) {
            $interfaces = array_filter($interfaces, function (PHPInterface $interface) use ($shouldSuitCurrentPhpVersion, $sourceFilePath) {
                return $interface->sourceFilePath === $sourceFilePath &&
                    (!$shouldSuitCurrentPhpVersion || ParserUtils::entitySuitsCurrentPhpVersion($interface));
            });
        }
        if (count($interfaces) > 1) {
            throw new RuntimeException("Multiple interfaces with name $id found");
        }
        if (!empty($interfaces)) {
            return array_pop($interfaces);
        }
        return null;
    }

    public function getInterfaceByHash(string $hash)
    {
        $interfaces = array_filter($this->interfaces, function (PHPInterface $class) use ($hash) {
            return $class->stubObjectHash === $hash;
        });
        if (count($interfaces) > 1) {
            throw new RuntimeException("Multiple interfaces with hash $hash found");
        }
        return array_pop($interfaces);
    }

    /**
     * @return PHPInterface[]
     */
    public function getInterfaces()
    {
        return $this->interfaces;
    }

    /**
     * @return PHPEnum[]
     */
    public function getEnums()
    {
        return $this->enums;
    }

    /**
     * @return PHPInterface[]
     */
    public function getCoreInterfaces($shouldSuitCurrentPhpVersion = true)
    {
        return array_filter($this->interfaces, function (PHPInterface $interface) use ($shouldSuitCurrentPhpVersion) {
            return $interface->stubBelongsToCore === true && (!$shouldSuitCurrentPhpVersion || ParserUtils::entitySuitsCurrentPhpVersion($interface));
        });
    }

    public function getCoreEnums($shouldSuitCurrentPhpVersion = true)
    {
        return array_filter($this->enums, function (PHPEnum $enum) use ($shouldSuitCurrentPhpVersion) {
            return $enum->stubBelongsToCore === true && (!$shouldSuitCurrentPhpVersion || ParserUtils::entitySuitsCurrentPhpVersion($enum));
        });
    }

    public function addInterface(PHPInterface $interface)
    {
        if (isset($interface->id)) {
            if (array_key_exists($interface->id, $this->interfaces)) {
                $amount = count(array_filter(
                    $this->interfaces,
                    function (PHPInterface $nextInterface) use ($interface) {
                        return $nextInterface->id === $interface->id;
                    }
                ));
                $this->interfaces[$interface->id . '_duplicated_' . $amount] = $interface;
            } else {
                $this->interfaces[$interface->id] = $interface;
            }
        }
    }

    public function addEnum(PHPEnum $enum)
    {
        if (isset($enum->id)) {
            if (array_key_exists($enum->id, $this->enums)) {
                $amount = count(array_filter(
                    $this->enums,
                    function (PHPEnum $nextEnum) use ($enum) {
                        return $nextEnum->id === $enum->id;
                    }
                ));
                $this->enums[$enum->id . '_duplicated_' . $amount] = $enum;
            } else {
                $this->enums[$enum->id] = $enum;
            }
        }
    }
}
