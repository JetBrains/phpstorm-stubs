<?php

namespace StubTests\Model;

use StubTests\Parsers\ParserUtils;
use function array_key_exists;
use function count;

abstract class BasePHPClass extends PHPNamespacedElement
{
    /**
     * @var PHPMethod[]
     */
    public $methods = [];

    /**
     * @var PHPClassConstant[]
     */
    public $constants = [];
    public $isFinal = false;

    public function addConstant(PHPClassConstant $parsedConstant)
    {
        if (isset($parsedConstant->name)) {
            if (array_key_exists($parsedConstant->name, $this->constants)) {
                $amount = count(array_filter(
                    $this->constants,
                    function (PHPClassConstant $nextConstant) use ($parsedConstant) {
                        return $nextConstant->name === $parsedConstant->name;
                    }
                ));
                $this->constants[$parsedConstant->name . '_duplicated_' . $amount] = $parsedConstant;
            } else {
                $this->constants[$parsedConstant->name] = $parsedConstant;
            }
        }
    }

    /**
     * @param string $constantName
     * @param true $shouldSuitCurrentPhpVersion
     * @param false $fromReflection
     * @return PHPClassConstant|null
     */
    public function getConstant($constantName, $shouldSuitCurrentPhpVersion = true, $fromReflection = false)
    {
        if ($fromReflection) {
            $constants = array_filter($this->constants, function (PHPClassConstant $constant) use ($constantName) {
               return $constant->name === $constantName && $constant->stubObjectHash == null;
            });
        } else {
            $constants = array_filter($this->constants, function (PHPClassConstant $constant) use ($constantName, $shouldSuitCurrentPhpVersion) {
                return $constant->name === $constantName && $constant->duplicateOtherElement === false
                    && (!$shouldSuitCurrentPhpVersion || ParserUtils::entitySuitsCurrentPhpVersion($constant));
            });
        }
        return array_pop($constants);
    }

    public function addMethod(PHPMethod $parsedMethod)
    {
        if (isset($parsedMethod->name)) {
            if (array_key_exists($parsedMethod->name, $this->methods)) {
                $amount = count(array_filter(
                    $this->methods,
                    function (PHPMethod $nextMethod) use ($parsedMethod) {
                        return $nextMethod->name === $parsedMethod->name;
                    }
                ));
                $this->methods[$parsedMethod->name . '_duplicated_' . $amount] = $parsedMethod;
            } else {
                $this->methods[$parsedMethod->name] = $parsedMethod;
            }
        }
    }

    /**
     * @param bool $fromReflection
     * @param string $name
     * @return PHPMethod|null
     */
    public function getMethod($name, $shouldSuitCurrentPhpVersion = true, $fromReflection = false)
    {
        if ($fromReflection) {
            $methods = array_filter($this->methods, function (PHPMethod $method) use ($name) {
                return $method->name === $name && $method->stubObjectHash == null;
            });
        } else {
            $methods = array_filter($this->methods, function (PHPMethod $method) use ($name, $shouldSuitCurrentPhpVersion) {
                return $method->name === $name && $method->duplicateOtherElement === false
                    && (!$shouldSuitCurrentPhpVersion || ParserUtils::entitySuitsCurrentPhpVersion($method));
            });
        }
        return array_pop($methods);
    }

    /**
     * @param string $methodHash
     * @return PHPMethod|null
     */
    public function getMethodByHash($methodHash)
    {
        $methods = array_filter($this->methods, function (PHPMethod $method) use ($methodHash) {
            return $method->stubObjectHash === $methodHash;
        });
        return array_pop($methods);
    }
}
