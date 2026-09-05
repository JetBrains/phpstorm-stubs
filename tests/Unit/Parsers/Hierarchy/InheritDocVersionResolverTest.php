<?php

namespace StubTests\Unit\Parsers\Hierarchy;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Hierarchy\InheritDocVersionResolver;
use StubTests\Framework\Model\PHPClass;
use StubTests\Framework\Model\PHPEnum;
use StubTests\Framework\Model\PHPInterface;
use StubTests\Framework\Model\PHPMethod;

/**
 * Tests for @inheritDoc since-version inheritance.
 *
 * This resolver mutates entity metadata in place and had no direct test, while its sibling
 * ClassHierarchyResolver — which it depends on having run first — does. The cases below cover each
 * parent-walking axis (implemented interfaces, parent interfaces, parent class chain), the guards
 * that decide whether a method is a candidate at all, and the cycle detection.
 *
 * @see InheritDocVersionResolver
 */
class InheritDocVersionResolverTest extends TestCase
{
    private InheritDocVersionResolver $resolver;

    protected function setUp(): void
    {
        $this->resolver = new InheritDocVersionResolver();
    }

    private function method(string $name, ?string $phpDoc = null, ?string $since = null): PHPMethod
    {
        $method = new PHPMethod();
        $method->setName($name);
        if ($phpDoc !== null) {
            $method->initStubsMetadata()->setPhpDoc($phpDoc);
        }
        if ($since !== null) {
            $method->initStubsMetadata()->setSinceVersion($since);
        }
        return $method;
    }

    private function classWith(string $id, PHPMethod ...$methods): PHPClass
    {
        $class = new PHPClass();
        $class->setId($id);
        $class->setName(ltrim($id, '\\'));
        foreach ($methods as $m) {
            $class->addMethod($m);
        }
        return $class;
    }

    private function interfaceWith(string $id, PHPMethod ...$methods): PHPInterface
    {
        $interface = new PHPInterface();
        $interface->setId($id);
        $interface->setName(ltrim($id, '\\'));
        foreach ($methods as $m) {
            $interface->addMethod($m);
        }
        return $interface;
    }

    public function testVersionIsInheritedFromAnImplementedInterface()
    {
        $child = $this->method('count', '/** {@inheritDoc} */');
        $class = $this->classWith('\\MyCollection', $child);
        $class->addImplementedInterface($this->interfaceWith('\\Countable', $this->method('count', null, '5.1')));

        $this->resolver->resolve([$class], [], []);

        self::assertSame('5.1', $child->getStubsMetadata()?->getSinceVersion());
    }

    public function testVersionIsInheritedFromTheParentClassChain()
    {
        $child = $this->method('doThing', '/** {@inheritDoc} */');
        $class = $this->classWith('\\Child', $child);

        $grandparent = $this->classWith('\\Grandparent', $this->method('doThing', null, '7.2'));
        $parent = $this->classWith('\\Parent_');
        $parent->setParentClass($grandparent);
        $class->setParentClass($parent);

        $this->resolver->resolve([$class], [], []);

        self::assertSame('7.2', $child->getStubsMetadata()?->getSinceVersion(), 'walks more than one level up');
    }

    public function testVersionIsInheritedFromAParentInterface()
    {
        $child = $this->method('getIterator', '/** {@inheritDoc} */');
        $interface = $this->interfaceWith('\\MyIterable', $child);
        $interface->addParentInterface($this->interfaceWith('\\Traversable', $this->method('getIterator', null, '5.0')));

        $this->resolver->resolve([], [$interface], []);

        self::assertSame('5.0', $child->getStubsMetadata()?->getSinceVersion());
    }

    public function testEnumsInheritFromTheirImplementedInterfaces()
    {
        $child = $this->method('cases', '/** {@inheritDoc} */');
        $enum = new PHPEnum();
        $enum->setId('\\Suit');
        $enum->setName('Suit');
        $enum->addMethod($child);
        $enum->addImplementedInterface($this->interfaceWith('\\UnitEnum', $this->method('cases', null, '8.1')));

        $this->resolver->resolve([], [], [$enum]);

        self::assertSame('8.1', $child->getStubsMetadata()?->getSinceVersion());
    }

    /** An explicit @since already present must never be overwritten by an inherited one. */
    public function testExistingSinceVersionIsNotOverwritten()
    {
        $child = $this->method('count', '/** {@inheritDoc} */', '8.0');
        $class = $this->classWith('\\MyCollection', $child);
        $class->addImplementedInterface($this->interfaceWith('\\Countable', $this->method('count', null, '5.1')));

        $this->resolver->resolve([$class], [], []);

        self::assertSame('8.0', $child->getStubsMetadata()?->getSinceVersion());
    }

    /** Without an @inheritDoc tag there is nothing to inherit, even when a parent has a version. */
    public function testMethodWithoutInheritDocIsLeftAlone()
    {
        $child = $this->method('count', '/** Just a description. */');
        $class = $this->classWith('\\MyCollection', $child);
        $class->addImplementedInterface($this->interfaceWith('\\Countable', $this->method('count', null, '5.1')));

        $this->resolver->resolve([$class], [], []);

        self::assertNull($child->getStubsMetadata()?->getSinceVersion());
    }

    public function testMethodWithNoPhpDocAtAllIsLeftAlone()
    {
        $child = $this->method('count');
        $class = $this->classWith('\\MyCollection', $child);
        $class->addImplementedInterface($this->interfaceWith('\\Countable', $this->method('count', null, '5.1')));

        $this->resolver->resolve([$class], [], []);

        self::assertNull($child->getStubsMetadata()?->getSinceVersion());
    }

    /** The tag is matched case-insensitively — `@inheritdoc` and `@inheritDoc` both count. */
    public function testInheritDocTagIsMatchedCaseInsensitively()
    {
        foreach (['/** {@inheritDoc} */', '/** {@inheritdoc} */', '/** @INHERITDOC */'] as $doc) {
            $child = $this->method('count', $doc);
            $class = $this->classWith('\\C' . md5($doc), $child);
            $class->addImplementedInterface(
                $this->interfaceWith('\\I' . md5($doc), $this->method('count', null, '5.1'))
            );

            $this->resolver->resolve([$class], [], []);

            self::assertSame('5.1', $child->getStubsMetadata()?->getSinceVersion(), "doc: {$doc}");
        }
    }

    /** Only a parent method of the *same name* supplies the version. */
    public function testUnrelatedParentMethodDoesNotSupplyAVersion()
    {
        $child = $this->method('count', '/** {@inheritDoc} */');
        $class = $this->classWith('\\MyCollection', $child);
        $class->addImplementedInterface($this->interfaceWith('\\Countable', $this->method('somethingElse', null, '5.1')));

        $this->resolver->resolve([$class], [], []);

        self::assertNull($child->getStubsMetadata()?->getSinceVersion());
    }

    /** A parent that declares the method but has no @since of its own supplies nothing. */
    public function testParentWithoutAnExplicitSinceSuppliesNothing()
    {
        $child = $this->method('count', '/** {@inheritDoc} */');
        $class = $this->classWith('\\MyCollection', $child);
        $class->addImplementedInterface($this->interfaceWith('\\Countable', $this->method('count')));

        $this->resolver->resolve([$class], [], []);

        self::assertNull($child->getStubsMetadata()?->getSinceVersion());
    }

    /**
     * Interfaces are resolved before classes, so a class inheriting through an interface that
     * itself inherited its version still sees a resolved value. Guards the ordering in resolve().
     */
    public function testInterfacesAreResolvedBeforeClassesSoChainedInheritanceWorks()
    {
        $grandparentMethod = $this->method('count', null, '5.1');
        $base = $this->interfaceWith('\\BaseCountable', $grandparentMethod);

        $middleMethod = $this->method('count', '/** {@inheritDoc} */');
        $middle = $this->interfaceWith('\\MiddleCountable', $middleMethod);
        $middle->addParentInterface($base);

        $classMethod = $this->method('count', '/** {@inheritDoc} */');
        $class = $this->classWith('\\Impl', $classMethod);
        $class->addImplementedInterface($middle);

        $this->resolver->resolve([$class], [$middle], []);

        self::assertSame('5.1', $middleMethod->getStubsMetadata()?->getSinceVersion(), 'interface resolved first');
        self::assertSame('5.1', $classMethod->getStubsMetadata()?->getSinceVersion(), 'class then sees it');
    }

    /**
     * A cyclic parent graph must terminate rather than recurse forever. Constructed directly
     * because ClassHierarchyResolver would not normally produce one.
     */
    public function testCyclicInterfaceGraphTerminates()
    {
        $a = $this->interfaceWith('\\A', $this->method('count', '/** {@inheritDoc} */'));
        $b = $this->interfaceWith('\\B', $this->method('count', '/** {@inheritDoc} */'));
        $a->addParentInterface($b);
        $b->addParentInterface($a);

        $this->resolver->resolve([], [$a, $b], []);

        // The point is that we get here at all; neither side can supply a version.
        self::assertNull($a->getMethods()[0]->getStubsMetadata()?->getSinceVersion());
        self::assertNull($b->getMethods()[0]->getStubsMetadata()?->getSinceVersion());
    }

    /** A self-referencing parent class must also terminate. */
    public function testSelfReferencingParentClassTerminates()
    {
        $class = $this->classWith('\\Loop', $this->method('count', '/** {@inheritDoc} */'));
        $class->setParentClass($class);

        $this->resolver->resolve([$class], [], []);

        self::assertNull($class->getMethods()[0]->getStubsMetadata()?->getSinceVersion());
    }

    /** An implemented interface is preferred over the parent class when both could supply it. */
    public function testImplementedInterfaceIsCheckedBeforeTheParentClass()
    {
        $child = $this->method('count', '/** {@inheritDoc} */');
        $class = $this->classWith('\\Impl', $child);
        $class->addImplementedInterface($this->interfaceWith('\\Countable', $this->method('count', null, '5.1')));
        $class->setParentClass($this->classWith('\\Base', $this->method('count', null, '7.0')));

        $this->resolver->resolve([$class], [], []);

        self::assertSame('5.1', $child->getStubsMetadata()?->getSinceVersion());
    }

    public function testResolveToleratesEmptyInput()
    {
        $this->resolver->resolve([], [], []);
        $this->addToAssertionCount(1);
    }
}
