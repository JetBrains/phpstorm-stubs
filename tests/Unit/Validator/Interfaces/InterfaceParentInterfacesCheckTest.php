<?php

namespace StubTests\Unit\Validator\Interfaces;

use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Interfaces\InterfaceParentInterfacesCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class InterfaceParentInterfacesCheckTest extends CheckTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    /**
     * Build an unresolved parent placeholder (getName() and getId() both set, but the
     * object is intentionally absent from the stubs collection passed to the check).
     * This simulates what ClassHierarchyResolver leaves when it cannot find the parent:
     * the placeholder retains its tentative Id but is never added to the stubs list.
     */
    private function makeUnresolvedParent(string $name): PHPInterface
    {
        $iface = new PHPInterface();
        $iface->setName($name);
        $iface->setId('\\' . $name);
        return $iface;
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsAllPhpVersions(): void
    {
        $check = new InterfaceParentInterfacesCheck();
        $this->assertTrue($check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    // ── Interface not found in stubs ──────────────────────────────────────────

    public function testInterfaceNotFoundInStubsIsFailure(): void
    {
        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([]);

        $result = (new InterfaceParentInterfacesCheck())->run($stubs, '\MissingInterface', '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', $result->getFailures()['\MissingInterface']);
    }

    // ── No parent interfaces ──────────────────────────────────────────────────

    public function testInterfaceWithNoParentsSucceeds(): void
    {
        $iface = $this->makeInterface('\Countable');

        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$iface]);

        $result = (new InterfaceParentInterfacesCheck())->run($stubs, '\Countable', '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── Resolved parent interfaces ────────────────────────────────────────────

    public function testInterfaceWithResolvedParentSucceeds(): void
    {
        // OuterIterator extends Iterator. Both are in stubs → parent is resolved.
        $iteratorStub      = $this->makeInterface('\Iterator');
        $outerIteratorStub = $this->makeInterface('\OuterIterator', parentInterfaces: [$iteratorStub]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$outerIteratorStub, $iteratorStub]);

        $result = (new InterfaceParentInterfacesCheck())->run($stubs, '\OuterIterator', '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testInterfaceWithMultipleResolvedParentsSucceeds(): void
    {
        $unitEnumStub    = $this->makeInterface('\UnitEnum');
        $stringableStub  = $this->makeInterface('\Stringable');
        $backedEnumStub  = $this->makeInterface('\BackedEnum', parentInterfaces: [$unitEnumStub, $stringableStub]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$backedEnumStub, $unitEnumStub, $stringableStub]);

        $result = (new InterfaceParentInterfacesCheck())->run($stubs, '\BackedEnum', '8.1');

        $this->assertFalse($result->hasFailures());
    }

    // ── Missing parent interfaces ─────────────────────────────────────────────

    public function testMissingDirectParentIsFailure(): void
    {
        // OuterIterator's parent 'Iterator' was not found in stubs → unresolved placeholder.
        $missingParent     = $this->makeUnresolvedParent('Iterator');
        $outerIteratorStub = $this->makeInterface('\OuterIterator', parentInterfaces: [$missingParent]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$outerIteratorStub]);

        $result = (new InterfaceParentInterfacesCheck())->run($stubs, '\OuterIterator', '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertCount(1, $failures);
        $this->assertStringContainsString('Iterator', array_values($failures)[0]);
        $this->assertStringContainsString('not found in stubs', array_values($failures)[0]);
    }

    public function testMultipleMissingParentsAreEachReported(): void
    {
        $missingA = $this->makeUnresolvedParent('InterfaceA');
        $missingB = $this->makeUnresolvedParent('InterfaceB');
        $iface    = $this->makeInterface('\MyInterface', parentInterfaces: [$missingA, $missingB]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$iface]);

        $result = (new InterfaceParentInterfacesCheck())->run($stubs, '\MyInterface', '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertCount(2, $result->getFailures());
    }

    // ── Full hierarchy chain ──────────────────────────────────────────────────

    public function testMissingGrandparentIsReported(): void
    {
        // SeekableIterator → Iterator → Traversable (Traversable missing in stubs).
        $missingTraversable = $this->makeUnresolvedParent('Traversable');
        $iteratorStub       = $this->makeInterface('\Iterator', parentInterfaces: [$missingTraversable]);
        $seekableStub       = $this->makeInterface('\SeekableIterator', parentInterfaces: [$iteratorStub]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$seekableStub, $iteratorStub]);

        $result = (new InterfaceParentInterfacesCheck())->run($stubs, '\SeekableIterator', '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('Traversable', array_values($result->getFailures())[0]);
    }

    public function testAllAncestorsResolvedInDeepHierarchySucceeds(): void
    {
        // InterfaceC → InterfaceB → InterfaceA (all resolved)
        $ifaceA = $this->makeInterface('\InterfaceA');
        $ifaceB = $this->makeInterface('\InterfaceB', parentInterfaces: [$ifaceA]);
        $ifaceC = $this->makeInterface('\InterfaceC', parentInterfaces: [$ifaceB]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$ifaceC, $ifaceB, $ifaceA]);

        $result = (new InterfaceParentInterfacesCheck())->run($stubs, '\InterfaceC', '8.0');

        $this->assertFalse($result->hasFailures());
    }

    public function testMissingAncestorAtAnyDepthIsReported(): void
    {
        // InterfaceC → InterfaceB → InterfaceA (InterfaceA missing)
        $missingA = $this->makeUnresolvedParent('InterfaceA');
        $ifaceB   = $this->makeInterface('\InterfaceB', parentInterfaces: [$missingA]);
        $ifaceC   = $this->makeInterface('\InterfaceC', parentInterfaces: [$ifaceB]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$ifaceC, $ifaceB]);

        $result = (new InterfaceParentInterfacesCheck())->run($stubs, '\InterfaceC', '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('InterfaceA', array_values($result->getFailures())[0]);
    }

    // ── Cycle guard ───────────────────────────────────────────────────────────

    public function testCyclicParentChainDoesNotCauseInfiniteLoop(): void
    {
        // IfaceA → IfaceB → IfaceA (cycle, both resolved)
        $ifaceA = $this->makeInterface('\IfaceA');
        $ifaceB = $this->makeInterface('\IfaceB', parentInterfaces: [$ifaceA]);
        $ifaceA->addParentInterface($ifaceB);  // cycle!

        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$ifaceA, $ifaceB]);

        // Must complete without infinite recursion
        $result = (new InterfaceParentInterfacesCheck())->run($stubs, '\IfaceA', '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Missing parent name deduplication ─────────────────────────────────────

    public function testSameMissingParentReferencedTwiceIsReportedOnce(): void
    {
        // Both direct parents reference the same unresolved name
        $missingA1 = $this->makeUnresolvedParent('SharedParent');
        $missingA2 = $this->makeUnresolvedParent('SharedParent');
        $iface     = $this->makeInterface('\MyInterface', parentInterfaces: [$missingA1, $missingA2]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$iface]);

        $result = (new InterfaceParentInterfacesCheck())->run($stubs, '\MyInterface', '8.0');

        $this->assertTrue($result->hasFailures());
        // 'SharedParent' should only appear once in the failures list
        $allMessages = implode('', $result->getFailures());
        $this->assertEquals(1, substr_count($allMessages, 'SharedParent'));
    }

    // ── Known problems ────────────────────────────────────────────────────────

    public function testInterfaceLevelKnownProblemSkipsCheck(): void
    {
        $interfaceId   = '\SpecialInterface';
        $missingParent = $this->makeUnresolvedParent('MissingParent');
        $iface         = $this->makeInterface($interfaceId, parentInterfaces: [$missingParent]);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::INTERFACE_TYPE,
                entityId: $interfaceId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::INTERFACE_PARENT_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Interface-level skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getInterfaces')->willReturn([$iface]);

        $result = (new InterfaceParentInterfacesCheck(null, $registry))->run($stubs, $interfaceId, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertStringContainsString('skipped', $result->getSuccesses()[0]);
        $this->assertStringContainsString('Interface-level skip', $result->getSuccesses()[0]);
    }
}
