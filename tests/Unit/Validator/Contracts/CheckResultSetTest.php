<?php

namespace StubTests\Unit\Validator\Contracts;

use PHPUnit\Framework\TestCase;
use StubTests\Framework\Validator\Contracts\CheckResultSet;

class CheckResultSetTest extends TestCase
{
    public function testEmptyResultSetHasNoFailures(): void
    {
        $results = new CheckResultSet();
        $this->assertFalse($results->hasFailures());
        $this->assertEmpty($results->getFailures());
        $this->assertEquals(0, $results->getFailureCount());
        $this->assertEquals(0, $results->getSuccessCount());
    }

    public function testAddSuccess(): void
    {
        $results = new CheckResultSet();
        $results->addSuccess('\\SomeClass');
        $this->assertEquals(1, $results->getSuccessCount());
        $this->assertFalse($results->hasFailures());
        $this->assertEquals(['\\SomeClass'], $results->getSuccesses());
    }

    public function testAddFailure(): void
    {
        $results = new CheckResultSet();
        $results->addFailure('\\SomeClass', 'Something went wrong');
        $this->assertTrue($results->hasFailures());
        $this->assertEquals(1, $results->getFailureCount());
        $this->assertEquals(['\\SomeClass' => 'Something went wrong'], $results->getFailures());
    }

    public function testMultipleFailuresForSameEntityJoinedWithNewline(): void
    {
        $results = new CheckResultSet();
        $results->addFailure('\\SomeClass', 'Error 1');
        $results->addFailure('\\SomeClass', 'Error 2');
        $this->assertEquals(1, $results->getFailureCount());
        $this->assertEquals(['\\SomeClass' => "Error 1\nError 2"], $results->getFailures());
    }

    public function testMultipleFailuresForDifferentEntities(): void
    {
        $results = new CheckResultSet();
        $results->addFailure('\\ClassA', 'Error A');
        $results->addFailure('\\ClassB', 'Error B');
        $this->assertEquals(2, $results->getFailureCount());
    }

    public function testMixedSuccessesAndFailures(): void
    {
        $results = new CheckResultSet();
        $results->addSuccess('\\Good');
        $results->addFailure('\\Bad', 'Failed');
        $results->addSuccess('\\AlsoGood');
        $this->assertTrue($results->hasFailures());
        $this->assertEquals(1, $results->getFailureCount());
        $this->assertEquals(2, $results->getSuccessCount());
    }
}
