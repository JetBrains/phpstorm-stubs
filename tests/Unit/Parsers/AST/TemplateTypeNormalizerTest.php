<?php

namespace StubTests\Unit\Parsers\AST;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Parsers\Stubs\PhpDoc\TemplateTypeNormalizer;
use StubTests\Framework\Parsers\Stubs\StubClassParser;
use StubTests\Framework\Parsers\Stubs\StubInterfaceParser;

class TemplateTypeNormalizerTest extends TestCase
{
    // ── extractTemplateNames ──────────────────────────────────────

    public function testExtractTemplateNamesFromNull(): void
    {
        self::assertSame([], TemplateTypeNormalizer::extractTemplateNames(null));
    }

    public function testExtractTemplateNames(): void
    {
        $doc = <<<'DOC'
/**
 * @template TKey
 * @template-covariant TValue
 * @template-contravariant TIn
 */
DOC;
        self::assertSame(['TKey', 'TValue', 'TIn'], TemplateTypeNormalizer::extractTemplateNames($doc));
    }

    public function testExtractTemplateNamesIgnoresTemplateExtends(): void
    {
        // @template-extends is not a template declaration and must not be picked up
        $doc = "/**\n * @template-extends Foo<int>\n * @template T\n */";
        self::assertSame(['T'], TemplateTypeNormalizer::extractTemplateNames($doc));
    }

    // ── unqualify ─────────────────────────────────────────────────

    #[DataProvider('unqualifyProvider')]
    public function testUnqualify(string $type, array $templates, string $expected): void
    {
        self::assertSame($expected, TemplateTypeNormalizer::unqualify($type, $templates));
    }

    public static function unqualifyProvider(): array
    {
        return [
            'single'             => ['\TValue', ['TValue'], 'TValue'],
            'inside generics'    => ['iterable<\TKey, \TValue>', ['TKey', 'TValue'], 'iterable<TKey, TValue>'],
            'keeps real class'   => ['\Map<\TKey, \TValue>', ['TKey', 'TValue'], '\Map<TKey, TValue>'],
            'class-string'       => ['class-string<\T>', ['T'], 'class-string<T>'],
            'array shape'        => ['array{key: \TKey, value: \TValue}', ['TKey', 'TValue'], 'array{key: TKey, value: TValue}'],
            'prefix boundary'    => ['\TValue|\TValue2', ['TValue', 'TValue2'], 'TValue|TValue2'],
            'no false strip T'   => ['\Traversable<int, \TValue>', ['T', 'TValue'], '\Traversable<int, TValue>'],
            'namespaced kept'    => ['\Foo\TValue', ['TValue'], '\Foo\TValue'],
            'no templates'       => ['\TValue', [], '\TValue'],
            'already bare'       => ['array<TKey, TValue>', ['TKey', 'TValue'], 'array<TKey, TValue>'],
        ];
    }

    public function testUnqualifyNullType(): void
    {
        self::assertNull(TemplateTypeNormalizer::unqualify(null, ['T']));
    }

    // ── parser integration: class/interface + method templates ────

    public function testInterfaceTemplatesAreStoredBare(): void
    {
        $stub = <<<'PHP'
<?php
namespace Ds;
/**
 * @template TKey
 * @template TValue
 */
interface Map extends \Traversable {
  /** @return iterable<TKey, TValue> */
  public function pairs(): iterable;
  /**
   * @param TKey $key
   * @return TValue
   */
  public function get($key);
  /**
   * @template TNewValue
   * @return Map<TKey, TNewValue>
   */
  public function map(callable $cb): Map;
}
PHP;
        $interface = (new StubInterfaceParser())->parse($stub);
        $methods = [];
        foreach ($interface->getMethods() as $m) {
            $methods[$m->getName()] = $m;
        }

        self::assertSame('iterable<TKey,TValue>', $methods['pairs']->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertSame('TValue', $methods['get']->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertSame('TKey', $methods['get']->getParameters()[0]->getStubsMetadata()->getTypeFromPhpDoc());
        // Real class \Map kept FQN; class template TKey and method template TNewValue both bare
        self::assertSame('\Map<TKey,TNewValue>', $methods['map']->getStubsMetadata()->getTypeFromPhpDoc());
    }

    public function testClassPropertyAndMethodTemplatesAreStoredBare(): void
    {
        $stub = <<<'PHP'
<?php
namespace App;
/**
 * @template T
 */
class Box {
  /** @var T */
  public $value;
  /** @return T */
  public function unwrap() {}
}
PHP;
        $class = (new StubClassParser())->parse($stub);

        self::assertSame('T', $class->getProperties()[0]->getStubsMetadata()->getTypeFromPhpDoc());
        self::assertSame('T', $class->getMethods()[0]->getStubsMetadata()->getTypeFromPhpDoc());
    }
}
