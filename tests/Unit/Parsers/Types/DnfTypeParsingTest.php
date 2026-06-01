<?php

namespace StubTests\Unit\Parsers\Types;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Stubs\Types\TypeNodeConverter;
use StubTests\Framework\Parsers\Model\Types\IntersectionType;
use StubTests\Framework\Parsers\Model\Types\NullableType;
use StubTests\Framework\Parsers\Model\Types\StandaloneType;
use StubTests\Framework\Parsers\Model\Types\UnionType;
use StubTests\Framework\Parsers\Stubs\StubClassParser;

/**
 * Tests for DNF (Disjunctive Normal Form) type support: int|(Foo&Bar)
 * Also covers pure intersection types, roundtrip serialization, and edge cases.
 */
class DnfTypeParsingTest extends TestCase
{
    // ===================== UnionType model =====================

    public function testUnionTypeAcceptsIntersectionMember(): void
    {
        $intersection = new IntersectionType();
        $intersection->addType(new StandaloneType('Iterator'));
        $intersection->addType(new StandaloneType('Countable'));

        $union = new UnionType();
        $union->addType(new StandaloneType('int'));
        $union->addType($intersection);

        self::assertEquals('int|(Iterator&Countable)', $union->toString());
    }

    public function testUnionTypeToStringWithOnlyStandaloneMembers(): void
    {
        $union = new UnionType();
        $union->addType(new StandaloneType('string'));
        $union->addType(new StandaloneType('int'));

        self::assertEquals('string|int', $union->toString());
    }

    public function testUnionTypeToStringWithMultipleIntersectionMembers(): void
    {
        $i1 = new IntersectionType();
        $i1->addType(new StandaloneType('Foo'));
        $i1->addType(new StandaloneType('Bar'));

        $i2 = new IntersectionType();
        $i2->addType(new StandaloneType('Baz'));
        $i2->addType(new StandaloneType('Qux'));

        $union = new UnionType();
        $union->addType(new StandaloneType('null'));
        $union->addType($i1);
        $union->addType($i2);

        self::assertEquals('null|(Foo&Bar)|(Baz&Qux)', $union->toString());
    }

    // ===================== TypeNodeConverter (string parsing) =====================

    /** @return array<string, array{string, string}> */
    public static function dnfTypeStringProvider(): array
    {
        return [
            'dnf int|(Foo&Bar)' => ['int|(\\Foo&\\Bar)',     'int|(\\Foo&\\Bar)'],
            'dnf null|(Foo&Bar)' => ['null|(\\Foo&\\Bar)',    'null|(\\Foo&\\Bar)'],
            'dnf int|(Foo&Bar)|null' => ['int|(\\Foo&\\Bar)|null', 'int|(\\Foo&\\Bar)|null'],
            'pure intersection (Foo&Bar)' => ['(\\Foo&\\Bar)',         '\\Foo&\\Bar'],
            'plain union string|int' => ['string|int',            'string|int'],
            'nullable string|null' => ['string|null',           'string|null'],
            'standalone int' => ['int',                   'int'],
        ];
    }

    #[DataProvider('dnfTypeStringProvider')]
    public function testTypeNodeConverterRoundtrip(string $typeStr, string $expected): void
    {
        // Simulate what NikicTypeNode.toString() produces for a type string like "int|(Foo&Bar)"
        // by creating a stub TypeNode wrapper
        $typeNode = new class($typeStr) implements \StubTests\Framework\Parsers\Stubs\Nodes\TypeNode {
            public function __construct(private readonly string $str) {}

            public function toString(): string { return $this->str; }
        };

        $converter = new TypeNodeConverter();
        $result = $converter->convert($typeNode);

        self::assertEquals($expected, $result->toString());
    }

    public function testTypeNodeConverterDnfProducesUnionWithIntersectionMember(): void
    {
        $typeNode = new class('int|(\\Foo&\\Bar)') implements \StubTests\Framework\Parsers\Stubs\Nodes\TypeNode {
            public function toString(): string { return 'int|(\\Foo&\\Bar)'; }
        };

        $converter = new TypeNodeConverter();
        $result = $converter->convert($typeNode);

        self::assertInstanceOf(UnionType::class, $result);
        self::assertEquals('int|(\\Foo&\\Bar)', $result->toString());
    }

    public function testTypeNodeConverterPureIntersectionProducesIntersectionType(): void
    {
        $typeNode = new class('(\\Foo&\\Bar)') implements \StubTests\Framework\Parsers\Stubs\Nodes\TypeNode {
            public function toString(): string { return '(\\Foo&\\Bar)'; }
        };

        $converter = new TypeNodeConverter();
        $result = $converter->convert($typeNode);

        self::assertInstanceOf(IntersectionType::class, $result);
        self::assertEquals('\\Foo&\\Bar', $result->toString());
    }

    public function testTypeNodeConverterNullableDnfIsUnionNotNullable(): void
    {
        // null|(Foo&Bar) should be a UnionType, not a NullableType, since the
        // non-null part is a group not a simple type
        $typeNode = new class('null|(\\Foo&\\Bar)') implements \StubTests\Framework\Parsers\Stubs\Nodes\TypeNode {
            public function toString(): string { return 'null|(\\Foo&\\Bar)'; }
        };

        $converter = new TypeNodeConverter();
        $result = $converter->convert($typeNode);

        self::assertInstanceOf(UnionType::class, $result);
        self::assertEquals('null|(\\Foo&\\Bar)', $result->toString());
    }

    // ===================== Full parsing pipeline =====================

    public function testDnfPropertyParsedFromStub(): void
    {
        $stubCode = <<<'PHP'
            <?php
            namespace Test;
            use Iterator;
            use Countable;
            class Foo {
                public int|(Iterator&Countable) $prop;
            }
            PHP;

        $parser = new StubClassParser();
        $class = $parser->parse($stubCode);
        $properties = $class->getProperties();

        self::assertCount(1, $properties);
        $type = $properties[0]->getType();

        self::assertInstanceOf(UnionType::class, $type);
        // Iterator and Countable are resolved relative to namespace Test
        self::assertStringContainsString('int', $type->toString());
        self::assertStringContainsString('Iterator', $type->toString());
        self::assertStringContainsString('Countable', $type->toString());
    }

    public function testIntersectionReturnTypeParsedFromStub(): void
    {
        $stubCode = <<<'PHP'
            <?php
            namespace Test;
            use Iterator;
            use Countable;
            function makeIterableCountable(): Iterator&Countable {}
            PHP;

        $parser = new \StubTests\Framework\Parsers\Stubs\StubFunctionParser();
        $function = $parser->parse($stubCode);

        $returnType = $function->getReturnTypeFromSignature();
        self::assertInstanceOf(IntersectionType::class, $returnType);
        self::assertStringContainsString('Iterator', $returnType->toString());
        self::assertStringContainsString('Countable', $returnType->toString());
    }
}
