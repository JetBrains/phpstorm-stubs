<?php

namespace StubTests\Unit\Runner;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use StubTests\Framework\Runner\PhpVersions;

class PhpVersionsTest extends TestCase
{
    public static function phpVersionNormalizationProvider(): array
    {
        return [
            'known minor' => ['8.4', '8.4'],
            'earliest supported' => ['5.6', '5.6'],
            'patch narrows to minor' => ['7.0.7', '7.0'],
            'PHP version older than the suite covers' => ['5.3', null],
            'library version' => ['2.3.0', null],
            // Deliberately a version that can never be added to PhpVersions. Using a plausible
            // next release (9.0) would turn this case into a false failure the day it ships.
            'unrecognised version' => ['99.0', null],
            'not a version' => ['use g() instead', null],
            'empty' => ['', null],
        ];
    }

    #[DataProvider('phpVersionNormalizationProvider')]
    public function testItNormalizesOnlyKnownPhpVersions(string $version, ?string $expected): void
    {
        self::assertSame($expected, PhpVersions::normalizePhpVersion($version));
    }

    /**
     * Guards the boundary the `@_deprecated` filter silently depends on. If the newest supported
     * version ever stopped being recognised, every `@_deprecated <newest>` would collapse to null —
     * i.e. to "deprecated in every version" — which is the widest possible claim and the opposite
     * of what the tag says. The failure would otherwise be silent.
     */
    public function testItNormalizesTheNewestAndOldestSupportedPhpVersions(): void
    {
        $latest = PhpVersions::LATEST->value;
        $earliest = PhpVersions::EARLIEST->value;

        self::assertSame($latest, PhpVersions::normalizePhpVersion($latest));
        self::assertSame($earliest, PhpVersions::normalizePhpVersion($earliest));
    }
}
