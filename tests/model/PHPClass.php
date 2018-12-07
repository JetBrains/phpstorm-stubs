<?php

namespace Model;

use ReflectionClass;
use ReflectionException;

class PHPClass extends BasePHPClass
{
    public $parentClass;
    public $interfaces = [];

    /**
     * @param mixed $clazz
     * @return PHPClass
     */
    public function serialize($clazz): self
    {
        try {
            $reflectionClass = new ReflectionClass($clazz);
            $this->name = $reflectionClass->getName();
            $parentClass = $reflectionClass->getParentClass();
            if (false !== $parentClass) {
                $this->parentClass = $reflectionClass->getParentClass()->getName();
            }
            $this->interfaces = $reflectionClass->getInterfaceNames();
            foreach ($reflectionClass->getMethods() as $method) {
                if ($method->getDeclaringClass()->getName() !== $this->name) {
                    continue;
                }
                $this->methods[$method->name] = (new PHPMethod())->serialize($method);
            }

            foreach ($reflectionClass->getReflectionConstants() as $constant) {
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