<?php
declare(strict_types=1);

namespace StubTests\Model;

use PhpParser\Node\Stmt\Class_;
use ReflectionClass;
use stdClass;

class PHPClass extends BasePHPClass
{
    /** @var false|string */
    public $parentClass;
    public array $interfaces = [];

    /**
     * @param ReflectionClass $clazz
     * @return $this
     */
    public function readObjectFromReflection($clazz): self
    {
        $this->name = $clazz->getName();
        $parent = $clazz->getParentClass();
        if ($parent !== false) {
            $this->parentClass = $parent->getName();
        }
        $this->interfaces = $clazz->getInterfaceNames();

        foreach ($clazz->getMethods() as $method) {
            if ($method->getDeclaringClass()->getName() !== $this->name) {
                continue;
            }
            $this->methods[$method->name] = (new PHPMethod())->readObjectFromReflection($method);
        }

        foreach ($clazz->getReflectionConstants() as $constant) {
            if ($constant->getDeclaringClass()->getName() !== $this->name) {
                continue;
            }
            $this->constants[$constant->name] = (new PHPConst())->readObjectFromReflection($constant);
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
        $this->collectTags($node);
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
