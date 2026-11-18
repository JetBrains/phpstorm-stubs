<?php

namespace StubTests\Unit\Validator\Classes\Constants;

use StubTests\Framework\Model\PHPClassConstant;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Classes\Constants\ClassConstantsDeprecationCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class ClassConstantsDeprecationCheckTest extends CheckTestCase
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

    public function testSupportsPhp84AndAbove(): void
    {
        $check = new ClassConstantsDeprecationCheck();
        $this->assertFalse($check->supports(PhpVersions::PHP_8_3->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_8_4->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    public function testMatchingDeprecationPasses(): void
    {
        $result = $this->runCheck(
            $this->makeClassConstant('FL_RECOMPRESS', deprecated: true),
            $this->makeClassConstant('FL_RECOMPRESS', deprecated: true, deprecatedSinceVersion: '8.3')
        );

        $this->assertFalse($result->hasFailures());
    }

    public function testDeprecatedInPhpButNotInStubsFails(): void
    {
        $result = $this->runCheck(
            $this->makeClassConstant('FL_RECOMPRESS', deprecated: true),
            $this->makeClassConstant('FL_RECOMPRESS')
        );

        $this->assertSame(
            'Constant \\ZipArchive::FL_RECOMPRESS is deprecated in PHP 8.4 but not marked as deprecated in stubs',
            $result->getFailures()['\\ZipArchive::FL_RECOMPRESS']
        );
    }

    public function testStubsNamingADeprecationVersionPhpDoesNotHaveFails(): void
    {
        $result = $this->runCheck(
            $this->makeClassConstant('FL_RECOMPRESS'),
            $this->makeClassConstant('FL_RECOMPRESS', deprecated: true, deprecatedSinceVersion: '8.4')
        );

        $this->assertSame(
            'Constant \\ZipArchive::FL_RECOMPRESS is marked as deprecated since PHP 8.4 in stubs but PHP 8.4 does not deprecate it',
            $result->getFailures()['\\ZipArchive::FL_RECOMPRESS']
        );
    }

    public function testDocumentationOnlyDeprecationWithoutVersionPasses(): void
    {
        $result = $this->runCheck(
            $this->makeClassConstant('FL_RECOMPRESS'),
            $this->makeClassConstant('FL_RECOMPRESS', deprecated: true)
        );

        $this->assertFalse($result->hasFailures());
    }

    private function runCheck(PHPClassConstant $reflConstant, PHPClassConstant $stubConstant): CheckResultSet
    {
        $stubs = $this->createMockStorageManager();
        $stubs->method('getClasses')->willReturn([$this->makeClass('\\ZipArchive', constants: [$stubConstant])]);
        $provider = $this->createMockReflectionProviderWithClasses([$this->makeClass('\\ZipArchive', constants: [$reflConstant])]);

        return (new ClassConstantsDeprecationCheck($provider))->run($stubs, '\\ZipArchive', '8.4');
    }
}
