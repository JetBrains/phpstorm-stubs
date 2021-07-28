<?php
declare(strict_types=1);

namespace StubTests\TestData\Providers;

use StubTests\Model\StubsContainer;
use StubTests\Parsers\PHPReflectionParser;

class ReflectionStubsSingleton
{
    /**
     * @var StubsContainer|null
     */
    private static $reflectionStubs = null;

    /**
     * @var StubsContainer|null
     */
    private static $peclReflectionStubs = null;

    public static function getReflectionStubs(): StubsContainer
    {
        if (self::$reflectionStubs === null) {
            self::$reflectionStubs = PHPReflectionParser::getStubs();
        }
        return self::$reflectionStubs;
    }

    public static function getReflectionStubsNoPecl(): StubsContainer
    {
        if (self::$peclReflectionStubs === null) {
            if (file_exists(__DIR__ . '/../../ReflectionDataNoPecl.json')) {
                self::$reflectionStubs = unserialize(file_get_contents(__DIR__ . '/../../../ReflectionDataNoPecl.json'));
            }
        }
        return self::$reflectionStubs;
    }
}
