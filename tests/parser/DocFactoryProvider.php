<?php

namespace Parsers;

use phpDocumentor\Reflection\DocBlockFactory;

class DocFactoryProvider
{
    private static $docFactory;

    public static function getDocFactory()
    {
        if (self::$docFactory === null) {
            self::$docFactory = DocBlockFactory::createInstance();
        }
        return self::$docFactory;
    }
}