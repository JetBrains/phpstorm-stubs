<?php

namespace StubTests\Model;

use Exception;
use PhpParser\Node\Stmt\Property;
use ReflectionProperty;
use stdClass;

class PHPProperty extends BasePHPElement
{
    /** @var string[] */
    public $typesFromSignature = [];

    /** @var string[][] */
    public $typesFromAttribute = [];

    /** @var string[] */
    public $typesFromPhpDoc = [];
    public $access = '';
    public $is_static = false;
    public $parentId;
    public $isReadonly = false;

    /**
     * @param string|null $parentId
     */
    public function __construct($parentId = null)
    {
        $this->parentId = $parentId;
    }

    /**
     * @param ReflectionProperty $reflectionObject
     * @return static
     */
    public function readObjectFromReflection($reflectionObject)
    {
        $this->name = $reflectionObject->getName();
        $this->parentId = "\\{$reflectionObject->class}";
        if ($reflectionObject->isProtected()) {
            $access = 'protected';
        } elseif ($reflectionObject->isPrivate()) {
            $access = 'private';
        } else {
            $access = 'public';
        }
        $this->access = $access;
        $this->is_static = $reflectionObject->isStatic();
        if (method_exists($reflectionObject, 'getType')) {
            $this->typesFromSignature = self::getReflectionTypeAsArray($reflectionObject->getType());
        }
        if (method_exists($reflectionObject, 'isReadonly')) {
            $this->isReadonly = $reflectionObject->isReadOnly();
        }
        return $this;
    }

    /**
     * @param Property $node
     * @return static
     */
    public function readObjectFromStubNode($node)
    {
        $this->name = $node->props[0]->name->name;
        $this->collectTags($node);
        $this->is_static = $node->isStatic();
        if ($node->isProtected()) {
            $access = 'protected';
        } elseif ($node->isPrivate()) {
            $access = 'private';
        } else {
            $access = 'public';
        }
        $this->access = $access;
        $this->isReadonly = $node->isReadonly();
        $this->typesFromSignature = self::convertParsedTypeToArray($node->type);
        $this->typesFromAttribute = self::findTypesFromAttribute($node->attrGroups);
        foreach ($this->varTags as $varTag) {
            $this->typesFromPhpDoc = explode('|', (string)$varTag->getType());
        }

        $parentNode = $node->getAttribute('parent');
        if ($parentNode !== null) {
            $this->parentId = self::getFQN($parentNode);
        }
        $this->checkDeprecationTag($node);
        $this->stubObjectHash = spl_object_hash($this);
        return $this;
    }

    /**
     * @param stdClass|array $jsonData
     * @throws Exception
     */
    public function readMutedProblems($jsonData)
    {
        foreach ($jsonData as $property) {
            if ($property->name === $this->name && !empty($property->problems)) {
                foreach ($property->problems as $problem) {
                    switch ($problem->description) {
                        case 'missing property':
                            $this->mutedProblems[StubProblemType::STUB_IS_MISSED] = $problem->versions;
                            break;
                        case 'wrong readonly':
                            $this->mutedProblems[StubProblemType::WRONG_READONLY] = $problem->versions;
                            break;
                        default:
                            throw new Exception("Unexpected value $problem->description");
                    }
                }
            }
        }
    }
}
