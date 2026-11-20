<?php

namespace StubTests\Unit\Validator\Classes\Methods;

use PHPUnit\Framework\Attributes\DataProvider;
use StubTests\Framework\Runner\PhpVersionRange;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Storage\StubDataQueryInterface;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterByReferenceCheck;
use StubTests\Framework\Validator\Classes\Methods\ClassMethodsParameterVariadicCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\Contracts\EntityTypeConfig;
use StubTests\Framework\Validator\KnownProblems\CheckType;
use StubTests\Framework\Validator\KnownProblems\EntityType;
use StubTests\Framework\Validator\KnownProblems\KnownProblemsProvider;
use StubTests\Framework\Validator\KnownProblems\ProblemDefinition;
use StubTests\Framework\Validator\KnownProblems\ProblemType;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

/**
 * ClassMethodsParameterByReferenceCheck and ClassMethodsParameterVariadicCheck, run for each
 * entity kind they are registered for (class, interface, enum). The comparison rules themselves
 * are covered by ParameterPassingComparatorTest.
 */
class ClassMethodsParameterPassingChecksTest extends CheckTestCase
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

    public static function entityKinds(): array
    {
        return [
            'class' => ['class', '\\MyClass'],
            'interface' => ['interface', '\\MyInterface'],
            'enum' => ['enum', '\\MyEnum'],
        ];
    }

    public function testSupportsAllPhpVersions(): void
    {
        foreach ([new ClassMethodsParameterByReferenceCheck(), new ClassMethodsParameterVariadicCheck()] as $check) {
            $this->assertTrue($check->supports(PhpVersions::EARLIEST->value));
            $this->assertTrue($check->supports(PhpVersions::LATEST->value));
        }
    }

    // ── By reference ──────────────────────────────────────────────────────────

    #[DataProvider('entityKinds')]
    public function testByReferenceMatchIsSuccess(string $kind, string $id): void
    {
        $result = $this->runCheck(
            ClassMethodsParameterByReferenceCheck::class,
            $kind,
            $id,
            [$this->makeParam('value', byRef: true)],
            [$this->makeParam('value', byRef: true)]
        );

        $this->assertFalse($result->hasFailures());
        $this->assertGreaterThan(0, $result->getSuccessCount());
    }

    #[DataProvider('entityKinds')]
    public function testByReferenceMismatchIsFailure(string $kind, string $id): void
    {
        $result = $this->runCheck(
            ClassMethodsParameterByReferenceCheck::class,
            $kind,
            $id,
            [$this->makeParam('value')],
            [$this->makeParam('value', byRef: true)]
        );

        $this->assertTrue($result->hasFailures());
        $message = implode("\n", $result->getFailures());
        $this->assertStringContainsString('$value (reflection: by value, stubs: by reference)', $message);
        $this->assertStringContainsString('::doWork', $message);
    }

    public function testByReferencePreferRefIsSuccess(): void
    {
        // FFI::addr(FFI\CData &$ptr) is @prefer-ref in php-src; the stub declares it by value.
        $result = $this->runCheck(
            ClassMethodsParameterByReferenceCheck::class,
            'class',
            '\\FFI',
            [$this->makeParam('ptr', preferRef: true)],
            [$this->makeParam('ptr')]
        );

        $this->assertFalse($result->hasFailures());
    }

    public function testByReferenceMethodLevelKnownProblemSkipsOnlyThatMethod(): void
    {
        $registry = $this->registryWith(EntityType::METHOD, '\\MyClass::doWork', CheckType::PARAMETER_BY_REFERENCE);

        $refl = $this->makeClass('\\MyClass', [
            $this->makeMethod('doWork', parameters: [$this->makeParam('a', byRef: true)]),
            $this->makeMethod('other', parameters: [$this->makeParam('b', byRef: true)]),
        ]);
        $stub = $this->makeClass('\\MyClass', [
            $this->makeMethod('doWork', parameters: [$this->makeParam('a')]),
            $this->makeMethod('other', parameters: [$this->makeParam('b')]),
        ]);

        $result = $this->runEntities(ClassMethodsParameterByReferenceCheck::class, 'class', '\\MyClass', $refl, $stub, $registry);

        $failures = implode("\n", $result->getFailures());
        $this->assertStringContainsString('::other', $failures);
        $this->assertStringNotContainsString('::doWork', $failures);
    }

    // ── Variadic ──────────────────────────────────────────────────────────────

    #[DataProvider('entityKinds')]
    public function testVariadicMatchIsSuccess(string $kind, string $id): void
    {
        $result = $this->runCheck(
            ClassMethodsParameterVariadicCheck::class,
            $kind,
            $id,
            [$this->makeParam('args', variadic: true)],
            [$this->makeParam('args', variadic: true)]
        );

        $this->assertFalse($result->hasFailures());
        $this->assertGreaterThan(0, $result->getSuccessCount());
    }

    #[DataProvider('entityKinds')]
    public function testVariadicMismatchIsFailure(string $kind, string $id): void
    {
        $result = $this->runCheck(
            ClassMethodsParameterVariadicCheck::class,
            $kind,
            $id,
            [$this->makeParam('args')],
            [$this->makeParam('args', variadic: true)],
            '7.4'
        );

        $this->assertTrue($result->hasFailures());
        $message = implode("\n", $result->getFailures());
        $this->assertStringContainsString('stubs declare variadic $args', $message);
        $this->assertStringContainsString('PHP 7.4', $message);
    }

    public function testVariadicSpelledOutLeadingArgumentIsSuccess(): void
    {
        // mysqli_stmt::bind_result: reflection (&...$vars), stubs (&$var1, &...$_).
        $result = $this->runCheck(
            ClassMethodsParameterVariadicCheck::class,
            'class',
            '\\mysqli_stmt',
            [$this->makeParam('vars', variadic: true, byRef: true)],
            [$this->makeParam('var1', byRef: true), $this->makeParam('_', variadic: true, byRef: true)]
        );

        $this->assertFalse($result->hasFailures());
    }

    public function testVariadicClassLevelKnownProblemSkipsValidation(): void
    {
        $registry = $this->registryWith(EntityType::CLASS_TYPE, '\\MyClass', CheckType::PARAMETER_VARIADIC);

        $refl = $this->makeClass('\\MyClass', [$this->makeMethod('doWork', parameters: [$this->makeParam('a')])]);
        $stub = $this->makeClass('\\MyClass', [$this->makeMethod('doWork', parameters: [$this->makeParam('a', variadic: true)])]);

        $result = $this->runEntities(ClassMethodsParameterVariadicCheck::class, 'class', '\\MyClass', $refl, $stub, $registry);

        $this->assertFalse($result->hasFailures());
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    private function runCheck(string $checkClass, string $kind, string $id, array $reflParams, array $stubParams, string $version = '8.1'): CheckResultSet
    {
        $make = match ($kind) {
            'class' => fn (array $methods) => $this->makeClass($id, $methods),
            'interface' => fn (array $methods) => $this->makeInterface($id, $methods),
            'enum' => fn (array $methods) => $this->makeEnum($id, $methods),
        };

        return $this->runEntities(
            $checkClass,
            $kind,
            $id,
            $make([$this->makeMethod('doWork', parameters: $reflParams)]),
            $make([$this->makeMethod('doWork', parameters: $stubParams)]),
            $this->emptyRegistry(),
            $version
        );
    }

    private function runEntities(string $checkClass, string $kind, string $id, object $refl, object $stub, KnownProblemsRegistry $registry, string $version = '8.1'): CheckResultSet
    {
        [$provider, $getter, $config] = match ($kind) {
            'class' => [$this->createMockReflectionProvider([], [$refl]), 'getClasses', null],
            'interface' => [$this->createMockReflectionProviderWithInterfaces([$refl]), 'getInterfaces', EntityTypeConfig::forInterface()],
            'enum' => [$this->createMockReflectionProviderWithEnums([$refl]), 'getEnums', EntityTypeConfig::forEnum()],
        };
        /** @var StubDataQueryInterface $stubs */
        $stubs = $this->createMockStorageManager();
        $stubs->method($getter)->willReturn([$stub]);

        $check = new $checkClass(reflectionProvider: $provider, knownProblemsRegistry: $registry, entityTypeConfig: $config);
        return $check->run($stubs, $id, $version);
    }

    /**
     * No known problems: the default registry would apply the real DefaultKnownProblemsProvider,
     * so a future entry for an id used here (e.g. \FFI) could make a test pass by skipping the check.
     */
    private function emptyRegistry(): KnownProblemsRegistry
    {
        $knownProblemsProvider = $this->createStub(KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([]);
        KnownProblemsRegistry::reset();
        return KnownProblemsRegistry::getInstance($knownProblemsProvider);
    }

    private function registryWith(EntityType $entityType, string $id, CheckType $checkType): KnownProblemsRegistry
    {
        $knownProblemsProvider = $this->createStub(KnownProblemsProvider::class);
        $knownProblemsProvider->method('getProblems')->willReturn([
            new ProblemDefinition(
                entityType: $entityType,
                entityId: $id,
                type: ProblemType::INTERNAL_IMPLEMENTATION,
                affectedChecks: [$checkType],
                versionRange: new PhpVersionRange(PhpVersions::EARLIEST, PhpVersions::LATEST),
                reason: 'Test skip reason'
            ),
        ]);
        KnownProblemsRegistry::reset();
        return KnownProblemsRegistry::getInstance($knownProblemsProvider);
    }
}
