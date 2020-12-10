<?php
declare(strict_types=1);

namespace StubTests\Model;

use PhpParser\Node\Expr;
use PhpParser\Node\Param;
use ReflectionParameter;
use stdClass;

class PHPParameter extends BasePHPElement
{
    public string $type = '';
    public bool $is_vararg = false;
    public bool $is_passed_by_ref = false;
    public ?Expr $defaultValue = null;

    /**
     * @param ReflectionParameter $reflectionObject
     * @return $this
     */
    public function readObjectFromReflection($reflectionObject): static
    {
        $this->name = $reflectionObject->name;
        $this->type = self::convertReflectionTypeToString($reflectionObject->getType());
        $this->is_vararg = $reflectionObject->isVariadic();
        $this->is_passed_by_ref = $reflectionObject->isPassedByReference() && !$reflectionObject->canBePassedByValue();
        return $this;
    }

    /**
     * @param Param $node
     * @return $this
     */
    public function readObjectFromStubNode($node): static
    {
        $this->name = $node->var->name;

        $typeFromAttribute = self::findTypeFromAttribute($node->attrGroups);
        if ($typeFromAttribute != null) {
            $this->type = $typeFromAttribute;
        } else {
            $this->type = self::convertParsedTypeToString($node->type);
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
                        default => -1
                    };
                }
                return;
            }
        }
    }
}
