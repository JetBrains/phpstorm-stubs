<?php
declare(strict_types=1);

namespace StubTests\Model;

use PhpParser\Node\Expr;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\NullableType;
use PhpParser\Node\Param;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\UnionType;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;
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
        if ($parameterType instanceof ReflectionUnionType) {
            foreach ($parameterType->getTypes() as $type) {
                $this->type .= $type->getName() . '|';
            }
            $this->type = substr($this->type, 0, -1);
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
        // #[LanguageLevelTypeAware(["8.0" => "OpenSSLCertificate|string"], default: "resource|string")]
        $this->name = $node->var->name;

        $typeFromAttribute = $this->findTypeFromAttribute($node);
        if ($typeFromAttribute != null) {
            $this->type = $typeFromAttribute;
        } else {
            $type = $node->type;
            if ($type !== null) {
                if ($type instanceof UnionType) {
                    foreach ($type->types as $type) {
                        $this->type .= $this->getTypeNameFromNode($type) . '|';
                    }
                    $this->type = substr($this->type, 0, -1);
                } else {
                    $this->type = $this->getTypeNameFromNode($type);
                }
            }
        }
        if($node->default instanceof Expr\ConstFetch && $node->default->name->parts[0] === "null"){
            $this->type .= "|null";
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

    protected function getTypeNameFromNode(Name|Identifier|NullableType|string $type): string
    {
        if($type instanceof NullableType){
            $type = $type->type;
        }
        if (empty($type->name)) {
            if (!empty($type->parts)) {
                return $type->parts[0];
            }
        } else {
            return $type->name;
        }
    }

    protected function findTypeFromAttribute(Param $node): ?string
    {
        foreach ($node->attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attr) {
                if ($attr->name->toString() === "LanguageLevelTypeAware") {
                    $arg = $attr->args[0]->value;
                    if ($arg instanceof Array_) {
                        $value = $arg->items[0]->value;
                        if ($value instanceof String_) {
                            return $value->value;
                        }
                    }
                }
            }
        }
        return null;
    }
}
