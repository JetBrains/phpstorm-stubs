<?php

namespace Model;

use PhpParser\Node\Stmt\Interface_;
use ReflectionClass;
use ReflectionException;

class PHPInterface extends BasePHPClass
{
    public $parentInterfaces = [];

    /**
     * @param ReflectionClass $interface
     * @return $this
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
                $this->constants[$constant->name] = (new PHPConst())->readObjectFromReflection($constant);
            }
        } catch (ReflectionException $ex) {
            $this->parseError = $ex;
        }
        return $this;
    }

    /**
     * @param Interface_ $node
     * @return $this
     */
    public function readObjectFromStubNode($node)
    {
        $this->name = $this->getFQN($node);
        $this->collectLinks($node);
        $this->parentInterfaces = [];
        if (!empty($node->extends)) {
            foreach ($node->extends[0]->parts as $part) {
                array_push($this->parentInterfaces, $part);
            }
        }
        return $this;
    }
}