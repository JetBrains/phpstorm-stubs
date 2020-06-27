<?php
declare(strict_types=1);

namespace StubTests\Model;

use PhpParser\Node\Stmt\Property;
use stdClass;

class PHPProperty extends BasePHPElement
{
    public ?string $parentName = null;
    public string $type;
    public string $access;
    public bool $is_static;

    public function __construct(?string $parentName = null)
    {
        $this->parentName = $parentName;
    }

    /**
     * @param \ReflectionProperty $property
     * @return $this
     */
    public function readObjectFromReflection($property): self
    {
        $this->name = $property->getName();
        if ($property->isProtected()) {
            $access = 'protected';
        } elseif ($property->isPrivate()) {
            $access = 'private';
        } else {
            $access = 'public';
        }
        $this->access = $access;
        $this->is_static = $property->isStatic();
        $this->type = "";
        if ($property->hasType()) {
            $this->type = "" . $property->getType();
        }
        return $this;
    }

    /**
     * @param Property $node
     * @return $this
     */
    public function readObjectFromStubNode($node): self
    {
        $this->name = $node->props[0]->name->name;
        $this->is_static = $node->isStatic();
        if ($node->isProtected()) {
            $access = 'protected';
        } elseif ($node->isPrivate()) {
            $access = 'private';
        } else {
            $access = 'public';
        }
        $this->access = $access;


        $this->type = $node->type->name ?? "";

        $parentNode = $node->getAttribute('parent');
        if ($parentNode !== null){
            $this->parentName = $this->getFQN($parentNode);
        }
        return $this;
    }


    public function readMutedProblems($jsonData): void
    {
        /**@var stdClass $property */
        foreach ($jsonData as $property) {
            if ($property->name === $this->name && !empty($property->problems)) {
                /**@var stdClass $problem */
                foreach ($property->problems as $problem) {
                    switch ($problem) {
                        case 'missing property':
                            $this->mutedProblems[] = StubProblemType::STUB_IS_MISSED;
                            break;
                        default:
                            $this->mutedProblems[] = -1;
                            break;
                    }
                }
                return;
            }
        }
    }
}
