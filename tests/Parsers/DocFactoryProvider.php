<?php
declare(strict_types=1);

namespace StubTests\Parsers;

use phpDocumentor\Reflection\DocBlockFactory;

class DocFactoryProvider
{
    private static $docFactory;

    public static function getDocFactory(): DocBlockFactory
    {
        if (self::$docFactory === null) {
            self::$docFactory = DocBlockFactory::createInstance();
        }
        return self::$docFactory;
    }
}
