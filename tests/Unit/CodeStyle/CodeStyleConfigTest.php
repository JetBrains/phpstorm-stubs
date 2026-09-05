<?php

namespace StubTests\Unit\CodeStyle;

use PHPUnit\Framework\TestCase;

/**
 * Guards `composer cs-fix` against re-acquiring a rule that treats a comment-only body as empty.
 *
 * The repo used to register a custom `PhpStorm/braces_one_line` fixer that located a block's
 * closing brace with `Tokens::getNextMeaningfulToken()`. That helper skips `T_COMMENT` and
 * `T_DOC_COMMENT`, so a body whose only content was a comment looked empty; the fixer then cleared
 * every token in the range and rebuilt it as `{}`, deleting the comment. Running the real fixer over
 * a three-method class reproduced it: the line comment and the block comment both vanished.
 *
 * Nothing caught that, because a formatter is only ever exercised by running it. So this asserts on
 * the actual configured rule set by invoking the actual binary — a rules-array assertion would pass
 * for any future rule with the same flaw under a different name.
 */
final class CodeStyleConfigTest extends TestCase
{
    /**
     * Deliberately already conformant apart from the empty bodies, so a single fixer run produces
     * exactly one intended change: `trulyEmpty()` collapses, the other two must not.
     */
    private const SOURCE = <<<'PHP'
        <?php

        namespace Scratch;

        class Sample
        {
            public function noOp(): void
            {
                // Intentionally empty: the parent already does the work.
            }

            public function documentedNoOp(): void
            {
                /* keep this */
            }

            public function trulyEmpty(): void
            {
            }
        }

        PHP;

    /** Scratch directory for the fixture, removed in tearDown() even when the assertions fail. */
    private string $directory = '';

    protected function tearDown(): void
    {
        if ($this->directory !== '' && is_dir($this->directory)) {
            foreach (glob($this->directory . '/*') ?: [] as $file) {
                unlink($file);
            }
            rmdir($this->directory);
        }

        parent::tearDown();
    }

    public function testCsFixPreservesCommentOnlyBodiesButStillCollapsesEmptyOnes(): void
    {
        $repositoryRoot = dirname(__DIR__, 3);
        $binary = $repositoryRoot . '/vendor/bin/php-cs-fixer';
        $config = $repositoryRoot . '/.php-cs-fixer.php';

        if (!is_file($binary)) {
            self::markTestSkipped('php-cs-fixer is not installed; run composer install.');
        }

        $this->directory = sys_get_temp_dir() . '/phpstorm-stubs-cs-' . bin2hex(random_bytes(6));
        mkdir($this->directory);
        $file = $this->directory . '/Sample.php';
        file_put_contents($file, self::SOURCE);

        // The path argument overrides the config's Finder (--path-mode defaults to "override"), so
        // the repo rules are applied to this file alone. --using-cache=no keeps .php_cs.cache clean.
        $command = sprintf(
            '%s %s fix %s --config=%s --using-cache=no 2>&1',
            escapeshellarg(PHP_BINARY),
            escapeshellarg($binary),
            escapeshellarg($file),
            escapeshellarg($config)
        );

        $output = [];
        $exitCode = 0;
        exec($command, $output, $exitCode);
        $report = implode("\n", $output);

        self::assertSame(0, $exitCode, "php-cs-fixer failed:\n" . $report);

        $fixed = file_get_contents($file);

        self::assertStringContainsString(
            '// Intentionally empty: the parent already does the work.',
            $fixed,
            'A line comment that is a body\'s sole content must survive cs-fix'
        );
        self::assertStringContainsString(
            '/* keep this */',
            $fixed,
            'A block comment that is a body\'s sole content must survive cs-fix'
        );
        self::assertStringNotContainsString(
            'public function noOp(): void {}',
            $fixed,
            'A body holding a comment is not empty and must not be collapsed'
        );
        self::assertStringContainsString(
            'public function trulyEmpty(): void {}',
            $fixed,
            'A genuinely empty body must still be collapsed onto one line'
        );
    }
}
