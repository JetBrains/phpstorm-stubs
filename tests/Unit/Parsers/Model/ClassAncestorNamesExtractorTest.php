<?php

namespace StubTests\Unit\Parsers\Model;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Validator\Services\ClassAncestorNamesExtractor;
use StubTests\Framework\Parsers\Model\PHPClass;

/**
 * Unit tests for ClassAncestorNamesExtractor.
 *
 * Verifies ancestor chain traversal, FQN normalisation (leading \ stripped),
 * getName() fallback for unresolved stubs, and cycle safety.
 */
class ClassAncestorNamesExtractorTest extends TestCase
{
    private ClassAncestorNamesExtractor $extractor;

    protected function setUp(): void
    {
        $this->extractor = new ClassAncestorNamesExtractor();
    }

    private function makeClass(string $id, ?string $shortName = null): PHPClass
    {
        $class = new PHPClass();
        $class->setId($id);
        $class->setName($shortName ?? ltrim(basename(str_replace('\\', '/', $id)), '\\'));
        return $class;
    }

    // ── No parent ─────────────────────────────────────────────────────────────

    public function testReturnsEmptyArrayWhenNoParent(): void
    {
        $class = new PHPClass();
        $this->assertSame([], $this->extractor->extract($class));
    }

    // ── Single parent via getId() ─────────────────────────────────────────────

    public function testReturnsSingleParentViaId(): void
    {
        $parent = $this->makeClass('\Exception');
        $class = new PHPClass();
        $class->setParentClass($parent);

        $this->assertSame(['Exception'], $this->extractor->extract($class));
    }

    public function testStripsLeadingBackslashFromId(): void
    {
        $parent = $this->makeClass('\Exception');
        $class = new PHPClass();
        $class->setParentClass($parent);

        $result = $this->extractor->extract($class);
        $this->assertStringStartsNotWith('\\', $result[0]);
        $this->assertSame('Exception', $result[0]);
    }

    public function testNamespacedIdReturnsFullFqn(): void
    {
        $parent = $this->makeClass('\Random\RandomError', 'RandomError');
        $class = new PHPClass();
        $class->setParentClass($parent);

        $this->assertSame(['Random\RandomError'], $this->extractor->extract($class));
    }

    // ── Fallback to getName() when getId() is null ────────────────────────────

    public function testFallsBackToNameWhenIdIsNull(): void
    {
        $parent = new PHPClass();
        $parent->setName('BaseClass'); // id not set → null
        $class = new PHPClass();
        $class->setParentClass($parent);

        $this->assertSame(['BaseClass'], $this->extractor->extract($class));
    }

    // ── Multi-level chain ─────────────────────────────────────────────────────

    public function testTwoLevelChain(): void
    {
        $grandparent = $this->makeClass('\Exception');
        $parent = $this->makeClass('\RuntimeException');
        $parent->setParentClass($grandparent);
        $class = new PHPClass();
        $class->setParentClass($parent);

        $this->assertSame(['RuntimeException', 'Exception'], $this->extractor->extract($class));
    }

    public function testThreeLevelChain(): void
    {
        $root = $this->makeClass('\Error');
        $middle = $this->makeClass('\Exception');
        $middle->setParentClass($root);
        $child = $this->makeClass('\RuntimeException');
        $child->setParentClass($middle);
        $class = new PHPClass();
        $class->setParentClass($child);

        $this->assertSame(['RuntimeException', 'Exception', 'Error'], $this->extractor->extract($class));
    }

    public function testNamespacedMultiLevelChain(): void
    {
        $root = $this->makeClass('\Random\RandomError', 'RandomError');
        $mid = $this->makeClass('\Random\BrokenRandomEngineError', 'BrokenRandomEngineError');
        $mid->setParentClass($root);
        $class = new PHPClass();
        $class->setParentClass($mid);

        $this->assertSame(
            ['Random\BrokenRandomEngineError', 'Random\RandomError'],
            $this->extractor->extract($class)
        );
    }

    // ── Cycle safety ──────────────────────────────────────────────────────────

    public function testBreaksOnDirectCycle(): void
    {
        // A -> B -> A (cycle)
        $classA = $this->makeClass('\ClassA', 'ClassA');
        $classB = $this->makeClass('\ClassB', 'ClassB');
        $classA->setParentClass($classB);
        $classB->setParentClass($classA);

        // Traversal from classA:
        //  step 1: classB → 'ClassB' added, visited
        //  step 2: classA → 'ClassA' added, visited
        //  step 3: classB → already visited → stop
        $result = $this->extractor->extract($classA);
        $this->assertSame(['ClassB', 'ClassA'], $result);
    }

    // ── Null / empty name guards ──────────────────────────────────────────────

    public function testBreaksWhenIdAndNameAreBothNull(): void
    {
        $parent = new PHPClass(); // id=null, name=null
        $class = new PHPClass();
        $class->setParentClass($parent);

        $this->assertSame([], $this->extractor->extract($class));
    }

    public function testBreaksWhenNameIsEmptyString(): void
    {
        $parent = new PHPClass();
        $parent->setName('');
        $class = new PHPClass();
        $class->setParentClass($parent);

        $this->assertSame([], $this->extractor->extract($class));
    }

    public function testStopsAtFirstNullNameInChain(): void
    {
        $root = new PHPClass(); // id=null, name=null — traversal must stop here
        $parent = $this->makeClass('\Exception');
        $parent->setParentClass($root);
        $class = new PHPClass();
        $class->setParentClass($parent);

        // Only 'Exception' — root has null id/name so traversal stops
        $this->assertSame(['Exception'], $this->extractor->extract($class));
    }
}
