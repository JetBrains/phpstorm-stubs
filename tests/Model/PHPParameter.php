<?php
declare(strict_types=1);

namespace StubTests\Model;

use PhpParser\Node\Expr;
use PhpParser\Node\Param;
use ReflectionParameter;
use stdClass;

class PHPParameter extends BasePHPElement
{
    public array $types = [];
    public bool $is_vararg = false;
    public bool $is_passed_by_ref = false;
    public ?Expr $defaultValue = null;

    /**
     * @param ReflectionParameter $reflectionObject
     * @return static
     */
    public function readObjectFromReflection($reflectionObject): static
    {
        $this->name = $reflectionObject->name;
        $this->types = self::getReflectionTypeAsArray($reflectionObject->getType());
        $this->is_vararg = $reflectionObject->isVariadic();
        $this->is_passed_by_ref = $reflectionObject->isPassedByReference() && !$reflectionObject->canBePassedByValue();
        return $this;
    }

    /**
     * @param Param $node
     * @return static
     */
    public function readObjectFromStubNode($node): static
    {
        $this->name = $node->var->name;

        $typeFromAttribute = self::findTypeFromAttribute($node->attrGroups);
        if ($typeFromAttribute != null) {
            array_push($this->types, ...array_map(fn(string $type) => preg_replace('/\w+\[]/', 'array', $type),
                explode('|', $typeFromAttribute)));
        } else {
            $this->types = self::convertParsedTypeToArray($node->type);
        }

        $this->is_vararg = $node->variadic;
        $this->is_passed_by_ref = $node->byRef;
        $this->defaultValue = $node->default;
        return $this;
    }

    public function readMutedProblems(stdClass|array $jsonData): void
    {
        foreach ($jsonData as $parameter) {
            if ($parameter->name === $this->name && !empty($parameter->problems)) {
                foreach ($parameter->problems as $problem) {
                    $this->mutedProblems[] = match ($problem) {
                        'parameter type mismatch' => StubProblemType::PARAMETER_TYPE_MISMATCH,
                        'parameter reference' => StubProblemType::PARAMETER_REFERENCE,
                        'parameter vararg' => StubProblemType::PARAMETER_VARARG,
                        'has scalar typehint' => StubProblemType::PARAMETER_HAS_SCALAR_TYPEHINT,
                        'parameter name mismatch' => StubProblemType::PARAMETER_NAME_MISMATCH,
                        'has nullable typehint' => StubProblemType::HAS_NULLABLE_TYPEHINT,
                        'has union typehint' => StubProblemType::HAS_UNION_TYPEHINT,
                        'has type mismatch in signature and phpdoc' => StubProblemType::TYPE_IN_PHPDOC_DIFFERS_FROM_SIGNATURE,
                        default => -1
                    };
                }
                return;
            }
        }
    }
}
