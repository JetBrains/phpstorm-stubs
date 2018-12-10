<?php

namespace Model;

use PhpParser\Node\Stmt\Class_;
use ReflectionClass;
use ReflectionException;

class PHPClass extends BasePHPClass
{
    public $parentClass;
    public $interfaces = [];

    /**
     * @param ReflectionClass $clazz
     * @return $this
     */
    public function readObjectFromReflection($clazz)
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
                $this->methods[$method->name] = (new PHPMethod())->readObjectFromReflection($method);
            }

            foreach ($reflectionClass->getReflectionConstants() as $constant) {
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
     * @param Class_ $node
     * @return $this
     */
    public function readObjectFromStubNode($node)
    {
        $this->name = $this->getFQN($node);
        $this->collectLinks($node);
        if (empty($node->extends)) {
            $this->parentClass = null;
        } else {
            $this->parentClass = "";
            foreach ($node->extends->parts as $part) {
                $this->parentClass .= "\\$part";
            }
            $this->parentClass = ltrim($this->parentClass, "\\");
        }
        if (!empty($node->implements)) {
            foreach ($node->implements as $interfaceObject) {
                $interfaceFQN = "";
                foreach ($interfaceObject->parts as $interface) {
                    $interfaceFQN .= "\\$interface";
                }
                array_push($this->interfaces, ltrim($interfaceFQN, "\\"));
            }
        }

        return $this;
    }
}