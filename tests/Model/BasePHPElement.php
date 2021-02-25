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
    #[ArrayShape(['from' => 'float', 'to' => 'float'])]
    public array $availableVersionsRangeFromAttribute = [];
    public ?string $sourceFilePath = null;

    abstract public function readObjectFromReflection(Reflector $reflectionObject): static;

    abstract public function readObjectFromStubNode(Node $node): static;

    abstract public function readMutedProblems(stdClass|array $jsonData): void;

    #[Pure]
    public static function getFQN(Node $node): string
    {
        $fqn = '';
        if (!property_exists($node, 'namespacedName') || $node->namespacedName === null) {
            if (property_exists($node, 'name')) {
                $fqn = $node->name->parts[0];
            } else {
                foreach ($node->parts as $part) {
                    $fqn .= "$part\\";
                }
            }
        } else {
            /**@var string $part */
            foreach ($node->namespacedName->parts as $part) {
                $fqn .= "$part\\";
            }
        }
        return rtrim($fqn, "\\");
    }

    protected static function getReflectionTypeAsArray(?ReflectionType $type): array
    {
        $reflectionTypes = [];
        if ($type instanceof ReflectionNamedType) {
            $type->allowsNull() && $type->getName() !== 'mixed' ?
                array_push($reflectionTypes, '?' . $type->getName()) : array_push($reflectionTypes, $type->getName());
        }
        if ($type instanceof ReflectionUnionType) {
            foreach ($type->getTypes() as $type) {
                array_push($reflectionTypes, $type->getName());
            }
        }
        return $reflectionTypes;
    }

    protected static function convertParsedTypeToArray(Name|Identifier|NullableType|string|UnionType|null $type): array
    {
        $types = [];
        if ($type !== null) {
            if ($type instanceof UnionType) {
                foreach ($type->types as $type) {
                    array_push($types, self::getTypeNameFromNode($type));
                }
            } else {
                array_push($types, self::getTypeNameFromNode($type));
            }
        }
        return $types;
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
     * @return string[]
     */
    protected static function findTypesFromAttribute(array $attrGroups): array
    {
        foreach ($attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attr) {
                if ($attr->name->toString() === LanguageLevelTypeAware::class) {
                    $types = [];
                    $versionTypesMap = $attr->args[0]->value->items;
                    foreach ($versionTypesMap as $item) {
                        $types[$item->key->value] = explode('|', preg_replace('/\w+\[]/', 'array', $item->value->value));
                    }
                    $types[$attr->args[1]->name->name] = explode('|', preg_replace('/\w+\[]/', 'array', $attr->args[1]->value->value));
                    return $types;
                }
            }
        }
        return [];
    }

    /**
     * @param AttributeGroup[] $attrGroups
     * @return array
     */
    #[ArrayShape(['from' => 'float', 'to' => 'float'])]
    protected static function findAvailableVersionsRangeFromAttribute(array $attrGroups): array
    {
        $versionRange = [];
        foreach ($attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attr) {
                if ($attr->name->toString() === PhpStormStubsElementAvailable::class) {
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

    #[Pure]
    public function hasMutedProblem(int $stubProblemType): bool
    {
        return in_array($stubProblemType, $this->mutedProblems, true);
    }
}
