<?php

namespace StubTests\Framework\Parsers\Stubs\Types;

use StubTests\Framework\Parsers\Model\Types\IntersectionType;
use StubTests\Framework\Parsers\Model\Types\NoType;
use StubTests\Framework\Parsers\Model\Types\NullableType;
use StubTests\Framework\Parsers\Model\Types\StandaloneType;
use StubTests\Framework\Parsers\Model\Types\UnionType;
use StubTests\Framework\Parsers\Stubs\Nodes\TypeNode;
use StubTests\Framework\Parsers\Types\TypeNameResolver;
use StubTests\Framework\Parsers\Types\TypeStringParser;

/**
 * Converts TypeNode (from stub AST) to type objects (StandaloneType, UnionType, NullableType, NoType).
 * This provides a unified type representation between stubs and reflection parsers.
 * Resolves imported class names to fully qualified names.
 */
class TypeNodeConverter
{
    private array $imports;
    private string $namespace;
    private TypeStringParser $typeStringParser;
    private TypeNameResolver $nameResolver;

    /**
     * @param array $imports Map of import aliases to fully qualified names
     * @param string $namespace Current namespace context (e.g., '\Dom' or '\\' for global)
     */
    public function __construct(array $imports = [], string $namespace = '\\')
    {
        $this->imports = $imports;
        $this->namespace = $namespace;
        $this->typeStringParser = new TypeStringParser();
        $this->nameResolver = new TypeNameResolver();
    }

    /**
     * Convert a TypeNode to a type object.
     *
     * @param TypeNode|null $typeNode The type node from stub AST
     * @return StandaloneType|UnionType|NullableType|NoType|IntersectionType The corresponding type object
     */
    public function convert(?TypeNode $typeNode): StandaloneType|UnionType|NullableType|NoType|IntersectionType
    {
        if ($typeNode === null) {
            return new NoType();
        }

        return $this->typeStringParser->parse(
            $typeNode->toString(),
            fn (string $name): string => $this->nameResolver->resolve($name, $this->imports, $this->namespace)
        );
    }
}
