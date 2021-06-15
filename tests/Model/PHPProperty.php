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
    public array $typesFromSignature = [];
    /** @var string[] */
    public array $typesFromAttribute = [];
    /** @var string[] */
    public array $typesFromPhpDoc = [];
    public string $access = '';
    public bool $is_static = false;

    public function __construct(public ?string $parentName = null) {}

    /**
     * @param ReflectionProperty $reflectionObject
     * @return static
     */
    public function readObjectFromReflection($reflectionObject): static
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
        $this->typesFromSignature = self::getReflectionTypeAsArray($reflectionObject->getType());;
        return $this;
    }

    /**
     * @param Property $node
     * @return static
     */
    public function readObjectFromStubNode($node): static
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
        if ($parentNode !== null){
            $this->parentName = self::getFQN($parentNode);
        }
        return $this;
    }

    public function readMutedProblems(stdClass|array $jsonData): void
    {
        foreach ($jsonData as $property) {
            if ($property->name === $this->name && !empty($property->problems)) {
                foreach ($property->problems as $problem) {
                    $this->mutedProblems[] = match ($problem) {
                        'missing property' => StubProblemType::STUB_IS_MISSED,
                        default => -1
                    };
                }
                return;
            }
        }
    }
}
