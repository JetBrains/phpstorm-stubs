<?php

namespace StubTests\Unit\Parsers;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Validator\Services\ClassAncestorNamesExtractor;
use StubTests\Framework\Parsers\Hierarchy\ClassHierarchyResolver;
use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPInterface;

class ClassHierarchyResolverTest extends TestCase
{
    private ClassHierarchyResolver $resolver;

    protected function setUp(): void
    {
        $this->resolver = new ClassHierarchyResolver();
    }

    private function makeClass(string $id, ?string $parentShortName = null): PHPClass
    {
        $parts = explode('\\', ltrim($id, '\\'));
        $shortName = array_pop($parts);
        $ns = empty($parts) ? '\\' : '\\' . implode('\\', $parts);

        $class = new PHPClass();
        $class->setId($id);
        $class->setName($shortName);
        $class->setNamespace($ns);

        if ($parentShortName !== null) {
            $stub = new PHPClass();
            $stub->setName($parentShortName);
            $class->setParentClass($stub);
        }

        return $class;
    }

    private function makeInterface(string $id, ?string $parentShortName = null): PHPInterface
    {
        $parts = explode('\\', ltrim($id, '\\'));
        $shortName = array_pop($parts);
        $ns = empty($parts) ? '\\' : '\\' . implode('\\', $parts);

        $iface = new PHPInterface();
        $iface->setId($id);
        $iface->setName($shortName);
        $iface->setNamespace($ns);

        if ($parentShortName !== null) {
            $stub = new PHPInterface();
            $stub->setName($parentShortName);
            $iface->addParentInterface($stub);
        }

        return $iface;
    }

    public function testRootNamespaceParentIsLinked(): void
    {
        $exception = $this->makeClass('\\Exception');
        $errorException = $this->makeClass('\\ErrorException', 'Exception');

        $this->resolver->resolve([$exception, $errorException]);

        $this->assertSame($exception, $errorException->getParentClass());
    }

    public function testSameNamespaceShortNameIsLinkedViaNsFallback(): void
    {
        // BrokenRandomEngineError extends RandomError (short name in cache)
        // Both are in \Random namespace.
        $randomError = $this->makeClass('\\Random\\RandomError');
        $broken = $this->makeClass('\\Random\\BrokenRandomEngineError', 'RandomError');

        $this->resolver->resolve([$randomError, $broken]);

        $this->assertSame($randomError, $broken->getParentClass());
    }

    public function testShortNameCollisionResolvesToCorrectFqnClass(): void
    {
        // Simulates the \ErrorException case: 16+ classes named "Exception" exist,
        // but \ErrorException should be linked to \Exception, not Swoole\...\Exception.
        $rootException = $this->makeClass('\\Exception');
        $swooleException = $this->makeClass('\\Swoole\\Coroutine\\Http2\\Client\\Exception', 'Exception');
        $errorException = $this->makeClass('\\ErrorException', 'Exception');

        $this->resolver->resolve([$rootException, $swooleException, $errorException]);

        // \ErrorException (in root namespace) must resolve to \Exception, not the Swoole one
        $this->assertSame($rootException, $errorException->getParentClass(),
            'ErrorException.parentClass must link to \\Exception, not a same-short-name class in another namespace');

        // Swoole's Exception's parent stub (short name "Exception") also resolves to root \Exception
        $this->assertSame($rootException, $swooleException->getParentClass());
    }

    public function testAncestorChainAfterResolution(): void
    {
        // ErrorException -> Exception -> (none)
        // After resolution, ClassAncestorNamesExtractor should return ["Exception"]
        $exception = $this->makeClass('\\Exception');
        $errorException = $this->makeClass('\\ErrorException', 'Exception');

        $this->resolver->resolve([$exception, $errorException]);

        $extractor = new ClassAncestorNamesExtractor();
        $this->assertEquals(['Exception'], $extractor->extract($errorException));
    }

    public function testNamespacedAncestorChainAfterResolution(): void
    {
        // \Random\BrokenRandomEngineError -> RandomError -> (none)
        // After resolution via namespace fallback, extractor uses getId()
        // and returns "Random\RandomError" (without leading \), matching reflection format.
        $randomError = $this->makeClass('\\Random\\RandomError');
        $broken = $this->makeClass('\\Random\\BrokenRandomEngineError', 'RandomError');

        $this->resolver->resolve([$randomError, $broken]);

        $extractor = new ClassAncestorNamesExtractor();
        $this->assertEquals(['Random\\RandomError'], $extractor->extract($broken));
    }

    // ── Interface parent resolution ───────────────────────────────────────────

    public function testInterfaceParentInterfaceIsLinked(): void
    {
        $traversable = $this->makeInterface('\\Traversable');
        $iterator = $this->makeInterface('\\Iterator', 'Traversable');

        $this->resolver->resolve([], [$traversable, $iterator]);

        $parents = $iterator->getParentInterfaces();
        $this->assertCount(1, $parents);
        $this->assertSame($traversable, $parents[0]);
    }

    public function testInterfaceParentInSameNamespaceIsLinkedViaNsFallback(): void
    {
        // \Random\CryptoSafeEngine extends BaseEngine (short name stored in cache).
        // Both live in the \Random namespace, so the fallback prepends the namespace.
        $baseEngine = $this->makeInterface('\\Random\\BaseEngine');
        $cryptoEngine = $this->makeInterface('\\Random\\CryptoSafeEngine', 'BaseEngine');

        $this->resolver->resolve([], [$baseEngine, $cryptoEngine]);

        $parents = $cryptoEngine->getParentInterfaces();
        $this->assertCount(1, $parents);
        $this->assertSame($baseEngine, $parents[0]);
    }

    public function testUnresolvableInterfaceParentRemainsAsStub(): void
    {
        // Parent 'NonExistentInterface' is not in the collection.
        // The stub PHPInterface with only the short name must remain unchanged.
        $iface = $this->makeInterface('\\MyInterface', 'NonExistentInterface');

        $this->resolver->resolve([], [$iface]);

        $parents = $iface->getParentInterfaces();
        $this->assertCount(1, $parents);
        $this->assertEquals('NonExistentInterface', $parents[0]->getName());
    }

    public function testClassAndInterfaceParentsResolvedInSameCall(): void
    {
        // A single resolve() call must resolve both class parents and interface parents.
        $exception = $this->makeClass('\\Exception');
        $errorException = $this->makeClass('\\ErrorException', 'Exception');

        $traversable = $this->makeInterface('\\Traversable');
        $iterator = $this->makeInterface('\\Iterator', 'Traversable');

        $this->resolver->resolve([$exception, $errorException], [$traversable, $iterator]);

        $this->assertSame($exception, $errorException->getParentClass(), 'Class parent should be resolved');

        $iteratorParents = $iterator->getParentInterfaces();
        $this->assertCount(1, $iteratorParents);
        $this->assertSame($traversable, $iteratorParents[0], 'Interface parent should be resolved');
    }
}
