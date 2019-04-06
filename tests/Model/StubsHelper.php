<?php
declare(strict_types=1);

namespace StubTests\Model;

use phpDocumentor\Reflection\DocBlock\DescriptionFactory;
use phpDocumentor\Reflection\DocBlock\StandardTagFactory;
use phpDocumentor\Reflection\DocBlockFactory;
use phpDocumentor\Reflection\FqsenResolver;
use phpDocumentor\Reflection\Type;
use phpDocumentor\Reflection\TypeResolver;
use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Types\ArrayArray;
use phpDocumentor\Reflection\Types\ArrayFloat;
use phpDocumentor\Reflection\Types\ArrayInt;
use phpDocumentor\Reflection\Types\ArrayString;
use phpDocumentor\Reflection\Types\Boolean;
use phpDocumentor\Reflection\Types\BooleanFalse;
use phpDocumentor\Reflection\Types\BooleanTrue;
use phpDocumentor\Reflection\Types\Callable_;
use phpDocumentor\Reflection\Types\Compound;
use phpDocumentor\Reflection\Types\Float_;
use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\Mixed_;
use phpDocumentor\Reflection\Types\Null_;
use phpDocumentor\Reflection\Types\Object_;
use phpDocumentor\Reflection\Types\Resource_;
use phpDocumentor\Reflection\Types\Scalar;
use phpDocumentor\Reflection\Types\String_;
use phpDocumentor\Reflection\Types\Void_;

class StubsHelper
{

    /**
     * Factory method for easy instantiation.
     *
     * @param string[] $additionalTags
     *
     * @return DocBlockFactory
     */
    public static function createDocBlockInstance(array $additionalTags = []): DocBlockFactory
    {
        $fqsenResolver = new FqsenResolver();
        $tagFactory = new StandardTagFactory($fqsenResolver);
        $descriptionFactory = new DescriptionFactory($tagFactory);
        $typeResolver = new TypeResolver($fqsenResolver);

        $typeResolver->addKeyword('array[]', ArrayArray::class);
        $typeResolver->addKeyword('float[]', ArrayFloat::class);
        $typeResolver->addKeyword('int[]', ArrayInt::class);
        $typeResolver->addKeyword('string[]', ArrayString::class);
        $typeResolver->addKeyword('false', BooleanFalse::class);
        $typeResolver->addKeyword('true', BooleanTrue::class);

        $tagFactory->addService($descriptionFactory);
        $tagFactory->addService($typeResolver);

        $docBlockFactory = new DocBlockFactory($descriptionFactory, $tagFactory);
        foreach ($additionalTags as $tagName => $tagHandler) {
            $docBlockFactory->registerTagHandler($tagName, $tagHandler);
        }

        return $docBlockFactory;
    }

    /**
     * @return string|string[]
     */
    public static function parseDocTypeObject(?Type $type)
    {
        if ($type instanceof Object_) {
            $tmpObject = (string)$type->getFqsen();
            if ($tmpObject) {
                return $tmpObject;
            }

            return 'object';
        }

        if ($type instanceof Compound) {
            $types = [];
            foreach ($type as $subType) {
                $types[] = self::parseDocTypeObject($subType);
            }

            return $types;
        }

        if ($type instanceof Array_) {
            $valueTypeTmp = $type->getValueType() . '';
            if ($valueTypeTmp !== 'mixed') {
                return $valueTypeTmp . '[]';
            }

            return 'array';
        }

        if ($type instanceof Null_) {
            return 'null';
        }

        if ($type instanceof Mixed_) {
            return 'mixed';
        }

        if ($type instanceof Scalar) {
            return 'string|int|float|bool';
        }

        if ($type instanceof BooleanTrue) {
            return 'true';
        }

        if ($type instanceof BooleanFalse) {
            return 'false';
        }

        if ($type instanceof Boolean) {
            return 'bool';
        }

        if ($type instanceof Callable_) {
            return 'callable';
        }

        if ($type instanceof Float_) {
            return 'float';
        }

        if ($type instanceof String_) {
            return 'string';
        }

        if ($type instanceof Integer) {
            return 'int';
        }

        if ($type instanceof Void_) {
            return 'void';
        }

        if ($type instanceof Resource_) {
            return 'resource';
        }

        return $type . '';

        // throw new \Exception('Unhandled PhpDoc type: ' . get_class($type));
    }
}
