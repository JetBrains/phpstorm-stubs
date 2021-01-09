<?php
declare(strict_types=1);

namespace StubTests\Model;

use Exception;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
use JetBrains\PhpStorm\Internal\PhpStormStubsElementAvailable;
use JetBrains\PhpStorm\Pure;
use PhpParser\Node;
use PhpParser\Node\AttributeGroup;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\NullableType;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\UnionType;
use ReflectionNamedType;
use ReflectionType;
use ReflectionUnionType;
use Reflector;
use stdClass;

abstract class BasePHPElement
{
    public ?string $name = null;
    public bool $stubBelongsToCore = false;
    public ?Exception $parseError = null;
    public array $mutedProblems = [];
    #[ArrayShape(['from' => 'string', 'to' => 'string'])]
    public array $availableVersionsRangeFromAttribute = [];

    abstract public function readObjectFromReflection(Reflector $reflectionObject): static;

    abstract public function readObjectFromStubNode(Node $node): static;

    abstract public function readMutedProblems(stdClass|array $jsonData): void;

    #[Pure]
    protected function getFQN(Node $node): string
    {
        $fqn = '';
        if ($node->namespacedName === null) {
            $fqn = $node->name->parts[0];
        } else {
            /**@var string $part */
            foreach ($node->namespacedName->parts as $part) {
                $fqn .= "$part\\";
            }
        }
        return rtrim($fqn, "\\");
    }

    protected static function convertReflectionTypeToString(?ReflectionType $type): string
    {
        if ($type instanceof ReflectionNamedType) {
            return (string)$type;
        }
        if ($type instanceof ReflectionUnionType) {
            $reflectionType = '';
            foreach ($type->getTypes() as $type) {
                $reflectionType .= (string)$type . '|';
            }
            return substr($reflectionType, 0, -1);
        }
        return '';
    }

    protected static function convertParsedTypeToString(Name|Identifier|NullableType|string|UnionType|null $type): string
    {
        if ($type !== null) {
            if ($type instanceof UnionType) {
                $unionType = '';
                foreach ($type->types as $type) {
                    $unionType .= self::getTypeNameFromNode($type) . '|';
                }
                return substr($unionType, 0, -1);
            } else {
                return self::getTypeNameFromNode($type);
            }
        }
        return '';
    }

    #[Pure]
    protected static function getTypeNameFromNode(Name|Identifier|NullableType|string $type): string
    {
        $nullable = false;
        $typeName = '';
        if ($type instanceof NullableType) {
            $type = $type->type;
            $nullable = true;
        }
        if (empty($type->name)) {
            if (!empty($type->parts)) {
                $typeName =  $nullable ? '?' . implode('\\', $type->parts) : implode('\\', $type->parts);
            }
        } else {
            $typeName =  $nullable ? '?' . $type->name : $type->name;
        }
        return $typeName;
    }

    /**
     * @param AttributeGroup[] $attrGroups
     * @return string|null
     */
    protected static function findTypeFromAttribute(array $attrGroups): ?string
    {
        foreach ($attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attr) {
                if ($attr->name->toString() === LanguageLevelTypeAware::class) {
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

    /**
     * @param AttributeGroup[] $attrGroups
     * @return array
     */
    protected static function findAvailableVersionsRangeFromAttribute(array $attrGroups): array
    {
        $versionRange = [];
        foreach ($attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attr) {
                if ($attr->name->toString() === PhpStormStubsElementAvailable::class) {
                    if (count($attr->args) == 2) {
                        foreach ($attr->args as $arg) {
                            $versionRange[$arg->name->name] = $arg->value->value;
                        }
                    } else {
                        $arg = $attr->args[0]->value;
                        if ($arg instanceof Array_) {
                            $value = $arg->items[0]->value;
                            if ($value instanceof String_) {
                                return ['from' => $value->value];
                            }
                        } else {
                            $rangeName = $attr->args[0]->name;
                            return $rangeName === null || $rangeName->name == 'from' ?
                                ['from' => $arg->value, 'to' => PhpVersions::getLatest()] :
                                ['from' => PhpVersions::getFirst(), 'to' => $arg->value];
                        }
                    }
                }
            }
        }
        return $versionRange;
    }

    #[Pure]
    public function hasMutedProblem(int $stubProblemType): bool
    {
        return in_array($stubProblemType, $this->mutedProblems, true);
    }
}
