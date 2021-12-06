<?php

namespace StubTests\Tools;

require_once 'ModelAutoloader.php';

ModelAutoloader::register();

use StubTests\TestData\Providers\ReflectionStubsSingleton;

$reflectionFileName = 'ReflectionData.json';
file_put_contents(__DIR__ . "/../../$reflectionFileName", serialize(ReflectionStubsSingleton::getReflectionStubs()));
