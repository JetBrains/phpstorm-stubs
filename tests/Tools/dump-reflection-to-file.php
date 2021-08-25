<?php
declare(strict_types=1);

namespace StubTests\TestData;

require_once __DIR__ . '/../../vendor/autoload.php';

use StubTests\TestData\Providers\ReflectionStubsSingleton;

$reflectionFileName = $argv[1];
file_put_contents(__DIR__ . "/../../$reflectionFileName", serialize(ReflectionStubsSingleton::getReflectionStubs()));
