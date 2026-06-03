<?php

namespace StubTests\Unit\Validator\Meta;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Validator\Meta\RegisteredArgumentsSetExistsCheck;

class RegisteredArgumentsSetExistsCheckTest extends TestCase
{
    public function testRegisteredSetFound(): void
    {
        $check = new RegisteredArgumentsSetExistsCheck(['mySet', 'otherSet']);
        $stubs = $this->createMock(\StubTests\Framework\Parsers\StubDataQueryInterface::class);

        $result = $check->run($stubs, 'mySet', '8.0');
        $this->assertFalse($result->hasFailures());
        $this->assertEquals(1, $result->getSuccessCount());
    }

    public function testUnregisteredSetFails(): void
    {
        $check = new RegisteredArgumentsSetExistsCheck(['mySet']);
        $stubs = $this->createMock(\StubTests\Framework\Parsers\StubDataQueryInterface::class);

        $result = $check->run($stubs, 'unknownSet', '8.0');
        $this->assertTrue($result->hasFailures());
        $this->assertStringContainsString('unknownSet', $result->getFailures()['unknownSet']);
    }

    public function testEmptyDefinedSetsAlwaysFails(): void
    {
        $check = new RegisteredArgumentsSetExistsCheck([]);
        $stubs = $this->createMock(\StubTests\Framework\Parsers\StubDataQueryInterface::class);

        $result = $check->run($stubs, 'anySet', '8.0');
        $this->assertTrue($result->hasFailures());
    }

    public function testSupportsAllVersions(): void
    {
        $check = new RegisteredArgumentsSetExistsCheck([]);
        $this->assertTrue($check->supports('5.6'));
        $this->assertTrue($check->supports('8.4'));
    }
}
