<?php

namespace StubTests\Unit\Validator\Meta;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Validator\Meta\RegisteredArgumentsSetAreUniqueCheck;

class RegisteredArgumentsSetAreUniqueCheckTest extends TestCase
{
    private RegisteredArgumentsSetAreUniqueCheck $check;

    protected function setUp(): void
    {
        $this->check = new RegisteredArgumentsSetAreUniqueCheck();
    }

    public function testPassesWithUniqueSetNames(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    registerArgumentsSet('ini_values', 'display_errors', 'error_reporting');
    registerArgumentsSet('curl_options', \CURLOPT_RETURNTRANSFER);
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertEmpty($violations);
    }

    public function testDetectsDuplicateSetName(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    registerArgumentsSet('ini_values', 'display_errors');
    registerArgumentsSet('ini_values', 'error_reporting');
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertCount(1, $violations);
        $this->assertStringContainsString('ini_values', $violations[0]);
        $this->assertStringContainsString('Duplicate', $violations[0]);
    }

    public function testDetectsMultipleDuplicates(): void
    {
        $code = <<<'PHP'
<?php
namespace PHPSTORM_META {
    registerArgumentsSet('set_a', 'val1');
    registerArgumentsSet('set_b', 'val2');
    registerArgumentsSet('set_a', 'val3');
    registerArgumentsSet('set_b', 'val4');
}
PHP;
        $violations = $this->checkCode($code);
        $this->assertCount(2, $violations);
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
