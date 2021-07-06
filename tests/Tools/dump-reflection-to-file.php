<?php
declare(strict_types=1);

namespace StubTests\TestData;

require_once __DIR__ . '/../../vendor/autoload.php';

use StubTests\TestData\Providers\ReflectionStubsSingleton;

file_put_contents(__DIR__ . '/../../ReflectionData.json', serialize(ReflectionStubsSingleton::getReflectionStubs()));
