<?php

namespace StubTests\Unit\Validator\Constants;

use StubTests\Framework\Model\PHPConstant;
use StubTests\Framework\Runner\PhpVersions;
use StubTests\Framework\Validator\Constants\ConstantDeprecationCheck;
use StubTests\Framework\Validator\Contracts\CheckResultSet;
use StubTests\Framework\Validator\Contracts\ReflectionProviderInterface;
use StubTests\Framework\Validator\KnownProblemsRegistry;
use StubTests\Unit\Validator\CheckTestCase;

class ConstantDeprecationCheckTest extends CheckTestCase
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
        $check = new ConstantDeprecationCheck();
        $this->assertFalse($check->supports(PhpVersions::PHP_8_3->value));
        $this->assertTrue($check->supports(PhpVersions::PHP_8_4->value));
        $this->assertTrue($check->supports(PhpVersions::LATEST->value));
    }

    public function testDeprecatedOnBothSidesPasses(): void
    {
        $result = $this->runCheck(
            $this->makeGlobalConstant('\\ASSERT_ACTIVE', deprecated: true),
            $this->makeGlobalConstant('\\ASSERT_ACTIVE', deprecated: true, deprecatedSinceVersion: '8.3'),
            '8.4'
        );

        $this->assertFalse($result->hasFailures());
    }

    public function testNotDeprecatedOnEitherSidePasses(): void
    {
        $result = $this->runCheck($this->makeGlobalConstant('\\E_ALL'), $this->makeGlobalConstant('\\E_ALL'), '8.4');

        $this->assertFalse($result->hasFailures());
    }

    public function testDeprecatedInPhpButNotInStubsFails(): void
    {
        $result = $this->runCheck(
            $this->makeGlobalConstant('\\ASSERT_ACTIVE', deprecated: true),
            $this->makeGlobalConstant('\\ASSERT_ACTIVE'),
            '8.4'
        );

        $this->assertSame(
            'Constant \\ASSERT_ACTIVE is deprecated in PHP 8.4 but not marked as deprecated in stubs',
            $result->getFailures()['\\ASSERT_ACTIVE']
        );
    }

    public function testDeprecatedInPhpBeforeTheVersionStubsGiveFails(): void
    {
        $result = $this->runCheck(
            $this->makeGlobalConstant('\\MB_ONIGURUMA_VERSION', deprecated: true),
            $this->makeGlobalConstant('\\MB_ONIGURUMA_VERSION', deprecated: true, deprecatedSinceVersion: '8.6'),
            '8.5'
        );

        $this->assertSame(
            'Constant \\MB_ONIGURUMA_VERSION is deprecated in PHP 8.5 but not marked as deprecated in stubs (stubs say since 8.6)',
            $result->getFailures()['\\MB_ONIGURUMA_VERSION']
        );
    }

    public function testStubsNamingADeprecationVersionPhpDoesNotHaveFails(): void
    {
        $result = $this->runCheck(
            $this->makeGlobalConstant('\\FILTER_DEFAULT'),
            $this->makeGlobalConstant('\\FILTER_DEFAULT', deprecated: true, deprecatedSinceVersion: '8.5'),
            '8.5'
        );

        $this->assertSame(
            'Constant \\FILTER_DEFAULT is marked as deprecated since PHP 8.5 in stubs but PHP 8.5 does not deprecate it',
            $result->getFailures()['\\FILTER_DEFAULT']
        );
    }

    public function testStubDeprecationFromALaterVersionPassesBeforeIt(): void
    {
        $result = $this->runCheck(
            $this->makeGlobalConstant('\\SORT_LOCALE_STRING'),
            $this->makeGlobalConstant('\\SORT_LOCALE_STRING', deprecated: true, deprecatedSinceVersion: '8.6'),
            '8.5'
        );

        $this->assertFalse($result->hasFailures());
    }

    public function testDocumentationOnlyDeprecationWithoutVersionPasses(): void
    {
        $result = $this->runCheck(
            $this->makeGlobalConstant('\\DATE_ISO8601'),
            $this->makeGlobalConstant('\\DATE_ISO8601', deprecated: true),
            '8.5'
        );

        $this->assertFalse($result->hasFailures());
    }

    public function testConstantMissingFromStubsIsLeftToTheExistsCheck(): void
    {
        $result = $this->runCheck($this->makeGlobalConstant('\\ASSERT_ACTIVE', deprecated: true), null, '8.4');

        $this->assertFalse($result->hasFailures());
    }

    public function testDeprecationSinceAnExtensionVersionIsNotAPhpClaim(): void
    {
        $result = $this->runCheck(
            $this->makeGlobalConstant('\\EXT_CONSTANT'),
            $this->makeGlobalConstant('\\EXT_CONSTANT', deprecated: true, deprecatedSinceVersion: '1.20.0'),
            '8.4'
        );

        $this->assertFalse($result->hasFailures());
    }

    public function testStubConstantNotAvailableInTheVersionIsLeftToTheExistsChecks(): void
    {
        $stubConstant = $this->makeGlobalConstant('\\OLD_CONSTANT', deprecated: true, deprecatedSinceVersion: '8.0');
        $stubConstant->initStubsMetadata()->setRemovedVersion('8.4');

        $result = $this->runCheck($this->makeGlobalConstant('\\OLD_CONSTANT'), $stubConstant, '8.4');

        $this->assertFalse($result->hasFailures());
    }

    private function runCheck(PHPConstant $reflConstant, ?PHPConstant $stubConstant, string $phpVersion): CheckResultSet
    {
        $provider = $this->createStub(ReflectionProviderInterface::class);
        $reflection = $this->createMockStorageManager();
        $reflection->method('getConstants')->willReturn([$reflConstant]);
        $provider->method('getReflection')->willReturn($reflection);

        $stubs = $this->createMockStorageManager();
        $stubs->method('getConstants')->willReturn($stubConstant === null ? [] : [$stubConstant]);

        return (new ConstantDeprecationCheck($provider))->run($stubs, $reflConstant->getId(), $phpVersion);
    }
}
