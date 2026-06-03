<?php

namespace StubTests\Unit\Validator\Meta;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Validator\Meta\MetaInternalTagCheck;

class MetaInternalTagCheckTest extends TestCase
{
    private MetaInternalTagCheck $check;

    protected function setUp(): void
    {
        $this->check = new MetaInternalTagCheck();
    }

    public function testPassesWhenMetaTagAndOverrideMatch(): void
    {
        $stubCode = <<<'PHP'
<?php
/**
 * @meta
 */
function array_filter(array $array): array {}
PHP;

        $metaCode = <<<'PHP'
<?php
namespace PHPSTORM_META {
    override(\array_filter(0), type(0));
}
PHP;
        $violations = $this->checkWithFiles($stubCode, $metaCode);
        $this->assertEmpty($violations);
    }

    public function testDetectsMetaTagWithoutOverride(): void
    {
        $stubCode = <<<'PHP'
<?php
/**
 * @meta
 */
function array_filter(array $array): array {}
PHP;

        $metaCode = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(\ini_get(), 0, 'display_errors');
}
PHP;
        $violations = $this->checkWithFiles($stubCode, $metaCode);
        $this->assertCount(1, $violations);
        $this->assertStringContainsString('array_filter', $violations[0]);
        $this->assertStringContainsString('@meta tag but no corresponding override()', $violations[0]);
    }

    public function testDetectsOverrideWithoutMetaTag(): void
    {
        $stubCode = <<<'PHP'
<?php
/**
 * Some function.
 */
function array_filter(array $array): array {}
PHP;

        $metaCode = <<<'PHP'
<?php
namespace PHPSTORM_META {
    override(\array_filter(0), type(0));
}
PHP;
        $violations = $this->checkWithFiles($stubCode, $metaCode);
        $this->assertCount(1, $violations);
        $this->assertStringContainsString('array_filter', $violations[0]);
        $this->assertStringContainsString('no @meta phpdoc tag', $violations[0]);
    }

    public function testHandlesMethodsInClasses(): void
    {
        $stubCode = <<<'PHP'
<?php
class DOMNode {
    /**
     * @meta
     */
    public function appendChild(DOMNode $node) {}
}
PHP;

        $metaCode = <<<'PHP'
<?php
namespace PHPSTORM_META {
    override(\DOMNode::appendChild(0), type(0));
}
PHP;
        $violations = $this->checkWithFiles($stubCode, $metaCode);
        $this->assertEmpty($violations);
    }

    public function testDetectsMethodOverrideWithoutMetaTag(): void
    {
        $stubCode = <<<'PHP'
<?php
class DOMNode {
    /**
     * Adds child.
     */
    public function appendChild(DOMNode $node) {}
}
PHP;

        $metaCode = <<<'PHP'
<?php
namespace PHPSTORM_META {
    override(\DOMNode::appendChild(0), type(0));
}
PHP;
        $violations = $this->checkWithFiles($stubCode, $metaCode);
        $this->assertCount(1, $violations);
        $this->assertStringContainsString('DOMNode::appendChild', $violations[0]);
    }

    public function testSkipsThirdPartyOverrides(): void
    {
        $stubCode = <<<'PHP'
<?php
function some_func(): void {}
PHP;

        $metaCode = <<<'PHP'
<?php
namespace PHPSTORM_META {
    override(\PHPUnit\Framework\TestCase::createMock(0), map(['' => '$0']));
    override(\Mockery::mock(0), map(['' => '@']));
    override(\mock(0), map(['' => '@']));
}
PHP;
        $violations = $this->checkWithFiles($stubCode, $metaCode);
        $this->assertEmpty($violations);
    }

    public function testHandlesNamespacedClasses(): void
    {
        $stubCode = <<<'PHP'
<?php
namespace FFI {
    class FFI {
        /**
         * @meta
         */
        public static function addr($ptr) {}
    }
}
PHP;

        $metaCode = <<<'PHP'
<?php
namespace PHPSTORM_META {
    override(\FFI\FFI::addr(), type(0));
}
PHP;
        $violations = $this->checkWithFiles($stubCode, $metaCode);
        $this->assertEmpty($violations);
    }

    public function testBidirectionalMismatch(): void
    {
        $stubCode = <<<'PHP'
<?php
/**
 * @meta
 */
function func_with_meta(): array {}

function func_without_meta(): array {}
PHP;

        $metaCode = <<<'PHP'
<?php
namespace PHPSTORM_META {
    override(\func_without_meta(0), type(0));
}
PHP;
        $violations = $this->checkWithFiles($stubCode, $metaCode);
        $this->assertCount(2, $violations);

        $violationTexts = implode("\n", $violations);
        $this->assertStringContainsString('func_with_meta', $violationTexts);
        $this->assertStringContainsString('func_without_meta', $violationTexts);
    }

    public function testIgnoresFunctionsWithoutDocblock(): void
    {
        $stubCode = <<<'PHP'
<?php
function no_doc_func(): void {}
PHP;

        $metaCode = <<<'PHP'
<?php
namespace PHPSTORM_META {
    expectedArguments(\no_doc_func(), 0, 'a', 'b');
}
PHP;
        $violations = $this->checkWithFiles($stubCode, $metaCode);
        $this->assertEmpty($violations);
    }

    // --- Helper ---

    private function checkWithFiles(string $stubCode, string $metaCode): array
    {
        $dir = sys_get_temp_dir() . '/meta_internal_tag_test_' . getmypid();
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        // Write stub file
        file_put_contents($dir . '/stubs.php', $stubCode);

        // Write meta file
        file_put_contents($dir . '/.phpstorm.meta.php', $metaCode);

        $violations = $this->check->check($dir);

        // Cleanup
        @unlink($dir . '/stubs.php');
        @unlink($dir . '/.phpstorm.meta.php');
        @rmdir($dir);

        return $violations;
    }
}
