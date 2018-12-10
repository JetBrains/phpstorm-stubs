<?php

namespace Model;

use Exception;
use ReflectionClass;
use ReflectionException;

class PHPInterface extends BasePHPClass
{
    public $parentInterfaces = [];

    /**
     * @param mixed $interface
     * @return PHPInterface
     */
    public function readObjectFromReflection($interface): self
    {
        try {
            $reflectionInterface = new ReflectionClass($interface);
            $this->name = $reflectionInterface->getName();
            foreach ($reflectionInterface->getMethods() as $method) {
                if ($method->getDeclaringClass()->getName() !== $this->name) {
                    continue;
                }
                $this->methods[$method->name] = (new PHPMethod())->readObjectFromReflection($method);
            }
            $this->parentInterfaces = $reflectionInterface->getInterfaceNames();
            foreach ($reflectionInterface->getReflectionConstants() as $constant) {
                if ($constant->getDeclaringClass()->getName() !== $this->name) {
                    continue;
                }
                $this->constants[$constant->name] = (new PHPConst())->readObjectFromReflection([$constant->name, $constant->getValue()]);
            }
        } catch (ReflectionException $ex) {
            $this->parseError = $ex;
        }
        return $this;
    }

    public function readObjectFromStubNode($node)
    {
        $interfaceName = $this->getFQN($node);
        //this will test PHPDocs
        $this->parseError = null;
        $this->collectLinks($node);
        $this->name = $interfaceName;
        $this->parentInterfaces = [];
        if (!empty($node->extends)) {
            foreach ($node->extends[0]->parts as $part) {
                array_push($this->parentInterfaces, $part);
            }
        }
        $this->constants = [];
        $this->methods = [];
        return $this;
    }
}