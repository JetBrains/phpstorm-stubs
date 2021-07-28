<?php
declare(strict_types=1);

namespace StubTests\Parsers;

use phpDocumentor\Reflection\DocBlockFactory;
use StubTests\Model\Tags\RemovedTag;

class DocFactoryProvider
{
    /**
     * @var DocBlockFactory|null
     */
    private static $docFactory = null;

    public static function getDocFactory(): DocBlockFactory
    {
        if (self::$docFactory === null) {
            self::$docFactory = DocBlockFactory::createInstance(['removed' => RemovedTag::class]);
        }
        return self::$docFactory;
    }
}
