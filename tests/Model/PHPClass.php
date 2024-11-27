<?php

namespace StubTests\Model;

use Exception;
use phpDocumentor\Reflection\DocBlock\Tags\PropertyRead;
use phpDocumentor\Reflection\DocBlockFactory;
use PhpParser\Node\Stmt\Class_;
use ReflectionClass;
use RuntimeException;
use stdClass;
use StubTests\Parsers\ParserUtils;
use function array_key_exists;
use function assert;
use function count;

class PHPClass extends BasePHPClass
{
    /**
     * @var false|string|null
     */
    public $parentClass;
    public $interfaces = [];

    /** @var PHPProperty[] */
    public $properties = [];
    public $isReadonly = false;

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
        $parent = $reflectionObject->getParentClass();
        if ($parent !== false) {
            if (!empty($parent->getNamespaceName())) {
                $namespace = "\\" . $parent->getNamespaceName();
                $this->parentClass = implode("\\", [$namespace, $parent->getShortName()]);
            } else {
                $this->parentClass = "\\" . $parent->getShortName();
            }
        }
        $this->interfaces = array_map(function ($interface) {
            return "\\" . $interface;
        }, $reflectionObject->getInterfaceNames());
        $this->isFinal = $reflectionObject->isFinal();
        if (method_exists($reflectionObject, 'isReadOnly')) {
            $this->isReadonly = $reflectionObject->isReadOnly();
        }
        foreach ($reflectionObject->getMethods() as $method) {
            if ($method->getDeclaringClass()->getShortName() !== $this->name) {
                continue;
            }
            $parsedMethod = (new PHPMethod())->readObjectFromReflection($method);
            $this->addMethod($parsedMethod);
        }

        if (method_exists($reflectionObject, 'getReflectionConstants')) {
            foreach ($reflectionObject->getReflectionConstants() as $constant) {
                if ($constant->getDeclaringClass()->getShortName() !== $this->name) {
                    continue;
                }
                $parsedConstant = (new PHPClassConstant())->readObjectFromReflection($constant);
                $this->addConstant($parsedConstant);
            }
        }

        foreach ($reflectionObject->getProperties() as $property) {
            if ($property->getDeclaringClass()->getShortName() !== $this->name) {
                continue;
            }
            $parsedProperty = (new PHPProperty())->readObjectFromReflection($property);
            $this->addProperty($parsedProperty);
        }
        return $this;
    }

    /**
     * @param Class_ $node
     * @return static
     */
    public function readObjectFromStubNode($node)
    {
        $this->id = $this::getFQN($node);
        $this->name = self::getShortName($node);
        $this->namespace = rtrim(str_replace((string)$node->name, "", "\\" . $node->namespacedName), '\\');
        $this->isFinal = $node->isFinal();
        $this->isReadonly = $node->isReadonly();
        $this->availableVersionsRangeFromAttribute = self::findAvailableVersionsRangeFromAttribute($node->attrGroups);
        $this->collectTags($node);
        $this->checkDeprecationTag($node);
        if (!empty($node->extends)) {
            $this->parentClass = $node->extends->toCodeString();
        }
        if (!empty($node->implements)) {
            foreach ($node->implements as $interfaceObject) {
                $this->interfaces[] = $interfaceObject->toCodeString();
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
                $newProperty = new PHPProperty($this->id);
                $newProperty->is_static = false;
                $newProperty->access = 'public';
                $newProperty->name = $propertyName;
                $newProperty->parentId = $this->id;
                $newProperty->typesFromSignature = self::convertParsedTypeToArray($property->getType());
                assert(
                    !array_key_exists($propertyName, $this->properties),
                    "Property '$propertyName' is already declared in class '$this->name'"
                );
                $this->properties[$propertyName] = $newProperty;
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
        foreach ($jsonData as $class) {
            if ($class->name === $this->name) {
                if (!empty($class->problems)) {
                    foreach ($class->problems as $problem) {
                        switch ($problem->description) {
                            case 'wrong parent':
                                $this->mutedProblems[StubProblemType::WRONG_PARENT] = $problem->versions;
                                break;
                            case 'wrong interface':
                                $this->mutedProblems[StubProblemType::WRONG_INTERFACE] = $problem->versions;
                                break;
                            case 'missing class':
                                $this->mutedProblems[StubProblemType::STUB_IS_MISSED] = $problem->versions;
                                break;
                            case 'has wrong final modifier':
                                $this->mutedProblems[StubProblemType::WRONG_FINAL_MODIFIER] = $problem->versions;
                                break;
                            default:
                                throw new Exception("Unexpected value $problem->description");
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
                if (!empty($class->properties)) {
                    foreach ($this->properties as $property) {
                        $property->readMutedProblems($class->properties);
                    }
                }
                return;
            }
        }
    }

    public function addProperty(PHPProperty $parsedProperty)
    {
        if (isset($parsedProperty->name)) {
            if (array_key_exists($parsedProperty->name, $this->properties)) {
                $amount = count(array_filter(
                    $this->properties,
                    function (PHPProperty $nextProperty) use ($parsedProperty) {
                        return $nextProperty->name === $parsedProperty->name;
                    }
                ));
                $this->properties[$parsedProperty->name . '_duplicated_' . $amount] = $parsedProperty;
            } else {
                $this->properties[$parsedProperty->name] = $parsedProperty;
            }
        }
    }

    /**
     * @param false $fromReflection
     * @return PHPProperty|null
     * @throws RuntimeException
     */
    public function getProperty($propertyName, $fromReflection = false)
    {
        if ($fromReflection) {
            $properties = array_filter($this->properties, function (PHPProperty $property) use ($propertyName) {
                return $property->name === $propertyName && $property->stubObjectHash == null;
            });
        } else {
            $properties = array_filter($this->properties, function (PHPProperty $property) use ($propertyName) {
                return $property->name === $propertyName && $property->duplicateOtherElement === false
                    && ParserUtils::entitySuitsCurrentPhpVersion($property);
            });
        }
        if (empty($properties)) {
            throw new RuntimeException("Property $propertyName not found in stubs for set language version");
        }
        return array_pop($properties);
    }
}
