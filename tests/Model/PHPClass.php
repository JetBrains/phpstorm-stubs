<?php
declare(strict_types=1);

namespace StubTests\Model;

use PhpParser\Node\Stmt\Class_;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionException;
use ReflectionMethod;
use stdClass;

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
        $this->collectSinceDeprecatedVersions($node);
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

    public function readMutedProblems($jsonData): void
    {
        /**@var stdClass $class */
        foreach ($jsonData as $class) {
            if ($class->name === $this->name) {
                if (!empty($class->problems)) {
                    /**@var stdClass $problem */
                    foreach ($class->problems as $problem) {
                        switch ($problem) {
                            case 'wrong parent':
                                $this->mutedProblems[] = StubProblemType::WRONG_PARENT;
                                break;
                            case 'wrong interface':
                                $this->mutedProblems[] = StubProblemType::WRONG_INTERFACE;
                                break;
                            case 'missing class':
                                $this->mutedProblems[] = StubProblemType::STUB_IS_MISSED;
                                break;
                            default:
                                $this->mutedProblems[] = -1;
                                break;
                        }
                    }
                }
                if (!empty($class->methods)) {
                    foreach ($this->methods as $method) {
                        $method->readMutedProblems($class->methods);
                    }
                }
                if (!empty($class->constants)) {
                    foreach ($this->constants as $constant) {
                        $constant->readMutedProblems($class->constants);
                    }
                }
                return;
            }
        }
    }
}
