<?php

namespace StubTests\Unit\Validator\Classes;

use StubTests\Framework\Parsers\Model\PHPClass;
use StubTests\Framework\Validator\Classes\ClassParentClassCheck;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;

class ClassParentClassCheckTest extends CheckTestCase
{
    private ClassParentClassCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new ClassParentClassCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    public function testSupportsAllPhpVersions(): void
    {
        $this->assertTrue($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    public function testClassWithNoParentInBoth(): void
    {
        // Arrange
        $className = 'MyClass';

        $reflectionClass = $this->createMockClassWithProperties($className);
        $stubClass = $this->createMockClassWithProperties($className);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassParentClassCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $className, '8.0');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testClassWithMatchingParentInBoth(): void
    {
        // Arrange
        $className = 'ChildClass';
        $parentClassName = 'ParentClass';

        $reflectionParent = $this->createMockClassWithProperties($parentClassName);
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, [], $reflectionParent);

        $stubParent = $this->createMockClassWithProperties($parentClassName);
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [], $stubParent);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassParentClassCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $className, '8.0');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testParentClassMismatch(): void
    {
        // Arrange
        $className = 'ChildClass';

        $reflectionParent = $this->createMockClassWithProperties('Exception');
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, [], $reflectionParent);

        $stubParent = $this->createMockClassWithProperties('Error');
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [], $stubParent);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassParentClassCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $className, '8.0');

        // Assert
        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());

        $failures = $result->getFailures();
        $this->assertArrayHasKey($className, $failures);
        $this->assertStringContainsString('Parent class mismatch', $failures[$className]);
        $this->assertStringContainsString('Exception', $failures[$className]);
        $this->assertStringContainsString('Error', $failures[$className]);
    }

    public function testReflectionHasParentButStubsDoNot(): void
    {
        // Arrange
        $className = 'ChildClass';

        $reflectionParent = $this->createMockClassWithProperties('Exception');
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, [], $reflectionParent);

        $stubClass = $this->createMockClassWithProperties($className); // no parent

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassParentClassCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $className, '8.0');

        // Assert
        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());

        $failures = $result->getFailures();
        $this->assertArrayHasKey($className, $failures);
        $this->assertStringContainsString('Parent class mismatch', $failures[$className]);
        $this->assertStringContainsString('Exception', $failures[$className]);
        $this->assertStringContainsString('(none)', $failures[$className]);
    }

    public function testStubsHaveParentButReflectionDoesNot(): void
    {
        // Arrange
        $className = 'ChildClass';

        $reflectionClass = $this->createMockClassWithProperties($className); // no parent

        $stubParent = $this->createMockClassWithProperties('Exception');
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [], $stubParent);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassParentClassCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $className, '8.0');

        // Assert
        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());

        $failures = $result->getFailures();
        $this->assertArrayHasKey($className, $failures);
        $this->assertStringContainsString('Parent class mismatch', $failures[$className]);
        $this->assertStringContainsString('no parent', $failures[$className]);
        $this->assertStringContainsString('Exception', $failures[$className]);
    }

    public function testClassNotFoundInReflection(): void
    {
        // Arrange
        $className = 'MissingClass';

        $stubClass = $this->createMockClassWithProperties($className);

        $reflectionProvider = $this->createMockReflectionProvider([], []);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassParentClassCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $className, '8.0');

        // Assert
        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());

        $failures = $result->getFailures();
        $this->assertArrayHasKey($className, $failures);
        $this->assertStringContainsString('not found in reflection data', $failures[$className]);
    }

    public function testClassNotFoundInStubs(): void
    {
        // Arrange
        $className = 'MissingClass';

        $reflectionClass = $this->createMockClassWithProperties($className);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([]);

        $check = new ClassParentClassCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $className, '8.0');

        // Assert
        $this->assertTrue($result->hasFailures());
        $this->assertEquals(1, $result->getFailureCount());

        $failures = $result->getFailures();
        $this->assertArrayHasKey($className, $failures);
        $this->assertStringContainsString('not found in stubs', $failures[$className]);
    }

    public function testKnownProblemSkipsValidation(): void
    {
        // Arrange
        $className = '\\SpecialClass';

        $reflectionParent = $this->createMockClassWithProperties('Exception');
        $reflectionClass = $this->createMockClassWithProperties($className, null, null, null, [], $reflectionParent);

        $stubParent = $this->createMockClassWithProperties('Error'); // different parent
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [], $stubParent);

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: $className,
                type: ProblemType::OVERLOADED_SIGNATURE,
                affectedChecks: [CheckType::CLASS_PARENT],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Test known problem'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassParentClassCheck($reflectionProvider, $registry);

        // Act
        $result = $check->run($stubsManager, $className, '8.0');

        // Assert - should succeed because validation is skipped for known problem
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());

        $successes = $result->getSuccesses();
        $this->assertNotEmpty($successes);
        $this->assertStringContainsString('skipped', $successes[0]);
        $this->assertStringContainsString('Test known problem', $successes[0]);
    }

    public function testClassInNamespaceWithMatchingParent(): void
    {
        // Arrange
        $className = 'Dom\\Element';
        $parentClassName = 'Dom\\Node';

        $reflectionParent = $this->createMockClassWithProperties($parentClassName);
        $reflectionClass = $this->createMockClassWithProperties($className, 'Dom', null, null, [], $reflectionParent);

        $stubParent = $this->createMockClassWithProperties($parentClassName);
        $stubClass = $this->createMockClassWithProperties($className, 'Dom', null, null, [], $stubParent);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionClass]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubClass]);

        $check = new ClassParentClassCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $className, '8.4');

        // Assert
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testReflectionParentFoundInStubsAncestorChain(): void
    {
        // Simulate ParseError in PHP 7.0:
        // - Reflection reports ParseError extends Error directly (CompileError was introduced in 7.3)
        // - Stubs define the full hierarchy: ParseError -> CompileError -> Error
        // After ClassHierarchyResolver links the objects, getAncestorClassNames() traverses
        // the full chain, so "Error" is found and validation passes.
        $className = 'ParseError';

        // Reflection: ParseError -> Error (direct parent)
        $reflectionError = $this->createMockClassWithProperties('Error');
        $reflectionParseError = $this->createMockClassWithProperties($className, null, null, null, [], $reflectionError);

        // Stubs: ParseError -> CompileError -> Error (full linked chain)
        $stubError = $this->createMockClassWithProperties('Error');
        $stubCompileError = $this->createMockClassWithProperties('CompileError', null, null, null, [], $stubError);
        $stubParseError = $this->createMockClassWithProperties($className, null, null, null, [], $stubCompileError);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionParseError]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubParseError]);

        $check = new ClassParentClassCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $className, '7.0');

        // Assert — "Error" appears in ancestor chain [CompileError, Error], so validation passes
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testNamespacedParentMatchedViaId(): void
    {
        // Simulate \Random\BrokenRandomEngineError:
        // - Reflection reports parent as "Random\RandomError" (FQN, no leading \, as PHP reflection returns)
        // - Stubs: source has `extends RandomError` inside `namespace Random { ... }`.
        //   ClassHierarchyResolver links the parent stub (name="RandomError") to the actual
        //   RandomError PHPClass, which carries getId() = "\Random\RandomError".
        //   getAncestorClassNames() must strip the leading \ and return "Random\RandomError"
        //   so it matches the reflection-reported name.
        $classId = '\\Random\\BrokenRandomEngineError';

        // Stubs: build the linked hierarchy as ClassHierarchyResolver would produce it.
        // The RandomError object has the short name but carries the FQN id.
        $stubRandomError = new PHPClass();
        $stubRandomError->setName('RandomError');
        $stubRandomError->setId('\\Random\\RandomError');

        $stubBroken = new PHPClass();
        $stubBroken->setName('BrokenRandomEngineError');
        $stubBroken->setId($classId);
        $stubBroken->setParentClass($stubRandomError);

        // Reflection: parent reported as FQN without leading backslash
        $reflectionParent = $this->createMockClassWithProperties('Random\\RandomError');
        $reflectionBroken = $this->createMockClassWithProperties($classId, null, null, null, [], $reflectionParent);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionBroken]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubBroken]);

        $check = new ClassParentClassCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $classId, '8.2');

        // Assert — getAncestorClassNames() returns "Random\RandomError" via getId(), matching reflection
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testLinkedReflectionParentUsesIdNotShortName(): void
    {
        // This is the exact \Random\BrokenRandomEngineError scenario that was failing:
        // After ClassHierarchyResolver links the reflection parent stub (stored name
        // "Random\RandomError") to the actual \Random\RandomError PHPClass object,
        // $reflectionClass->getParentClass()->getName() returns "RandomError" (the short name
        // of the linked object). Meanwhile getAncestorClassNames() on the stubs side
        // returns "Random\RandomError" (via getId()). Without using getId() on the
        // reflection side too, in_array("RandomError", ["Random\RandomError"]) = false.
        //
        // The check must use getId() (stripped of \) on both sides for consistency.
        $classId = '\\Random\\BrokenRandomEngineError';

        // Stubs: linked RandomError with proper FQN id (as ClassHierarchyResolver produces)
        $stubRandomError = new PHPClass();
        $stubRandomError->setName('RandomError');        // short name
        $stubRandomError->setId('\\Random\\RandomError'); // full id
        $stubBroken = new PHPClass();
        $stubBroken->setName('BrokenRandomEngineError');
        $stubBroken->setId($classId);
        $stubBroken->setParentClass($stubRandomError);

        // Reflection: also linked — parent object has short getName()="RandomError"
        // but full getId()="\Random\RandomError", simulating a ClassHierarchyResolver-linked object
        $reflectionRandomError = new PHPClass();
        $reflectionRandomError->setName('RandomError');        // short name (as getName() returns after linking)
        $reflectionRandomError->setId('\\Random\\RandomError'); // full id
        $reflectionBroken = new PHPClass();
        $reflectionBroken->setName('BrokenRandomEngineError');
        $reflectionBroken->setId($classId);
        $reflectionBroken->setParentClass($reflectionRandomError);

        $reflectionProvider = $this->createMockReflectionProvider([], [$reflectionBroken]);
        $stubsManager = $this->createMockStorageManager();
        $stubsManager->method('getClasses')->willReturn([$stubBroken]);

        $check = new ClassParentClassCheck($reflectionProvider);

        // Act
        $result = $check->run($stubsManager, $classId, '8.2');

        // Assert — both sides resolve to "Random\RandomError" via getId(), so check passes
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }
}
