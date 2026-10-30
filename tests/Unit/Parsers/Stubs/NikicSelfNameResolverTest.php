<?php

namespace StubTests\Unit\Parsers\Stubs;

use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\NodeFinder;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\ParserFactory;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Stubs\Adapters\Nikic\NikicSelfNameResolver;

class NikicSelfNameResolverTest extends TestCase
{
    public function testSelfResolvesToTheEnclosingClassAfterANestedAnonymousClass(): void
    {
        $resolved = $this->resolveSelfFetches(<<<'PHP'
            <?php
            namespace NotLoaded\Ext;

            class Walker
            {
                public function make() { return new class {}; }

                public function __construct($mode = self::LEAVES_ONLY) {}
            }
            PHP);

        self::assertSame(['NotLoaded\Ext\Walker'], $resolved);
    }

    public function testSelfInAnAnonymousClassStaysUnresolved(): void
    {
        $resolved = $this->resolveSelfFetches(<<<'PHP'
            <?php
            class Walker
            {
                public function make() { return new class { public function f($mode = self::LEAVES_ONLY) {} }; }
            }
            PHP);

        self::assertSame(['self'], $resolved);
    }

    /**
     * @return string[] what each class constant fetch's class resolved to, in source order
     */
    private function resolveSelfFetches(string $code): array
    {
        $ast = (new ParserFactory())->createForNewestSupportedVersion()->parse($code);
        (new NodeTraverser(new NameResolver(null, ['replaceNodes' => false]), new NikicSelfNameResolver()))->traverse($ast);

        $resolved = [];
        foreach ((new NodeFinder())->findInstanceOf($ast, ClassConstFetch::class) as $fetch) {
            $resolved[] = $fetch->class->getAttribute('resolvedName')->toString();
        }
        return $resolved;
    }
}
