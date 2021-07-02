<?php
declare(strict_types=1);

namespace StubTests\Model;

use JetBrains\PhpStorm\Internal\Optional;
use PhpParser\Node\AttributeGroup;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Param;
use PhpParser\Node\Scalar\String_;
use ReflectionParameter;
use stdClass;

class PHPParameter extends BasePHPElement
{
    public $indexInSignature = 0;
    /** @var string[] */
    public $typesFromSignature = [];
    /** @var string[] */
    public $typesFromAttribute = [];
    /** @var string[] */
    public $typesFromPhpDoc = [];
    public $is_vararg = false;
    public $is_passed_by_ref = false;
    public $isOptional = false;
    public $optionalInVersionsRange = [];
    public $defaultValue = null;

    /**
     * @param ReflectionParameter $reflectionObject
     * @return static
     */
    public function readObjectFromReflection($reflectionObject)
    {
        $this->name = $reflectionObject->name;
        $this->typesFromSignature = self::getReflectionTypeAsArray($reflectionObject->getType());
        $this->is_vararg = $reflectionObject->isVariadic();
        $this->is_passed_by_ref = $reflectionObject->isPassedByReference() && !$reflectionObject->canBePassedByValue();
        $this->isOptional = $reflectionObject->isOptional();
        $this->indexInSignature = $reflectionObject->getPosition();
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
    public function readObjectFromStubNode($node)
    {
        $this->name = $node->var->name;

        $this->typesFromAttribute = self::findTypesFromAttribute($node->attrGroups);
        $this->typesFromSignature = self::convertParsedTypeToArray($node->type);
        $this->availableVersionsRangeFromAttribute = self::findAvailableVersionsRangeFromAttribute($node->attrGroups);
        $this->is_vararg = $node->variadic;
        $this->is_passed_by_ref = $node->byRef;
        $this->defaultValue = $node->default;
        $this->optionalInVersionsRange = self::findOptionalVersionsRangeFromAttribute($node->attrGroups);
        $optionalFromAttribute = false;
        if (!empty($this->optionalInVersionsRange)) {
            $optionalFromAttribute = (doubleval(getenv('PHP_VERSION')) >= $this->optionalInVersionsRange['from'] &&
                doubleval(getenv('PHP_VERSION')) <= $this->optionalInVersionsRange['to']);
        }
        $this->isOptional = !empty($this->defaultValue) || $optionalFromAttribute;

        return $this;
    }

    /**
     * @param stdClass|array $jsonData
     */
    public function readMutedProblems($jsonData): void
    {
        foreach ($jsonData as $parameter) {
            if ($parameter->name === $this->name && !empty($parameter->problems)) {
                foreach ($parameter->problems as $problem) {
                    switch ($problem->description) {
                        case 'parameter type mismatch':
                            $this->mutedProblems[StubProblemType::PARAMETER_TYPE_MISMATCH] = $problem->versions;
                            break;
                        case 'parameter reference':
                            $this->mutedProblems[StubProblemType::PARAMETER_REFERENCE] = $problem->versions;
                            break;
                        case 'parameter vararg':
                            $this->mutedProblems[StubProblemType::PARAMETER_VARARG] = $problem->versions;
                            break;
                        case 'has scalar typehint':
                            $this->mutedProblems[StubProblemType::PARAMETER_HAS_SCALAR_TYPEHINT] = $problem->versions;
                            break;
                        case 'parameter name mismatch':
                            $this->mutedProblems[StubProblemType::PARAMETER_NAME_MISMATCH] = $problem->versions;
                            break;
                        case 'has nullable typehint':
                            $this->mutedProblems[StubProblemType::HAS_NULLABLE_TYPEHINT] = $problem->versions;
                            break;
                        case 'has union typehint':
                            $this->mutedProblems[StubProblemType::HAS_UNION_TYPEHINT] = $problem->versions;
                            break;
                        case 'has type mismatch in signature and phpdoc':
                            $this->mutedProblems[StubProblemType::TYPE_IN_PHPDOC_DIFFERS_FROM_SIGNATURE] = $problem->versions;
                            break;
                        case 'wrong default value':
                            $this->mutedProblems[StubProblemType::WRONG_PARAMETER_DEFAULT_VALUE] = $problem->versions;
                            break;
                        case 'wrong optionallity':
                            $this->mutedProblems[StubProblemType::WRONG_OPTIONALLITY] = $problem->versions;
                            break;
                    }
                }
                return;
            }
        }
    }

    /**
     * @param AttributeGroup[] $attrGroups
     * @return array
     */
    private static function findOptionalVersionsRangeFromAttribute(array $attrGroups): array
    {
        $versionRange = [];
        foreach ($attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attr) {
                if ($attr->name->toString() === Optional::class) {
                    if (count($attr->args) == 2) {
                        foreach ($attr->args as $arg) {
                            $versionRange[$arg->name->name] = (float)$arg->value->value;
                        }
                    } else {
                        $arg = $attr->args[0]->value;
                        if ($arg instanceof Array_) {
                            $value = $arg->items[0]->value;
                            if ($value instanceof String_) {
                                return ['from' => (float)$value->value];
                            }
                        } else {
                            $rangeName = $attr->args[0]->name;
                            return $rangeName === null || $rangeName->name == 'from' ?
                                ['from' => (float)$arg->value, 'to' => PhpVersions::getLatest()] :
                                ['from' => PhpVersions::getFirst(), 'to' => (float)$arg->value];
                        }
                    }
                }
            }
        }
        return $versionRange;
    }
}
