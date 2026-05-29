<?php

namespace StubTests\Unit\Validator\Classes\TypeForbidden;

use PHPUnit\Framework\Attributes\DataProvider;
use StubTests\Framework\Parsers\Model\PHPParameter;
use StubTests\Framework\Parsers\Model\Types\StandaloneType;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\TypeForbidden\ClassMethodsScalarTypeForbiddenCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class ClassMethodsScalarTypeForbiddenCheckTest extends CheckTestCase
{
    private ClassMethodsScalarTypeForbiddenCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new ClassMethodsScalarTypeForbiddenCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsOnlyVersionsBeforePhp70(): void
    {
        $this->assertTrue($this->check->supports(PhpVersions::EARLIEST->value),  'PHP 5.6 must be supported');
        $this->assertFalse($this->check->supports(PhpVersions::PHP_7_0->value),  'PHP 7.0 must NOT be supported');
        $this->assertFalse($this->check->supports(PhpVersions::PHP_7_1->value),  'PHP 7.1 must NOT be supported');
        $this->assertFalse($this->check->supports(PhpVersions::PHP_8_0->value),  'PHP 8.0 must NOT be supported');
        $this->assertFalse($this->check->supports(PhpVersions::LATEST->value),   'PHP 8.4 must NOT be supported');
    }

    // ── Entity not found ──────────────────────────────────────────────────────

    public function testClassNotFoundInStubsSucceeds(): void
    {
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([]);

        $result = $this->check->run($stubs, '\MissingClass', PhpVersions::EARLIEST->value);

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── No methods / no scalar types ──────────────────────────────────────────

    public function testClassWithNoMethodsSucceeds(): void
    {
        $className = '\MyClass';
        $stubClass = $this->createMockClassWithProperties($className);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::EARLIEST->value);

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testMethodWithNoParametersSucceeds(): void
    {
        $className = '\MyClass';
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork')]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::EARLIEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Scalar type detection — all four scalar types ─────────────────────────

    #[DataProvider('scalarTypeProvider')]
    public function testScalarParamTypeIsFailure(string $scalarType): void
    {
        $className = '\MyClass';
        $method    = $this->makeMethod(
            'doSomething',
            parameters: [$this->makeParam('val', new StandaloneType($scalarType))]
        );
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$method]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::EARLIEST->value);

        $this->assertTrue($result->hasFailures(), "Scalar type '{$scalarType}' on param must be flagged");
        $paramKey = $className . '::doSomething::$val';
        $this->assertArrayHasKey($paramKey, $result->getFailures());
        $this->assertStringContainsString('scalar type hint', $result->getFailures()[$paramKey]);
        $this->assertStringContainsString('PHP 7.0', $result->getFailures()[$paramKey]);
    }

    public static function scalarTypeProvider(): array
    {
        return [
            'int'   => ['int'],
            'float' => ['float'],
            'string' => ['string'],
            'bool'  => ['bool'],
        ];
    }

    // ── Non-scalar types — must NOT be flagged ─────────────────────────────────

    #[DataProvider('allowedParamTypeProvider')]
    public function testAllowedParamTypeSucceeds(string $typeName): void
    {
        $className = '\MyClass';
        $method    = $this->makeMethod(
            'doSomething',
            parameters: [$this->makeParam('val', new StandaloneType($typeName))]
        );
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$method]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::EARLIEST->value);

        $this->assertFalse($result->hasFailures(), "Type '{$typeName}' must not be flagged as scalar");
    }

    public static function allowedParamTypeProvider(): array
    {
        return [
            'array'       => ['array'],
            'callable'    => ['callable'],
            'class name'  => ['DateTime'],
            'self'        => ['self'],
            'parent'      => ['parent'],
        ];
    }

    // ── NullableType wrapping a scalar ─────────────────────────────────────────

    public function testNullableScalarParamTypeIsFailure(): void
    {
        // ?int in stub signature → NullableType wrapping int → must be flagged
        $className = '\MyClass';
        $nullableInt = $this->createNullableType('int');
        $method    = $this->makeMethod(
            'doSomething',
            parameters: [$this->makeParam('val', $nullableInt)]
        );
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$method]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::EARLIEST->value);

        $this->assertTrue($result->hasFailures(), '?int must be flagged (inner scalar type)');
        $paramKey = $className . '::doSomething::$val';
        $this->assertArrayHasKey($paramKey, $result->getFailures());
        $this->assertStringContainsString('scalar type hint', $result->getFailures()[$paramKey]);
    }

    public function testNullableNonScalarParamTypeSucceeds(): void
    {
        // ?array → NullableType wrapping array → array is not a scalar type → OK
        $className = '\MyClass';
        $method    = $this->makeMethod(
            'doSomething',
            parameters: [$this->makeParam('val', $this->createNullableType('array'))]
        );
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$method]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::EARLIEST->value);

        $this->assertFalse($result->hasFailures(), '?array must not be flagged');
    }

    // ── LanguageLevelTypeAware — must NOT be flagged ──────────────────────────

    public function testScalarParamTypeViaLLADefaultSucceeds(): void
    {
        // LLA with default: 'int' — IDE metadata only, not a PHP signature type.
        $className = '\MyClass';
        $param = new PHPParameter('val');
        $param->initStubsMetadata()->setLanguageLevelTypes([]);
        $param->initStubsMetadata()->setDefaultType('int');
        $method    = $this->makeMethod('doSomething', parameters: [$param]);
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$method]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::EARLIEST->value);

        $this->assertFalse($result->hasFailures(), 'Scalar type only in LLA default must not be flagged');
    }

    public function testScalarParamTypeRestrictedToPhp70ViaLLASucceeds(): void
    {
        // #[LanguageLevelTypeAware(['7.0' => 'int'], default: '')] — LLA attribute, not a signature type.
        $className = '\MyClass';
        $param = new PHPParameter('val');
        $param->initStubsMetadata()->setLanguageLevelTypes(['7.0' => 'int']);
        $param->initStubsMetadata()->setDefaultType('');
        $method    = $this->makeMethod('doSomething', parameters: [$param]);
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$method]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::EARLIEST->value);

        $this->assertFalse($result->hasFailures(), 'int only from 7.0 via LLA must not be flagged for PHP 5.6');
    }

    // ── Version filtering: sinceVersion ───────────────────────────────────────

    public function testMethodAvailableOnlyFromPhp70IsNotCollectedForPhp56(): void
    {
        // sinceVersion = '7.0' → method not available in PHP 5.6 → no check
        $className = '\MyClass';
        $method    = $this->makeMethod(
            'doSomething',
            sinceVersion: '7.0',
            parameters: [$this->makeParam('val', new StandaloneType('int'))]
        );
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$method]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::EARLIEST->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Visibility: only overridable methods checked ──────────────────────────

    public function testPrivateMethodWithScalarParamIsNotFlagged(): void
    {
        $className = '\MyClass';
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('privateWork',
                access: 'private',
                parameters: [$this->makeParam('val', new StandaloneType('int'))])]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::EARLIEST->value);

        $this->assertFalse($result->hasFailures(), 'Private method with scalar param must not be flagged');
    }

    public function testProtectedMethodWithScalarParamIsFlagged(): void
    {
        $className = '\MyClass';
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('protectedWork',
                access: 'protected',
                parameters: [$this->makeParam('val', new StandaloneType('int'))])]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::EARLIEST->value);

        $this->assertTrue($result->hasFailures(), 'Protected method with scalar param must be flagged');
    }

    public function testFinalMethodWithScalarParamIsNotFlagged(): void
    {
        $className = '\MyClass';
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('finalWork',
                isFinal: true,
                parameters: [$this->makeParam('val', new StandaloneType('int'))])]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::EARLIEST->value);

        $this->assertFalse($result->hasFailures(), 'Final method with scalar param must not be flagged');
    }

    public function testFinalClassMethodsAreNotFlagged(): void
    {
        $className = '\FinalClass';
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork',
                parameters: [$this->makeParam('val', new StandaloneType('int'))])]
        );
        $stubClass->setIsFinal(true);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::EARLIEST->value);

        $this->assertFalse($result->hasFailures(), 'Methods of a final class must not be flagged');
    }

    public function testMethodWithTentativeReturnTypeIsNotFlagged(): void
    {
        $className = '\MyClass';
        $method    = $this->makeMethod(
            'tentativeWork',
            isTentative: true,
            parameters: [$this->makeParam('val', new StandaloneType('int'))]
        );
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$method]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::EARLIEST->value);

        $this->assertFalse($result->hasFailures(), 'Method with tentative return type must not be flagged');
    }

    // ── Multiple scalar params: all are reported ───────────────────────────────

    public function testMultipleScalarParamsAllReported(): void
    {
        $className = '\MyClass';
        $method    = $this->makeMethod(
            'doSomething',
            parameters: [
                $this->makeParam('a', new StandaloneType('int')),
                $this->makeParam('b', new StandaloneType('string')),
                $this->makeParam('c', new StandaloneType('array')),   // allowed — not scalar
            ]
        );
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$method]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::EARLIEST->value);

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::doSomething::$a', $result->getFailures());
        $this->assertArrayHasKey($className . '::doSomething::$b', $result->getFailures());
        $this->assertArrayNotHasKey($className . '::doSomething::$c', $result->getFailures());
        $this->assertEquals(2, $result->getFailureCount());
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
                affectedChecks: [CheckType::SCALAR_TYPE_FORBIDDEN],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Test class skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry  = KnownProblemsRegistry::getInstance($knownProblemsProvider);
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork',
                parameters: [$this->makeParam('val', new StandaloneType('int'))])]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsScalarTypeForbiddenCheck(null, $registry))->run($stubs, $className, PhpVersions::EARLIEST->value);

        $this->assertFalse($result->hasFailures());
        $this->assertStringContainsString('Test class skip', $result->getSuccesses()[0]);
    }

    public function testKnownProblemAtMethodLevelSkipsSpecificMethod(): void
    {
        $className      = '\MyClass';
        $methodEntityId = $className . '::doWork';

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: $methodEntityId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::SCALAR_TYPE_FORBIDDEN],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Test method skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry  = KnownProblemsRegistry::getInstance($knownProblemsProvider);
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doWork',
                parameters: [$this->makeParam('val', new StandaloneType('int'))])]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsScalarTypeForbiddenCheck(null, $registry))->run($stubs, $className, PhpVersions::EARLIEST->value);

        $this->assertFalse($result->hasFailures());
    }
}
