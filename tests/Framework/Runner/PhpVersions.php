<?php

namespace StubTests\Framework\Runner;

enum PhpVersions: string
{
    case PHP_5_6 = '5.6';
    case PHP_7_0 = '7.0';
    case PHP_7_1 = '7.1';
    case PHP_7_2 = '7.2';
    case PHP_7_3 = '7.3';
    case PHP_7_4 = '7.4';
    case PHP_8_0 = '8.0';
    case PHP_8_1 = '8.1';
    case PHP_8_2 = '8.2';
    case PHP_8_3 = '8.3';
    case PHP_8_4 = '8.4';

    case PHP_8_5 = '8.5';
    case PHP_8_6 = '8.6';
    const EARLIEST = self::PHP_5_6;
    const LATEST = self::PHP_8_6;

    /**
     * Narrows a version string to the PHP version it names, or null when this suite validates
     * no such version. A patch component is tolerated: `7.0.7` narrows to `7.0`.
     */
    public static function normalizePhpVersion(string $version): ?string
    {
        if (!preg_match('/^(\d+\.\d+)(?:\.\d+)?$/', $version, $matches)) {
            return null;
        }

        return self::tryFrom($matches[1])?->value;
    }
}
