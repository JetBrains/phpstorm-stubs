<?php

namespace StubTests\TestData\Providers\Stubs;

use Generator;
use StubTests\TestData\Providers\PhpStormStubsSingleton;

class StubsCompositeMixedProvider
{
    public static function expectedFunctionsMixedFalseReturnProvider(): ?Generator
    {
        $functions = ['end', 'prev', 'next', 'reset', 'current'];
        foreach ($functions as $function) {
            yield $function => [PhpStormStubsSingleton::getPhpStormStubs()->getFunction($function)];
        }
    }

    public static function expectedFunctionsMixedNullReturnProvider(): ?Generator
    {
        $functions = ['array_pop', 'array_shift'];
        foreach ($functions as $function) {
            yield $function => [PhpStormStubsSingleton::getPhpStormStubs()->getFunction($function)];
        }
    }
}
