<?php

namespace StubTests\Unit\Validator\Meta;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Validator\Meta\ReferencesAreFullyQualifiedCheck;

class ReferencesAreFullyQualifiedCheckTest extends TestCase
{
    private ReferencesAreFullyQualifiedCheck $check;

    protected function setUp(): void
    {
        $this->check = new ReferencesAreFullyQualifiedCheck();
    }

    public function testPassesWithFullyQualifiedReferences(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(\array_change_key_case(), 1, \CASE_LOWER, \CASE_UPPER);
    expectedArguments(\PDO::setAttribute(), 0, \PDO::ATTR_CASE);
    expectedReturnValues(\json_last_error(), \JSON_ERROR_NONE);
    registerArgumentsSet('test', \SORT_ASC, \SORT_DESC);
    override(\array_shift(0), elementType(0));
    exitPoint(\trigger_error(0, \E_USER_ERROR));
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertEmpty($violations);
    }

    public function testDetectsNonFqFunction(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(array_change_key_case(), 1, \CASE_LOWER);
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertCount(1, $violations);
        $this->assertStringContainsString('array_change_key_case', $violations[0]);
        $this->assertStringContainsString('not fully qualified', $violations[0]);
    }

    public function testDetectsNonFqClassInStaticCall(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(PDO::setAttribute(), 0, \PDO::ATTR_CASE);
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertCount(1, $violations);
        $this->assertStringContainsString('PDO', $violations[0]);
        $this->assertStringContainsString('not fully qualified', $violations[0]);
    }

    public function testDetectsNonFqConstantInValue(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(\array_change_key_case(), 1, CASE_LOWER, CASE_UPPER);
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertCount(2, $violations);
        $this->assertStringContainsString('CASE_LOWER', $violations[0]);
        $this->assertStringContainsString('CASE_UPPER', $violations[1]);
    }

    public function testDetectsNonFqClassConstInValue(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(\PDO::setAttribute(), 0, PDO::ATTR_CASE);
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertCount(1, $violations);
        $this->assertStringContainsString('PDO', $violations[0]);
        $this->assertStringContainsString('constant fetch', $violations[0]);
    }

    public function testDetectsNonFqInBitwiseOr(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    registerArgumentsSet('test', SORT_ASC | \SORT_DESC);
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertCount(1, $violations);
        $this->assertStringContainsString('SORT_ASC', $violations[0]);
    }

    public function testSkipsTrueFalseNull(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(\test_func(), 0, true, false, null);
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertEmpty($violations);
    }

    public function testDetectsNonFqInExpectedReturnValuesSubject(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedReturnValues(PHP_OS_FAMILY, 'Windows');
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertCount(1, $violations);
        $this->assertStringContainsString('PHP_OS_FAMILY', $violations[0]);
    }

    public function testDetectsNonFqInExitPoint(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    exitPoint(trigger_error(0, \E_USER_ERROR));
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertCount(1, $violations);
        $this->assertStringContainsString('trigger_error', $violations[0]);
    }

    public function testIgnoresMetaInternalFunctions(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(\ini_get(), 0, argumentsSet('ini_values'));
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertEmpty($violations);
    }

    // --- Helper ---

    private function checkCode(string $code): array
    {
        $dir = sys_get_temp_dir() . '/meta_lint_test_' . getmypid();
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents($dir . '/.phpstorm.meta.php', $code);

        $violations = $this->check->check($dir);

        unlink($dir . '/.phpstorm.meta.php');
        rmdir($dir);

        return $violations;
    }
}
