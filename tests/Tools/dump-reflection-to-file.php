<?php
declare(strict_types=1);

namespace StubTests\TestData;

require_once __DIR__ . '/../../vendor/autoload.php';

use StubTests\TestData\Providers\ReflectionStubsSingleton;

if (empty(getenv('NO_PECL'))) {
    file_put_contents(__DIR__ . '/../../ReflectionData.json', serialize(ReflectionStubsSingleton::getReflectionStubs()));
} else {
    file_put_contents(__DIR__ . '/../../ReflectionDataNoPecl.json', serialize(ReflectionStubsSingleton::getReflectionStubs()));
}
