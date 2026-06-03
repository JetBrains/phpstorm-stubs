<?php

namespace StubTests\Unit\Validator\Meta;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Validator\Meta\ExpectedArgumentsAreUniqueCheck;

class ExpectedArgumentsAreUniqueCheckTest extends TestCase
{
    private ExpectedArgumentsAreUniqueCheck $check;

    protected function setUp(): void
    {
        $this->check = new ExpectedArgumentsAreUniqueCheck();
    }

    public function testPassesWithUniqueRegistrations(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(\array_change_key_case(), 1, \CASE_LOWER, \CASE_UPPER);
    expectedArguments(\file_put_contents(), 2, \FILE_APPEND, \LOCK_EX);
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertEmpty($violations);
    }

    public function testPassesSameFunctionDifferentArgIndex(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(\setlocale(), 0, \LC_ALL, \LC_COLLATE);
    expectedArguments(\setlocale(), 1, 'en_US', 'de_DE');
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertEmpty($violations);
    }

    public function testDetectsDuplicateFunctionArgIndex(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(\array_change_key_case(), 1, \CASE_LOWER);
    expectedArguments(\array_change_key_case(), 1, \CASE_UPPER);
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertCount(1, $violations);
        $this->assertStringContainsString('array_change_key_case', $violations[0]);
        $this->assertStringContainsString('arg 1', $violations[0]);
        $this->assertStringContainsString('Duplicate', $violations[0]);
    }

    public function testDetectsDuplicateMethodArgIndex(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(\PDO::setAttribute(), 0, \PDO::ATTR_CASE);
    expectedArguments(\PDO::setAttribute(), 0, \PDO::ATTR_ERRMODE);
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertCount(1, $violations);
        $this->assertStringContainsString('PDO::setAttribute', $violations[0]);
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
