<?php

namespace StubTests\Unit\Parsers\Types;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Types\TypeNameResolver;

/**
 * Boundary tests for stub-source name resolution (imports + current namespace).
 *
 * Shared by TypeNodeConverter (type hints) and StubClassParser (parent class / interfaces) so that
 * class references and type hints resolve identically — which makes a regression here able to
 * change both at once. It had no direct test.
 *
 * The resolution order is: built-in → already-qualified → import alias → contains a separator →
 * relative to the current namespace. Each branch is pinned below, along with the two subtleties
 * worth knowing: built-ins are matched case-insensitively but returned with their original case,
 * and a qualified-but-unimported name is treated as global rather than namespace-relative.
 *
 * @see TypeNameResolver
 */
class TypeNameResolverTest extends TestCase
{
    private TypeNameResolver $resolver;

    protected function setUp(): void
    {
        $this->resolver = new TypeNameResolver();
    }

    #[DataProvider('builtInTypes')]
    public function testBuiltInTypesAreReturnedUnchanged(string $name)
    {
        // even with an import that would otherwise shadow it, and inside a namespace
        self::assertSame($name, $this->resolver->resolve($name, ['int' => '\\Some\\Int_'], '\\Dom'));
    }

    public static function builtInTypes(): array
    {
        return array_map(
            static fn (string $t): array => [$t],
            ['int', 'string', 'bool', 'float', 'array', 'object', 'mixed', 'void', 'never',
             'null', 'false', 'true', 'callable', 'iterable', 'resource', 'self', 'parent', 'static']
        );
    }

    /**
     * Built-ins are recognised case-insensitively, but the original spelling is preserved rather
     * than normalised — the method returns `$name`, not the lowercased form it matched on.
     */
    public function testBuiltInMatchingIsCaseInsensitiveButPreservesTheOriginalSpelling()
    {
        self::assertSame('INT', $this->resolver->resolve('INT', [], '\\Dom'));
        self::assertSame('Iterable', $this->resolver->resolve('Iterable', [], '\\Dom'));
    }

    public function testAlreadyQualifiedNamesAreLeftAlone()
    {
        self::assertSame('\\Dom\\Node', $this->resolver->resolve('\\Dom\\Node', [], '\\Other'));
        self::assertSame('\\Exception', $this->resolver->resolve('\\Exception', [], '\\Other'));
    }

    public function testImportAliasWins()
    {
        $imports = ['Exception' => '\\FFI\\Exception'];

        self::assertSame('\\FFI\\Exception', $this->resolver->resolve('Exception', $imports, '\\Dom'));
    }

    /** An import target recorded without its leading backslash still resolves fully qualified. */
    public function testImportTargetIsNormalisedToALeadingBackslash()
    {
        $imports = ['Result' => 'LDAP\\Result'];

        self::assertSame('\\LDAP\\Result', $this->resolver->resolve('Result', $imports, '\\Dom'));
    }

    public function testImportTakesPrecedenceOverTheCurrentNamespace()
    {
        $imports = ['Attr' => '\\Dom\\Attr'];

        self::assertSame('\\Dom\\Attr', $this->resolver->resolve('Attr', $imports, '\\SomewhereElse'));
    }

    /**
     * A name containing a separator but matching no import is treated as global-qualified, *not*
     * as relative to the current namespace. This is the branch most likely to be "corrected" into
     * namespace-relative resolution, which would silently repoint every such reference.
     */
    public function testQualifiedButUnimportedNameIsTreatedAsGlobal()
    {
        self::assertSame('\\LDAP\\Result', $this->resolver->resolve('LDAP\\Result', [], '\\Dom'));
    }

    public function testUnqualifiedNameResolvesRelativeToTheCurrentNamespace()
    {
        self::assertSame('\\Dom\\Node', $this->resolver->resolve('Node', [], '\\Dom'));
    }

    /** In the global namespace, '\\' must not produce a doubled separator. */
    public function testUnqualifiedNameInTheGlobalNamespaceGetsASingleBackslash()
    {
        self::assertSame('\\Node', $this->resolver->resolve('Node', [], '\\'));
    }

    public function testNestedNamespaceIsPreserved()
    {
        self::assertSame('\\Dom\\Sub\\Node', $this->resolver->resolve('Node', [], '\\Dom\\Sub'));
    }

    /**
     * Import lookup is case-sensitive: PHP class names are case-insensitive, but the import map is
     * keyed by the alias exactly as written, so a differently-cased name falls through to
     * namespace-relative resolution. Pinned as observed behaviour rather than endorsed.
     */
    public function testImportLookupIsCaseSensitive()
    {
        $imports = ['Result' => '\\LDAP\\Result'];

        self::assertSame('\\LDAP\\Result', $this->resolver->resolve('Result', $imports, '\\Dom'));
        self::assertSame('\\Dom\\result', $this->resolver->resolve('result', $imports, '\\Dom'));
    }
}
