<?php
declare(strict_types=1);

namespace StubTests\Model;

use phpDocumentor\Reflection\DocBlock\Tags\PropertyRead;
use phpDocumentor\Reflection\DocBlockFactory;
use PhpParser\Node\Stmt\Class_;
use ReflectionClass;
use stdClass;

class PHPClass extends BasePHPClass
{
    /**
     * @var false|string|null
     */
    public $parentClass = null;
    public $interfaces = [];
    /** @var PHPProperty[] */
    public $properties = [];

    /**
     * @param ReflectionClass $reflectionObject
     * @return static
     */
    public function readObjectFromReflection($reflectionObject)
    {
        $this->name = $reflectionObject->getName();
        $parent = $reflectionObject->getParentClass();
        if ($parent !== false) {
            $this->parentClass = $parent->getName();
        }
        $this->interfaces = $reflectionObject->getInterfaceNames();

        foreach ($reflectionObject->getMethods() as $method) {
            if ($method->getDeclaringClass()->getName() !== $this->name) {
                continue;
            }
            $this->methods[$method->name] = (new PHPMethod())->readObjectFromReflection($method);
        }

        foreach ($reflectionObject->getReflectionConstants() as $constant) {
            if ($constant->getDeclaringClass()->getName() !== $this->name) {
                continue;
            }
            $this->constants[$constant->name] = (new PHPConst())->readObjectFromReflection($constant);
        }

        foreach ($reflectionObject->getProperties() as $property) {
            if ($property->getDeclaringClass()->getName() !== $this->name) {
                continue;
            }
            $this->properties[$property->name] = (new PHPProperty())->readObjectFromReflection($property);
        }
        return $this;
    }

    /**
     * @param Class_ $node
     * @return static
     */
    public function readObjectFromStubNode($node)
    {
        $this->name = self::getFQN($node);
        $this->isFinal = $node->isFinal();
        $this->availableVersionsRangeFromAttribute = self::findAvailableVersionsRangeFromAttribute($node->attrGroups);
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
        foreach ($node->getProperties() as $property) {
            $propertyName = $property->props[0]->name->name;
            $this->properties[$propertyName] = (new PHPProperty($this->name))->readObjectFromStubNode($property);
        }
        if ($node->getDocComment() !== null) {
            $docBlock = DocBlockFactory::createInstance()->create($node->getDocComment()->getText());
            /** @var PropertyRead[] $properties */
            $properties = array_merge(
                $docBlock->getTagsByName('property-read'),
                $docBlock->getTagsByName('property')
            );
            foreach ($properties as $property) {
                $propertyName = $property->getVariableName();
                assert($propertyName !== '', "@property name is empty in class $this->name");
                $newProperty = new PHPProperty($this->name);
                $newProperty->is_static = false;
                $newProperty->access = 'public';
                $newProperty->name = $propertyName;
                $newProperty->parentName = $this->name;
                $newProperty->typesFromSignature = self::convertParsedTypeToArray($property->getType());
                assert(
                    !array_key_exists($propertyName, $this->properties),
                    "Property '$propertyName' is already declared in class '$this->name'"
                );
                $this->properties[$propertyName] = $newProperty;
            }
        }

        return $this;
    }

    /**
     * @param stdClass|array $jsonData
     */
    public function readMutedProblems($jsonData): void
    {
        foreach ($jsonData as $class) {
            if ($class->name === $this->name) {
                if (!empty($class->problems)) {
                    foreach ($class->problems as $problem) {
                        switch ($problem->description){
                            case 'wrong parent':
                                $this->mutedProblems[StubProblemType::WRONG_PARENT] = $problem->versions;
                                break;
                            case 'wrong interface':
                                $this->mutedProblems[StubProblemType::WRONG_INTERFACE] = $problem->versions;
                                break;
                            case 'missing class':
                                $this->mutedProblems[StubProblemType::STUB_IS_MISSED] = $problem->versions;
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
