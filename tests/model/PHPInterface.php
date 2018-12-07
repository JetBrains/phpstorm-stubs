<?php

namespace Model;

use ReflectionClass;
use ReflectionException;

class PHPInterface extends BasePHPClass
{
    public $parentInterfaces = [];

    /**
     * @param mixed $interface
     * @return PHPInterface
     */
    public function serialize($interface): self
    {
        try {
            $reflectionInterface = new ReflectionClass($interface);
            $this->name = $reflectionInterface->getName();
            foreach ($reflectionInterface->getMethods() as $method) {
                if ($method->getDeclaringClass()->getName() !== $this->name) {
                    continue;
                }
                $this->methods[$method->name] = (new PHPMethod())->serialize($method);
            }
            $this->parentInterfaces = $reflectionInterface->getInterfaceNames();
            foreach ($reflectionInterface->getReflectionConstants() as $constant) {
                if ($constant->getDeclaringClass()->getName() !== $this->name) {
                    continue;
                }
                $this->constants[$constant->name] = (new PHPConst($constant->name))->serialize($constant->getValue());
            }
        } catch (ReflectionException $ex) {
            $this->parseError = $ex;
        }
        return $this;
    }
}