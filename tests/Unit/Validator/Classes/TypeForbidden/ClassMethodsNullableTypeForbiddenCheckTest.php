<?php

namespace StubTests\Unit\Validator\Classes\TypeForbidden;

use StubTests\Framework\Parsers\Model\PHPMethod;
use StubTests\Framework\Parsers\Model\Types\StandaloneType;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\TypeForbidden\ClassMethodsNullableTypeForbiddenCheck;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class ClassMethodsNullableTypeForbiddenCheckTest extends CheckTestCase
{
    private ClassMethodsNullableTypeForbiddenCheck $check;

    protected function setUp(): void
    {
        parent::setUp();
        KnownProblemsRegistry::reset();
        $this->check = new ClassMethodsNullableTypeForbiddenCheck();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    // ── supports() ────────────────────────────────────────────────────────────

    public function testSupportsOnlyVersionsBeforePhp71(): void
    {
        $this->assertTrue($this->check->supports(PhpVersions::EARLIEST->value),  'PHP 5.6 must be supported');
        $this->assertTrue($this->check->supports(PhpVersions::PHP_7_0->value),   'PHP 7.0 must be supported');
        $this->assertFalse($this->check->supports(PhpVersions::PHP_7_1->value),  'PHP 7.1 must NOT be supported');
        $this->assertFalse($this->check->supports(PhpVersions::PHP_8_0->value),  'PHP 8.0 must NOT be supported');
        $this->assertFalse($this->check->supports(PhpVersions::LATEST->value),   'PHP 8.4 must NOT be supported');
    }

    // ── Entity not found ──────────────────────────────────────────────────────

    public function testClassNotFoundInStubsSucceeds(): void
    {
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([]);

        $result = $this->check->run($stubs, '\MissingClass', PhpVersions::PHP_7_0->value);

        // Missing entity is not this check's responsibility — succeed silently.
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    // ── No methods / no nullable types ───────────────────────────────────────────

    public function testClassWithNoMethodsSucceeds(): void
    {
        $className = '\MyClass';
        $stubClass = $this->createMockClassWithProperties($className);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::PHP_7_0->value);

        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testMethodWithNoReturnTypeSucceeds(): void
    {
        $className = '\MyClass';
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('doSomething')]  // no return type
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::PHP_7_0->value);

        $this->assertFalse($result->hasFailures());
    }

    public function testMethodWithNonNullableReturnTypeSucceeds(): void
    {
        $className = '\MyClass';
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('getString', new StandaloneType('string'))]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::PHP_7_0->value);

        $this->assertFalse($result->hasFailures());
    }

    // ── Nullable return type detection ─────────────────────────────────────────

    public function testNullableReturnTypeViaSignatureIsFailure(): void
    {
        // ?string in stub signature → NullableType → toString() = 'string|null' → flagged
        $className = '\MyClass';
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('getStr', $this->createNullableType('string'))]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::PHP_7_0->value);

        $this->assertTrue($result->hasFailures());
        $methodKey = $className . '::getStr';
        $this->assertArrayHasKey($methodKey, $result->getFailures());
        $this->assertStringContainsString('nullable return type', $result->getFailures()[$methodKey]);
        $this->assertStringContainsString('PHP 7.1', $result->getFailures()[$methodKey]);
    }

    public function testNullableReturnTypeViaSignatureIsFailureAlsoForPhp56(): void
    {
        // Check also triggers for PHP 5.6 — entities exclusive to PHP 5.6 must be covered.
        $className = '\LegacyClass';
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('get', $this->createNullableType('int'))]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::EARLIEST->value);

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::get', $result->getFailures());
    }

    public function testNullableReturnTypeViaLLADefaultSucceeds(): void
    {
        // LanguageLevelTypeAware with default: '?string' — LLA is IDE metadata, not a PHP signature type.
        // The check must NOT flag this: no actual ?T in the PHP signature → no compatibility issue.
        $className  = '\MyClass';
        $method     = new PHPMethod();
        $method->setName('getStr');
        $method->setAccess($this->createAccessModifier('public'));
        $method->initStubsMetadata()->setLanguageLevelTypes([]);    // no version-specific entries
        $method->initStubsMetadata()->setDefaultType('?string');    // LLA attribute default — IDE metadata only

        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null, [$method]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::PHP_7_0->value);

        $this->assertFalse($result->hasFailures(), 'Nullable type only in LLA default must not be flagged');
    }

    public function testNullableReturnTypeRestrictedToPhp71ViaLLASucceeds(): void
    {
        // #[LanguageLevelTypeAware(['7.1' => '?string'], default: '')] → for PHP 7.0 returns '' → OK
        $className = '\MyClass';
        $method    = new PHPMethod();
        $method->setName('getStr');
        $method->setAccess($this->createAccessModifier('public'));
        $method->initStubsMetadata()->setLanguageLevelTypes(['7.1' => '?string']);
        $method->initStubsMetadata()->setDefaultType('');   // no type for pre-7.1

        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null, [$method]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::PHP_7_0->value);

        $this->assertFalse($result->hasFailures(), '?string only from 7.1 via LLA must not be flagged for PHP 7.0');
    }

    // ── Version filtering: sinceVersion ───────────────────────────────────────

    public function testMethodAvailableOnlyFromPhp71IsNotCollectedForPhp70(): void
    {
        // sinceVersion = '7.1' → not included when collecting for PHP 7.0
        $className = '\MyClass';
        $method    = $this->makeMethod('getStr', $this->createNullableType('string'), sinceVersion: '7.1');
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null, [$method]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::PHP_7_0->value);

        // Method not available in PHP 7.0, so no failure
        $this->assertFalse($result->hasFailures());
    }

    // ── Visibility: only overridable methods checked ──────────────────────────

    public function testPrivateMethodWithNullableTypeIsNotFlagged(): void
    {
        // Private methods cannot be overridden, so nullable types are irrelevant.
        $className = '\MyClass';
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('privateGet', $this->createNullableType('string'), access: 'private')]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::PHP_7_0->value);

        $this->assertFalse($result->hasFailures(), 'Private method with nullable type must not be flagged');
    }

    public function testProtectedMethodWithNullableTypeIsFlagged(): void
    {
        // Protected methods CAN be overridden — must be checked.
        $className = '\MyClass';
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('protectedGet', $this->createNullableType('string'), access: 'protected')]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::PHP_7_0->value);

        $this->assertTrue($result->hasFailures(), 'Protected method with nullable type must be flagged');
    }

    public function testFinalMethodWithNullableTypeIsNotFlagged(): void
    {
        // Final methods cannot be overridden, so nullable types are irrelevant.
        $className = '\MyClass';
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('finalGet', $this->createNullableType('string'), isFinal: true)]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::PHP_7_0->value);

        $this->assertFalse($result->hasFailures(), 'Final method with nullable type must not be flagged');
    }

    public function testFinalClassMethodsAreNotFlagged(): void
    {
        // Final classes cannot be extended — no child class can ever override any method.
        $className = '\FinalClass';
        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('getStr', $this->createNullableType('string'))]
        );
        $stubClass->setIsFinal(true);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::PHP_7_0->value);

        $this->assertFalse($result->hasFailures(), 'Methods of a final class must not be flagged');
    }

    public function testMethodWithTentativeReturnTypeIsNotFlagged(): void
    {
        // Methods with #[TentativeType] were introduced as non-enforced hints in PHP 8.1.
        // Subclasses can omit the return type without error, so there is no compatibility issue.
        $className = '\MyClass';
        $method = $this->makeMethod('tentativeGet', $this->createNullableType('string'), isTentative: true);

        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$method]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::PHP_7_0->value);

        $this->assertFalse($result->hasFailures(), 'Method with tentative return type must not be flagged');
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
                affectedChecks: [CheckType::NULLABLE_TYPE_FORBIDDEN],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Test class skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('getStr', $this->createNullableType('string'))]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsNullableTypeForbiddenCheck(null, $registry))->run($stubs, $className, PhpVersions::PHP_7_0->value);

        $this->assertFalse($result->hasFailures());
        $this->assertStringContainsString('Test class skip', $result->getSuccesses()[0]);
    }

    // ── Nullable parameter type detection ─────────────────────────────────────

    public function testNullableParamTypeViaSignatureIsFailure(): void
    {
        $className = '\MyClass';
        $method    = $this->makeMethod(
            'doSomething',
            parameters: [$this->makeParam('val', $this->createNullableType('string'))]
        );
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$method]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::PHP_7_0->value);

        $this->assertTrue($result->hasFailures());
        $paramKey = $className . '::doSomething::$val';
        $this->assertArrayHasKey($paramKey, $result->getFailures());
        $this->assertStringContainsString('nullable type hint', $result->getFailures()[$paramKey]);
        $this->assertStringContainsString('PHP 7.1', $result->getFailures()[$paramKey]);
    }

    public function testNonNullableParamTypeSucceeds(): void
    {
        $className = '\MyClass';
        $method    = $this->makeMethod(
            'doSomething',
            parameters: [$this->makeParam('val', new StandaloneType('string'))]
        );
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$method]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::PHP_7_0->value);

        $this->assertFalse($result->hasFailures());
    }

    public function testNullableParamTypeViaLLADefaultSucceeds(): void
    {
        // LanguageLevelTypeAware with default: '?string' — LLA is IDE metadata, not a PHP signature type.
        // The check must NOT flag this: no actual ?T in the PHP signature → no compatibility issue.
        $className = '\MyClass';
        $param     = $this->makeParam('val', languageLevelTypes: [], defaultType: '?string');
        $method    = $this->makeMethod('doSomething', parameters: [$param]);
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$method]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::PHP_7_0->value);

        $this->assertFalse($result->hasFailures(), 'Nullable type only in LLA default must not be flagged');
    }

    public function testNullableParamTypeRestrictedToPhp71ViaLLASucceeds(): void
    {
        // #[LanguageLevelTypeAware(['7.1' => '?string'], default: '')] → for PHP 7.0 returns '' → OK
        $className = '\MyClass';
        $param     = $this->makeParam('val', languageLevelTypes: ['7.1' => '?string'], defaultType: '');
        $method    = $this->makeMethod('doSomething', parameters: [$param]);
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$method]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::PHP_7_0->value);

        $this->assertFalse($result->hasFailures(), '?string only from 7.1 via LLA must not be flagged for PHP 7.0');
    }

    public function testMethodWithNullableReturnAndNullableParamReportsBoth(): void
    {
        // Both return type and parameter type are nullable → two separate failure entries.
        $className = '\MyClass';
        $method    = $this->makeMethod(
            'doSomething',
            $this->createNullableType('string'),        // nullable return
            parameters: [$this->makeParam('val', $this->createNullableType('int'))]   // nullable param
        );
        $stubClass = $this->createMockClassWithProperties($className, null, null, null, [$method]);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = $this->check->run($stubs, $className, PhpVersions::PHP_7_0->value);

        $this->assertTrue($result->hasFailures());
        $this->assertArrayHasKey($className . '::doSomething', $result->getFailures());
        $this->assertArrayHasKey($className . '::doSomething::$val', $result->getFailures());
        $this->assertEquals(2, $result->getFailureCount());
    }

    // ── Known problems ────────────────────────────────────────────────────────

    public function testKnownProblemAtMethodLevelSkipsSpecificMethod(): void
    {
        $className      = '\MyClass';
        $methodEntityId = $className . '::getStr';

        $knownProblemsProvider = $this->createMock(\StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: EntityType::METHOD,
                entityId: $methodEntityId,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [CheckType::NULLABLE_TYPE_FORBIDDEN],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Test method skip'
            ),
        ]);

        KnownProblemsRegistry::reset();
        $registry = KnownProblemsRegistry::getInstance($knownProblemsProvider);

        $stubClass = $this->createMockClassWithProperties(
            $className, null, null, null,
            [$this->makeMethod('getStr', $this->createNullableType('string'))]
        );

        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        $result = (new ClassMethodsNullableTypeForbiddenCheck(null, $registry))->run($stubs, $className, PhpVersions::PHP_7_0->value);

        $this->assertFalse($result->hasFailures());
    }
}
