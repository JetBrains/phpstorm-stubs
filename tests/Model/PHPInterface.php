<?php
declare(strict_types=1);

namespace StubTests\Model;

use PhpParser\Node\Stmt\Interface_;
use ReflectionClass;
use stdClass;

class PHPInterface extends BasePHPClass
{
    public array $parentInterfaces = [];

    /**
     * @param ReflectionClass $reflectionObject
     * @return static
     */
    public function readObjectFromReflection($reflectionObject): static
    {
        $this->name = $reflectionObject->getName();
        foreach ($reflectionObject->getMethods() as $method) {
            if ($method->getDeclaringClass()->getName() !== $this->name) {
                continue;
            }
            $this->methods[$method->name] = (new PHPMethod())->readObjectFromReflection($method);
        }
        $this->parentInterfaces = $reflectionObject->getInterfaceNames();
        foreach ($reflectionObject->getReflectionConstants() as $constant) {
            if ($constant->getDeclaringClass()->getName() !== $this->name) {
                continue;
            }
            $this->constants[$constant->name] = (new PHPConst())->readObjectFromReflection($constant);
        }
        return $this;
    }

    /**
     * @param Interface_ $node
     * @return static
     */
    public function readObjectFromStubNode($node): static
    {
        $this->name = self::getFQN($node);
        $this->collectTags($node);
        $this->availableVersionsRangeFromAttribute = self::findAvailableVersionsRangeFromAttribute($node->attrGroups);
        if (!empty($node->extends)) {
            foreach ($node->extends as $extend) {
                $this->parentInterfaces[] = implode('\\', $extend->parts);
            }
        }
        return $this;
    }

    public function readMutedProblems(stdClass|array $jsonData): void
    {
        foreach ($jsonData as $interface) {
            if ($interface->name === $this->name) {
                if (!empty($interface->problems)) {
                    foreach ($interface->problems as $problem) {
                        $this->mutedProblems[] = match ($problem) {
                            'wrong parent' => StubProblemType::WRONG_PARENT,
                            'missing interface' => StubProblemType::STUB_IS_MISSED,
                            default => -1
                        };
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
                return;
            }
        }
    }
}
