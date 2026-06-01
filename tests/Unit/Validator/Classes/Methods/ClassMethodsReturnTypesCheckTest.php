<?php

namespace StubTests\Unit\Validator\Classes\Methods;

use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Model\Types\StandaloneType;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsReturnTypesCheck;
use StubTests\Unit\Validator\CheckTestCase;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Validator\KnownProblemsRegistry;

class ClassMethodsReturnTypesCheckTest extends CheckTestCase
{
    private ClassMethodsReturnTypesCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new ClassMethodsReturnTypesCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsPhp70AndAbove(): void
    {
        $this->assertFalse($this->check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_7_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::PHP_8_0->value));
        $this->assertTrue($this->check->supports(PhpVersions::LATEST->value));
    }

    // ── Class not found ───────────────────────────────────────────────────────

    public function testClassNotFoundInReflectionIsFailure(): void
    {
        $className = '\MissingClass';
        $stubClass = $this->createMockClassWithProperties($className);

        $provider = $this->createMockReflectionProvider([], []);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsReturnTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in reflection data', $result->getFailures()[$className]);
    }

    public function testClassNotFoundInStubsIsFailure(): void
    {
        $className = '\MissingClass';
        $reflClass = $this->createMockClassWithProperties($className);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([]);

        $result = (new ClassMethodsReturnTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('not found in stubs', $result->getFailures()[$className]);
    }

    // ── Basic matching ────────────────────────────────────────────────────────

    public function testClassWithNoMethodsSucceeds(): void
    {
        $className = '\MyClass';
        $reflClass = $this->createMockClassWithProperties($className);
        $stubClass = $this->createMockClassWithProperties($className);

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsReturnTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testMatchingReturnTypeIsSuccess(): void
    {
        $className = '\MyClass';
        $returnType = new StandaloneType('string');

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('getValue', $returnType)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('getValue', $returnType)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsReturnTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Mismatch detection ────────────────────────────────────────────────────

    public function testReturnTypeMismatchIsFailure(): void
    {
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('getValue', new StandaloneType('string'))]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('getValue', new StandaloneType('int'))] // wrong type
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsReturnTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures());
        $methodKey = $className . '::getValue';
        $this->assertArrayHasKey($methodKey, $result->getFailures());
        $this->assertStringContainsString('Return type mismatch', $result->getFailures()[$methodKey]);
        $this->assertStringContainsString('string', $result->getFailures()[$methodKey]);
        $this->assertStringContainsString('int', $result->getFailures()[$methodKey]);
    }

    // ── Reflection has no type (skip) ─────────────────────────────────────────

    public function testReflectionMethodHasNoTypeIsSkipped(): void
    {
        // If reflection has no return type, skip — stub may provide extra documentation
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('getValue', null)] // no type in reflection
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('getValue', new StandaloneType('string'))]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsReturnTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures(), 'Reflection has no type — check should be skipped');
    }

    public function testBothHaveNoTypeIsSuccess(): void
    {
        $className = '\MyClass';

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('getValue', null)]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('getValue', null)]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsReturnTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }

    // ── Method absent from stubs is silently skipped ───────────────────────────

    public function testMethodNotFoundInStubsIsSkipped(): void
    {
        $className = '\MyClass';

        // Reflection has a method that stubs don't
        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('missingMethod', new StandaloneType('string'))]
        );
        $stubClass = $this->createMockClassWithProperties($className); // no methods

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsReturnTypesCheck($provider))->run($stubs, $className, '8.0');

        // Silently skipped — ClassMethodsExistCheck handles existence
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── Static return type ────────────────────────────────────────────────────

    public function testStaticReturnTypeMatchesConcreteClassName(): void
    {
        // Stub declares 'static' — reflection (pre-8.0 style) reports the concrete class name.
        // 'static' in context of \MyClass means MyClass, so they are equivalent.
        $className = '\MyClass';

        $stubMethod = new PHPMethod();
        $stubMethod->setName('create');
        $stubMethod->setReturnTypeFromSignature(new StandaloneType('static'));

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('create', new StandaloneType('MyClass'))]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$stubMethod]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsReturnTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures(), 'static should match the concrete class name');
    }

    public function testStaticUnionReturnTypeMatchesConcreteClassNameInUnion(): void
    {
        // Stub declares 'static|null' — reflection reports 'MyClass|null'.
        // After substituting static → MyClass, they match.
        $className = '\MyClass';

        $stubMethod = new PHPMethod();
        $stubMethod->setName('getCurrent');
        $stubMethod->initStubsMetadata()->setLanguageLevelTypes(['8.0' => 'static|null']);
        $stubMethod->initStubsMetadata()->setDefaultType('');

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('getCurrent', new StandaloneType('MyClass|null'))]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$stubMethod]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsReturnTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures(), 'static|null should match MyClass|null');
    }

    public function testBothStaticReturnTypesMatch(): void
    {
        // When both reflection and stubs report 'static' (PHP 8.0+), they match directly.
        $className = '\MyClass';

        $stubMethod = new PHPMethod();
        $stubMethod->setName('create');
        $stubMethod->setReturnTypeFromSignature(new StandaloneType('static'));

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('create', new StandaloneType('static'))]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$stubMethod]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsReturnTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures(), 'static == static should pass directly');
    }

    public function testStaticReturnTypeInheritedMethodMatchesParentClassInReflection(): void
    {
        // When a method is inherited from a parent with 'static|null' return, PHP reflection
        // for the child class still reports the PARENT class type (e.g. 'ParentClass|null').
        // The non-static union parts ('null') must still match.
        $childClassName = '\ChildClass';

        $stubMethod = new PHPMethod();
        $stubMethod->setName('children');
        $stubMethod->setReturnTypeFromSignature(new StandaloneType('static|null'));

        // Reflection reports the parent (declaring) class type, not the child class type.
        $reflClass = $this->createMockClassWithProperties(
            $childClassName,
            null,
            null,
            null,
            [$this->makeMethod('children', new StandaloneType('ParentClass|null'))]
        );
        $stubClass = $this->createMockClassWithProperties(
            $childClassName,
            null,
            null,
            null,
            [$stubMethod]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsReturnTypesCheck($provider))->run($stubs, $childClassName, '8.0');

        $this->assertFalse($result->hasFailures(), 'static|null from parent should match ParentClass|null in reflection');
    }

    public function testStaticReturnTypeReportsFailureForUnrelatedType(): void
    {
        // Stub declares 'static' but reflection says 'int' — genuine mismatch, must fail.
        $className = '\MyClass';

        $stubMethod = new PHPMethod();
        $stubMethod->setName('compute');
        $stubMethod->setReturnTypeFromSignature(new StandaloneType('static'));

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('compute', new StandaloneType('int'))]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$stubMethod]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsReturnTypesCheck($provider))->run($stubs, $className, '8.0');

        $this->assertTrue($result->hasFailures(), 'static vs int should be reported as a mismatch');
    }

    // ── True / false as subtype of bool ───────────────────────────────────────

    public function testTrueReturnTypeWhenReflectionReturnsBoolIsSkipped(): void
    {
        // Stub narrows bool to 'true' via TentativeType / LanguageLevelTypeAware.
        // PHP reflection always reports 'bool' for tentative-type methods — the narrowing
        // is intentional in the stub and must not be flagged as a mismatch.
        $className = '\MyClass';

        $stubMethod = new PHPMethod();
        $stubMethod->setName('doSomething');
        $stubMethod->initStubsMetadata()->setLanguageLevelTypes(['8.4' => 'true']);
        $stubMethod->initStubsMetadata()->setDefaultType('bool');

        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('doSomething', new StandaloneType('bool'))]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$stubMethod]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        // On PHP 8.4: stub resolves to 'true', reflection has 'bool' — skip (subtype)
        $result = (new ClassMethodsReturnTypesCheck($provider))->run($stubs, $className, '8.4');
        $this->assertFalse($result->hasFailures(), 'true narrows bool — should be skipped on PHP 8.4');

        // On PHP 8.3: stub resolves to 'bool' (default), reflection has 'bool' — match
        $result = (new ClassMethodsReturnTypesCheck($provider))->run($stubs, $className, '8.3');
        $this->assertFalse($result->hasFailures(), 'bool == bool on PHP 8.3 — should pass');
    }

    // ── Known problems ────────────────────────────────────────────────────────

    public function testKnownProblemAtClassLevelSkipsAllMethods(): void
    {
        $className = '\SpecialClass';

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::CLASS_TYPE,
                entityId: $className,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::RETURN_TYPES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Test class skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        // Mismatch: different types — would normally fail
        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('getValue', new StandaloneType('string'))]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('getValue', new StandaloneType('int'))]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsReturnTypesCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
        $successes = $result->getSuccesses();
        $this->assertNotEmpty($successes);
        $this->assertStringContainsString('Test class skip', $successes[0]);
    }

    public function testKnownProblemAtMethodLevelSkipsSpecificMethod(): void
    {
        $className = '\MyClass';
        $methodEntityId = $className . '::getValue';

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: $methodEntityId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::RETURN_TYPES],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Test method skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        // Mismatch: different types — would normally fail
        $reflClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('getValue', new StandaloneType('string'))]
        );
        $stubClass = $this->createMockClassWithProperties(
            $className,
            null,
            null,
            null,
            [$this->makeMethod('getValue', new StandaloneType('int'))]
        );

        $provider = $this->createMockReflectionProvider([], [$reflClass]);
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsReturnTypesCheck($provider, $registry))->run($stubs, $className, '8.0');

        $this->assertFalse($result->hasFailures());
    }
}
