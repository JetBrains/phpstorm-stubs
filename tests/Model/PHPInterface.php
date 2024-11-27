<?php

namespace StubTests\Model;

use Exception;
use PhpParser\Node\Stmt\Interface_;
use ReflectionClass;
use stdClass;

class PHPInterface extends BasePHPClass
{
    public $parentInterfaces = [];

    /**
     * @param ReflectionClass $reflectionObject
     * @return static
     */
    public function readObjectFromReflection($reflectionObject)
    {
        $this->name = $reflectionObject->getShortName();
        if (!empty($reflectionObject->getNamespaceName())) {
            $this->namespace = "\\" . $reflectionObject->getNamespaceName();
        }
        $this->id = "$this->namespace\\$this->name";
        foreach ($reflectionObject->getMethods() as $method) {
            if ($method->getDeclaringClass()->getShortName() !== $this->name) {
                continue;
            }
            $this->methods[$method->name] = (new PHPMethod())->readObjectFromReflection($method);
        }
        $this->parentInterfaces = array_map(function ($interface) {
            return "\\" . $interface;
        }, $reflectionObject->getInterfaceNames());
        if (method_exists($reflectionObject, 'getReflectionConstants')) {
            foreach ($reflectionObject->getReflectionConstants() as $constant) {
                if ($constant->getDeclaringClass()->getShortName() !== $this->name) {
                    continue;
                }
                $this->constants[$constant->name] = (new PHPClassConstant())->readObjectFromReflection($constant);
            }
        }
        return $this;
    }

    /**
     * @param Interface_ $node
     * @return static
     */
    public function readObjectFromStubNode($node)
    {
        $this->id = self::getFQN($node);
        $this->name = self::getShortName($node);
        $this->namespace = rtrim(str_replace((string)$node->name, "", "\\" . $node->namespacedName), '\\');
        $this->collectTags($node);
        $this->checkDeprecationTag($node);
        $this->availableVersionsRangeFromAttribute = self::findAvailableVersionsRangeFromAttribute($node->attrGroups);
        if (!empty($node->extends)) {
            foreach ($node->extends as $extend) {
                $this->parentInterfaces[] = $extend->toCodeString();
            }
        }
        $this->stubObjectHash = spl_object_hash($this);
        return $this;
    }

    /**
     * @param stdClass|array $jsonData
     * @throws Exception
     */
    public function readMutedProblems($jsonData)
    {
        foreach ($jsonData as $interface) {
            if ($interface->name === $this->name) {
                if (!empty($interface->problems)) {
                    foreach ($interface->problems as $problem) {
                        switch ($problem->description) {
                            case 'wrong parent':
                                $this->mutedProblems[StubProblemType::WRONG_PARENT] = $problem->versions;
                                break;
                            case 'missing interface':
                                $this->mutedProblems[StubProblemType::STUB_IS_MISSED] = $problem->versions;
                                break;
                            default:
                                throw new Exception("Unexpected value $problem->description");
                        }
                    }
                }
                if (!empty($interface->methods)) {
                    foreach ($this->methods as $method) {
                        $method->readMutedProblems($interface->methods);
                    }
                }
                if (!empty($interface->constants)) {
                    foreach ($this->constants as $constant) {
                        $constant->readMutedProblems($interface->constants);
                    }
                }
            }
        }
    }
}
