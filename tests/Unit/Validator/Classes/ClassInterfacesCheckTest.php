<?php

namespace StubTests\Unit\Validator\Classes;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Parsers\Model\PHPInterface;
use StubTests\Framework\Validator\Classes\ClassInterfacesCheck;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;

class ClassInterfacesCheckTest extends CheckTestCase
{
    private ClassInterfacesCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new ClassInterfacesCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    /**
     * Build a linked PHPInterface with the given id (e.g. '\Throwable').
     * getName() returns the short name extracted from the id.
     */
    private function makeLinkedInterface(string $id): PHPInterface
    {
        $parts = explode('\\', ltrim($id, '\\'));
        $shortName = array_pop($parts);
        $ns = empty($parts) ? '\\' : '\\' . implode('\\', $parts);

        $iface = new PHPInterface();
        $iface->setId($id);
        $iface->setName($shortName);
        $iface->setNamespace($ns);
        return $iface;
    }

    public function testSupportsAllPhpVersions(): void
    {
        $this->assertTrue($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    public function testClassWithNoInterfacesOnBothSides(): void
    {
        $className = '\MyClass';

        $reflectionClass = $this->createMockClassWithProperties($className);
        $stubClass = $this->createMockClassWithProperties($className);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassInterfacesCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testClassWithMatchingInterfaces(): void
    {
        $className = '\Exception';
        $throwable = $this->makeLinkedInterface('\Throwable');

        // Reflection: Exception implements Throwable (all interfaces, no parent)
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [$throwable]);

        // Stubs: Exception declares implements Throwable
        $stubThrowable = $this->makeLinkedInterface('\Throwable');
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [$stubThrowable]);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassInterfacesCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '7.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testStubsDeclareSpuriousInterface(): void
    {
        // Stubs declare an interface that reflection does not report at all
        $className = '\MyClass';
        $reflectionClass = $this->createMockClassWithProperties($className);

        $stubFakeIface = $this->makeLinkedInterface('\FakeInterface');
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [$stubFakeIface]);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassInterfacesCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($className, $failures);
        $this->assertStringContainsString('stubs declare interface(s) not in reflection', $failures[$className]);
        $this->assertStringContainsString('FakeInterface', $failures[$className]);
    }

    public function testTransitiveInterfaceFromReflectionDoesNotCauseFalsePositive(): void
    {
        // PHP reflection getInterfaces() returns ALL interfaces including transitive ones.
        // If a class declares `implements Iterator` and Iterator extends Traversable,
        // reflection reports both [Iterator, Traversable]. Stubs only declare [Iterator].
        // The check should pass because Traversable is NOT declared in stubs — we only
        // check that what stubs declare exists in reflection, not that stubs declare
        // everything reflection reports.
        $className = '\Generator';
        $iterator = $this->makeLinkedInterface('\Iterator');
        $traversable = $this->makeLinkedInterface('\Traversable');

        // Reflection: Generator implements both (Iterator + transitive Traversable)
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [$iterator, $traversable]);

        // Stubs: Generator only declares Iterator directly
        $stubIterator = $this->makeLinkedInterface('\Iterator');
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [$stubIterator]);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassInterfacesCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        // Iterator IS in reflection's full list, so stubs' declaration is valid → passes
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testClassWithMultipleMatchingInterfaces(): void
    {
        $className = '\ArrayObject';
        $interfaces = [
            $this->makeLinkedInterface('\IteratorAggregate'),
            $this->makeLinkedInterface('\ArrayAccess'),
            $this->makeLinkedInterface('\Serializable'),
            $this->makeLinkedInterface('\Countable'),
        ];

        // Reflection reports same 4 interfaces (no parent class, so all are "direct")
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, [], null, $interfaces);

        $stubInterfaces = [
            $this->makeLinkedInterface('\IteratorAggregate'),
            $this->makeLinkedInterface('\ArrayAccess'),
            $this->makeLinkedInterface('\Serializable'),
            $this->makeLinkedInterface('\Countable'),
        ];
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [], null, $stubInterfaces);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassInterfacesCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testClassNotFoundInReflection(): void
    {
        $className = '\MissingClass';
        $stubClass = $this->createMockClassWithProperties($className);

        $reflectionProvider = $this->createMockReflectionProvider([], []);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassInterfacesCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($className, $failures);
        $this->assertStringContainsString('not found in reflection data', $failures[$className]);
    }

    public function testClassNotFoundInStubs(): void
    {
        $className = '\MissingClass';
        $reflectionClass = $this->createMockClassWithProperties($className);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([]);

        $check = new ClassInterfacesCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $failures = $result->getFailures();
        $this->assertArrayHasKey($className, $failures);
        $this->assertStringContainsString('not found in stubs', $failures[$className]);
    }

    public function testKnownProblemSkipsValidation(): void
    {
        $className = '\SpecialClass';
        $throwable = $this->makeLinkedInterface('\Throwable');

        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, [], null, [$throwable]);
        $stubClass = $this->createMockClassWithProperties($className); // missing Throwable, but skipped

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: $className,
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::CLASS_INTERFACES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Known interface issue'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassInterfacesCheck($reflectionProvider, $registry);
        $result = $check->run($stubsManager, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
        $successes = $result->getSuccesses();
        $this->assertStringContainsString('skipped', $successes[0]);
        $this->assertStringContainsString('Known interface issue', $successes[0]);
    }

    public function testLinkedInterfacesFqnsUsedForComparison(): void
    {
        // When ClassHierarchyResolver links interface objects, getId() returns the full FQN
        // with a leading backslash (e.g. '\Random\RandomEngine'). Both reflection and stubs
        // sides must normalize using ltrim(getId(), '\\') so they compare equal.
        $className = '\Random\Randomizer';

        $reflectionIface = new PHPInterface();
        $reflectionIface->setName('RandomEngine');          // short name (as getName() returns after linking)
        $reflectionIface->setId('\Random\RandomEngine');     // full id

        $reflectionClass = $this->createMockClassWithProperties(
            $className, null, null, null, [], null, [$reflectionIface]
        );

        $stubIface = new PHPInterface();
        $stubIface->setName('RandomEngine');
        $stubIface->setId('\Random\RandomEngine');

        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null, [], null, [$stubIface]
        );

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassInterfacesCheck($reflectionProvider);
        $result = $check->run($stubsManager, $className, '8.2');

        // Both sides normalize to 'Random\RandomEngine', so they match
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }
}
