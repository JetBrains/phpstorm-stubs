<?php

namespace StubTests\Unit\Validator\Meta;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Validator\Meta\StringLiteralsSingleQuotedCheck;

class StringLiteralsSingleQuotedCheckTest extends TestCase
{
    private StringLiteralsSingleQuotedCheck $check;

    protected function setUp(): void
    {
        $this->check = new StringLiteralsSingleQuotedCheck();
    }

    public function testPassesWithSingleQuotedStrings(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    registerArgumentsSet('ini_values', 'display_errors', 'error_reporting');
    expectedArguments(\ini_get(), 0, argumentsSet('ini_values'));
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertEmpty($violations);
    }

    public function testDetectsDoubleQuotedSetName(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    registerArgumentsSet("ini_values", 'display_errors');
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertCount(1, $violations);
        $this->assertStringContainsString('ini_values', $violations[0]);
        $this->assertStringContainsString('double-quoted', $violations[0]);
    }

    public function testDetectsDoubleQuotedMapArgs(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    override(\array_shift(0), map(["" => "$0"]));
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertCount(2, $violations);
    }

    public function testDetectsMultipleViolationsInOneFile(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    registerArgumentsSet("set1", "value1", 'value2');
    expectedArguments(\ini_get(), 0, argumentsSet("set1"));
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertCount(3, $violations);
    }

    public function testIgnoresCodeOutsidePhpStormMetaNamespace(): void
    {
        $code = <<<'PHP'
<?php
namespace SomeOtherNamespace {
    function test() {
        return "some double-quoted string";
    }
}
namespace PHPSTORM_META {
    expectedArguments(\ini_get(), 0, 'display_errors');
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
