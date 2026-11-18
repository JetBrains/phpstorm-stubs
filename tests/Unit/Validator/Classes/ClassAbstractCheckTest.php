<?php

namespace StubTests\Unit\Validator\Classes;

use PHPUnit\Framework\Attributes\DataProvider;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\ClassAbstractCheck;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class ClassAbstractCheckTest extends CheckTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->useNoKnownProblems();
    }

    protected function tearDown(): void
    {
        KnownProblemsRegistry::reset();
        parent::tearDown();
    }

    public function testSupportsAllVersions(): void
    {
        $check = new ClassAbstractCheck();
        $this->assertTrue($check->supports(PhpVersions::EARLIEST->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    public static function matchingFlags(): array
    {
        return ['both abstract' => [true], 'both concrete' => [false]];
    }

    #[DataProvider('matchingFlags')]
    public function testMatchingFlagPasses(bool $isAbstract): void
    {
        $result = $this->runCheck(
            $this->makeClass('\\Dom\\Document', isAbstract: $isAbstract),
            $this->makeClass('\\Dom\\Document', isAbstract: $isAbstract)
        );

        $this->assertFalse($result->hasFailures());
        $this->assertSame(1, $result->getSuccessCount());
    }

    public function testAbstractInReflectionButConcreteInStubsFails(): void
    {
        $result = $this->runCheck(
            $this->makeClass('\\Dom\\Document', isAbstract: true),
            $this->makeClass('\\Dom\\Document')
        );

        $this->assertSame(
            'Class \\Dom\\Document is abstract in PHP 8.4 but non-abstract in stubs',
            $result->getFailures()['\\Dom\\Document']
        );
    }

    public function testConcreteInReflectionButAbstractInStubsFails(): void
    {
        $result = $this->runCheck(
            $this->makeClass('\\Foo'),
            $this->makeClass('\\Foo', isAbstract: true)
        );

        $this->assertSame(
            'Class \\Foo is non-abstract in PHP 8.4 but abstract in stubs',
            $result->getFailures()['\\Foo']
        );
    }

    public function testClassMissingFromStubsFails(): void
    {
        $result = (new ClassAbstractCheck($this->createMockReflectionProviderWithClasses([$this->makeClass('\\Foo')])))
            ->run($this->createMockStorageManager(), '\\Foo', '8.4');

        $this->assertStringContainsString('not found in stubs', $result->getFailures()['\\Foo']);
    }

    private function runCheck($reflClass, $stubClass)
    {
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$stubClass]);

        return (new ClassAbstractCheck($this->createMockReflectionProviderWithClasses([$reflClass])))
            ->run($stubs, $reflClass->getId(), '8.4');
    }
}
