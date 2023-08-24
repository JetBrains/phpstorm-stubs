<?php

namespace StubTests\Model;

use phpDocumentor\Reflection\DocBlock\Tags\PropertyRead;
use phpDocumentor\Reflection\DocBlockFactory;
use PhpParser\Node\Stmt\Enum_;
use ReflectionClass;

class PHPEnum extends PHPClass
{
    /**
     * @param ReflectionClass $reflectionObject
     * @return static
     */
    public function readObjectFromReflection($reflectionObject)
    {
        $this->name = $reflectionObject->getName();
        $this->interfaces = $reflectionObject->getInterfaceNames();
        $this->isFinal = $reflectionObject->isFinal();
        if (method_exists($reflectionObject, 'isReadOnly')) {
            $this->isReadonly = $reflectionObject->isReadOnly();
        }
        foreach ($reflectionObject->getMethods() as $method) {
            if ($method->getDeclaringClass()->getName() !== $this->name) {
                continue;
            }
            $parsedMethod = (new PHPMethod())->readObjectFromReflection($method);
            $this->addMethod($parsedMethod);
        }

        if (method_exists($reflectionObject, 'getReflectionConstants')) {
            foreach ($reflectionObject->getReflectionConstants() as $constant) {
                if ($constant->getDeclaringClass()->getName() !== $this->name) {
                    continue;
                }
                if ($constant->isEnumCase()) {
                    $enumCase = (new PHPEnumCase())->readObjectFromReflection($constant);
                    $this->addEnumCase($enumCase);
                } else {
                    $parsedConstant = (new PHPConst())->readObjectFromReflection($constant);
                    $this->addConstant($parsedConstant);
                }
            }
        }

        foreach ($reflectionObject->getProperties() as $property) {
            if ($property->getDeclaringClass()->getName() !== $this->name) {
                continue;
            }
            $parsedProperty = (new PHPProperty())->readObjectFromReflection($property);
            $this->addProperty($parsedProperty);
        }

        return $this;
    }

    /**
     * @param Enum_ $node
     * @return static
     */
    public function readObjectFromStubNode($node)
    {
        $this->name = self::getFQN($node);
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

    public function readMutedProblems($jsonData) {}
}
