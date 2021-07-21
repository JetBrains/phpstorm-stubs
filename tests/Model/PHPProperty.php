<?php
declare(strict_types=1);

namespace StubTests\Model;

use PhpParser\Node\Stmt\Property;
use ReflectionProperty;
use stdClass;

class PHPProperty extends BasePHPElement
{
    use PHPDocElement;

    /** @var string[] */
    public $typesFromSignature = [];
    /** @var string[] */
    public $typesFromAttribute = [];
    /** @var string[] */
    public $typesFromPhpDoc = [];
    public $access = '';
    public $is_static = false;
    public $parentName = null;

    public function __construct(?string $parentName = null)
    {
        $this->parentName = $parentName;
    }

    /**
     * @param ReflectionProperty $reflectionObject
     * @return static
     */
    public function readObjectFromReflection($reflectionObject)
    {
        $this->name = $reflectionObject->getName();
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

        $this->typesFromSignature = self::convertParsedTypeToArray($node->type);
        $this->typesFromAttribute = self::findTypesFromAttribute($node->attrGroups);
        foreach ($this->varTags as $varTag) {
            $this->typesFromPhpDoc = explode('|', (string)$varTag->getType());
        }

        $parentNode = $node->getAttribute('parent');
        if ($parentNode !== null) {
            $this->parentName = self::getFQN($parentNode);
        }
        return $this;
    }

    /**
     * @param stdClass|array $jsonData
     */
    public function readMutedProblems($jsonData): void
    {
        foreach ($jsonData as $property) {
            if ($property->name === $this->name && !empty($property->problems)) {
                foreach ($property->problems as $problem) {
                    switch ($problem->description) {
                        case 'missing property':
                            $this->mutedProblems[StubProblemType::STUB_IS_MISSED] = $problem->versions;
                            break;
                    }
                }
                return;
            }
        }
    }
}
