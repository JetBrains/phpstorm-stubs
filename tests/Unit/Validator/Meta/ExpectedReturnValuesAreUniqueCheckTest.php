<?php

namespace StubTests\Unit\Validator\Meta;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Validator\Meta\ExpectedReturnValuesAreUniqueCheck;

class ExpectedReturnValuesAreUniqueCheckTest extends TestCase
{
    private ExpectedReturnValuesAreUniqueCheck $check;

    protected function setUp(): void
    {
        $this->check = new ExpectedReturnValuesAreUniqueCheck();
    }

    public function testPassesWithUniqueRegistrations(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedReturnValues(\json_last_error(), \JSON_ERROR_NONE, \JSON_ERROR_DEPTH);
    expectedReturnValues(\php_sapi_name(), 'cli', 'fpm-fcgi');
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertEmpty($violations);
    }

    public function testDetectsDuplicateFunction(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedReturnValues(\json_last_error(), \JSON_ERROR_NONE);
    expectedReturnValues(\json_last_error(), \JSON_ERROR_DEPTH);
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertCount(1, $violations);
        $this->assertStringContainsString('json_last_error', $violations[0]);
        $this->assertStringContainsString('Duplicate', $violations[0]);
    }

    public function testDetectsDuplicateMethod(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedReturnValues(\ReflectionClass::getModifiers(), \ReflectionClass::IS_FINAL);
    expectedReturnValues(\ReflectionClass::getModifiers(), \ReflectionClass::IS_EXPLICIT_ABSTRACT);
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertCount(1, $violations);
        $this->assertStringContainsString('ReflectionClass::getModifiers', $violations[0]);
    }

    public function testDetectsDuplicateConstant(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedReturnValues(\PHP_OS_FAMILY, 'Windows', 'Linux');
    expectedReturnValues(\PHP_OS_FAMILY, 'Darwin');
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertCount(1, $violations);
        $this->assertStringContainsString('PHP_OS_FAMILY', $violations[0]);
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
