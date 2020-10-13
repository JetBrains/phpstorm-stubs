<?php
declare(strict_types=1);

namespace StubTests\Model;

use PhpParser\Node\Param;
use ReflectionNamedType;
use ReflectionParameter;
use stdClass;

class PHPParameter extends BasePHPElement
{
    public string $type = '';
    public bool $is_vararg = false;
    public bool $is_passed_by_ref = false;

    /**
     * @param ReflectionParameter $reflectionObject
     * @return $this
     */
    public function readObjectFromReflection($reflectionObject): static
    {
        $this->name = $reflectionObject->name;
        $parameterType = $reflectionObject->getType();
        if ($parameterType instanceof ReflectionNamedType) {
            $this->type = $parameterType->getName();
        }
        $this->is_vararg = $reflectionObject->isVariadic();
        $this->is_passed_by_ref = $reflectionObject->isPassedByReference();
        return $this;
    }

    /**
     * @param Param $node
     * @return $this
     */
    public function readObjectFromStubNode($node): static
    {
        $this->name = $node->var->name;
        if ($node->type !== null) {
            if (empty($node->type->name)) {
                if (!empty($node->type->parts)) {
                    $this->type = $node->type->parts[0];
                }
            } else {
                $this->type = $node->type->name;
            }
        }
        $this->is_vararg = $node->variadic;
        $this->is_passed_by_ref = $node->byRef;
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
                        default => -1
                    };
                }
                return;
            }
        }
    }
}
