<?php
declare(strict_types=1);

namespace StubTests\Model;

use PhpParser\Node\Param;
use ReflectionParameter;
use stdClass;

class PHPParameter extends BasePHPElement
{
    /** @var string[] */
    public array $typesFromSignature = [];
    /** @var string[] */
    public array $typesFromAttribute = [];
    public bool $is_vararg = false;
    public bool $is_passed_by_ref = false;
    public bool $isOptional = false;
    public mixed $defaultValue = null;

    /**
     * @param ReflectionParameter $reflectionObject
     * @return static
     */
    public function readObjectFromReflection($reflectionObject): static
    {
        $this->name = $reflectionObject->name;
        $this->typesFromSignature = self::getReflectionTypeAsArray($reflectionObject->getType());
        $this->is_vararg = $reflectionObject->isVariadic();
        $this->is_passed_by_ref = $reflectionObject->isPassedByReference() && !$reflectionObject->canBePassedByValue();
        $this->isOptional = $reflectionObject->isOptional();
        if ($reflectionObject->isDefaultValueAvailable()) {
            $this->defaultValue = $reflectionObject->getDefaultValue();
            if (in_array('bool', $this->typesFromSignature)) {
                $this->defaultValue = $reflectionObject->getDefaultValue() ? 'true' : 'false';
            }
        }
        return $this;
    }

    /**
     * @param Param $node
     * @return static
     */
    public function readObjectFromStubNode($node): static
    {
        $this->name = $node->var->name;

        $this->typesFromAttribute = self::findTypesFromAttribute($node->attrGroups);
        $this->typesFromSignature = self::convertParsedTypeToArray($node->type);

        $this->is_vararg = $node->variadic;
        $this->is_passed_by_ref = $node->byRef;
        $this->defaultValue = $node->default;
        $this->isOptional = $this->defaultValue !== null || $this->is_vararg;
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
                        'wrong default value' => StubProblemType::WRONG_PARAMETER_DEFAULT_VALUE,
                        default => -1
                    };
                }
                return;
            }
        }
    }
}
