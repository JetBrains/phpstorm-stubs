<?php
declare(strict_types=1);

namespace StubTests\Model;

use PhpParser\Node\Stmt\Class_;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionException;
use ReflectionMethod;

class PHPClass extends BasePHPClass
{
    public $parentClass;
    public $interfaces = [];

    /**
     * @param ReflectionClass $clazz
     * @return $this
     */
    public function readObjectFromReflection($clazz): self
    {
        try {
            $reflectionClass = new ReflectionClass($clazz);
            $this->name = $reflectionClass->getName();
            $parentClass = $reflectionClass->getParentClass();
            if ($parentClass !== false) {
                $this->parentClass = $reflectionClass->getParentClass()->getName();
            }
            $this->interfaces = $reflectionClass->getInterfaceNames();

            /**@var ReflectionMethod $method */
            foreach ($reflectionClass->getMethods() as $method) {
                if ($method->getDeclaringClass()->getName() !== $this->name) {
                    continue;
                }
                $this->methods[$method->name] = (new PHPMethod())->readObjectFromReflection($method);
            }

            /**@var ReflectionClassConstant $constant */
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
    public function readObjectFromStubNode($node): self
    {
        $this->name = $this->getFQN($node);
        $this->collectLinks($node);
        if (!empty($node->extends)) {
            $this->parentClass = '';
            foreach ($node->extends->parts as $part) {
                $this->parentClass .= "\\$part";
            }
            $this->parentClass = ltrim($this->parentClass, "\\");
        }
        if (!empty($node->implements)) {
            foreach ($node->implements as $interfaceObject) {
                $interfaceFQN = '';
                foreach ($interfaceObject->parts as $interface) {
                    $interfaceFQN .= "\\$interface";
                }
                $this->interfaces[] = ltrim($interfaceFQN, "\\");
            }
        }

        return $this;
    }
}
