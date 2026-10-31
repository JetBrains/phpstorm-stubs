<?php

namespace StubTests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Every top-level test file must be listed in a phpunit.xml.dist test suite. CI runs the suites by
 * name, so an unlisted file is never run, and nothing reports that it stopped running.
 */
class TestSuiteRegistrationTest extends TestCase
{
    /**
     * @return iterable<string, array{string}>
     */
    public static function topLevelTestFileProvider(): iterable
    {
        foreach (glob(dirname(__DIR__) . '/*Test.php') ?: [] as $file) {
            yield basename($file) => [basename($file)];
        }
    }

    #[DataProvider('topLevelTestFileProvider')]
    public function testFileIsListedInATestSuite(string $fileName): void
    {
        $config = simplexml_load_file(dirname(__DIR__, 2) . '/phpunit.xml.dist');
        $listed = array_map('strval', $config->xpath('//testsuite/file') ?: []);

        self::assertContains("tests/{$fileName}", $listed, "tests/{$fileName} is not listed in any phpunit.xml.dist test suite, so CI never runs it.");
    }
}
